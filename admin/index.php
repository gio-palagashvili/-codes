<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="users.css">
    <script src="../../node_modules/animejs/lib/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
       <?php
    session_start();
    require "../conn.php";
    if (isset($_SESSION["user_type"]) == "admin") {
        $user_id_1 = $_SESSION["user_id"];
         }else{
        header("location:login/login.php");
        }
            ?>
            <nav>
                <h1>Admin Details</h1>
                <ul>
                    <li><a name='users'>Users</a>
                    <img src="Rectangle 2.png" alt="" name='one' class='first_pic'>
                </li>
                    <li><a name='rooms'>Rooms</a>
                </li>
                    <li><a name='packages'>Packages</a>
                </li>
                <li><a name='home'>Home</a>
                </ul>
            </nav>
                    <div class="user_list">
                                <table>
                                    <tr class='theader'>
                                        <th>User_id</th>
                                        <th>name</th>
                                        <th>last name</th>
                                        <th>email</th>
                                        <th>active</th>
                                        <th>user_type</th>
                                        <th>room_n</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php 
                                    require "../conn.php";
                                    
                                    ?>
                                        <?php 
                                    $grab_users = "SELECT * FROM users";
                                    $grab_users_res = mysqli_query($conn,$grab_users);
                                    while($row = mysqli_fetch_array($grab_users_res)){
                                        $user_id=$row["user_id"];
                                        // $password
                                        echo "<tr>"."<th>".$row["user_id"]."</th>";
                                        echo "<th>"."<a href='../user_profile/user_profile.php?user_id=$user_id&my_id=$user_id_1'>".$row["name"]."</a>"."</th>";
                                        echo "<th>".$row["last_name"]."</th>";
                                        echo "<th>".$row["email"]."</th>";
                                        echo "<th>".$row["active"]."</th>";
                                        echo "<th>".$row["user_type"]."</th>";
                                        echo "<th>".$row["room_n"]."</th>";
                                        echo "<th>"."<a onclick='delete_id($user_id)' class='an1'>Delete</a>"."</th>";

                                        }
                                    ?>
                                </table>
                    </div>
                    <!-- rooms -->
                    <div class="room_list">
                                <table>
                                    <tr class='theader'>
                                        <th>room_id</th>
                                        <th>user</th>
                                        <th class='lmaos'>package</th>
                                    </tr>
                                    <?php 
                                    require "../conn.php";
                                    
                                    ?>
                                        <?php 
                                    $grab_users = "SELECT * FROM rooms";
                                    $grab_users_res = mysqli_query($conn,$grab_users);
                                    while($row = mysqli_fetch_array($grab_users_res)){
                                        $user_id=$row["user_id"];

                                        echo "<tr>"."<th>".$row["room_id"]."</th>";
                                        echo "<th>".$row["user"]."</th>";
                                        echo "<th>".$row["package"]."</th>"."</th>";

                                        }
                                    ?>
                                </table>
                    </div>
                    <!-- packages -->
            <div class="packs_list" style='display:none;'>
                                <table>
                                    <tr class='theader'>
                                        <th>Id</th>
                                        <th>user_id</th>
                                        <th>status</th>
                                        <th>weight</th>
                                        <th>name</th>
                                        <th>price</th>
                                        <th>time</th>
                                        <th>tracking</th>
                                        <th>room_n</th>
                                        <th>inputer</th>
                                        <th class='lmaos'>fee</th>
                                    </tr>
                                        <?php 
                                    $grab_users = "SELECT * FROM packs";
                                    $grab_users_res = mysqli_query($conn,$grab_users);
                                    while($row = mysqli_fetch_array($grab_users_res)){
                                        $user_id=$row["user_id"];

                                        echo "<tr>"."<th>".$row["package_id"]."</th>";
                                        echo "<th>".$row["user_id"]."</th>";
                                        echo "<th>".$row["status_of"]."</th>";
                                        echo "<th>".$row["weight_of"]."</th>";
                                        echo "<th>"."<a href=''>".$row["name_on"]."</a>"."</th>";
                                        echo "<th>".$row["price_of"]."</th>";
                                        echo "<th>".$row["arrived_time"]."</th>";
                                        echo "<th>".$row["tracking_n"]."</th>";
                                        echo "<th>".$row["room_n"]."</th>";
                                        echo "<th>".$row["fee"]."</th>";
                                        echo "<th>".$row["inputer"]."</th>"."</th>";

                                        }
                                    ?>
                                </table>
              </div>

   <script>
          function delete_id(user_id) {
        var confirm = prompt("Type Confirm If You are Sure (This Action Is Not Reversible)");
        confirm = confirm.toString();
            if (confirm == "confirm" ) {
                $.ajax({
                    type: "post",
                    url: "delete.php",
                    data: {
                        'user_id' : user_id,
                    },
                    dataType: "text",
                    success: function (e) {
                    if (e=='deleted') {
                        location.reload();
                    }                        
                    }
                });
            }

      }
      $( document ).ready(function() {
          $("[name='home']").css("color","#69696b");  
          $("[name='packages']").css("color","#69696b");
          $("[name='rooms']").css("color","#69696b");
          $(".room_list").hide();
          $(".packs_list").hide();

            $("[name='rooms']").click(function (e) { 
               $(".user_list").hide();
               $(".packs_list").hide();
               $(".room_list").show();
                   anime({
                    targets: '.first_pic',
                    translateX: 63,
                    scale :0.5
                    });
               $("[name='users']").css("color","#69696b");
               $("[name='rooms']").css("color","white");
               $("[name='packages']").css("color","#69696b");
                
            });
            $("[name='packages']").click(function (e) { 
               $(".user_list").hide();
               $(".room_list").hide();
               $(".packs_list").show();

                  anime({
                    targets: '.first_pic',
                    translateX: 135,
                    scale :0.5
                    });
               
               $("[name='rooms']").css("color","#69696b");
               $("[name='packages']").css("color","white");
               $("[name='users']").css("color","#69696b")
               $(".lma").hide();
            });
               $("[name='users']").click(function (e) { 
               $(".room_list").hide();
                 anime({
                    targets: '.first_pic',
                    translateX: 0,
                    scale :0.5
                    });
               $("[name='rooms']").css("color","#69696b");
               $("[name='users']").css("color","white");
               $("[name='packages']").css("color","#69696b")
                $(".packs_list").hide();
                    
          $(".user_list").show();
               $(".lma").hide();
               $(".lma1").hide();
               $("[name='one']").show();
                
            });

});
$("[name='home']").click(function (e) { 
    e.preventDefault();

    window.location.href = '../';
    
});
  
</script>


</body>

</html>