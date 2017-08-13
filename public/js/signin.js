var signin_btn = $("#signin_btn");
signin_btn.bind("click", function () {
  alert('signin'); 
  var username = $("#username").val();
  var password = $("#password").val();
  var uri = "/api/home/v1/session";
  $.ajax({
    url: uri,
    data: {
        username: username,
        password: password,
        device: "pc"
    },
    type: "post",
    dataType: "json",
    success: function(data) {
        if (data.code == 0) {
            alert(data.msg);    
            $("#before_signin").addClass("hidden");
            $("#after_signin").removeClass("hidden");
            $("#signin_modal").modal('hide');
        } else if (data.code == 100) {
            alert(data.msg);    
        } else if (data.code == 101) {
            console.log(data.data);    
        }
    },
    error: function (data) {
      console.log(data);    
    }
  });
});
