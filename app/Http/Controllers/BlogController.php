<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Validator;
use App\Models\Blog\Blog;
use App\Models\User\User;

/**
 * BlogController
 *
 * @uses Controller
 * PHP version 7
 *
 * @category
 * @package
 * @author    Qinjianbo <279250819@qq.com>
 * @copyright 2016-2019 boboidea Co. All Rights Reserved.
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   GIT:<git_id>
 * @link      https://www.boboidea.com
 */
class BlogController extends Controller
{
    /**
     * save
     *
     * @param Request $request
     * @param mixed $id
     *
     * @access public
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'user_id' => 'required|numeric|min:1',
            'content' => 'required|string',
            'description' => 'sometimes|string',
            'type' => 'required|numeric|in:1,2',
            'device' => 'required|string|in:pc,h5,ios,android',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        $key = sprintf('user_%s_%s', $request->get('user_id'), $request->get('device'));
        if (($user = collect(Cache::get($key)))->isNotEmpty()) {
            if ($blog = (new Blog())->updateMine(collect($request->input()), $id)) {
                return $this->result($id);
            } else {
                return $this->result(collect(), '添加失败', 100);
            }
        }

        return $this->result(collect(), '请先登录');
    }

    /**
     * create
     *
     * @param Request $request
     *
     * @access public
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:1|max:255',
            'user_id' => 'required|string',
            'content' => 'required|string|min:1',
            'type'    => 'required|numeric|in:1,2',
            'description' => 'sometimes|string|min:1|max:255',
            'device' => 'required|string|in:pc,h5,ios,android',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        $key = sprintf('user_%s_%s', $request->get('user_id'), $request->get('device'));
        if (($user = collect(Cache::get($key)))->isNotEmpty()) {
            if ($blog = (new Blog())->createMine(
                    collect($request->input())->merge(['user_id' => $user['user_id']])
                )) {
                return $this->result(collect($blog)->only(['id']));
            } else {
                return $this->result(collect(), '添加失败', 100);
            }
        }

        return $this->result(collect(), '请先登录');
    }

    /**
     * delete
     *
     * @param Request $request
     * @param mixed $user_id
     * @param mixed $id
     *
     * @access public
     *
     * @return mixed
     */
    public function delete(Request $request, $user_id, $id)
    {
        $key = sprintf('user_%s_%s', $user_id, $request->get('device', 'pc'));

        if (($user = Cache::get($key))->isNotEmpty()) {
            if ((new Blog())->deleteMine($user_id, $id)) {
                return $this->result(collect(), '删除成功');
            } else {
                return $this->result(collect(), '删除失败');
            }
        }

        return $this->result(collect(), '请先登录');
    }

    /**
     * get
     *
     * @param Request $request
     * @param mixed $id
     *
     * @access public
     *
     * @return mixed
     */
    public function get(Request $request, $id)
    {
        return (new Blog())->show(collect($request->input()), $id);
    }

    /**
     * list
     *
     * @param Request $request
     *
     * @access public
     *
     * @return mixed
     */
    public function list(Request $request)
    {
        return $this->result(collect([
                'list' => (new Blog())->list(collect($request->input()))->pipe(function ($blogs) {
                    $users = (new User())->listByIds($blogs->pluck('user_id')->implode(','))->keyBy('id');

                    return $blogs->map(function ($blog) use ($users) {
                        $blog['nickname'] = $users[$blog['user_id']]['nickname'];

                        return $blog;
                    });
                }),
                'count' => (new Blog())->count(collect($request->input()))
            ]), '获取成功');
    }
    
    /**
     * show
     * 
     * @param Request $request
     * @param int $id
     *
     * @access public
     *
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        // 阅读量增加
        (new Blog())->where('id', $id)->increment('reading', 1);

        return view('blog_detail', ['blog' => (new Blog())->show(collect($request->input), $id)]);
    }
}
