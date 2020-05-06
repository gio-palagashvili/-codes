<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
       <?php
    session_start();
    require "../conn.php";
    if (isset($_SESSION["user_type"]) == "user" ) {
        $user_id = $_SESSION["user_id"];
         }else{
        header("location:login/login.php");
        }
            ?>

        <nav>
            <?php 
            if ($_SESSION["user_type"] == "console" || $_SESSION["user_type"] == "admin") {
               echo "
            <input autocomplete='off' type='text shadow-lg text-yellow-500' placeholder='Search Users' id='search'><a href='logout.php' class='ahm'>Log Out</a>
               
               ";
            }
           else{
               echo "<a href='logout.php' class='ahm' style='margin-left:90%'>Log Out</a>";
           }
            ?>
        </nav>
                <div class='search'>
                    <ul>
                        <li><a href="../"  style='opacity:0.85;'>home</a></li>
                        <li><a href='items/' class='active_a' style='color:white;'>Items</a></li>
                      <?php 
                if ($_SESSION["user_type"] == "admin") {
                    echo "<li><a href='admin/' >admin</a></li>";
                }
                ?>
            </ul>
        </div><br><br>
        <?php
?>  
<div class='search2'>
  <ul class='if2'></ul>
</div>
<?php 
if ($_SESSION["user_type"] == "admin" ||$_SESSION["user_type"] == "console"){
    echo "<div class='decor'>
    
    </div>
    ";
}
?>
<script>
    function func() { 
         window.location.replace("pack_input/index.php");
        
     }
jQuery(document).ready(function($) {

$(".search2").hide();
$("#search").keyup(function () { 
    
    var search = $("#search").val();
         $(".search2").fadeIn();
        if (search.length==0) {
         $(".search2").hide();
            
        }        
        $.ajax({
        type: "post",
        url: "search.php",
        data: {
            "search" : search,
        },
        dataType: "text",
        success: function (e) {
            if(e == ""){
                console.log("ss");
                
        $(".if2").html("No Users Found");

            }
            else{
        $(".if2").html(e);

            }
        }
    });
   
});

var one = "lol";
$.ajax({
    type: "post",
    url: "checker.php",
    data: {
        "lol":one,
    },
    dataType: "text",
    success: function (e) {
        $(".decor").html(e);
    }
});

});
</script>
        
          


</body>

</html>