<?php 
require "conn.php";
session_start();
$user_id = $_SESSION["user_id"];
$user_type = $_SESSION["user_type"];
        
        //TODO worked!   $get_pack_id = "SELECT * FROM packs ORDER BY package_id DESC";
        //   $get_pack_id_res = mysqli_query($conn,$get_pack_id);
        //   $pack_id_row = mysqli_fetch_array($get_pack_id_res);
        //   $package_id =  $pack_id_row["package_id"];
?>