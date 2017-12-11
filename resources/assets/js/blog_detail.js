// 该js 暂时无用
import {markdown} from 'markdown';

function parseBlogContent()
{
    var blog_content = $("#content_hidden").val();
    $("#body-content").html(markdown.toHTML(blog_content));
    console.log(markdown.toHTML(blog_content));
}

parseBlogContent();
