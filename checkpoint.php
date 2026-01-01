<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>員工打卡系統</title>
<style>
  body {
    font-family: "微軟正黑體", sans-serif;
    background-color: #dcdfb1ff;
  }
  .header {
    background-color: #4CAF50;
    color: white;
    font-size: 28px;
    text-align: center;
    padding: 20px;
    font-weight: bold;
    border-radius: 8px;
    margin-bottom: 30px;
  }
  input[type="text"], input[type="submit"] {
    padding: 5px;
    margin: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }
  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #45a049;
  }
  .message {
    margin-top: 10px;
    font-weight: bold;
    color: #0066cc;
  }
  .container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    margin-top: 20px;
  }
  .clock-img {
    max-width: 250px;
    height: auto;
    margin-right: 20px;
  }
  .form-box {
    text-align: left;
  }
</style>
</head>
<body>

<div class="header">員工打卡系統</div>

<div class="container">
  <!-- 左邊圖片 -->
  <img src="clock.png" alt="員工" class="clock-img">

  <!-- 右邊表單 -->
  <div class="form-box">
    <form method="post" action="checkpoint.php">
        員工編號：<input type="text" name="employee_id" size="10"><br><br>
        打卡類型：
        <input type="radio" name="clock_type" value="in" checked> 上班
        <input type="radio" name="clock_type" value="out"> 下班
        <br><br>
        <input type="submit" value="打卡">
    </form>

<?php
// 設定時區為台北
date_default_timezone_set('Asia/Taipei');

require_once("dbtools.inc.php");

if (isset($_POST["employee_id"]) && isset($_POST["clock_type"])) {

    $employee_id = $_POST["employee_id"];
    $clock_type  = $_POST["clock_type"];
    $clock_time  = date("Y-m-d H:i:s"); // 現在會顯示台北時間

    $link = create_connection();
    $sql  = "INSERT INTO clock_record (employee_id, clock_type, clock_time)
             VALUES ('$employee_id', '$clock_type', '$clock_time')";
    execute_sql("clinic", $sql, $link);
    mysqli_close($link);

    echo '<div class="message">
            員工 ' . $employee_id . ' 已打卡 ' . 
            ($clock_type=="in" ? "上班" : "下班") . 
            ' (' . $clock_time . ')</div>';

    // 跳轉帳號登入
    echo '<form method="post" action="accounts.php" style="margin-top:10px;">';
    echo '<input type="submit" value="登入帳號密碼">';
    echo '</form>';

    // 查看打卡紀錄按鈕
    echo '<form method="get" action="check.php" style="margin-top:10px;">';
    echo '<input type="submit" value="查看打卡紀錄">';
    echo '</form>';
}
?>
  </div>
</div>

</body>
</html>
