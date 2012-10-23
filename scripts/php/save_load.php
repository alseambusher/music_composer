<?
include("connect.php");
include("basic_functions.php");
switch($_GET['action']){
	case "save": save();break;
}

function save(){//this is done async
	if(isLogin()){
		$data=sql_inject_clean($_POST['data']);
		if(isset($_POST['share']))
			$share=1;
		else
			$share=0;
		$title=sql_inject_clean($_POST['title']);
		if((get_music($title)==-1)||($title!=''){
			$genre=sql_inject_clean($_POST['genre']);
			$query=mysqli_query($connect,"insert into cloud (uid,share,data,title,genre) values('".$_SESSION['id']."','".$share."','".$data."','".$title."','".$genre."');") or die("cant insert");
			echo "1";
		}
		else{
			echo "0";//failed raise title has to be unique  or title empty modal
		}
	}
}
//this will get all music data from its title
function get_music($title){
	$query=mysqli_query($connect,"select * from cloud where title='".$title."'");
	while($row=mysqli_fetch_array($query)){
		return $row;
	}
	return -1;//failed
}
	
?>
