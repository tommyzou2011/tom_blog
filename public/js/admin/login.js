//点击刷新验证码
$captchaSrc = $("#captcha")[0].src;

$("#captcha").click(function () {

    $src = $captchaSrc + '/' + Math.floor(Math.random() * 100 + 1);

    $(this).attr('src', $src);

    // console.log($(this)[0].src);
});

//提交登陆
$("#login_btn").click(function () {

    $.ajax({
        url: '/admin/user/login',
        data: {"code": $(".code").val(), "username": $(".username").val(), "password": $(".password").val()},
        dataType: 'json',
        type: "post",
        crossDomain: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (datas) {
            if (datas == 1) {
                window.location.href = "/admin/index";

            } else {
                $("#login_info").html(datas);
            }
        },
        error: function (xhr, type) {
            $("#login_info").html('服务器错误，联系管理员');
        }
    });
});