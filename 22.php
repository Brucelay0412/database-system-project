<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("dbtools.inc.php");

// 只允許 POST 進來
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("非法存取");
}

// 檢查必要欄位
if (
    empty($_POST['timestamp']) ||
    empty($_POST['student_id']) ||
    empty($_POST['student_name']) ||
    empty($_POST['temperature'])
) {
    die("資料不完整");
}

$timestamp    = $_POST['timestamp'];
$student_id   = $_POST['student_id'];
$student_name = $_POST['student_name'];
$temperature  = $_POST['temperature'];

$fever = ($temperature >= 37.5) ? 'Yes' : 'No';

// 連線資料庫
$link = create_connection();

$sql = "
INSERT INTO registration
(timestamp, student_id, student_name, temperature, fever)
VALUES
('$timestamp', '$student_id', '$student_name', $temperature, '$fever')
";

if (!mysqli_query($link, $sql)) {
    die(mysqli_error($link));
}

mysqli_close($link);

// 成功後跳回首頁
header("Location: register.php?success=1");
exit;
