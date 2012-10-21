<? 
/*
login
signup
*/
include("../../config.php");
include_once("basic_functions.php");
switch($_GET['action']){
	case "login": login();break;
	case "signup": signup();break;
	case "logout": logout();
}

function login(){
	include("connect.php");
	$user_name=sql_inject_clean($_POST['login_username']);
	$password=sql_inject_clean($_POST['login_password']);
	$query=mysqli_query($connect,"select * from users where user_name='".$user_name."' and password='".$password."'");
	if(mysqli_num_rows($query)>0){
		session_start();
		$_SESSION['id']=get_user_id($user_name);
		header("Location:".$config['base_url']);
	}
	else
		header("Location:".$config['base_url']."/?error=Login%20Failed!!");
}
function signup(){
	if(!isset($_POST['terms']))
		header("Location:".$config['base_url']."/?error=Please%20agree%20to%20terms%20and%20conditions%20and%20Try%20again");
	else if(!(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['user_name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['user_type']))){
		header("Location:".$config['base_url']."/?error=Something%20went%20wrong..%20Try%20again");
	}
	else{
		//manage all the errors
		//first name cant be empty but last name can be empty
		if($_POST['first_name']=="")
			header("Location:".$config['base_url']."/?error=First%20name%20cant%20be%20left%20empty");
		//username
		else if($_POST["user_name"]=="")
			header("Location:".$config['base_url']."/?error=User%20name%20cant%20be%20left%20empty");

		else if(get_user_id(sql_inject_clean($_POST["user_name"]))!=-1)//username already exists
			header("Location:".$config['base_url']."/?error=User%20name%20already%20exists");
		//email
		else if($_POST["email"]=="")
			header("Location:".$config['base_url']."/?error=email%20cant%20be%20left%20empty");
		else if (!preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/", $_POST['email']))//invalid email
			header("Location:".$config['base_url']."/?error=email%20invalid");
		//password
		else if($_POST["password"]=="")
			header("Location:".$config['base_url']."/?error=Password%20cant%20be%20left%20empty");
		else if(strlen($_POST["password"])<6)//min 6 characters
			header("Location:".$config['base_url']."/?error=Password%20should%20have%20minimum%206%20characters");
		//confirm_password
		else if($_POST["confirm_password"]!=$_POST["password"])
			header("Location:".$config['base_url']."/?error=Passwords%20does%20not%20match");

		//signup successfully
		else{
			include("connect.php");
			$first_name=sql_inject_clean($_POST['first_name']);
			$last_name=sql_inject_clean($_POST['last_name']);
			$user_name=sql_inject_clean($_POST['user_name']);
			$email=sql_inject_clean($_POST['email']);
			$password=sql_inject_clean($_POST['password']);
			$user_type=sql_inject_clean($_POST['user_type']);
			$query=mysqli_query($connect,"insert into users (first_name,last_name,user_name,email,password,user_type) values ('".$first_name."','".$last_name."','".$user_name."','".$email."','".$password."','".$user_type."')") or die("cant add user");
			header("Location:".$config['base_url']."/?message_head=Signup%20Successful&message=Signup%20Complete..%20Now%20you%20can%20login");
		}
	}
}
function logout(){
	session_start();
	if(isLogin()){
		$_SESSION=array();
		session_destroy();
	}
	header("Location:".$config['base_url']);
}
?>
