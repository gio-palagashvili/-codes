<?php
session_start();
require "../conn.php";
if (isset($_POST["weight"]) && $_SESSION["user_type"] == "console" || $_SESSION["user_type"] == "admin") {

  //! var declaration
    $weight = $_POST["weight"];
    $weight = intval($weight);
    $price = intval($_POST["price"]);
    $name_on_package = $_POST["name"];
    $room_n = $_POST["room_n"];
    $tracking_n = $_POST["tracking_n"];
    $inputer_id = $_SESSION["user_id"];

  //* break down the name
    $name = explode(" ", $name_on_package);
    $f_name = $name[0];
    $l_name = $name[1];

    //? check if user exist
    $check_name = "SELECT * FROM  users WHERE name = '$f_name' AND last_name = '$l_name'";
    $check_name_res = mysqli_query($conn, $check_name);
    $idk = mysqli_num_rows($check_name_res);

  //* necessary chekcing 
    if ($idk == 1) {

      //* creaete user _id
        $row = mysqli_fetch_array($check_name_res);
        $user_id = $row["user_id"];

      //? check if user is in the room

        $check_room = "SELECT * FROM rooms WHERE user_id = '$user_id' AND room_n = '$room_n'";
        $check_room_res = mysqli_query($conn, $check_room);
        $grab_rend = mysqli_num_rows($check_room_res);
      //! calculating the fee 
        $first_fee = 8/100 * $price;
        $second_fee = ($weight * 4) + 1;
        $fee = $first_fee + $second_fee;


      //! if $row_r == 1 thats means that the user is in the room
        if ($grab_rend == 1) {
          // ? insert into packs tbl
          $date = date("y-m-d");
          $insert_into = "INSERT INTO `packs`(`user_id`, `status_of`, `weight_of`, `name_on`, `price_of`, `arrived_time`, `tracking_n`, `room_n`, `inputer`,`fee`) 
          VALUES ('$user_id','in','$weight','$name_on_package','$price','$date','$tracking_n','$room_n','$inputer_id','$fee')";
          $insert_into_res = mysqli_query($conn,$insert_into);
          //! echos succ if successfully inserted
          echo "succ";
          //? inserting into the fees table
         $get_pack_id = "SELECT * FROM packs ORDER BY package_id DESC";
          $get_pack_id_res = mysqli_query($conn,$get_pack_id);
          $pack_id_row = mysqli_fetch_array($get_pack_id_res);
          $package_id =  $pack_id_row["package_id"];
          

          $insert_into_fees = "INSERT INTO `fees`( `user_id`, `package_id`, `fee`, `payed`) VALUES ('$user_id','$package_id','$fee','no')";
          $insert_into_fees = mysqli_query($conn,$insert_into_fees);
        } else {
            echo "user_not_in_room";
        }
    } else {
        echo "user_not_found";
    }
} else {
echo "text";
}
?>