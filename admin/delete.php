<?php 
session_start();
require "../conn.php";
if ($_SESSION["user_type"] == "admin") {
    if (isset($_POST["user_id"])) {
        $user_id = $_POST["user_id"];
        $delete = "DELETE FROM users WHERE user_id = '$user_id'";
        $delete_res = mysqli_query($conn,$delete);
        echo "deleted";
    }else{
    header("location:../");
    }
}else{
    header("location:../");
}
?>