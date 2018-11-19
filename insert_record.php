<?php

function connect_database()
{
    $con = mysqli_connect("sql128.main-hosting.eu",
        "u334971496_cutqa", "cutqa1234", "u334971496_cutqa");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_set_charset($con, "utf8");
    return $con;
}

function update_database()
{
    global $con;
    $query = "INSERT INTO `ACCOUNT` (`no`, `pin`, `name`, `balance`, `waterCharge`, `electricCharge`, `phoneCharge`)
              VALUES('1111111110', '1150', 'Tom Jerry', 1000, 0, 777, 999)
              ON DUPLICATE KEY UPDATE `pin`='1150', `name`='Tom Jerry', `balance`=1000, `waterCharge`=0, `electricCharge`=777, `phoneCharge`=999;";
    mysqli_query($con, $query);
}

function initial()
{
    global $con;
    $con = connect_database();
    update_database();
}

initial();
