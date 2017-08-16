<?php

namespace Tests\User;

use Tests\TestCase;

/**
 * UserTestCase  
 * 
 * @uses TestCase
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
class UserTestCase extends TestCase
{
    /**
     * testSignup 
     * 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function testSignup()
    {
        $username = date('YmdHis', time());
        $response = $this->post(
            '/api/home/v1/user',
            [
                'username' => $username,
                'password' => 'abcqwe',
                'device'   => 'pc',
            ]
        );
       
        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);

        return $username;
    }

    /**
     * testSignin 
     * 
     * 
     * @access public
     * 
     * @return mixed
     */
     /**
      * @depends testSignup
      */
    public function testSignin(string $username)
    {
        $response = $this->post(
            '/api/home/v1/session',
            [
                'username' => $username,
                'password' => 'abcqwe',
                'device'   => 'pc',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);

        $content = json_decode($response->getContent(), true);

        return $content['data']['id'];
    }

    /**
     * testIsSignin 
     * 
     * @param string $id 
     * 
     * @access public
     * 
     * @return mixed
     */
     /**
      * @depends testSignin
      */
    public function testIsSignin(string $id)
    {
        $response = $this->get(
            sprintf('/api/home/v1/session/%s/%s', $id, 'pc')
        );   

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);

        return $id;
    }


    /**
     * testSignout 
     * 
     * 
     * @access public
     * 
     * @return mixed
     */
     /**
      * @depends testIsSignin
      */
    public function testSignout(string $id)
    {
        $response = $this->delete(
            sprintf('/api/home/v1/session/%s/%s', $id, 'pc')
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);
    }
}
