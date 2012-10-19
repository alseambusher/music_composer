window.onload=init;
function init(){
}
function wait(msec){
	var start=new Date().getTime();
	var cur=start;
	while(cur-start<msec){
		cur=new Date().getTime();
	}
}
window.onkeydown=function(e){
	console.log(e.keyCode);
	//90 88 67 86 66 78 77
	if(system_mode=="KEYBOARD"){
		//if user presses z it toggles
		if(e.keyCode==90)
			octet_focus=(octet_focus+1)%2;

		//console.log((parseInt(e.keyCode)+octet_focus*100)+"_key");
		document.getElementById((parseInt(e.keyCode)+octet_focus*100)+"_key").src="images/keypressed.jpg";
		document.getElementById(parseInt(e.keyCode)+octet_focus*100).play();
	}
	if((system_mode!="KEYBOARD")&&(parseInt(e.keyCode)==27))//when ESC is pressed to close modal
		toggle_mode();
	if((system_mode=="KEYBOARD")&&record_mode){
	//in record mode when a key is pressed the previous sleeping time and the key pressed is added to the system
		record_mode_DATA+=record_mode_SLEEP_TIME+':'+e.KeyCode+':';
	}
}
//write a key pressed event handler which can handle the duration of key pressed event
window.onkeyup=function(e){
	//wait(200);
	document.getElementById((parseInt(e.keyCode)+octet_focus*100)+"_key").src="images/key.jpg";
	// TODO here make sure that you add the duration to the json file before this:
	document.getElementById(parseInt(e.keyCode)+octet_focus*100).pause();
	document.getElementById(parseInt(e.keyCode)+octet_focus*100).currentTime=0;
}
function play_key(keyCode){
	// TODO take care of the graphics thingy also
	document.getElementById(keyCode).play();
}
function play_cheatsheet(cheat){
	//here cheat is a json
}
function add_to_new_cheatsheet(){
	//add to the local json variable
}
function is_Loaded(){
	//find whether all the music files are loaded before itself else launch a modal with Loading.... thing
}
