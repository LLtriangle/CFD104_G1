<?php
$dbname = "tibamefe_cfd104g1";
$user = "tibamefe_since2021";
$password = "vwRBSb.j&K#E";

$dsn = "mysql:host=localhost;port=3306;dbname=$dbname;charset=utf8";

$options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);

//建立pdo物件
$pdo = new PDO($dsn, $user, $password, $options);


// $sql = "select * from emp where EMP_STATE=1 and JOB='整理師'";
// $emps = $pdo->query($sql);

// $empRows = $emps->fetchAll(PDO::FETCH_ASSOC); 

// echo json_encode($empRows);
?>