<?php
$conn = new mysqli("localhost", "root", "", "newyear");
// if ($conn) {
//  	echo "++";
//  } else{
//  	echo mysqli_error($conn);
//  }

mysqli_set_charset($conn, "utf8");
