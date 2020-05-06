<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='../../node_modules/animejs/lib/anime.min.js'></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php 
    require "../conn.php";
    session_start();
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $user_type = $_SESSION["user_type"];
    }
  if ($_GET["my_id"] == $user_id) {
            }else{
                header("location:../");
            }
    if ($user_type == 'admin' || $user_type == 'console' || $user_type = 'mod') {
       
    if (isset($_GET["user_id"])) {
        $user_c_id = $_GET["user_id"];
        $select_1 = "SELECT * FROM users WHERE user_id = '$user_c_id'";
        $select_1_res = mysqli_query($conn,$select_1);
        $row_1 = mysqli_fetch_array($select_1_res);
        $row_name = $row_1['name'];
        $row_last_name = $row_1['last_name'];
        $row_email=$row_1['email'];
        $row_social = $row_1['social_number'];
        $row_active = $row_1['active'];
        $row_type = $row_1['user_type'];

    ?>
    <?php 
    $select_packs = "SELECT * FROM packs WHERE user_"
    ?>
    <div class="main_div">
        <div class="div1">
            <div class='wrapper'>

                <h1>User Details</h1><br>
                <nav>
                    <ul>
                        <li><a href="" class='active'>Overview</a></li>
                        <img src="assets/images/Rectangle 2.png" alt="" class='bard'>
                        <?php 
                        if ($_SESSION["user_type"] == 'admin') {
                           echo "
                        <li><a href=''>Payments</a></li>
                        <li><a href=''>promotion</a></li>
                           
                           ";
                        }
                        ?>
                    </ul>
                </nav>
                <div class="cubes container">
                    <div class="up1">
                        <div class="extra">
                            <span>USA <span> </span>Address Info :</span>
                            <div class="intel">
                                <ul>
                                    <li><span class='span1'>Email : </span > <div><?php echo $row_name." ".$row_last_name;?></div></li>
                                    <li><span class='span1'>Adress :</span><div>8 McCullough Dr.</div></li>
                                    <li><span class='span1'>Zip :</span><div>19726</div></li>
                                    <li><span class='span1'>State :</span><div>LA</div></li>
                                    <li><span class='span1'>City :</span><div>New Castle</div></li>
                                    <li><span class='span1'>Full Name : </span > <div><?php echo $row_name." ".$row_last_name;?></div></li>
                                    <li><span class='span1'>Social Number : </span > <div><?php echo $row_social;?></div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="down1">
                        <div class="social_number">
                        <span>Packages :</span>
                        <div>
                            <ul>
                                <li class='li1'>Awaiting</li>
                                <li class='li1'>Shipping</li>
                                <li class='li1'>Recieved</li>
                            </ul>
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="div2">
            <div class="f2">
            <h1> <?php echo $row_name."<br>".$row_last_name;?> </h1>
            <?php 
          
          if ($row_type == 'admin') {
                echo "<img src='assets/images/OP Admin.png' class='admin'>";
            }else if($row_type = 'user'){
                echo "<img src='assets/images/User.png' class='admin'>";
            }
            ?>
            </div>
            <div class="line"></div>
             <div class="amm">

        </div>
            <div class='card'>
        <p>
                No Credit Card Information <br>
                was found
        </p>
        </div>
            <div class="buttons">
                <button data-toggle = 'modal' data-target='#mymodal'>Report</button>
                <?php 
                if ($row_type=="user" || $row_type == "console" || $row_type == "mod") {
                    echo "
                <button class='edit_admin'>Edit Profile</button>
                    
                    ";
                }
                ?>
                <button class='go'>Go Back</button>
           </div>
    </div>
    </div>
        
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="modal fade" id='mymodal'>

                <div class="modal-dialog" id="centralModalWarning">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Report User For</h3> 
                            <button type="button" class="close" data-dismiss="modal" id='sss' aria-label="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <select name="" id="select1" class='shadow-lg' required>
                                <option value="explotation" selected>Any Type Explotation</option>
                                <option value="info">Asking For Too Much Info</option>
                                <option value="activity">any type of suspicious activity</option>
                                <option value="other">other</option>
                            </select>
                            <textarea name="" placeholder='Describe The Issue' id="textarea1" cols="30" rows="10"></textarea>
                        </div>
                        <div class="modal-footer">
                <button type="button" class="btn btn-success submit1" style='background:#2A3137;border-color:#2A3137;' data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                   
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            var link_1 = window.location.href.split("?").pop().split("&");
            var reported_id = link_1[0].split('=');
            var reported_id = reported_id[1];
            
            var reporter_id = link_1[1].split('=');
            var reporter_id = reporter_id[1];

            
            $(".submit1").click(function (e) { 
                
                var category = $("#select1 option:selected").val();
                var textarea = $("#textarea1").val();
                
                       $.ajax({
                            type: "post",
                            url: "report.php",
                            data: {
                                "reporter_id" :reporter_id,
                                "reported_id" : reported_id,
                                "text" : textarea,
                                "category" : category,

                    },
                    dataType: "text",
                    success: function (e) {
                    if (e == "succ") {
                        $(".amm").html("<div class='alert alert-dark col-md-10 position-absolute agh1 fade-in' role='alert'>Reported Successfully <span class='mx-ml-2' role>x</span></div>")                                
                        anime({
                            targets:'.alert',
                            translateX:'-10px'
                        });
                    }
                    setTimeout(function(){ 
                             anime({
                            targets : '.alert',
                            translateY : '-200px',
                            opacity : '0.0',
                            easing : 'linear',
                            duration : '300'
                        })
                        $(".alert").alert("close fade");
                     }, 3000);

                    $(".mx-ml-2").click(function (e) { 
                        anime({
                            targets : '.alert',
                            translateY : '-200px',
                            opacity : '0.0',
                            easing : 'linear',
                            duration : '300'
                        })
                        $(".alert").alert("close fade");
                    });                                                                                
                    }
           
       });
});
            
     });
    </script>
    <?php 
    }
    else{
        header("location:../");
    }
    
    ?>
    <script>
    jQuery(document).ready(function($) {
    $(".go").click(function (e) { 
        e.preventDefault();
        window.location.href="../";
    });
    })

    </script>
    <?php 
    }else{
        header("location:../");
    }
    ?>
</body>
</html>
