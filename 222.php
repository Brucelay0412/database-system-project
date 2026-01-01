<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>查詢掛號紀錄</title>
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
    border: 1px solid #999;
    padding: 8px 12px;
    text-align: center;
  }
  th {
    background-color: #cfe3b4;
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
</style>
</head>
<body>

<h2>查詢掛號紀錄</h2>

<div align="center">
  <form method="post" action="222.php">
    查詢哪位學生的掛號紀錄: <input type="text" name="student_id" size="10"><br>
    <input type="submit" value="查詢">
  </form>
</div>

<?php
require_once("dbtools.inc.php");

$records_per_page = 20;

if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    $link = create_connection();

    // 查詢 clinic.registration 表格
    $sql = "SELECT * FROM registration WHERE student_id = '$student_id'";
    $result = execute_sql("clinic", $sql, $link);

    $total_records = mysqli_num_rows($result);
    echo "<p align='center'>總共: $total_records 筆</p>";

    // 顯示表格
    $total_fields = mysqli_num_fields($result);
    echo "<table>";
    echo "<tr>";
    for ($i = 0; $i < $total_fields; $i++) {
        $field_info = mysqli_fetch_field_direct($result, $i);
        echo "<th>" . $field_info->name . "</th>";
    }
    echo "</tr>";

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
}

// 回首頁按鈕
echo '<div align="center">';
echo '<form method="get" action="register.php">';
echo '<input type="submit" value="回到首頁">';
echo '</form>';
echo '</div>';
?>

</body>
</html>
