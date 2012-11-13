//this file has all the system variables
window.onload=init;
function init(){
	document.getElementById("keys").setAttribute("style","margin-left:"+($(window).width()-840)/2+"px;");
	//document.getElementById("learnboard_holder").setAttribute("style","margin-left:"+($(window).width()-600)/2+"px;");
}
setTimeout("init();",10);
var system_mode="KEYBOARD";
//recorder system elements
var record_mode=false;
var record_mode_SLEEP_TIME=0;
var record_mode_PLAY_TIME=0;
//ASDFGHJKLZXCVBNMQWERTYUIOP
var record_mode_DATA={65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]};
var record_mode_DATA_blocked={65:false,83:false,68:false,70:false,71:false,72:false,74:false,75:false,76:false,90:false,88:false,67:false,86:false,66:false,78:false,77:false,81:false,87:false,69:false,82:false,84:false,89:false,85:false,73:false,79:false,80:false};
function toggle_mode(){
	if(system_mode=="KEYBOARD")
		system_mode="SCREEN";
	else
		system_mode="KEYBOARD";
}
function set_buffer_state(state){
	document.getElementById("buffer_state").innerHTML=state;
}
