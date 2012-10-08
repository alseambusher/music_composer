<?php include('config.php');?>
<!doctype html>
<html>
<head>
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
<h1>Cloud<a href="#">Music</a></h1>
&nbsp; An online music composer / repository
<!--<a id="timer"></a>--><br>
<div class='pull-right'>
	<!-- show these buttons only if not logged in -->
	<button class='btn btn-primary' onclick='load_modal("header","body");'>Signup</button>
	<button class='btn btn-success' onclick='load_form_modal("Enter your login details","scripts/php/basic_functions.php?action=login","<input name=\"login_username\" type=\"text\" placeholder=\"user name\"/><br><input name=\"login_password\"type=\"password\" placeholder=\"password\"/>","login");'>Login</button>
</div>
	<!-- show logout and account settings button if logged in -->


<!-- this is the modal for everything without a form-->
<div class="modal hide fade" id="modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id='modal_header'>Default Header</h3>
  </div>
  <div class="modal-body" id='modal_body' >
  Default body
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
<script type='text/javascript'>
	function load_modal(header,body){
		$('#modal').modal('show');
		document.getElementById("modal_header").innerHTML=header;
		document.getElementById("modal_body").innerHTML=body;
	}
</script>

<!-- this is a modal for everything with a form -->
<div class="modal hide fade" id="form_modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id='form_modal_header'>Default Header</h3>
  </div>
  <form method='post' action='' id='form_modal_action'>
  	<div class="modal-body" id='form_modal_body' >
  	Default body
  	</div>
  	<div class="modal-footer">
    	<a href="#" class="btn" data-dismiss="modal">Close</a>
	<input type='submit' class='btn btn-primary' value='Submit' id='form_modal_submit'>
  	</div>
   </form>
</div>
<script type='text/javascript'>
	function load_form_modal(header,action,body,submit){
		$('#form_modal').modal('show');
		document.getElementById("form_modal_header").innerHTML=header;
		document.getElementById("form_modal_action").action=action;
		document.getElementById("form_modal_body").innerHTML=body;
		document.getElementById("form_modal_submit").value=submit;
	}
</script>
<div id="keys" style="padding-top:150px;">
<img id="65_key"src="images/key.jpg" />
<img id="83_key"src="images/key.jpg" />
<img id="68_key"src="images/key.jpg" />
<img id="70_key"src="images/key.jpg" />
<img id="71_key"src="images/key.jpg" />
<img id="72_key"src="images/key.jpg" />
<img id="74_key"src="images/key.jpg" />
<img id="75_key"src="images/key.jpg" />
<img id="76_key"src="images/key.jpg" />
<img id="59_key"src="images/key.jpg" />
<img id="39_key"src="images/key.jpg" />
</div>
<!-- music libary -->
<? include("includes/sounds.inc");?> 
<!-- music handler -->
<script src="scripts/js/music.js"></script>
</body>
</html>
