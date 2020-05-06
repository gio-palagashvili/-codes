<?php
require "../conn.php";
if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password = md5($password);

    $check_user = "SELECT * FROM users WHERE email = '$email'";
    $check_user_res = mysqli_query($conn, $check_user);
    $error = "";
    if (mysqli_num_rows($check_user_res) == 1) {
        $check_password = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $check_password_res = mysqli_query($conn, $check_password);
        if (mysqli_num_rows($check_password_res) == 1) {
                session_start();
            $row = mysqli_fetch_array($check_password_res);
            $check_for_admin = "SELECT * FROM users WHERE user_type = 'admin' AND email='$email' AND password='$password'";
            $check_for_admin_res = mysqli_query($conn,$check_for_admin);
             if (mysqli_num_rows($check_for_admin_res)==1) {
                  $_SESSION["user_type"] = "admin";

                }else{
                    $_SESSION["user_type"] = "user";
                }
            $user_id = $row["user_id"];
            $update_active = "UPDATE users SET active = '1' WHERE user_id='$user_id'";
            $update_active_res = mysqli_query($conn, $update_active);
            $_SESSION["email"] = $email;
            $_SESSION["user_id"] = $user_id;
            echo "succsess";
        }
    } else {
        echo "error1";
    }
} else {
    header("location:../");
}
