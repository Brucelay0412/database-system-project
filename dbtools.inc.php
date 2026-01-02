<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


function create_connection()
{
    if (getenv("MYSQLHOST")) {
        $host     = getenv("MYSQLHOST");
        $user     = getenv("MYSQLUSER");
        $password = getenv("MYSQLPASSWORD");
        $database = getenv("MYSQLDATABASE");
        $port     = getenv("MYSQLPORT");
    } else {
        $host     = "localhost";
        $user     = "root";
        $password = "";
        $database = "clinic";
        $port     = 3306;
    }

    $link = mysqli_connect($host, $user, $password, $database, $port);

    if (!$link) {
        die("❌ MySQL 連線失敗：" . mysqli_connect_error());
    }

    mysqli_set_charset($link, "utf8");
    return $link;
}
