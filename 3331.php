<?php
	
	require_once("dbtools.inc.php");
  $no = isset($_POST["no"]) ? $_POST["no"] : "";
  $message = isset($_POST["message"]) ? $_POST["message"] : "";
	
	$link=create_connection();
	
	$sql="SELECT * FROM grade";
	$result=execute_sql("students", $sql, $link);
 
  $sql = "UPDATE grade SET message = '$message' WHERE no = '$no'";
	  $result=execute_sql("students", $sql, $link);
    

	$sql = "INSERT INTO grade(no, message) VALUES('$no', '$message')";
  $result=execute_sql("students", $sql, $link);
	//執行 UPDATE 陳述式來更新使用者資料
   
	mysqli_free_result($result);
	mysqli_close($link);
?>
<?php	
	/*
	require_once("dbtools.inc.php");
	
//指定每頁顯示幾筆記錄
      $records_per_page = 20;
	
	$link=create_connection();
	//取得欄位數
      $total_fields = mysql_num_fields($result);
	
	//顯示欄位名稱
      echo "<table border='0' align='center' width='300'>";
      echo "<tr align='center'>";         
      for ($i = 0; $i < $total_fields; $i++)
        echo "<td>" . mysql_field_name($result, $i) . "</td>";                  
      //echo "</tr>";
      
      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_row($result) and $j <= $records_per_page)
      {
        echo "<tr>";      
        for($i = 0; $i < $total_fields; $i++)
          
          echo "<td>$row[$i]</td>"; 
                     
        $j++;
        echo "</tr>";     
      }
      echo "</table>" ;
	
	//釋放記憶體空間
	mysql_free_result($result);
	mysql_close($link); */
?>
