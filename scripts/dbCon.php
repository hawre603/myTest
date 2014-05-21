<?php
$mysql_hostname = "localhost";//"db503355418.db.1and1.com";
$mysql_user = "root";//"dbo503355418";
$mysql_password = "hkaa1";//"pampelmuse";
$mysql_database = "musuemdata";//"db503355418";
$prefix = "";
/*$dbCon= mysql_connect('localhost', 'root', 'hkaa1') or die('cnnot connect');
mysql_select_db('musuemdata')*/
/*
$mysql_hostname = "db503355418.db.1and1.com";
$mysql_user = "dbo503355418";
$mysql_password = "pampelmuse";
$mysql_database = "db503355418";
$prefix = "";
$dbCon= mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");*/



$dbCon = new mysqli("127.0.0.1", "root", "root", "musuemdata");
if ($dbCon->connect_errno) {
    echo "Failed to connect to MySQL: (" . $dbCon->connect_errno . ") " . $dbCon->connect_error;
}

/*$dbCon = new mysqli("127.0.0.1", "root", "root", "musuemdata", 3306);
if ($dbCon->connect_errno) {
    echo "Failed to connect to MySQL: (" . $dbCon->connect_errno . ") " . $dbCon->connect_error;
}

echo $dbCon->host_info . "\n";*/
?>