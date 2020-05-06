<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("location:../");
}
?>

<head>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="div1">
    <div class="inputs">
        <h2 id='h22'>Delivery</h2>
        <span for="h22">Welcome</span>
     <input type="text" name="email" placeholder="Email"  autocomplete="off"><br>
     <input type="password" class="password" placeholder="Password" name="pass1"><br>
             <button class="name">Login</button><br>

    </div>
    </div>
        <div class="div2">
            <img src="images/Untitled-1.png" alt="">
            <img src="images/agh.svg" alt="">
        <div class="slogan">
            <h1 class='m'>Order Anything, Anytime, <br> Anywhere And Get It <br> Quickly.</h1>    
         <br>   <h5 class='m'>If You Don’t Have An Account <br>
                Join Today </h5><br class='m'>
                <!-- aigh -->
                <h1 class='n'>Order Anything, Anytime, <br> Anywhere And Get It <br> Quickly.</h1>    <br class='n'>
         <br>   <h5 class='n' style='font-size:9px;margin-bottom:20%;'>If You Don’t Have An Account
                Join Today </h5><br class='n'>
                <!-- aign -->

                <br class='n'>
            <a href="../register"><button>Register</button></a>
        </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($) {
        $(".name").click(function(e) {
            var email = $("[name='email']").val();
            var password = $("[name='pass1']").val();
            $.ajax({
                type: "POST",
                url: "action_login.php",
                data: {
                    "email": email,
                    "password": password,
                },
                dataType: "html",
                success: function(e) {
                    if (e == 'succsess') {
                        window.location.replace("../");
                    } else {
                        $("[name='email']").attr("placeholder","Try Again").val("");
                        $("[name='pass1']").attr("placeholder","Try Again").val("");

                    }
                }
            });
        });
    })
    </script>
</body>

</html>