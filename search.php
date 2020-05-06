<?php 
require "conn.php";
  session_start();
  $user_id = $_SESSION["user_id"];
  require "conn.php";
    if ($_SESSION["user_type"] == "console" || $_SESSION["user_type"] == "admin") {
        if (isset($_POST["search"])) {
            $search = $_POST["search"];
            $select = "SELECT * FROM users WHERE name LIKE '%$search%' OR last_name LIKE '%$search%'";
            $select_res = mysqli_query($conn,$select);
            $f1 = mysqli_num_rows($select_res);
            if (2 >= 1) {
                while ($row = mysqli_fetch_array($select_res)) {
                    $name = $row['name'];
                    $last_name = $row['last_name'];
                    $user_profile = $row['user_id'];
                    ?>
        
                    <?php 
                    echo "
                   <a href='user_profile/user_profile.php?user_id=$user_profile'>$name $last_name</a>
                    </br>";
                }
                ?>
    
    <?php
                
            }
        }
else{
        header("location:/");

}
 }
 else{
        header("location:/");
        }
?>