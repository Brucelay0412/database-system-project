<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>員工打卡紀錄</title>
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
  table {
    border-collapse: collapse;
    margin: 0 auto 30px auto;
    background-color: white;
  }
  th, td {
    padding: 8px 12px;
    border: 1px solid #999;
    text-align: center;
  }
  th {
    background-color: #cfe3b4;
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

<div class="header">員工打卡紀錄</div>

<div align="center">
<?php
require_once("dbtools.inc.php");

$link = create_connection();
$sql = "SELECT * FROM clock_record ORDER BY clock_time DESC";
$result = execute_sql("clinic", $sql, $link);

echo "<table>";
echo "<tr>
        <th>員工編號</th>
        <th>打卡類型</th>
        <th>時間</th>
      </tr>";

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['employee_id']}</td>";
        echo "<td>" . ($row['clock_type']=="in" ? "上班" : "下班") . "</td>";
        echo "<td>{$row['clock_time']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>目前沒有打卡紀錄</td></tr>";
}

echo "</table>";
mysqli_free_result($result);
mysqli_close($link);

// 返回打卡頁
echo '<form method="get" action="checkpoint.php">';
echo '<input type="submit" value="返回打卡頁">';
echo '</form>';
?>
</div>

</body>
</html>
