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
    public function save(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'user_id' => 'required|numeric|min:1',
            'content' => 'required|string',
            'description' => 'sometimes|string',
            'type' => 'sometimes|in:1,2',
        ];
    }
}

