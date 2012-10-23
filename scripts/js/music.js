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
	}
}
function play_cheatsheet(music_data){
	//music data should be in JSON
	//PLAY_TIMER=0;
	//setTimeout("play_timer()","0");//start timer
	if((JSON.stringify(music_data)!=JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]}))||(PLAY_TIMER<0)){
		//90 elements
		for(var i=65;i<=90;i++){
			try{
				if(music_data[i][0]<PLAY_TIMER){
					play_thread(i,music_data[i][1]);//this will play the key from start time to end time
					music_data[i].shift();//remove first two entries
					music_data[i].shift();
				}
			}
			catch(e){
			}
		}
		setTimeout(function(){ play_cheatsheet(music_data);},2);
	}
	else{
		setTimeout(function(){PLAY_TIMER=-1;},1000);
		update_player_controls();
	}
}
function play_thread(key,end){
	if((end<PLAY_TIMER)||(PLAY_TIMER<0)){//stop playing
		if(key==90){
			document.getElementById("75_key").setAttribute("class","key");
			document.getElementById('75').pause();
			document.getElementById('75').currentTime=0;
		}
		else if(key==88){
			document.getElementById("76_key").setAttribute("class","key");
			document.getElementById('76').pause();
			document.getElementById('76').currentTime=0;
		}
		else{
			if(document.getElementById(key+"_key").getAttribute("class")=="key_pressed")
				document.getElementById(key+"_key").setAttribute("class","key");
			else if(document.getElementById(key+"_key").getAttribute("class")=="key_small_pressed")
				document.getElementById(key+"_key").setAttribute("class","key_small");
			document.getElementById(key).pause();
			document.getElementById(key).currentTime=0;
		}
		return;
	}
	//play if it is not already being played
	else if(key==90){
		if(document.getElementById("75_key").getAttribute("class")=="key"){
			document.getElementById("75_key").setAttribute("class","key_pressed");
			document.getElementById('75').play();
		}
	}
	else if(key==88){
		if(document.getElementById("76_key").getAttribute("class")=="key"){
			document.getElementById("76_key").setAttribute("class","key_pressed");
			document.getElementById('76').play();
		}
	}
	else{
		if(document.getElementById(key+"_key").getAttribute("class")=="key"){
			document.getElementById(key+"_key").setAttribute("class","key_pressed");
			document.getElementById(key).play();
		}
		else if((document.getElementById(key+"_key").getAttribute("class")=="key_small")&&(document.getElementById(key+"_key").getAttribute("class")!="key_pressed")){
			document.getElementById(key+"_key").setAttribute("class","key_small_pressed");
			document.getElementById(key).play();
		}
	}
	setTimeout(function(){ play_thread(key,end);},5);
}
