<!-- cancel.php -->
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>取消掛號</title>
</head>
<body>

<div align="center">
  <h2>取消掛號系統</h2>
  <form method="post" action="cancel.php">
    輸入學號取消掛號: <br>
    <input type="text" name="student_id" size="10"><br><br>
    <input type="submit" value="取消掛號">
  </form>
</div>

<?php
require_once("dbtools.inc.php");

if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    $link = create_connection();
    $sql = "DELETE FROM registration WHERE student_id = '$student_id'";
    execute_sql("clinic", $sql, $link);
    mysqli_close($link);

    echo "<p align='center'>學號 $student_id 的掛號已取消！</p>";
}
?>

</body>
</html>
