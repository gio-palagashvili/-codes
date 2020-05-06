<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php
require "../conn.php";
session_start();
if(isset($_SESSION["user_id"])){
    header("location:../");
}
?>

<body>
    <div class="container">
        <div class="div1">
    <div class="inputs">
        <h2 id='h22'>Delivery</h2>
        <span for="h22">Welcome</span>
     <input type="text" name="name" placeholder="First Name"  autocomplete="off" maxlength="25"><br>
     <input type="text" name="last_name" placeholder="Last Name"  autocomplete="off" maxlength="25"><br>
     <input type="email" name="email" placeholder="Email"  autocomplete="off"><br>
     <input type="text" name="social_num" placeholder="Piradoba"  autocomplete="off" maxlength="25"><br>
     <input type="password" placeholder="Password (max:16)"  autocomplete="off" name='pass1' class='password'><br>
     <input type="password" class="password" placeholder="Confirm Password" name="pass2"><br>
             <button class="name">Register</button><br>

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
         <br>   <h5 class='n' style='font-size:9px;margin-bottom:20%;'>If You Do Have An Account
                Log In </h5><br class='n'>
                <!-- aign -->

                <br class='n'>
            <a href="../login/login.php"><button>Login</button></a>
        </div>
        </div>
    </div>
</body>
<script>
    jQuery(document).ready(function($) {
        $(".name").click(function () { 
            var last_name = $("[name='last_name']").val();
            var pass1 = $("[name='pass1']").val();
            var pass2 = $("[name='pass2']").val();
            var name = $("[name='name']").val();
            var email = $("[name='email']").val();
            var social_num = $("[name='social_num']").val();

                if (pass1.length >= 6 && pass1 == pass2 && pass1.length < 17 ) {
                if(name.match(/[!@#$%^&*(),.?":{}|<>\[\]]/g) || name.match(/[0-9]/g ) ){
                    
                    $("[name='name']").attr("placeholder","Must Not Contain Numbers/Special Charatcters").val("");
                }else{
                    var ak = "a";
                }
            
                 if(last_name.match(/[!@#$%^&*(),.?":{}|<>\[\]]/g) || last_name.match(/[0-9]/g)){
                    $("[name='last_name']").attr("placeholder","Must Not Contain Numbers/Special Characters").val("");
                       
                }else{
                    var ak47 = "b";
                }
              if(ak47 == "b" && ak == "a"){
                   $.ajax({
                    type: "POST",
                    url: "action_register.php",
                    data: {
                        "last_name": last_name,
                        "password": pass1,
                        "email": email,
                        "name": name,
                        "social_num":social_num,
                    },
                    dataType: "html",
                    success: function(e) {
                        console.log(e);
                        if (e == "error1") {
                            $("[name='email']").val("").
                            attr("placeholder", "Email Taken");
                        } else if (e == "error2") {
                            $(".username").
                            attr("placeholder", "username taken");
                        } else if (e == "error1error2") {
                            $(".username").
                            attr("placeholder", "username taken").val();
                            $("[name='email']").val("").
                            attr("placeholder", "Email Taken");
                        }
                        else if(e=="error3"){
                            $("[name='name']").
                            attr("placeholder", "name already used").val("");
                            $("[name='last_name']").val("").
                            attr("placeholder", "name already used");
                        }
                        else{
                            window.location.replace("../");
                        }
                    }
                });
                  
              }
                    
                
        
            } else if (pass1 != pass2) {
                $(".password").val("").
                attr("placeholder", "Passwords Did Not Match");
            } else if (pass1.length < 6) {
                $(".password").val("").
                attr("placeholder", "  Password Must be 6 or more charachters long").
                toggleClass("error_border");
            } 
            else if(pass1.length>17){
                  $(".password").val("").
                attr("placeholder", "Passwords Too Long(max:16)");
            }
            else{
                
            }          
        });
                        
            
        });
    
    </script>

</html>