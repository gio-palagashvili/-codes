<?php 
session_start();
require "../conn.php";
if (isset($_POST["reporter_id"]) && isset($_POST["reported_id"])) {
   if (isset($_SESSION["user_id"])) {
      $reporter_id = $_SESSION["user_id"];
      $reported_id = $_POST["reported_id"];
      $details = (isset($_POST["text"]) ? $_POST["text"]:" " );
      $category = $_POST["category"];
      $insert = "INSERT INTO `reports`(`user_id`, `reporter_id`, `category`, `details`) 
      VALUES ('$reported_id','$reporter_id','$category','$details')";
      $insert_res = mysqli_query($conn,$insert);
   echo "succ";
   }
}else{
    header("location:../");
}
?>