function wait(msec){
	var start=new Date().getTime();
	var cur=start;
	while(cur-start<msec){
		cur=new Date().getTime();
	}
}
window.onkeydown=function(e){
	console.log("alse");
	console.log(record_mode_DATA);
	try{
		if(system_mode=="KEYBOARD"){
			//console.log((parseInt(e.keyCode)+octet_focus*100)+"_key");
			document.getElementById(e.keyCode+"_key").setAttribute("class","key_pressed");
			document.getElementById(e.keyCode).play();
		}
		if((system_mode!="KEYBOARD")&&(parseInt(e.keyCode)==27))//when ESC is pressed to close modal
			toggle_mode();
		if((system_mode=="KEYBOARD")&&record_mode)
			record_mode_DATA[parseInt(e.keyCode)].push(RECORD_TIMER);
	}
	catch(e){
		console.log(e);
	}
}
//write a key pressed event handler which can handle the duration of key pressed event
window.onkeyup=function(e){
	try{
		//wait(200);
		if((system_mode=="KEYBOARD")&&record_mode)
			record_mode_DATA[parseInt(e.keyCode)].push(RECORD_TIMER);
		document.getElementById(e.keyCode+"_key").setAttribute("class","key");
		document.getElementById(e.keyCode).pause();
		document.getElementById(e.keyCode).currentTime=0;
	}
	catch(e){
		console.log(e);
	}
}
function play_key(keyCode){
	// TODO take care of the graphics thingy also
	document.getElementById(keyCode).play();
}
function play_cheatsheet(cheat){
	
}
function stringify(obj){
	JSON.stringify(obj);
}
