<?php

namespace App\Models\User;

use App\Models\Model;

/**
 * User 
 * 
 * @uses Model
 * PHP version 7
 * 
 * @category  
 * @package   App\Models\User
 * @author    Qinjianbo <279250819@qq.com> 
 * @copyright 2016-2019 boboidea Co. All Rights Reserved.
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @version   GIT:<git_id>
 * @link      https://www.boboidea.com
 */
class User extends Model
{
    /**
     * signin 
     * 
     * @param string $username 
     * @param string $password 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function signin(string $username, string $password)
    {
        return self::where([
                'username' => $username,
                'password' => md5($password)]
            )
            ->first();
    }
}
