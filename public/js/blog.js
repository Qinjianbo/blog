function getBlogs(page, size)
{
  var page = page;
  var size = size;
  var uri = "api/home/v1/blogs";
  $.ajax({
    url:uri,
    data:{
      page:page,
      size:size
    },
    success:function (data) {
      if (data.code == 0) {
        var j = 0;
        var data = data.data;
        for (var i = 0; i < data.list.length; i++) {
            var col = $('<div class="col-sm-4"></div>');
            var panel = $('<div class="panel panel-default"></div>');
            var panelHeading = $('<div class="panel-heading"></div>');
            var panelBody = $('<div class="panel-body"></div>');
            var panelFooter = $('<div class="panel-footer"></div>');
            var nicknameSpan = $('<span></span>');
            var readNumSpan = $('<span class="pull-right"></span>')
            panelHeading.html(data.list[i].title);
            panelBody.html(data.list[i].description);
            nicknameSpan.html('Author:' + data.list[i].nickname);
            readNumSpan.html('Read:' + data.list[i].reading);
            panelFooter.append(nicknameSpan);
            panelFooter.append(readNumSpan);
            panel.append(panelHeading);
            panel.append(panelBody);
            panel.append(panelFooter);
            col.append(panel);
            j++;
          if ((i + 1) % 3 == 1) {
            var row = $("<div class='row'></div>");
            row.append(col);
          } else {
            row.append(col);
          }
          if (j == 3) {
            $(".blog-body").append(row);    
            j = 0;
          }
        } 
        $("#page").val(parseInt(page) + 1);
        $("#totalPage").val(Math.ceil(parseInt(data.count)/size));
      } else {
        console.log(data);    
      }
    },
    error:function (data) {
      console.log(data);    
    }
  });
}
getBlogs(1, 9);

function loadBlog()
{
    var winH = $(window).height();
    var scrollTop = $(window).scrollTop();
    var offsetTop = $(".blog-body").height();
    console.log(winH);
    console.log(scrollTop);
    console.log(offsetTop);
    if (offsetTop < scrollTop + winH) {
        var page = $("#page").val();
        var totalPage = $("#totalPage").val();
        var size = 9;
        if (page <= totalPage) {
            getBlogs(page, size);
        }
    }
}
$(window).scroll(function() {
    loadBlog(); 
});
