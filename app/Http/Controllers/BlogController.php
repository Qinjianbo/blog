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
            'user_id' => 'required|string',
            'content' => 'required|string',
            'description' => 'sometimes|string',
            'type' => 'required|numeric|in:1,2',
            'device' => 'required|string|in:pc,h5,ios,android',
            'tags' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        $key = sprintf('user_%s_%s', $request->get('user_id'), $request->get('device'));
        if (($user = collect(Cache::get($key)))->isNotEmpty()) {
            if ($blog = (new Blog())->updateMine(collect($request->input()), $id)) {
                return $this->result(collect(['id' => $id]), '更新成功');
            } else {
                return $this->result(collect(), '更新失败', 100);
            }
        }

        return $this->result(collect(), '请先登录', 102);
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
            'type'    => 'required|numeric|in:1,0',
            'description' => 'sometimes|string|min:1|max:255',
            'device' => 'required|string|in:pc,h5,ios,android',
            'tags' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }
        $input = collect($request->input());

        $key = sprintf('user_%s_%s', $request->get('user_id'), $request->get('device'));
        if (($user = collect(Cache::get($key)))->isNotEmpty()) {
            if ($blog = (new Blog())->createMine(
                    $input->merge(['user_id' => $user['user_id']])
                )) {
                return $this->result(collect($blog)->only(['id']));
            } else {
                return $this->result(collect(), '添加失败', 100);
            }
        }

        return $this->result(collect(), '请先登录', 102);
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
        $url = sprintf(
            '%s/%s?p=%d&ps=%d&q=%s',
            config('app.search_url'),
            'api/search/v1/blogs',
            $request->input('page', 1),
            $request->input('pageSize', 30),
            $request->input('q', '')
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = collect(json_decode(curl_exec($curl), true));
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);
        if ($curl_errno > 0) {
            info('curl error '.$curl_error);
        } else {
            $esList = collect($result->get('list'));
            $list = $esList->pipe(function ($list) use ($request) {
                if ($list->isEmpty() && !$request->get('q', '')) {
                    $list = (new Blog())->list(
                        collect([
                        'page' => $request->input('page', 1),
                        'size' => $request->input('pageSize', 30)])
                    );
                }
                $authors = (new User())->listByIds($list->pluck('user_id')->unique()->implode(','))->keyBy('id');
                return $list->map(function ($item) use ($authors) {
                    $item['nickname'] = $authors[$item['user_id']]['nickname'];
                    $item['tags'] = explode(',', $item['tags']);

                    return $item;
                });
            });
            $count = $result->get('count', 0);
            if ($esList->isEmpty()) {
                $count = (new Blog())->count(collect());
            }
        }
        if ($request->ajax()) {
            return $this->result(collect(['list' => $list, 'count' => $count]), '获取成功');
        } else {
            $pagination = (new Blog())->paginate(
                $count,
                $request->input('pageSize', 30),
                $request->input('page', 1)
            );
            return view('blog.blogs', [
                'list' => $list,
                'count' => $count,
                'pagination' => $pagination,
                'q' => $request->input('q', ''),
                'styles' => config('app.styles'),
            ]);
        }
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

        return view(
            'blog.blog_detail',
            [
                'blog' => (new Blog())->show(collect($request->input), $id, true)
            ]
        );
    }

    /**
     * edit
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        return view(
            'blog.edit_blog',
            [
                'blog' => (new Blog())->show(collect($request->input), $id)
            ]
        );
    }

    /**
     * myList
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function myList(Request $request): Collection
    {
        $uid = $request->input('uid', '');
        $device = $request->input('device', 'pc');
        $key = sprintf('user_%s_%s', $uid, $device);
        $user = Cache::get($key);
        $uid = $user['user_id'] ?? 0;
        if (!$uid) {
            return $this->result(collect(), '登录超时或未登录', 100);
        }
        $list = (new Blog())->list(collect($request->input())->merge(['user_id' => $uid, 'select' => 'id,title,reading,user_id']))
             ->pipe(function ($blogs) {
                 $users = (new User())->listByIds($blogs->pluck('user_id')->unique()->implode(','))->keyBy('id');
 
                 return $blogs->map(function ($blog) use ($users) {
                     $blog['nickname'] = $users[$blog['user_id']]['nickname'];

                     return $blog;
                 });
             });
        $count = (new Blog())->count(collect($request->input()));
         
        return $this->result(collect(['list' => $list, 'count' => $count]), '获取成功');
    }
}
