<style type="text/css">
#cloud_control{
	position:fixed;
	right:0px;
	bottom:200px;
	color:white;
	background:white;
	border:1px white solid;
	padding:5px;
	-moz-border-radius:3px;
	border-radius:3px;
	background: rgb(246,248,249); /* Old browsers */
	background: -moz-linear-gradient(top, rgba(246,248,249,1) 0%, rgba(229,235,238,1) 50%, rgba(215,222,227,1) 61%, rgba(245,247,249,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(50%,rgba(229,235,238,1)), color-stop(61%,rgba(215,222,227,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 61%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 61%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top, rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 61%,rgba(245,247,249,1) 100%); /* IE10+ */
	background: linear-gradient(to bottom, rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 61%,rgba(245,247,249,1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-9 */

	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.8);

	line-height:0.5em;

}
#cloud_control a{
	line-height:1.5em;
	font-size:1.3em;
	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.8);
	cursor:pointer;
}
</style>
<script>
	function my_music(order){
		var xhr=new XMLHttpRequest();
		load_modal("My music","<div id='my_music_results'>Fetching results.. wait..</div>");
		var data_buffer='{}';
		if(xhr){
			xhr.onreadystatechange=function(){
				if(xhr.readyState==4){
					if(xhr.status==200){
						document.getElementById("my_music_results").innerHTML="<a class='btn' onclick='my_music(\"title\");'>Order by title </a>&nbsp;";
						document.getElementById("my_music_results").innerHTML+="<a class='btn' onclick='my_music(\"genre\");'>Order by genre</a>&nbsp;";
						document.getElementById("my_music_results").innerHTML+="<a class='btn' onclick='my_music(\"time\");'>Order by time</a>";
						document.getElementById("my_music_results").innerHTML+=xhr.responseText;
					}
					else{
						document.getElementById("my_music_results").innerHTML="Some error occured.. Try again!";
					}
				}
			};
			xhr.open("GET","scripts/php/save_load.php?action=my_music&order="+order);
			xhr.send(null);
		}
	}
	function extract_buffer(){
		toggle_mode();
		record_mode_DATA=data_buffer;
		update_player_controls();
	}
	function share_unshare(isshare,id){//share or unshare async
		var xhr=new XMLHttpRequest();
		if(xhr){
			xhr.open("GET","scripts/php/save_load.php?action="+isshare+"&id="+id);
			xhr.send(null);
		}
	}
	function delete_music(id){
		var xhr=new XMLHttpRequest();
		if(xhr){
			xhr.open("GET","scripts/php/save_load.php?action=delete&id="+id);
			xhr.send(null);
		}
	}
	function all_music(order){
		var xhr=new XMLHttpRequest();
		load_modal("All music","<div id='all_music_results'>Fetching results.. wait..</div>");
		var data_buffer='{}';
		if(xhr){
			xhr.onreadystatechange=function(){
				if(xhr.readyState==4){
					if(xhr.status==200){
						document.getElementById("all_music_results").innerHTML="<a class='btn' onclick='all_music(\"title\");'>Order by title </a>&nbsp;";
						document.getElementById("all_music_results").innerHTML+="<a class='btn' onclick='all_music(\"genre\");'>Order by genre</a>&nbsp;";
						document.getElementById("all_music_results").innerHTML+="<a class='btn' onclick='all_music(\"time\");'>Order by time</a>";
						document.getElementById("all_music_results").innerHTML+=xhr.responseText;
					}
					else{
						document.getElementById("all_music_results").innerHTML="Some error occured.. Try again!";
					}
				}
			};
			xhr.open("GET","scripts/php/save_load.php?action=all_music&order="+order);
			xhr.send(null);
		}
	}
	function update_search_bar(mode){
	console.log(mode);
		var xhr=new XMLHttpRequest();
		if(xhr){
			xhr.onreadystatechange=function(){
				if(xhr.readyState==4){
					if(xhr.status==200){
						document.getElementById("search_music_results").innerHTML=xhr.responseText;
					}
				}
			};
			xhr.open("GET","scripts/php/save_load.php?action=search&type="+mode+"&query="+document.getElementById("search_bar").value);
			xhr.send(null);
		}
	}
	function search_music(mode){
		load_modal("Search "+mode,"<input type='text' id='search_bar'></input><div id='search_music_results'>results</div>");
		document.getElementById("search_bar").onkeyup=function(){ update_search_bar(mode); };
	}
</script>
<div id="cloud_control">
<a class="btn btn-info" onclick="my_music('time');">My music</a><br><br>
<a class="btn btn-info" onclick="all_music('time');">All music&nbsp;</a><br><br>
<a class="btn btn-info" onclick="search_music('title');">&nbsp;<i class='icon-search'></i> Titles&nbsp;&nbsp;</a><br><br>
<a class="btn btn-info" onclick="search_music('users');">&nbsp;<i class='icon-search'></i> Users&nbsp;&nbsp;</a>
</div>
