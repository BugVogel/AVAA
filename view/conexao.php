<?php

$con = @mysql_connect("localhost", "root", "") or die("Não foi possível conectar ao BD!");
mysql_select_db("avaadb", $con) or die("Banco não localizado!");
?>
