function getBlogs(page, size)
{
  var uri = "https://www.boboidea.com/api/home/v1/user/blogs";
  var uid = $.cookie("uid");
  $.ajax({
    url:uri,
    data:{
      user_id:uid,
      page:page,
      size:size,
      device:'pc'
    },
    success:function (data) {
      if (data.code == 0) {
        var isLessThanThree = true;
        for (var i = 0; i < data.data.list.length; i++) {
            var col = $('<div class="col-sm-4"></div>');
            var panel = $('<div class="panel panel-default"></div>');
            var panelHeading = $('<div class="panel-heading"></div>');
            var panelFooter = $('<div class="panel-footer"></div>');
            var readNumSpan = $('<span class="pull-right"></span>')
            var blogHref = $('<a target="_blank"></a>');
            var operators = $('<a tagrant="_blank">编辑</a>');
            blogHref.html(data.data.list[i].title);
            blogHref.attr("href", "/blog/" + data.data.list[i].id);
            operators.attr("href", "/blog/edit/" + data.data.list[i].id);
            panelHeading.html(blogHref);
            readNumSpan.html('<span class="glyphicon glyphicon-eye-open"></span>&nbsp;' + data.data.list[i].reading);
            panelFooter.append(operators);
            panelFooter.append(readNumSpan);
            panel.append(panelHeading);
            panel.append(panelFooter);
            col.append(panel);
          if ((i + 1) % 3 == 1) {
            var row = $("<div class='row'></div>");
            row.append(col);
          } else {
            row.append(col);
          }
          if ((i%3) == 0) {
              isLessThanThree = false;
          }
          if (!isLessThanThree) {
            $(".my-blog-body").append(row);    
            isLessThanThree = true;
          }
        } 
        $("#page").val(parseInt(page) + 1);
        $("#totalPage").val(Math.ceil(parseInt(data.data.count)/size));
      } else if(data.code == 102) {
        alert(data.msg);
        location.href = "http://dev.boboidea.com";
      } else {
        console.log(data);    
      }
    },
    error:function (data) {
      console.log(data);    
    }
  });
}
getBlogs(1, 24);

function loadBlog()
{
    var winH = $(window).height();
    var scrollTop = $(window).scrollTop();
    var offsetTop = $(".my-blog-body").height();
    var bottom = 50;
    if ((bottom + scrollTop) >= (offsetTop - winH)) {
        var page = $("#page").val();
        var totalPage = $("#totalPage").val();
        var size = 24;
        if (page <= totalPage) {
            getBlogs(page, size);
        }
    }
}
$(window).scroll(function() {
        loadBlog(); 
});
