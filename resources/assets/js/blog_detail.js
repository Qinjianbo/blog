import {markdown} from 'markdown';

function parseBlogContent()
{
    var content = "- 表锁（TABLE LOCK）> 表锁类似于上面示例中的第一种方案，给整个餐厅设立一个守卫。它是开销最小的策略，当某一个用户对一张表进行增、删、改的时候，就会给这个表加上一个写锁，这样其他用户在同一时段就不能对该表进行读写了。只有这个写操作执行完成释放了写锁后，其他用户才能对这个表进行其他的操作。";
    var blog_content = $("#content_hidden").html();
    $("#body-content").html(markdown.toHTML(blog_content));
    console.log(markdown.toHTML(content));
}

parseBlogContent();
