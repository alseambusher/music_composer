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
	//TODO make sure that the modals are not running before this
	document.getElementById(e.keyCode+"_key").src="images/keypressed.jpg";
	document.getElementById(e.keyCode).play();
}
//write a key pressed event handler which can handle the duration of key pressed event
window.onkeyup=function(e){
	//wait(200);
	document.getElementById(e.keyCode+"_key").src="images/key.jpg";
	// TODO here make sure that you add the duration to the json file before this:
	document.getElementById(e.keyCode).pause();
	document.getElementById(e.keyCode).currentTime=0;
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
