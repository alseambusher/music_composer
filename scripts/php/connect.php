<?
//this includes config also
include("$_SERVER[DOCUMENT_ROOT]/music_composer/config.php");
$connect=mysqli_connect($config['db_host'],$config['db_username'],$config['db_password'],$config['db_database']) or die("cant connect");
?>
