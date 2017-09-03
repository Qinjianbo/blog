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
        for (var i = 0; i < data.list.length; i++) {
          if ((i + 1) % 3 == 1) {
            var row = $("<div class='row'></div>");
          } else {
            var col = $("")      
          }
        } 
      } else {
        console.log(data);    
      }
    },
    error:function (data) {
      console.log(data);    
    }
  });
}

function loadBlog()
{
    var winH = $(window).height();
    var scrollTop = $(window).scrollTop();
    var offsetTop = $(".blog-body").height();
    console.log(winH);
    console.log(scrollTop);
    console.log(offsetTop);
    if (offsetTop < scrollTop + winH) {
    }
}
$(window).scroll(function() {
    loadBlog(); 
});
