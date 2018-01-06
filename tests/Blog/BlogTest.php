<?php

namespace Tests\Blog;

use Tests\TestCase;

/**
 * BlogTestCase  
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

    public function testCreateFirstBlog()
    {
        $response = $this->post(
            '/api/home/v1/user/blog',
            [
                'user_id' => 'c4ca4238a0b923820dcc509a6f75849b',
                'content' => '# 【MySQL】并发控制

## 1.读写锁

### 1.1 读写锁的概念
- ** 读锁（READ LOCK）：也叫共享锁，即读锁是共享的，是相互不阻塞的。比如东方明珠，同一时刻站在东方明珠下面的人都可以看见它，不用任何等待，你看的同时也不会影响其他人看。你们看到的是同一个资源，但却不用互相等待。 **

- ** 写锁（WRITE LOCK）：也叫排他锁，即写锁是排他的，是相互阻塞的。比如东方明珠里面的厕所，同一个坑在某一时间段内只能供一位游客使用，其他游客就只能等着。 **

### 1.2 读写锁的意义

- ** 实现并发控制，解决读写互相干扰的问题。 **

## 2.锁粒度

### 1.1 什么是锁粒度
- ** 锁粒度就是锁的级别，锁能锁定的层次范围。 **

> 假设一家餐厅同一时间段一张桌子只允许一个客人用餐，那么这个餐厅要保证这一个条件，可以有以下几种选择：

> 1.在大门口设立一个守卫（加一把锁），同一时间段只放一个客人进去，让他选一个桌子吃饭。这样整个餐厅都只有一个人，那他选择哪个桌子吃饭，都可以实现同一时间段内一张桌子只有一个客人用餐。当这个客人吃好后，离开饭店，守卫才会放下一个人进来。

> 2.在大门口不设立守卫，当客人进入餐厅选择一个桌子坐下后，就给这个桌子设立一个守卫（加上一把锁），其他人再进来，桌子旁边如果有守卫，守卫就会阻止这个人在这张桌子就餐。等该桌客人吃完后，将守卫撤走（释放锁），其他人才可以继续选择这个桌子。这种办法同样可以实现同一个时间段内一张桌子只有一个客人用餐。

> 以上示例中锁粒度就体现在 **大门口设立守卫** 和 **餐桌旁这里守卫** ，同时我们也可以看出不同的锁粒度会影响同一时段内整个餐厅内的就餐人数，即一种 **并发数** 。第一种方式在 **守卫管理** （锁管理）上面会消耗更少的资源，也只需要发一个守卫的工资就够了。而如果没有一个餐桌被客人占用就增加守卫的方式，则明显会增加工资支出，同时对于守卫的管理也要付出更多的精力。但是也很明显，一个守卫的方式明显会大大减少同一时段内餐厅的就餐人数，使餐厅收入大大降低。所以这就需要一种 **权衡** 了。我们在使用数据库的锁时也是一样，在锁粒度上面要进行一定的权衡。

### 1.2 锁粒度

- 表锁（TABLE LOCK）

> 表锁类似于上面示例中的第一种方案，给整个餐厅设立一个守卫。它是开销最小的策略，当某一个用户对一张表进行增、删、改的时候，就会给这个表加上一个写锁，这样其他用户在同一时段就不能对该表进行读写了。只有这个写操作执行完成释放了写锁后，其他用户才能对这个表进行其他的操作。

> ** 注意： ** 尽管存储引擎可以管理自己的锁，MySQL 本身还是会使用各种有效的表锁来实现不同的目的。例如：服务器会为诸如 **ALTER TABLE** 之类的语句使用表锁，而忽略存储引擎的锁机制。

- 行锁（ROW LOCK)【InnoDB & XtraDB】

> 行锁则类似与上面示例中的第二种方案，行锁会带来最大的锁开销，但是可以最大程度的支持并发处理。行级锁仅在存储引擎层实现，而MySQL 服务层没有实现。
',
                'title' => '【MySQL】并发控制',
                'description' => '【MySQL】并发控制相关知识简记',
                'type' => 1,
                'device' => 'pc',
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure(['data', 'code', 'msg']);
        $response->assertJson(['code' => 0]);
    }
}
