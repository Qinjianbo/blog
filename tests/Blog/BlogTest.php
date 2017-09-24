<?php

namespace Tests\Blog;

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
class BlogTestCase extends TestCase
{
    /**
     * testCreate 
     * 
     * 
     * @access public
     * 
     * @return mixed
     */
    public function testCreate()
    {
        $response = $this->post(
            '/api/home/v1/user/blog',
            [
                'user_id' => 'c4ca4238a0b923820dcc509a6f75849b',
                'content' => '* 我来测试一下插入一篇博文的内容',
                'title' => '# 这是这篇博文的标题',
                'description' => '这是这篇博文的描述信息',
                'type' => 1,
                'device' => 'pc',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);
    }

    public function testList()
    {
        $response = $this->get(
            '/api/home/v1/blogs',
            [
                'page' => 1,
                'size' => '12',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);
    }
}
