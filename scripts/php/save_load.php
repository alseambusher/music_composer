<?ini_set('display_errors', 'On');?>
<?
include("basic_functions.php");
switch($_GET['action']){
	case "save": save();break;
	case "restore":restore();break;
	case "my_music":my_music();break;
	case "share":share();break;
	case "unshare":unshare();break;
	case "delete":delete_music();break;
	case "all_music":all_music();break;
	case "search":search();break;
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
	if(isLogin()){
		if(!isset($_SESSION['data']))
			echo "no history session found";
		else
			echo stripslashes($_SESSION['data']);
	}
}
function my_music(){
	if(isLogin()){
		include("connect.php");
		if($_GET['order']=="time")
			$query=mysqli_query($connect,"select * from cloud where uid='".$_SESSION['id']."' order by time desc") or die("cant query");
		else
			$query=mysqli_query($connect,"select * from cloud where uid='".$_SESSION['id']."' order by ".$_GET['order']) or die("cant query");
		echo '<div class="row-fluid" >
          		<div class="well sidebar-nav">
            			<ul class="nav nav-list">';
		while($row=mysqli_fetch_array($query)){
			if($row['share']==0)
				$share="<em class='btn btn-small' onclick='share_unshare(\"share\",".$row['id'].");this.innerHTML=\"Unshare\";'>Share</em>";
			else
				$share="<em class='btn btn-small' onclick='share_unshare(\"unshare\",".$row['id'].");this.innerHTML=\"Share\";'>Unshare</em>";
			echo "<li><a href='#' onclick='data_buffer=".stripslashes($row['data']).";extract_buffer();close_modal();set_buffer_state(\"".$row['title']." loaded to buffer\");'>".$row['title']."</a>".$row['genre']."<br>".$share." &nbsp;<em class='btn btn-small' onclick='delete_music(".$row['id'].");this.innerHTML=\"DELETED\";'>Delete</em> &nbsp;".$row['time']."<br><br></li>";
		}
			echo '</ul>
		  </div>
		</div>';
		}
}
function all_music(){
	if(isLogin()){
		include("connect.php");
		if($_GET['order']=="time")
		//select cloud.*,users.first_name,users.last_name from cloud inner join users on users.id=cloud.uid where cloud.share=1 and cloud.uid!=2
			$query=mysqli_query($connect,"select cloud.*,users.first_name,users.last_name from cloud  inner join users on users.id=cloud.uid where share=1 and uid!='".$_SESSION['id']."' order by time desc") or die("cant query");
		else
			$query=mysqli_query($connect,"select cloud.*,users.first_name,users.last_name from cloud  inner join users on users.id=cloud.uid where share=1 and uid!='".$_SESSION['id']."' order by ".$_GET['order']) or die("cant query");

		echo '<div class="row-fluid" >
          		<div class="well sidebar-nav">
            			<ul class="nav nav-list">';
		while($row=mysqli_fetch_array($query)){
			echo "<li><a href='#' onclick='data_buffer=".stripslashes($row['data']).";extract_buffer();close_modal();set_buffer_state(\"".$row['title']." loaded to buffer\");'>".$row['title']."</a>".$row['genre']."<br>by ".$row['first_name']." ".$row['last_name']." ".$row['time']."<br><br></li>";
		}
			echo '</ul>
		  </div>
		</div>';
		}
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
function share(){
	if(isLogin()){
		include("connect.php");
		$query=mysqli_query($connect,"update cloud set share=1 where uid='".$_SESSION['id']."' and  id='".$_GET['id']."'") or die("cant update");
	}
}
function unshare(){
	if(isLogin()){
		include("connect.php");
		$query=mysqli_query($connect,"update cloud set share=0 where uid='".$_SESSION['id']."' and id='".$_GET['id']."'") or die("cant update");
	}
}
function delete_music(){
	if(isLogin()){
		include("connect.php");
		$query=mysqli_query($connect,"delete from cloud where uid='".$_SESSION['id']."' and id='".$_GET['id']."'") or die("cant update");
	}
}
function search(){
	if(isLogin()){
		include("connect.php");
			if($_GET['type']=='title'){
			//echo "select cloud.*,users.first_name,users.last_name from cloud  inner join users on users.id=cloud.uid where (share=1 or uid='".$_SESSION['id']."') and title like '%".$_GET['query']."%' order by title";
				$query=mysqli_query($connect,"select cloud.*,users.first_name,users.last_name from cloud  inner join users on users.id=cloud.uid where (share=1 or uid='".$_SESSION['id']."') and title like '%".$_GET['query']."%' order by title") or die("cant query");
			}
			else if($_GET['type']=='users'){
				$query=mysqli_query($connect,"select cloud.*,users.first_name,users.last_name from cloud  inner join users on users.id=cloud.uid where (share=1 or uid='".$_SESSION['id']."') and ( users.first_name like '%".$_GET['query']."%' or users.last_name like '%".$_GET['query']."%')") or die('cant query');
			}

		echo '<div class="row-fluid" >
          		<div class="well sidebar-nav">
            			<ul class="nav nav-list">';
		if(mysqli_num_rows($query)<1)
			echo "No results found!!";
		while($row=mysqli_fetch_array($query)){
			echo "<li><a href='#' onclick='data_buffer=".stripslashes($row['data']).";extract_buffer();close_modal();set_buffer_state(\"".$row['title']." loaded to buffer\");'>".$row['title']."</a>".$row['genre']."<br>by ".$row['first_name']." ".$row['last_name']." ".$row['time']."<br><br></li>";
		}
			echo '</ul>
		  </div>
		</div>';
	}
}
?>
