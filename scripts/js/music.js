window.onload=init;
function init(){
}
window.onkeydown=function(e){
	//TODO make sure that the modals are not running before this
	document.getElementById(e.keyCode).play();
}
//write a key pressed event handler which can handle the duration of key pressed event
window.onkeyup=function(e){
	// TODO here make sure that you add the duration to the jason file before this:
	document.getElementById(e.keyCode).pause();
	document.getElementById(e.keyCode).currentTime=0;
}
function play_key(keyCode){
	// TODO take care of the graphics thingy also
	document.getElementById(keyCode).play();
}
function play_cheatsheet(cheat){
	//here cheat is a jason
}
function add_to_new_cheatsheet(){
	//add to the local jason variable
}
function is_Loaded(){
	//find whether all the music files are loaded before itself else launch a modal with Loading.... thing
}
