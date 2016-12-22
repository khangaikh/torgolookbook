$('#login').click(function(){
    $('.alert').hide(0);
    var $this = $(this);
    $this.after('<div id="loading"></div>');
    $this.addClass('disabled');
    $.post("login.php", {
        email: $('#email').val(),
        password: $('#password').val(),
        g_recaptcha_response: $('#recaptcha1').val()
    },
    function (result) {
        if(result==1){
            window.location.replace("index.php");
        }
        else if(result==2){
            $('#loading').remove();
            $this.removeClass('disabled');
            $('#login-alert').fadeIn(500);
            $('#login-alert p').text('Капча-г заавал бөглөх ёстой!');
        }
        else{
            $('#loading').remove();
            $this.removeClass('disabled');
            $('#login-alert').fadeIn(500);
            $('#login-alert p').text('Нэвтрэх нэр эсвэл нууц үг буруу байна!');
            grecaptcha.reset(widgetId1);
        }
    });
});