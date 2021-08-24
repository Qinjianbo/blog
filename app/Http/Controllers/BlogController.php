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
     * update 更新博文
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
            'user_id' => 'required|integer|min:1',
            'content' => 'required|string',
            'description' => 'sometimes|string',
            'type' => 'required|numeric|in:0,1',
            'device' => 'required|string|in:pc,h5,ios,android',
            'tags' => 'required|string',
            'is_url' => 'required|numeric|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        if ($blog = (new Blog())->updateMine(collect($request->input()), $id)) {
            return $this->result(collect(['id' => $id]), '更新成功');
        }

        return $this->result(collect(), '更新失败', 100);
    }

    /**
     * create 创建博文
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
            'user_id' => 'required|integer|min:1',
            'content' => 'required|string|min:1',
            'type'    => 'required|numeric|in:1,0',
            'description' => 'sometimes|string|min:1|max:255',
            'device' => 'required|string|in:pc,h5,ios,android',
            'tags' => 'required|string',
            'is_url' => 'required|numeric|in:0,1',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }
        $input = collect($request->input());

        if ($blog = (new Blog())->createMine($input)) {
            return $this->result(collect($blog)->only(['id']));
        }
        return $this->result(collect(), '添加失败', 100);
    }

    /**
     * delete 删除博文
     *
     * @param Request $request
     * @param mixed $user_id
     * @param mixed $id
     *
     * @access public
     *
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
         if ((new Blog())->deleteMine($request->get('user_id'), $id)) {
             return $this->result(collect(), '删除成功');
         }
         return $this->result(collect(), '删除失败');
    }

    /**
     * get 获取指定Id的博文，不增加阅读量 
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
        return $this->result(
            (new Blog())->show(collect($request->input()), $id),
            '数据获取成功'
        );
    }

    /**
     * list 博文列表
     *
     * @param Request $request
     *
     * @access public
     *
     * @return mixed
     */
    public function list(Request $request)
    {
        $result = $this->doSearch(collect($request->input()));
        $list = collect($result->get('list'));
        $count = $result->get('count', 0);
        if ($list->isEmpty() && !$request->get('q', '')) {
            $list = (new Blog())->list(
                collect([
                'page' => $request->input('page', 1),
                'size' => $request->input('pageSize', 40)])
            );
            $count = (new Blog())->count(collect());
        }
        if ($list->isNotEmpty()) {
            $authors = (new User())->listByIds($list->pluck('user_id')->unique()->implode(','))->keyBy('id');

            $list = $list->map(function ($item) use ($authors) {
                $item['nickname'] = $authors[$item['user_id']]['nickname'];
                $item['tags'] = explode(',', $item['tags']);

                return $item;
            });
        }

        if ($request->ajax()) {
            return $this->result(collect(['list' => $list, 'count' => $count]), '获取成功');
        } else {
            $pagination = (new Blog())->paginate(
                $count,
                $request->input('pageSize', 40),
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
     * doSearch 请求搜索服务
     *
     * @param Illuminate\Support\Collection $params
     *
     * @return Illuminate\Support\Collection
     */
    public function doSearch(Collection $params)
    {
        $url = sprintf(
            '%s/%s?p=%d&ps=%d&q=%s',
            config('app.search_url'),
            'api/search/v1/blogs',
            $params->get('page', 1),
            $params->get('pageSize', 40),
            $params->get('q', '')
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
            return collect();
        }

        return $result;
    }

    /**
     * show 获取指定博文
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
        $blog = (new Blog())->show(collect($request->input), $id, true);
        if ($blog->isEmpty()) {
            return view('404');
        }
        // 阅读量增加
        (new Blog())->where('id', $id)->increment('reading', 1);

        return view('blog.blog_detail', ['blog' => $blog]);
    }

    /**
     * edit 编辑博文跳转
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
     * myList 获取我的博文列表
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function myList(Request $request): Collection
    {
        $list = (new Blog())->list(collect($request->input())->merge(['select' => 'id,title,reading,user_id,created_at,tags,content']))
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
