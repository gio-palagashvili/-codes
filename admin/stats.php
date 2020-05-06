<?php 
if ($_POST["bluecake"] == "true") {
require "../conn.php";
$ret = "";

$users = "SELECT * FROM users WHERE user_type = 'user'";
$users_res = mysqli_query($conn,$users);
$number_of_users = mysqli_num_rows($users_res);

$admin = "SELECT * FROM users WHERE user_type = 'admin'";
$admin_res = mysqli_query($conn,$admin);
$number_of_admin = mysqli_num_rows($admin_res);

$ret.="$number_of_users"." "."$number_of_admin";
echo $ret;
}else{
    header("location:stats.php");
}
?>