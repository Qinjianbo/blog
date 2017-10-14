import {markdown} from 'markdown';

function getProfile()
{
    $.ajax({
        url:'/profile',
        success:function(data) {
            $(".profile").html(markdown.toHTML(data));
        },
        error:function(data) {
            alert("请检查网络");
        }
    });
}

getProfile();
