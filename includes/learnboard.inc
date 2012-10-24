<style>
#learnboard{
	border:10px solid #333333;
	padding:5px;
	margin:auto;
	width:600px;
	height:300px;
	word-wrap:break-word;
	overflow:auto;
	-webkit-box-shadow: 0px 0px 20px rgba(0,0,0,.8);
   	-moz-box-shadow: 0px 0px 20px rgba(0,0,0,.8);
   	box-shadow: 0px 0px 20px rgba(0,0,0,.8);
	background: rgb(0,110,46); /* Old browsers */
background: -moz-linear-gradient(top, rgba(0,110,46,1) 0%, rgba(0,110,46,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,110,46,1)), color-stop(100%,rgba(0,110,46,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(0,110,46,1) 0%,rgba(0,110,46,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(0,110,46,1) 0%,rgba(0,110,46,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(0,110,46,1) 0%,rgba(0,110,46,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(0,110,46,1) 0%,rgba(0,110,46,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#006e2e', endColorstr='#006e2e',GradientType=0 ); /* IE6-9 */
}
#learnboard .playing{
	font-size:1.4em;
	color:#FFFFFF;
	position:relative;
	z-index:2;
}
#learnboard .dummy{
	font-size:1.4em;
	color:#999999;
	position:relative;
	z-index:0;
}
</style>
<br>
<div id="learnboard_holder">
<div id="learnboard">
</div>
</div>

<script>
	$("#learnboard_holder").toggle(0);
	var learnboard_interrupt=false;
	var learn_timer;
	function relearn_learnboard(){
		document.getElementById("learnboard").innerHTML="";//reset it
		set_learnboard(jQuery.extend(true,{},record_mode_DATA));
		learn_timer=0;//reset timer
		learnboard_interrupt=false;//stop timer
		start_learn(jQuery.extend(true,{},record_mode_DATA));//this will make it play
	}
	function set_learnboard(music_data){
		var minimum;
		var i;
		var j=-1;
		while(JSON.stringify(music_data)!=JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]})){
			minimum=1000000;
			j=-1;
			for(i=65;i<=90;i++){//find min and add
				try{
					if(music_data[i][0]<minimum){
						j=i
						minimum=music_data[i][0];
					}
				}
				catch(e){
				}
			}
			var newElement=document.createElement("a");
			newElement.innerHTML=" "+String.fromCharCode(j)+" ";
			newElement.className="dummy";
			newElement.id=j+":"+music_data[j][0]+":"+music_data[j][1];// id is ascii:start:end
			music_data[j].shift();//remove first two entries
			music_data[j].shift();
			document.getElementById("learnboard").appendChild(newElement);
		}
	}
	function start_learn(music_data){
		if(!learnboard_interrupt){
			if(JSON.stringify(music_data)!=JSON.stringify({65:[],83:[],68:[],70:[],71:[],72:[],74:[],75:[],76:[],90:[],88:[],67:[],86:[],66:[],78:[],77:[],81:[],87:[],69:[],82:[],84:[],89:[],85:[],73:[],79:[],80:[]})){
			//console.log(music_data);
				for(var i=65;i<=90;i++){
					try{
						//if start >timer highlight it
						//if end >timer stop highlighting
						if((music_data[i][0]<=learn_timer)&&(music_data[i][1]>learn_timer)){
							document.getElementById(i+":"+music_data[i][0]+":"+music_data[i][1]).className="playing";
						}
						else if(music_data[i][1]<learn_timer){
							document.getElementById(i+":"+music_data[i][0]+":"+music_data[i][1]).className="dummy";
							music_data[i].shift();//remove first two entries
							music_data[i].shift();
						}
					}
					catch(e){
					}
						
				}
				learn_timer=learn_timer+1;
				setTimeout(function(){start_learn(music_data)},10);
			}
			else{
				setTimeout("learnboard_interrupt=true;",500);
			}
		}
	}
</script>
