<?php
session_start();
require_once("dbtools.inc.php");

// 登出
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: checkpoint.php");
    exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>掛號系統</title>
<style>
  body {
    font-family: "微軟正黑體", sans-serif;
    background-color: #fffffeff;
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
    position: relative;
  }
  .user-info {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 16px;
    color: white;
  }
  .user-info form {
    display: inline;
  }
  input[type="submit"] {
    padding: 5px 10px;
    margin-left: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #45a049;
    color: white;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #39843c;
  }
  .form-container {
    background-color: #f2f2f2;
    padding: 20px 30px;
    border-radius: 8px;
    display: inline-block;
    text-align: left;
  }
</style>
</head>
<body>

<div class="header">
  掛號系統
  <?php if(isset($_SESSION['username'])): ?>
    <div class="user-info">
      帳號: <?php echo $_SESSION['username']; ?>
      <form method="post" style="display:inline;">
          <input type="submit" name="logout" value="登出">
      </form>
    </div>
  <?php endif; ?>
</div>

<div align="center">
  <img src="STUST.png" alt="掛號系統" style="max-width:600px; height:auto;">
  <h2>掛號系統</h2>

  <div class="form-container">
    <!-- 掛號表單 -->
    <form method="post" action="22.php">
      輸入掛號時間: <input type="datetime-local" name="timestamp"><br>
      學號: <input type="text" name="student_id" size="10"><br>
      姓名: <input type="text" name="student_name" size="10"><br>
      體溫: <input type="text" name="temperature" size="5"><br>
      <input type="submit" value="掛號">
    </form>
    <br>
    <!-- 查看完整掛號紀錄 -->
    <form method="post" action="333.php">
      <input type="submit" value="查看完整掛號紀錄">
    </form>
    <br>
    <!-- 查詢指定學生掛號 -->
    <form method="post" action="222.php">
      查詢哪位學生的掛號紀錄: <input type="text" name="student_id" size="10"><br>
      <input type="submit" value="查詢">
    </form>
  </div>
</div>

</body>
</html>
