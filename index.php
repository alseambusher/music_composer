<?//ini_set('display_errors', 'On');?>
<?session_start();?>
<?php include("scripts/php/basic_functions.php");?>
<!doctype html>
<html>
<head>
<?include('config.php');?>
<?include('includes/bootstrap.inc.php');?>
<script src="scripts/js/misc.js"></script>
<link rel="stylesheet" href="css/style.css"/>
<meta http-equiv="Content-Type" content="application/xhtml+xm; charset=utf-8" />
<?header ('Content-type: text/html; charset=utf-8');?>
<title>Cloud Music</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<style type="text/css">
      body {
      	padding:15px;
      }
</style>
</head>
<body>
<h1>Cloud<a href="<?echo $config['base_url'];?>">Music</a></h1>
&nbsp; An online music composer / repository
<!--<a id="timer"></a>--><br>
<div class='pull-right'>
	<? if(!isLogin()){ ?>

	<button class='btn btn-primary' onclick='load_form_modal("Quick Signup","scripts/php/accounts.php?action=signup","<input name=\"first_name\" type=\"text\" placeholder=\"First Name\"/><br><input name=\"last_name\" type=\"text\" placeholder=\"Last Name\"/><br><input name=\"user_name\" type=\"text\" placeholder=\"username\"/><br><input name=\"email\" type=\"text\" placeholder=\"email\"/><br><input name=\"password\"type=\"password\" placeholder=\"password\"/><br><input name=\"confirm_password\"type=\"password\" placeholder=\"confirm password\"/><br><select name=\"user_type\" value=\"-1\"><option value=\"pro composer\">pro composer</option><option value=\"composer\">composer</option><option value=\"learner\">learner</option><option value=\"music_lover\">I Just Love Music</option></select><br><input name=\"terms\" value=\"1\" type=\"checkbox\"/> &nbsp;&nbsp;&nbsp;I agree to terms and conditions","Signup");'>Signup</button>

	<button class='btn btn-success' onclick='load_form_modal("Enter your login details","scripts/php/accounts.php?action=login","<input name=\"login_username\" type=\"text\" placeholder=\"user name\"/><br><input name=\"login_password\"type=\"password\" placeholder=\"password\"/>","login");'>Login</button>

	<?}else{?>
	<button class="brn btn-primary" onclick="account_settings();">Account Settings</button>
	<a class="btn btn-success" href="scripts/php/accounts.php?action=logout">Logout</a><br>
	<h2><?echo get_user_info("first_name",$_SESSION['id'])." ".get_user_info("last_name",$_SESSION['id']);?></h2>
	<?}?>
</div>

<!-- this is the modal for everything without a form-->
<div class="modal hide fade" id="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="toggle_mode();">×</button>
    <h3 id='modal_header'>Default Header</h3>
  </div>
  <div class="modal-body" id='modal_body' >
  Default body
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" onclick="toggle_mode();">Close</a>
  </div>
</div>
<script type='text/javascript'>
	function load_modal(header,body){
		toggle_mode();
		$('#modal').modal('show');
		document.getElementById("modal_header").innerHTML=header;
		document.getElementById("modal_body").innerHTML=body;
	}
</script>

<!-- this is a modal for everything with a form -->
<div class="modal hide fade" id="form_modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" onclick="toggle_mode();">×</button>
    <h3 id='form_modal_header'>Default Header</h3>
  </div>
  <form method='post' action='' id='form_modal_action'>
  	<div class="modal-body" id='form_modal_body' >
  	Default body
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal" onclick="toggle_mode();">Close</a>
	<input type='submit' class='btn btn-primary' value='Submit' id='form_modal_submit'>
  	</div>
   </form>
</div>
<script type='text/javascript'>
	function load_form_modal(header,action,body,submit){
		toggle_mode();
		$('#form_modal').modal('show');
		document.getElementById("form_modal_header").innerHTML=header;
		document.getElementById("form_modal_action").action=action;
		document.getElementById("form_modal_body").innerHTML=body;
		document.getElementById("form_modal_submit").value=submit;
	}
</script>


<? if(isLogin()){?>
<!--control -->
<?include("includes/player_controls.inc");?>
<?}?>
<!--keyboard-->
<? include("includes/keyboard.inc"); ?>
<!-- music libary -->
<? include("includes/sounds.inc");?> 
<!-- music handler -->
<script src="scripts/js/music.js"></script>
<script type="text/javascript">
	function alerts(){
		if("<?echo $_GET["error"]; ?>")
			load_modal("Error!!!","<?echo $_GET['error'];?>");
		else if("<?echo $_GET["message"]; ?>")
			load_modal("<?echo $_GET['message_head'];?>","<?echo $_GET['message'];?>");
	}
	setTimeout("alerts();","0");
</script>
</body>
</html>
