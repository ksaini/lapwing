var base_url = "http://localhost/pgexample/teacherapp/www/";

function getSID(){
	var sid = localStorage.getItem("sid");
	if(sid != null)
		return sid;
	else
		return 0;
}

function getMessageID(){
	var sid = localStorage.getItem("mid");
	if(sid != null)
		return sid;
	else
		return 0;
}

function getLocalMsg(mid){
	var msgs = "{}";
	if(mid > 0){
		if(localStorage.getItem("msgs") != null)
			msgs = JSON.parse(localStorage.getItem("msgs"));
	}
	return msgs;	
}

function populateLocalMsg(mid){
	var msgs = getLocalMsg(mid);
	populateMsg(msgs);
}

function getNewMsg(sid,mid){
	
	var sql = "sid=" + sid + "&mid=" + mid;
	var req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			try {
				//alert(req.responseText);
				var dataArray=JSON.parse(req.responseText);
				populateMsg(dataArray);
								
			} catch (e) {
				console.log("Exception::-"+e.toString());
			}
		}
	};
	
	req.open("GET", base_url + "/getMsg.php?" + sql, true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send();
}
function populateMsg(data){
		var chat = document.getElementById("chat");
		var msgstr = "";
		var tmp = "";
		var name = getParameterByName("name");
		
		for (var i = 0; i < data.length; i++) {
			var icon = "R"; var color ="55C1E7";
			
			if(data[i]['scope']!="cid" && data[i]['scope']!="sid"){
				// Individual msg from Student
				msgstr += getLeftMsg(data[i]['msg'],name,data[i]['scopeid'],data[i]['mid']);
			}
			else if(data[i]['scope']=="sid"){
				// Individual repl to student
				msgstr += getRightMsg(data[i]['msg'],"",data[i]['scopeid'],data[i]['mid']);				
			}	
			else if(data[i]['cid']==localStorage.getItem("cid") ){
				// Announcements for a given class
				msgstr += getRightMsg(data[i]['msg'],"<i class='fa fa-rotate-180 fa-volume-up'></i>",data[i]['scopeid'],data[i]['mid']);
			}
			
			tmp = data[i]['mid'];           
		}
		
		localStorage.setItem(mid, tmp);
		chat.innerHTML = msgstr;
		setTimeout(function(){window.scrollTo(0,document.body.scrollHeight+350);}, 250);
		
}

function getLeftMsg(m,id,sid,mid){
	var icon = id.substr(0,2).toUpperCase();
	
	msg = "<li id='m_"+mid+"' class='left clearfix'><span class='chat-img pull-left'>";
	//msg += "<img src='http://placehold.it/45/"+getRandomColor(sid)+"/fff&text="+icon+"' alt='User Avatar' class='img-circle' /></span>";
	  msg += "<div class='circleBase type1' style='background:#"+getRandomColor(sid)+"'>"+icon+"</div>";
    msg += "</span><div class='chat-body clearfix'><div class='header'>";
	msg += "<strong class='primary-font'>"+ id +"</strong> <small style='font-size:8px;' class='pull-right text-muted'>";
	msg += "<i class='fa fa-clock-o'></i></span> 12 mins ago</small></div>";
	msg += "<p>" + m ;
	msg += "  </p></div> </li>";
    
	return msg;	
}

function getRightMsg(m,id,sid,mid){
	var icon = "R";
	
	msg = "<li id='m_"+mid+"' class='right clearfix' style='background-color:#e6fff9;'><span class='chat-img pull-right'>";
	//msg += "<img src='http://placehold.it/45/ff9933/fff&text="+icon+"' alt='User Avatar' class='img-circle' /></span>";
	msg += "<div class='circleBase type1' style='background:#ff9933'>"+icon+"</div>";
    msg += "</span><div class='chat-body clearfix' ><div class=' header'>";
	msg += "<strong class='pull-right primary-font'>"+ id +"</strong> </div>";
	msg += "<p style='text-align:right;padding-top:5px;'>" + m ;
	
	msg += "</p><small style='font-size:8px;' class='pull-right text-muted'>";
	msg += "<i class='fa fa-clock-o'></i></span> 12 mins ago</small></div> </li>";
    
	return msg;	
}




function sendmsg(sid){
	var msg = document.getElementById("btn-input").value;
	var sql = "scope=sid&sid=" + sid + "&cid=" + localStorage.getItem("cid") + "&msg=" + msg;
	var req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if (req.readyState == 4 && req.status == 200) {
			try {
				//alert(req.responseText);
				
				var chat = document.getElementById("chat");
				chat.innerHTML += getRightMsg(msg,"","","");
				document.getElementById("btn-input").value="";
				window.scrollTo(0,document.body.scrollHeight+300);
				
								
			} catch (e) {
				console.log("Exception::-"+e.toString());
			}
		}
	};
	
	req.open("GET", base_url + "/setMsg.php?" + sql, true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send();
}

