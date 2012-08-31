<? 
/*
This page consists of all the basic functions required for this application
Functions that exists in this file are:
TODO login
TODO signup
*/
include("../../config.php");
//TODO write a switch case which launches functions based on $_GET['action']
if($_GET['action']=='login'){
	print_r($_POST);
	//redirect("Location:".$config['base_url']);
}
function login(){
}
function signup(){
}
?>
