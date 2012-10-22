<? 
include_once("basic_functions.php");
switch($_GET['action']){
	case "login": login();break;
	case "signup": signup();break;
	case "logout": logout();break;
	case "update": update();break;//TODO
	case "account_settings":account_settings();
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
	print_r($_POST);
	if(isLogin()){
		include("connect.php");
		if(!isset($_POST['first_name'])||($_POST['first_name']==""))//first name no change
			$first_name=get_user_info("first_name",$_SESSION['id']);
		else
			$first_name=sql_inject_clean($_POST['first_name']);

		if(!isset($_POST['last_name'])||($_POST['last_name']==""))//last name no change
			$last_name=get_user_info("last_name",$_SESSION['id']);
		else
			$last_name=sql_inject_clean($_POST['last_name']);

		if(!isset($_POST['user_name'])||($_POST['user_name']==""))//user name no change
			$user_name=get_user_info("user_name",$_SESSION['id']);
		else
			$user_name=sql_inject_clean($_POST['user_name']);

		if(!isset($_POST['email'])||($_POST['email']=="")){//email name no change
			$email=get_user_info("email",$_SESSION['id']);
		}
		else{
			$email=sql_inject_clean($_POST['email']);
			if (!preg_match("/^([a-zA-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/", $email))//invalid email
				echo "<script type='text/javascript'> document.location='".$config['base_url']."/?error=email invalid'</script>";
				//header("Location:".$config['base_url']."/?error=email invalid");
		}

		if(!isset($_POST['password'])||($_POST['password']=="")){//email name no change
			$password=get_user_info("password",$_SESSION['id']);
		}
		else{
			$password=sql_inject_clean($_POST['password']);
			if(strlen($password)<6)
				echo "<script type='text/javascript'> document.location='".$config['base_url']."/?error=passwords should have minimum 6 characters'</script>";
			$confirm_password=sql_inject_cleam($_POST['confirm_password']);
			if($password!=$confirm_password)
				echo "<script type='text/javascript'> document.location='".$config['base_url']."/?error=passwords does not match'</script>";
		}

		$query=mysqli_query($connect,"update users set first_name='".$first_name."',last_name='".$last_name."',user_name='".$user_name."',password='".$password."',email='".$email."' where id='".$_SESSION['id']."'");
			header("Location:".$config['base_url']."/?message_head=Update Successful&message=Update Complete..");
	}
}
function account_settings(){
	if(isLogin()){
		$data=get_user_info(-1,$_SESSION['id']);
		echo $data['first_name'].":".$data['last_name'].":".$data['user_name'].":".$data['email'].":".$data['user_type'];
	}
}
?>
