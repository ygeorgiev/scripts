#!/usr/bin/php -q
<?php
$pass='';
$max='10'; //seconds

mysql_connect("localhost","root",$pass);
$result = mysql_query("SHOW FULL PROCESSLIST");
while ($row=mysql_fetch_array($result)) {
        $process_id=$row["Id"];
        if ($row["Time"] > $max && $row["User"]!="root") {
                $sql="KILL $process_id";
                mysql_query($sql);
                }
        }
?>

