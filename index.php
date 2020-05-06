<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="users.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='../node_modules/sweetalert2/dist/sweetalert2.all.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body style='background:#222222;'>
       <?php
    session_start();
    require "conn.php";
    if (isset($_SESSION["user_type"]) == "user" ) {
        $user_id = $_SESSION["user_id"];
         }else{
        header("location:login/login.php");
        }
            ?>

        <nav>
            <?php 
            if ($_SESSION["user_type"] == "console" || $_SESSION["user_type"] == "admin") {
               echo "
            <input autocomplete='off' type='text shadow-lg text-yellow-500' placeholder='Search Users' id='search'><a href='logout.php' class='ahm'>Log Out</a>
               
               ";
            }
           else{
               echo "<a href='logout.php' class='ahm' style='margin-left:90%'>Log Out</a>";
           }
            ?>
        </nav>
                <div class='search'>
                    <ul>
                        <li><a href="../NewYear" class='active_a' style='color:white'>home</a></li>
                        <li><a href='' class='' style=''>Items</a></li>
                      <?php 
                if ($_SESSION["user_type"] == "admin") {
                    echo "<li><a href='admin/' >admin</a></li>";
                }
                ?>
            </ul>
        </div><br><br>
            <div class="packages">
                <p style='color:white;font-family:lato_b;'>Packages Inputed :</p>
                    <?php 
                    require "conn.php";
                    $select_packages = "SELECT * FROM packs WHERE inputer = '$user_id'";
                    $select_packages_res = mysqli_query($conn,$select_packages);
                    while ($row12 = mysqli_fetch_array($select_packages_res)) {
                        $status = $row12['status_of'];
                        $weight = $row12['weight_of'];
                        $package_id = $row12['package_id'];
                        $custom_id = $row12['user_id'];
                        $time = $row12['arrived_time'];
                        $price = $row12['price_of'];
                        $tracking = $row12['tracking_n'];
                        $name = $row12['name_on'];
                        $pack_id = $row12['package_id'];
                        ?>
  
                        <div class="package">
                            <div class="main">
                                <div class="my">
                                    <span>USER ID : <?php echo $custom_id;?></span>
                                    <h4 id='llll'><?php echo $name;?></h4>
                                </div>
                                <div class="lists">
                                    <ul class='ul1'>
                                        <li>
                                           <span> Package Status </span>
                                            <?php 
                                            echo "<p>".$status."</p>";
                                            ?>
                                        </li>     <li>
                                           <span> Package Weight </span>
                                            <?php 
                                            echo "<p>".$weight."</p>";
                                            ?>
                                        </li>     <li>
                                           <span> Tracking Number </span>
                                            <?php 
                                            echo "<p class='track'>".$tracking."</p>";
                                            ?>
                                        </li>
                                         <li>
                                           <span> Arrived Time </span>
                                            <?php 
                                            echo "<p>".$time."</p>";
                                            ?>
                                        </li>
                                            <li>
                                           <span> Inputer Id </span>
                                            <?php 
                                            echo "<p>".$user_id." (You)"."</p>";
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons">
                                     <button class="edit">Edit</button>
                                    <?php 
                                    echo "
                                     <button class='delete' onclick='delete_ajax($pack_id)'>Delete</button>
                                    ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                    //! end of while loop seprate from html
                    }
                    ?>
                    <script>
                        function func_reload() {
                            window.location="../NewYear/index.php";
                            } 
                    function delete_ajax(pack_id){
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This Action Can Not Be Reversed",
                            icon: 'warning',
                            showCancelButton: true,
                            cancelButtonColor: '#4F4F4F',
                            confirmButtonText: 'Delete'
                            }).then((result) => {
                            if (result.value) {
                        $.ajax({
                            type: "post",
                            url: "delete.php",
                            data: {
                                "pack_id" : pack_id,
                            },
                            dataType: "text",
                            success: function (se) {
                                setTimeout(() => {
                    window.location="../NewYear/index.php";
                                }, 2000);
                                if(se == "succ"){
                                 const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'bottom-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                    })
                                    Toast.fire({
                                    icon: 'success',
                                    title: 'Package Deleted Successfully'
                                });
                                 
                                }
                            }
                        });  
                            }
                        })                      
                        
                    }
                    </script>
                       <div class="package">
                            <div class="main">
                                <div class="button1">
                                     <button class="add" id='tho' data-toggle='modal' data-target='#exampleModal'>Add Package</button>
                                </div>
                            </div>
                        </div>
            </div>
                <div class="modal">
                    
                </div>
<div class='search2'>
  <ul class='if2'></ul>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Package</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        


       <div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="validationTooltip01">Name On Package</label>
        <input type="text" class="form-control" id="validationTooltip01" placeholder="Name On Package" required>
        
    </div>

    <div class="col-md-6 mb-3">
        <label for="validationTooltip03">Price of Package</label>
        <input type="text" class="form-control" id="validationTooltip03" placeholder="Price of Package" required>
        <div class="error_p">
            <span style='color: #f56565;font-size:11.5px;position:absolute;margin-top:5px;'> Price Must Be A Number</span>
    </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="validationTooltip04">Room Number</label>
        <input type="text" class="form-control" id="validationTooltip04" placeholder="Room Number" required>
               <div class="error_n">
            <span style='color: #f56565;font-size:11.5px;position:absolute;margin-top:5px;'> Invalid Room Number</span>
    </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="validationTooltip05">Weight of Package(kg)</label>
        <input type="text" class="form-control" id="validationTooltip05" placeholder="Weight of Package" required>
              <div class="error_w">
            <span style='color: #f56565;font-size:11.5px;position:absolute;margin-top:5px;'> Weight Must Be A Number</span>
    </div>
    </div>

</div>
<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="validationTooltip02">Tracking Number</label>
        <input type="text" class="form-control" id="validationTooltip02" placeholder="Tracking Number" required>
         <div class="error_t">
            <span style='color: #f56565;font-size:11.5px;position:absolute;margin-top:5px;'> Tracking Number Must Be A Number</span>
    </div>
    </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary yes" style='background:#615383;border:1px solid #615383;' data-dismiss='modal'>Input Packages</button>
      </div>
    </div>
  </div>
</div>
<script>
            $(".error_p").css("display","none");
            $(".error_w").css("display","none");
            $(".error_t").css("display","none");
            $(".error_r").css("display","none");
            $(".error_n").css("display","none");

    $(".modal").keyup(function (e) { 
        var name = $("input[placeholder='Name On Package']").val();
        var weight = $("input[placeholder='Weight of Package']").val();
        var tracking_n = $("input[placeholder='Tracking Number']").val();
        var price = $("input[placeholder='Price of Package']").val();
        var room_n = $("input[placeholder='Room Number']").val();
        

        //! check price numbers
        if(price.match(/[^0-9]/)){
            $(".error_p").css("display","unset");
            $("input[placeholder='Price of Package']").toggleClass('is-invalid');
        }else{
            $(".error_p").css("display","none");
            $("input[placeholder='Price of Package']").toggleClass('is-valid');
        }

        //! check weight NUmbers


        if(weight.match(/[^0-9]/)){
            $(".error_w").css("display","unset");
            $("input[placeholder='Weight of Package']").toggleClass('is-invalid');
        }else{
            $(".error_w").css("display","none");
            $("input[placeholder='Weight of Package']").toggleClass('is-valid');
        }

        //! check tracking number
        
        if(tracking_n.match(/[^0-9]/)){
            $(".error_t").css("display","unset");
            $("input[placeholder='Tracking Number']").toggleClass('is-invalid');
        }else{
            $(".error_t").css("display","none");
            $("input[placeholder='Tracking Number']").toggleClass('is-valid');
        }
        
        //! check room number
        if(room_n.match(/[^0-9]/)){
            $(".error_n").css("display","unset");
            $("input[placeholder='Room Number']").toggleClass('is-invalid');
        }else{
            $(".error_n").css("display","none");
            $("input[placeholder='Room Number']").toggleClass('is-valid');
        }


    });
    $(".yes").click(function (e) { 
        var name = $("input[placeholder='Name On Package']").val();
        var weight = $("input[placeholder='Weight of Package']").val();
        var tracking_n = $("input[placeholder='Tracking Number']").val();
        var price = $("input[placeholder='Price of Package']").val();
        var room_n = $("input[placeholder='Room Number']").val();
    
    $.ajax({
        type: "post",
        url: "pack_input/action_index.php",
        data: {
            "weight" : weight,
            "name" : name,
            "room_n": room_n,
            "price" : price,
            "tracking_n":tracking_n,
        },
        dataType: "text",
        success: function (e) {
           if(e=="succ"){
              const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
    Toast.fire({
    icon: 'success',
    title: 'Package Added Successfully'
});

setTimeout(func_reload,2000);
                
           }else if(e=="user_not_found"){
                     Swal.fire({
                        title: 'Error',
                        text: 'User Was Not Found',
                        confirmButtonText: 'Okay'
                })
               
           }else if(e=="user_not_in_room"){
                    Swal.fire({
                        title: 'Error',
                        text: 'User Was Not Found In The Room Specified',
                        confirmButtonText: 'Okay'
                })
           }
            
        }
    });
    
        
        
    });
</script>
<?php 
if ($_SESSION["user_type"] == "admin" ||$_SESSION["user_type"] == "console"){
    echo "<div class='decor'>
    
    </div>
    ";
}
?>
    <script>
    jQuery(document).ready(function($) {

    $(".search2").hide();
    $("#search").keyup(function () { 
        
        var search = $("#search").val();
            $(".search2").fadeIn();
            if (search.length==0) {
            $(".search2").hide();
                
            }        
            $.ajax({
            type: "post",
            url: "search.php",
            data: {
                "search" : search,
            },
            dataType: "text",
            success: function (e) {
                if(e == ""){
                    console.log("ss");
                    
            $(".if2").html("No Users Found");

                }
                else{
            $(".if2").html(e);

                }
            }
        });
    
    });

    var one = "lol";
    $.ajax({
        type: "post",
        url: "checker.php",
        data: {
            "lol":one,
        },
        dataType: "text",
        success: function (e) {
            if(e == "pack"){                
            }else{
            $(".decor").html(e);
            }
        }
    });

    });
    </script>
</body>

</html>
