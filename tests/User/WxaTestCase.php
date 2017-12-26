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
    public function testCode2Session()
    {
        $response = $this->post(
            '/api/wxa/v1/session',
            [
                'code' => 'a mock one',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);
    }
}
