<?ini_set('display_errors', 'On');?>
<?
include("basic_functions.php");
switch($_GET['action']){
	case "save": save();break;
	case "restore":restore();
}

function save(){//this is done async
	include("connect.php");
	print_r($_POST);
	if(isLogin()){
		if(!isset($_POST['title'])||($_POST['title']==''))
			$title=time();
		else
			$title=sql_inject_clean($_POST['title']);
		$data=sql_inject_clean($_POST['data']);
		$_SESSION['data']=$data;
		if(isset($_POST['share']))
			$share=1;
		else
			$share=0;
		$genre=sql_inject_clean($_POST['genre']);
		$query=mysqli_query($connect,"insert into cloud (uid,share,data,title,genre) values('".$_SESSION['id']."','".$share."','".$data."','".$title."','".$genre."');") or die("cant insert");
		header("Location:".$config['base_url']."/?message_head=Save Successfull&message='".$title."' successfully saved!!");
	}
}
function restore(){
	session_start();
	if(!isset($_SESSION['data']))
		echo "no history session found";
	else
		echo stripslashes($_SESSION['data']);
}
//this will get all music data from its title
function get_music($title){
	include("connect.php");
	$query=mysqli_query($connect,"select * from cloud where title='".$title."'");
	while($row=mysqli_fetch_array($query)){
		return $row;
	}
	return -1;//failed
}
	
?>
