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
RECORD_TIMER=0;
setTimeout("record_timer();",0);
