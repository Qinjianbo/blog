<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
            'content' => 'required|string|min:1|max:255',
            'type'    => 'required|numeric|in:1,2',
            'description' => 'sometimes|string|min:1|max:255',
            'device' => 'required|string|in:pc,h5,ios,android',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();

            return $this->result(collect(), collect($errors), 101);
        }

        if ($blog = (new Blog())->create($request->input())) {
            return $this->result($blog->only(['id']));    
        }

        return $this->result(collect(), '添加失败', 100);
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
             
        }
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
        
    }
}
