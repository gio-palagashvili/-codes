<?php 
session_start();
require "conn.php";
$user_type = $_SESSION["user_type"];
if (isset($_POST["pack_id"]) && $user_type == "admin") { 
    $pack_id = $_POST["pack_id"];
    $delete = "DELETE FROM packs WHERE package_id = '$pack_id'";
    $delete_res = mysqli_query($conn,$delete);
    echo "succ";
}else{
    header("location:../");
}
?>