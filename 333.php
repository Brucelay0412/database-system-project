<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>瀏覽掛號資料</title>
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
    padding: 8px 16px;
    margin: 10px;
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

<div class="header">掛號資料瀏覽</div>

<?php
require_once("dbtools.inc.php");

// 每頁顯示筆數
$records_per_page = 20;

// 連線資料庫
$link = create_connection();
$sql = "SELECT * FROM registration ORDER BY timestamp DESC";
$result = execute_sql("clinic", $sql, $link);

// 顯示表格標題
echo "<h3 align='center'>掛號資料列表（最新掛號在上方）</h3>";

$total_fields = mysqli_num_fields($result);
echo "<table border='1' width='800'>";
echo "<tr>";
for ($i = 0; $i < $total_fields; $i++) {
    $field_info = mysqli_fetch_field_direct($result, $i);
    echo "<th>" . $field_info->name . "</th>";
}
echo "</tr>";

// 顯示資料
$j = 1;
while ($row = mysqli_fetch_row($result) and $j <= $records_per_page) {
    echo "<tr>";
    for ($i = 0; $i < $total_fields; $i++) {
        echo "<td>$row[$i]</td>";
    }
    echo "</tr>";
    $j++;
}

echo "</table>";

mysqli_free_result($result);
mysqli_close($link);
?>

<div align="center">
  <form method="get" action="register.php">
      <input type="submit" value="回到首頁">
  </form>
</div>

</body>
</html>
