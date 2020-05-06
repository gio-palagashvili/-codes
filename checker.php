<?php 
    session_start();
    require "conn.php";
    if (isset($_SESSION["user_type"]) == "admin" || isset($_SESSION["user_type"]) == "console") {
        $user_id = $_SESSION["user_id"];
        $check = "SELECT * FROM packs WHERE inputer='$user_id'";
        $check_res = mysqli_query($conn,$check);
        if (mysqli_num_rows($check_res) == 0 ) {
            echo "
            <img src='theme/undraw_empty_xct9.svg' class='img22'><br>
            <p>You Haven’t Added Any Packages</p><br>
            <button id='tho' data-toggle='modal' data-target='#exampleModal' style='outline:none'>Add Recieved Packages</button>
            
            ";
        }else{
            echo "pack";
         }
        }else{
            header("../");
        }
?>