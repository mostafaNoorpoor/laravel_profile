<!DOCTYPE html>
<html>
<head>
    <title>log in</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body dir="rtl">
    <div class="container">

        <input type="text" id="phone_number" name="phone_number" placeholder="enter your phone number" class="form-control">

        <input type="text" id="OTP" name="OTP" placeholder="enter your OTP" class="form-control">

        <input type="submit" class="btn btn-success" onclick="login()">

    </div>
<script src="{{asset('js/app.js')}}"></script>

<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function login() {
        var number , otp ;
        number = $('#phone_number').val();
        otp = $('#OTP').val();
        $.ajax({
            type: 'POST' ,
            url : 'api/auth/login',
            data : 'phone_number='+number+'&OTP='+otp,
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            } ,
            success:function (msg) {
                setCookie('token' , msg.token_type + " " + msg.access_token , 5);
                setCookie('userId' , msg.userId , 5);
                window.location.href = "http://localhost/laravel/chat/public/";
            }
        });
    }
</script>

</body>
</html>
