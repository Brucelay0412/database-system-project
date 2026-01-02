<?php
error_reporting(E_ALL ^ E_DEPRECATED);

function create_connection()
{
    $host = getenv("MYSQLHOST");
    $user = getenv("MYSQLUSER");
    $password = getenv("MYSQLPASSWORD");
    $database = getenv("MYSQLDATABASE");
    $port = getenv("MYSQLPORT");

    $link = mysqli_connect($host, $user, $password, $database, $port)
        or die("資料庫連線失敗");

    mysqli_set_charset($link, "utf8");
    return $link;
}

?>
