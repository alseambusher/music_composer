<? 
/*
this will have all the basic functions
get_user_info(type,uid=-1)
get_user_id($user_name)
sql_inject_clean($string)
*/
function get_user_info($type=-1,$uid){
	include("connect.php");
	if($type==-1){//send all
		$query=mysqli_query($connect,"select * from users where id='".$uid."'") or die("cant get");
		while($row=mysqli_fetch_array($query))
			return $row;
	}
	else{
		$query=mysqli_query($connect,"select ".$type." from users where id='".$uid."'") or die("cant get");
		while($row=mysqli_fetch_array($query))
			return $row[$type];
	}
	return -1;//failed
}
function get_user_id($user_name){
	include("connect.php");
	$query=mysqli_query($connect,"select id from users where user_name='".$user_name."'");
	while($row=mysqli_fetch_array($query))
		return $row['id'];
	return -1;//failed
}
function sql_inject_clean($string){
	include("connect.php");
	return mysqli_real_escape_string($connect,$string);
}
function islogin(){
	session_start();
	if(isset($_SESSION['id']))
		if($_SESSION['id']!=NULL)
			return true;
	return false;
}
?>
