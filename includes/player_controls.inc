<style type="text/css">
#player_controls{
	position:fixed;
	left:0px;
	bottom:260px;
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
	margin-left:4px;
	border-bottom:15px solid transparent;  /* left arrow slant */
	border-top:15px solid transparent; /* right arrow slant */
	font-size:0px;
	line-height:0px;
	-moz-border-radius:6px;
	border-radius:6px;
	cursor:pointer;
	-webkit-box-shadow: 0px 0px 20px rgba(100,100,100,.4);
   	-moz-box-shadow: 0px 0px 20px rgba(100,100,100,.4);
   	box-shadow: 0px 0px 20px rgba(100,100,100,.4);

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
		console.log(record_mode);
		if(record_mode){
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
	function clear(){
		record_mode_DATA={65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]};
		record_mode_DATA_blocked={65:false,83:false,68:false,70:false,71:false,72:false,74:false,75:false,76:false,90:false,88:false,67:false,86:false,66:false,78:false,77:false,81:false,87:false,69:false,82:false,84:false,89:false,85:false,73:false,79:false,80:false};
		record_mode=false;
		update_player_controls();
	}
	function update_player_controls(){
	//TODO
	}
</script>
<div id='player_controls'>
<div class="play_button"></div><br>
<div class="record" onclick="toggle_record(this);"></div><br>
<div class="save"><p>save</p></div>
<div class="save" onclick="clear();"><p>clear</p></div>
</div>
