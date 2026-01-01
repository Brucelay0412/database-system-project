<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新增掛號資料</title>
<style>
  body {
    font-family: "微軟正黑體", sans-serif;
    background-color: #dcdfb1ff;
  }
  h2 {
    text-align: center;
  }
  table {
    border-collapse: collapse;
    margin: 0 auto 20px auto;
    background-color: white;
  }
  th, td {
    padding: 8px 12px;
    border: 1px solid #999;
    text-align: center;
  }
  form {
    text-align: center;
    margin: 10px 0;
  }
  input[type="text"], input[type="datetime-local"] {
    padding: 5px;
    margin: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }
  input[type="submit"] {
    padding: 5px 15px;
    margin: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>
</head>
<body>

<div align="center">
<br> 

<?php
require_once("dbtools.inc.php");

// 處理掛號送出的資料
if (isset($_POST['timestamp']) && isset($_POST['student_id']) && isset($_POST['student_name']) && isset($_POST['temperature'])) {
    $timestamp = $_POST["timestamp"];
    $student_id = $_POST["student_id"];
    $student_name = $_POST["student_name"];
    $temperature = $_POST["temperature"];
    $fever = ($temperature >= 37.5) ? 'Yes' : 'No';

    $link = create_connection();
    $sql = "INSERT INTO registration (timestamp, student_id, student_name, temperature, fever) 
            VALUES('$timestamp', '$student_id', '$student_name', $temperature, '$fever')";
    execute_sql("clinic", $sql, $link);
    mysqli_close($link);

    echo "<p>掛號資料已新增！ 發燒：$fever</p>";
}

// 處理刪除掛號
if (isset($_POST["delete_student_id"]) && !empty($_POST["delete_student_id"])) {
    $student_id = $_POST["delete_student_id"];
    $link = create_connection();
    $sql = "DELETE FROM registration WHERE student_id = '$student_id'";
    execute_sql("clinic", $sql, $link);
    mysqli_close($link);
    echo "<p>已刪除學號 $student_id 的掛號資料</p>";
}

// 顯示掛號列表
$link = create_connection();
$sql = "SELECT * FROM registration ORDER BY timestamp DESC";
$result = execute_sql("clinic", $sql, $link);

echo "<h2>掛號資料列表</h2>";
echo "<table>";
echo "<tr><th>時間</th><th>學號</th><th>姓名</th><th>體溫</th><th>發燒</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['timestamp'] . "</td>";
    echo "<td>" . $row['student_id'] . "</td>";
    echo "<td>" . $row['student_name'] . "</td>";
    echo "<td>" . $row['temperature'] . "</td>";
    echo "<td>" . $row['fever'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_free_result($result);
mysqli_close($link);
?>

<!-- 掛號表單 -->
<form method="post" action="22.php">
    輸入掛號時間:<input type="datetime-local" name="timestamp"><br>
    學號:<input type="text" name="student_id" size="10"><br>
    姓名:<input type="text" name="student_name" size="10"><br>
    體溫:<input type="text" name="temperature" size="5"><br>
    <input type="submit" value="掛號">
</form>

<!-- 刪除掛號表單 -->
<form method="post" action="22.php">
    取消掛號（輸入學號）：<br>
    <input type="text" name="delete_student_id" size="10">
    <input type="submit" value="刪除掛號">
</form>

<!-- 回到首頁按鈕 -->
<form method="get" action="register.php">
    <input type="submit" value="回到首頁">
</form>

</div>
</body>
</html>
