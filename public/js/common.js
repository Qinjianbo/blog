$("#signin_btn").bind("click", function () {
  var username = $("#username_signin").val();
  var password = $("#password_signin").val();
  var uri = "/api/home/v1/session";
  $.ajax({
    url: uri,
    data: {
        username: username,
        password: password,
        device: "pc"
    },
    type: "POST",
    dataType: "json",
    success: function(data) {
      if (data.code == 0) {
          alert(data.msg);    
          $("#before_signin").addClass("hidden");
          $("#after_signin").removeClass("hidden");
          $("#signin_modal").modal('hide');
          $("#nickname").text(data.data.username);
          if (data.data.avatar_url != "") {
              $("#after_signin #dLabel img").attr("src", data.data.avatar_url);    
          }

          // 将uid 存入cookie
          $.cookie('uid', data.data.id, {expires: 1, path: '/'});
      } else if (data.code == 100) {
          alert(data.msg);    
      } else if (data.code == 101) {
          console.log(data.msg);    
      }
    },
    error: function (data) {
      console.log(data);    
    }
  });
});

$("#register_btn").bind("click", function () {
  var username = $("#username_reg").val();
  var password = $("#password_reg").val();
  var uri = "/api/home/v1/user";
  $.ajax({
    url: uri,
    data: {
      username: username,
      password: password,
      device: "pc"
    },
    type: "POST",
    dataType: "json",
    success: function (data) {
        if (data.code == 0) {
          alert(data.msg);    
          $("#register_modal").modal('hide');
        } else if (data.code == 100) {
          alert(data.msg);    
        } else {
          console.log(data.msg);      
        }
    },
    error: function (data) {
      console.log(data); 
    }
  });
});

$("#signout_btn").bind("click", function () {
  var uid_hidden = ("#uid_hidden").val();
  var uri = "/api/home/v1/session/" + uid_hidden + "/pc";
  $.ajax({
    url: uri,
    data: {
    },
    type: "DELETE",
    dataType: "json",
    success: function (data) {
      if (data.code == 0) {
        alert(data.msg);
        window.location.reload();
      } else if (data.code == 100) {
        alert(data.msg);    
      }
    },
    'error': function (data) {
       console.log(data); 
    }
  });    
});

