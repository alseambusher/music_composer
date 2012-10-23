<style type="text/css">
#player_controls{
	position:fixed;
	left:0px;
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
.record,.record_active{
	width:20px; 
	height:20px; 
	cursor:pointer;
	padding:4px;
	margin:2px;
	margin-left:12px;
   	-moz-border-radius:10px;
   	-webkit-border-radius:10px;
   	border-radius:10px;
	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.8);

}
.record{
	background-color:red;
}
.record_active{
	background-color:#1f9f1f;
}
.play_button_disabled,.play_button,.play_button_playing{
	width:0px; 
	height:0px; 
	margin:2px;
	margin-left:15px;
	border-bottom:15px solid transparent;  /* left arrow slant */
	border-top:15px solid transparent; /* right arrow slant */
	font-size:0px;
	line-height:0px;
	-moz-border-radius:6px;
	border-radius:6px;
	cursor:pointer;
	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.2);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.2);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.2);

}
.play_button{
	border-left:25px solid #1f1f1f; /* bottom, add background color here */
}
.play_button_playing{
	border-left:25px solid #1f9f1f; /* bottom, add background color here */
}
.play_button_disabled{
	border-left:25px solid gray;
}
#player_controls .save{
	line-height:1.5em;
	font-size:1.3em;
	color:black;
	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.8);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.8);
	cursor:pointer;
}
</style>
<script type="text/javascript">
	function toggle_record(obj){
		if(record_mode){
			RECORD_TIMER=-1;//stop record timer thread
			record_mode=false;//this is in system.js
			obj.setAttribute("class","record");
		}
		else{
			RECORD_TIMER=0;
			setTimeout("record_timer();",0);
			record_mode_DATA={65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]};
			record_mode_DATA_blocked={65:false,83:false,68:false,70:false,71:false,72:false,74:false,75:false,76:false,90:false,88:false,67:false,86:false,66:false,78:false,77:false,81:false,87:false,69:false,82:false,84:false,89:false,85:false,73:false,79:false,80:false};
			record_mode=true;//this is in system.js
			obj.setAttribute("class","record_active");
		}
		update_player_controls();
	}
	function clear_data(){
		record_mode_DATA={65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]};
		record_mode_DATA_blocked={65:false,83:false,68:false,70:false,71:false,72:false,74:false,75:false,76:false,90:false,88:false,67:false,86:false,66:false,78:false,77:false,81:false,87:false,69:false,82:false,84:false,89:false,85:false,73:false,79:false,80:false};
		record_mode=false;
		update_player_controls();
	}
	function update_player_controls(){
		if(JSON.stringify(record_mode_DATA)==JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]})){
			document.getElementById("play_button").setAttribute("class","play_button_disabled");
		}
		else{
			document.getElementById("play_button").setAttribute("class","play_button");
		}
	}
	function play_back(){
		if(document.getElementById("play_button").getAttribute("class")=="play_button_playing"){
			document.getElementById("play_button").setAttribute("class","play_button");
			PLAY_TIMER=-1;//stop timer
		}
		else if(JSON.stringify(record_mode_DATA)!=JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]})){
			document.getElementById("play_button").setAttribute("class","play_button_playing");
			PLAY_TIMER=0;
			setTimeout("play_timer()","0");//start timer
			play_cheatsheet(jQuery.extend(true,{},record_mode_DATA));//is in music.js we have to deep copy to retain it
		}
	}
	function save(){
		console.log(JSON.stringify(record_mode_DATA));
		if(JSON.stringify(record_mode_DATA)!=JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]})){
			load_form_modal("Do you want to save?","scripts/php/save_load.php?action=save","<input name=\"title\" type=\"text\" placeholder=\"title\"/>&nbsp;&nbsp;If no title is given, a title is automatically generated<br><select name=\"genre\"><option value=\"classic\">classic</option><option value=\"hiphop\">hiphop</option><option value=\"rock\">rock</option><option value=\"other\">other</option><option value=\"jazz\">jazz</option><option value=\"RnB\">RnB</option></select><br><input name=\"share\" value=\"1\" type=\"checkbox\"/> &nbsp;&nbsp;&nbsp;Share with other users.<input type=\"hidden\" name=\"data\" value='"+JSON.stringify(record_mode_DATA)+"'>","Save");
		}
	}
	function restore(){
		load_modal("Operation in progress","<p id='data_result'>Restoring music data....<br>Please DONT CLOSE!!</p>");
		var xhr=new XMLHttpRequest();
		if(xhr){
			xhr.onreadystatechange=function(){
				if(xhr.readyState==4){
					if(xhr.status==200){
						if(xhr.responseText=="no history session found")
							document.getElementById("data_result").innerHTML="No history session found";
						else{
							record_mode_DATA=JSON.parse(xhr.responseText);
							update_player_controls();
							document.getElementById("data_result").innerHTML="Restore complete";
						}
					}
					else{
						document.getElementById("data_result").innerHTML="Some error occoured.. Try again..";
					}
				}
			};
			xhr.open("GET","scripts/php/save_load.php?action=restore");
			xhr.send(null);
		}
	}
</script>
<div id='player_controls'>
<div class="play_button_disabled" id="play_button" onclick="play_back();"></div><br>
<div class="record" id="record" onclick="toggle_record(this);"></div><br>
<div class="save"><a class='btn btn-info btn-small' onclick="save();">&nbsp;SAVE&nbsp;&nbsp;</a></div><br>
<div class="save" ><a class='btn btn-info btn-small' onclick="clear_data();">&nbsp;CLEAR</a></div><br>
<div class="save"><a class='btn btn-info btn-small'>&nbsp;LEARN</a></div><br>
<div class="save"><a class='btn btn-info btn-small' style='font-size:0.505em;' onclick="restore();">RESTORE</a></div><br>
</div>
