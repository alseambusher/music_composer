<? 
include_once("basic_functions.php");
switch($_GET['action']){
	case "login": login();break;
	case "signup": signup();break;
	case "logout": logout();break;
	case "update": update();//TODO
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
		header("Location:".$config['base_url']."/?error=Login Failed!! Try again");
}
function signup(){
	include("connect.php");
	if(!isset($_POST['terms']))
		header("Location:".$config['base_url']."/?error=Please agree to terms and conditions and Try again");
	else if(!(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['user_name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['user_type']))){
		header("Location:".$config['base_url']."/?error=Something went wrong.. Try again");
	}
	else{
		//manage all the errors
		//first name cant be empty but last name can be empty
		if($_POST['first_name']=="")
			header("Location:".$config['base_url']."/?error=First name cant be left empty");
		//username
		else if($_POST["user_name"]=="")
			header("Location:".$config['base_url']."/?error=User name cant be left empty");

		else if(get_user_id(sql_inject_clean($_POST["user_name"]))!=-1)//username already exists
			header("Location:".$config['base_url']."/?error=User name already exists");
		//email
		else if($_POST["email"]=="")
			header("Location:".$config['base_url']."/?error=email cant be left empty");
		else if (!preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/", $_POST['email']))//invalid email
			header("Location:".$config['base_url']."/?error=email invalid");
		//password
		else if($_POST["password"]=="")
			header("Location:".$config['base_url']."/?error=Password cant be left empty");
		else if(strlen($_POST["password"])<6)//min 6 characters
			header("Location:".$config['base_url']."/?error=Password should have minimum 6 characters");
		//confirm_password
		else if($_POST["confirm_password"]!=$_POST["password"])
			header("Location:".$config['base_url']."/?error=Passwords does not match");

		//signup successfully
		else{
			$first_name=sql_inject_clean($_POST['first_name']);
			$last_name=sql_inject_clean($_POST['last_name']);
			$user_name=sql_inject_clean($_POST['user_name']);
			$email=sql_inject_clean($_POST['email']);
			$password=sql_inject_clean($_POST['password']);
			$user_type=sql_inject_clean($_POST['user_type']);
			$query=mysqli_query($connect,"insert into users (first_name,last_name,user_name,email,password,user_type) values ('".$first_name."','".$last_name."','".$user_name."','".$email."','".$password."','".$user_type."')") or die("cant add user");
			header("Location:".$config['base_url']."/?message_head=Signup Successful&message=Signup Complete.. Now you can login");
		}
	}
}
function logout(){
	include("connect.php");
	session_start();
	if(isLogin()){
		$_SESSION=array();
		session_destroy();
	}
	header("Location:".$config['base_url']);
}
function update(){
//TODO
}
?>
