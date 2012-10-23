function wait(msec){
	var start=new Date().getTime();
	var cur=start;
	while(cur-start<msec){
		cur=new Date().getTime();
	}
}
window.onkeydown=function(e){
	try{
		if(system_mode=="KEYBOARD"){
			if(e.keyCode=='90'){
				document.getElementById("75_key").setAttribute("class","key_pressed");
				document.getElementById("75").play();
			}
			else if(e.keyCode=='88'){
				document.getElementById("76_key").setAttribute("class","key_pressed");
				document.getElementById('76').play();
			}
			else{
				if(document.getElementById(e.keyCode+"_key").getAttribute("class")=="key")
					document.getElementById(e.keyCode+"_key").setAttribute("class","key_pressed");
				else if(document.getElementById(e.keyCode+"_key").getAttribute("class")=="key_small")
					document.getElementById(e.keyCode+"_key").setAttribute("class","key_small_pressed");
				document.getElementById(e.keyCode).play();
			}
		}
		if((system_mode!="KEYBOARD")&&(parseInt(e.keyCode)==27))//when ESC is pressed to close modal
			toggle_mode();
		if((system_mode=="KEYBOARD")&&record_mode){
			if(!record_mode_DATA_blocked[parseInt(e.keyCode)]){
				record_mode_DATA[parseInt(e.keyCode)].push(RECORD_TIMER);
				record_mode_DATA_blocked[parseInt(e.keyCode)]=true;//handle press and hold
				console.log("alse");
				console.log(record_mode_DATA);
			}
		}
	}
	catch(e){
		console.log(e);
	}
}
//write a key pressed event handler which can handle the duration of key pressed event
window.onkeyup=function(e){
	try{
		//wait(200);
		if((system_mode=="KEYBOARD")&&record_mode){
			record_mode_DATA[parseInt(e.keyCode)].push(RECORD_TIMER);
			record_mode_DATA_blocked[parseInt(e.keyCode)]=false;//handle press and hold
		}
		if(e.keyCode=='90'){
			document.getElementById("75_key").setAttribute("class","key");
			document.getElementById('75').pause();
			document.getElementById('75').currentTime=0;
		}
		else if(e.keyCode=='88'){
			document.getElementById("76_key").setAttribute("class","key");
			document.getElementById('76').pause();
			document.getElementById('76').currentTime=0;
		}
		else{
			if(document.getElementById(e.keyCode+"_key").getAttribute("class")=="key_pressed")
				document.getElementById(e.keyCode+"_key").setAttribute("class","key");
			else if(document.getElementById(e.keyCode+"_key").getAttribute("class")=="key_small_pressed")
				document.getElementById(e.keyCode+"_key").setAttribute("class","key_small");
			document.getElementById(e.keyCode).pause();
			document.getElementById(e.keyCode).currentTime=0;
		}
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
