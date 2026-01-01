<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>查詢掛號資料</title>
  </head>
  <body>

  <div align="center">
    <h2>查詢掛號資料</h2>

    <!-- 查詢表單 -->
    <form method="post" action="search.php">
      請輸入學生學號: <input type="text" name="student_id" size="10"><br><br>
      <input type="submit" value="查詢">
    </form>
  </div>

<?php
require_once("dbtools.inc.php");

// 如果有送出表單
if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // 建立資料庫連線
    $link = create_connection();

    // 查詢指定學號的掛號資料
    $sql = "SELECT * FROM registration WHERE student_id = '$student_id' ORDER BY timestamp DESC";
    $result = execute_sql("clinic", $sql, $link);

    // 顯示結果
    echo "<h3 align='center'>查詢結果</h3>";

    if (mysqli_num_rows($result) > 0) {
        $total_fields = mysqli_num_fields($result);
        echo "<table border='1' align='center' width='600'>";
        echo "<tr align='center'>";
        for ($i = 0; $i < $total_fields; $i++) {
            $field_info = mysqli_fetch_field_direct($result, $i);
            echo "<th>" . $field_info->name . "</th>";
        }
        echo "</tr>";

        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            for ($i = 0; $i < $total_fields; $i++)
                echo "<td>$row[$i]</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p align='center'>查無資料！</p>";
    }

    mysqli_free_result($result);
    mysqli_close($link);
}
?>

  </body>
</html>
