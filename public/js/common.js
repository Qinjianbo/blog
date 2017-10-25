$("#signin_btn").bind("click", function () {
  var username = $("#username_signin").val();
  var password = $("#password_signin").val();
  if (username == "") {
    alert("请输入用户名");
    return false;
  }
  if (password == "") {
    alert("请输入密码");
    return false;
  }
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
          $("#nickname").text(data.data.nickname);
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
  var nickname = $("#nickname_reg").val();
  var uri = "/api/home/v1/user";
  if (username == "") {
    alert("请输入用户名");
    return false;
  }
  if (password == "") {
    alert("请输入密码");
    return false;
  }
  if (nickname == "") {
    alert("请输入昵称");
    return false;
  }
  $.ajax({
    url: uri,
    data: {
      username: username,
      password: password,
      nickname:nickname,
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
  var uid = $.cookie("uid");
  if (uid == "" || uid == undefined) {
    $("#before_signin").removeClass("hidden");
    $("#after_signin").addClass("hidden");
    return;    
  }
  var uri = "/api/home/v1/session/" + uid + "/pc";
  $.ajax({
    url: uri,
    type: "DELETE",
    dataType: "json",
    success: function (data) {
      if (data.code == 0) {
        alert(data.msg);
        $.removeCookie("uid", {path: '/'});
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

function checkSignStatus()
{
  var uid = $.cookie("uid");
  if (uid == "" || uid == undefined) {
    $("#before_signin").removeClass("hidden");
    $("#after_signin").addClass("hidden");
    return;    
  }
  var uri = "/api/home/v1/session/" + uid + "/pc";
  $.ajax({
    url: uri,
    dataType: "json",
    success: function (data) {
      if (data.code == 0) {
        $("#before_signin").addClass("hidden");
        $("#after_signin").removeClass("hidden");
        $("#nickname").text(data.data.nickname);
        if (data.data.avatar_url != "") {
            $("#after_signin #dLabel img").attr("src", data.data.avatar_url);    
        }
      } else if (data.code == 100) {
        alert(data.msg);
        $("#before_signin").removeClass("hidden");
        $("#after_signin").addClass("hidden");
        $.removeCookie('uid', {path: '/'});
      } 
    },
    error: function (data) {
       console.log(data); 
    }
  });
}
checkSignStatus();

function refreshImg(obj)
{
  var url = "/captcha?time=" + new Date();
  $(obj).attr("src", url);
}
