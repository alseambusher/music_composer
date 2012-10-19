var time=0;
function timer(){
	document.getElementById("timer").innerHTML=time;
	time=time+1;
	setTimeout("timer()",1);
}
setTimeout("timer()",0);
