//this file has all the system variables
window.onload=init;
function init(){
	document.getElementById("keys").setAttribute("style","margin-left:"+($(window).width()-840)/2+"px;");
}
function set_keys(){
	document.getElementById("keys").setAttribute("style","margin-left:"+($(window).width()-840)/2+"px;");
}
setTimeout("set_keys()","0");
function get_vars(){
}
var system_mode="KEYBOARD";
//recorder system elements
var record_mode=true;
var record_mode_SLEEP_TIME=0;
var record_mode_PLAY_TIME=0;
//ASDFGHJKLZXCVBNMQWERTYUIOP
var record_mode_DATA={65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]}
function toggle_mode(){
	if(system_mode=="KEYBOARD")
		system_mode="SCREEN";
	else
		system_mode="KEYBOARD";
}
