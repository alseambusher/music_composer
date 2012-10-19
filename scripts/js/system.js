//this file has all the system variables
var system_mode="KEYBOARD";
var octet_focus=0;
//recorder system elements
var record_mode=false;
var record_mode_SLEEP_TIME=0;
var record_mode_PLAY_TIME=0;
var record_mode_DATA='';
function toggle_mode(){
	if(system_mode=="KEYBOARD")
		system_mode="SCREEN";
	else
		system_mode="KEYBOARD";
}
