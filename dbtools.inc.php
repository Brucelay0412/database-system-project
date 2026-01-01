<?php
error_reporting(E_ALL ^ E_DEPRECATED);

function create_connection()
{

    $link = mysqli_connect("localhost", "root", "")
      or die("無法建立資料連接<br><br>" . mysqli_connect_error());

    mysqli_set_charset($link, "utf8");
    
    return $link;
}

function execute_sql($database, $sql, $link)
{
    $db_selected = mysqli_select_db($link, $database)
      or die("開啟資料庫失敗<br><br>" . mysqli_error($link));

    $result = mysqli_query($link, $sql);
    
    return $result;
}
?>
