<?php
session_start();
require_once("dbtools.inc.php");

$error = "";

// 登出
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: checkpoint.php?");
    exit;
}

// 登入驗證
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $link = create_connection();
    $sql = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
    $result = execute_sql("clinic", $sql, $link);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        if($result) mysqli_free_result($result);
        mysqli_close($link);
        header("Location: register.php"); // 登入成功直接跳掛號系統
        exit;
    } else {
        $error = "帳號或密碼錯誤";
    }

    if($result) mysqli_free_result($result);
    mysqli_close($link);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>帳號系統</title>
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
  .form-container {
    background-color: #f2f2f2;
    padding: 20px 30px;
    border-radius: 8px;
    display: inline-block;
    text-align: left;
  }
  input[type="text"], input[type="password"], input[type="submit"] {
    padding: 8px;
    margin: 8px 0;
    border-radius: 4px;
    border: 1px solid #ccc;
    width: 200px;
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
    text-align: center;
  }
</style>
</head>
<body>

<div class="header">
  帳號系統
</div>

<div align="center">
  <div class="form-container">
    <?php if(isset($_SESSION['username'])): ?>
        <p class="message">歡迎, <?php echo $_SESSION['username']; ?>!</p>
        <form method="post">
            <input type="submit" name="logout" value="登出">
        </form>
    <?php else: ?>
        <form method="post">
            帳號: <input type="text" name="username"><br>
            密碼: <input type="password" name="password"><br>
            <input type="submit" value="登入">
        </form>
        <?php if(!empty($error)) echo '<p class="message" style="color:red">'.$error.'</p>'; ?>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
