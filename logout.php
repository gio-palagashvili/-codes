  <?php
    session_start();
    if (isset($_SESSION["user_id"])) {
        require "conn.php";
        $user_id = $_SESSION["user_id"];
        $update_active = "UPDATE users SET active = '0' WHERE user_id = '$user_id'";
        $update_active_res = mysqli_query($conn, $update_active);
        session_destroy();
    } else {
        header("location:index.php");
    }
    header("location:index.php");

    ?>