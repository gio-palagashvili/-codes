<?php
require "../conn.php";
if($_POST["password"]){
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $social_num = $_POST["social_num"];
        $email = $_POST["email"];
        $email_check = "SELECT * FROM users WHERE email = '$email'";
        $error = "";
        $email_check_res = mysqli_query($conn, $email_check);
        $first_check = "SELECT * FROM users WHERE name ='$name' AND last_name = '$last_name'";
        $first_check_res = mysqli_query($conn,$first_check);
        $number_first = mysqli_num_rows($first_check_res);
        if ($number_first >= 1) {
            $error .= "error3";
        }else{
                 if (mysqli_num_rows($email_check_res) >= 1) {
            $error .= "error1";
        }else {
            $password = md5($password);
            $insert_info = "INSERT INTO users(last_name,name,password,email,user_type,social_number,room_n) VALUES('$last_name','$name','$password','$email','user','$social_num','22')";
            $insert_info_res = mysqli_query($conn, $insert_info);
            echo "succsess";

            $idkman = "SELECT * FROM users ORDER BY user_id DESC";
            $idkman_res = mysqli_query($conn,$idkman);
            $row  = mysqli_fetch_array($idkman_res);
            $user_future_id = $row["user_id"];

            $insert_into_rooms = "INSERT INTO rooms(user_id,room_n) VALUES('$user_future_id','22')";
            $insert_into_rooms_res = mysqli_query($conn,$insert_into_rooms);
        }
    }
    echo $error;

}
else{
    header("location:../");
}