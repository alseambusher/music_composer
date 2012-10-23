var CLOCK_RESPONSE_TIME=10;//this is equal to the time interval between which timers are updated
//to start timer just set the value of clock to 0
//to stop timer just set the value of clock to -1
var RECORD_TIMER=-1;
function record_timer(){
	RECORD_TIMER=RECORD_TIMER+1;
	if(RECORD_TIMER>0)
		setTimeout("record_timer()",10);
}
var PLAY_TIMER=-1;
function play_timer(){
	PLAY_TIMER=PLAY_TIMER+1;
	if(PLAY_TIMER>0)
		setTimeout("play_timer()",10);
}
//RECORD_TIMER=0;
//setTimeout("record_timer();",0);
function account_settings(){
	load_form_modal("Account settings","#","Loading Settings..... Please Wait","Signup");
	var xhr=new XMLHttpRequest();
	if(xhr){
		xhr.onreadystatechange=function(){
			if(xhr.readyState==4){
				if(xhr.status==200){
					var out=xhr.responseText.split(":");
					toggle_mode();//as it is already called
					load_form_modal("Account settings","scripts/php/accounts.php?action=update","<input name=\"first_name\" type=\"text\" placeholder=\"First Name\" value=\""+out[0]+"\"/> &nbsp; First Name<br><input name=\"last_name\" type=\"text\" placeholder=\"Last Name\" value=\""+out[1]+"\"/> &nbsp; Last Name<br><input name=\"user_name\" type=\"text\" placeholder=\"username\" value=\""+out[2]+"\"/> &nbsp; User Name<br><input name=\"email\" type=\"text\" placeholder=\"email\" value=\""+out[3]+"\"/> &nbsp; email id<br><input name=\"password\"type=\"password\" placeholder=\"new password\"/> &nbsp Leave blank if you dont like to change<br><input name=\"confirm_password\"type=\"password\" placeholder=\"confirm new password\"/><br>","Update");
				}
			}
		};
		xhr.open("GET","scripts/php/accounts.php?action=account_settings");
		xhr.send(null);
	}
}
