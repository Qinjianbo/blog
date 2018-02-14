import {markdown} from 'markdown';

$("#parsing_content").html(markdown.toHTML($('#content').val()));

$("#content").bind("input propertychange", function () {
    $("#parsing_content").html(markdown.toHTML($(this).val()));
});

$("#submit_btn").bind("click", function () {
    submit();
});
function submit()
{
    var blog_id = $("#blog_id").val();
    var title = $("#title").val();
    var description = $("#description").val();
    var content = $("#content").val();
    var type = $("#type").is(":checked") ? 1 : 0;
    if (title == "") {
        alert("请输入博文标题");
        return false;
    }
    if (description == "") {
        alert("请输入博文简介");
        return false;
    }
    if (content == "") {
        alert("请输入博文内容");
        return false;
    }
    var uid = $.cookie("uid");
    console.log(uid);
    if (uid == "" || uid == undefined) {
        alert("登陆超时或没有登陆，请先登陆");
        $("#signin_modal").modal('show');
        return false;
    }
    if (blog_id != 0 && blog_id != undefined) {
        var uri = "/api/home/v1/user/blog/" + blog_id;
        var requestType = "put";
    } else {
        var uri = "/api/home/v1/user/blog";
        var requestType = "post";
    }
    console.log(uri);
    $.ajax({
        url: uri,
        type:requestType,
        dataType:"json",
        data:{
            "user_id":uid,
            "title":title,
            "description":description,
            "content":content,
            "type":type,
            "device":"pc"
        },
        success:function (data) {
            if (data.code == 0) {
                alert("博文更新或发表成功");
                location.href = "/my/blogs";
            } else if (data.code == 100) {
                alert("博文发表失败");
            } else if (data.code == 101) {
                console.log(data.msg);
            } else if (data.code == 102) {
                alert(data.msg);
                $("#signin_modal").modal('show');
            }
        },
        error:function (data) {
            alert("请检查网络");
            console.log(data);
        }
    }); 
}
