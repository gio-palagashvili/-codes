<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<?php 
  session_start();
    require "../conn.php";
    if ($_SESSION["user_type"] == "console" || $_SESSION["user_type"] == "admin") {

?>
<body>
      <?php
    require "../conn.php";
    if (isset($_SESSION["user_type"]) == "user") {
        $user_id = $_SESSION["user_id"];
         }else{
        header("location:login/login.php");
        }
            ?>

        <nav>
        </nav>
                <div class='search'>
                    <ul>
                        <li><a href="../" >home</a></li>
                        <li><a href='items/' class='active_a' style='color:white'>Items</a></li>
                      <?php 
                if ($_SESSION["user_type"] == "admin") {
                    echo "<li><a href='../admin/' >admin</a></li>";
                }
                ?>
            </ul>
        </div>
            <div class="agh">
                <img src="assets/images/undraw_click_here_2li1.svg" alt="">
                <img src="assets/images/blob-shape.svg.png" alt="">
                <h1>Input Recievied Packages <br>So The User Sees It.</h1>
            </div>
        <br><br>
            <div class="inputs">
    <input type="text" placeholder="Full Name On Package" name='name' required>
    <input type="number" placeholder="Room Number" name='room_n' required>
    <input type="number" placeholder="Tracking Number" name='tracking_number' required class='ex'>
    <input type="number" placeholder="Price(usd)" name='price' required>
    <input type="number" placeholder="Weight(kg)" name='weight' required >

    <button id='sub'>Submit</button>
            </div>
<?php
?>  
<span class='ran12'></span>
<?php 
if ($_SESSION["user_type"] == "admin" ||$_SESSION["user_type"] == "console"){
    echo "<div class='decor'>
    
    </div>
    ";
}
?>
</body>
<script>
    jQuery(document).ready(function($) {
       $("#sub").click(function () { 
        var name = $("[name='name']").val();
        var weight = $("[name='weight']").val();
        var name_of = $("[name='name_of']").val();
        var price = $("[name='price']").val();
        var room_n = $("[name='room_n']").val();
        var tracking_number = $("[name='tracking_number']").val();
        
   $.ajax({
            type: "POST",
            url: "action_index.php",
            data: {
                "name":name,
                "weight":weight,
                "price":price,
                "room_n":room_n,
                "tracking_n":tracking_number,

            },
            dataType: "text",
            success: function (e) {
                console.log(e);
                
                if (e=="succ") {
                    location.reload();                    
                }
                else if(e=="user/room"){
                    $("[name='name']").toggleClass("error").val("");
                    $("[name='room_n']").toggleClass("error").val("");
                    
                }
            }
        });
        
    
       });

    })
</script>
<?php 
    }
       else{
        header("location:../");
        }
?>
</html>