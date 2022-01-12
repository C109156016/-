<?php

include("connectdb.php");
$sql = "SELECT deptid,deptname,managername FROM dept";
$result =$connect->query($sql);
while ($row = $result->fetch_assoc()) {
    $deptid=$row['deptid'];
    $deptname=$row['deptname'];
    $managername=$row['managername'];

    echo "$deptid  $deptname  $managername";
    echo "<BR>";
}
?>