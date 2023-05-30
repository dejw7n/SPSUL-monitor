$(document).ready(function () {
	refreshTime();
	findRinging();
});
setInterval(reload, 600000);
setInterval(refresh, 1000);

function reload() {
	location.reload();
}
function refresh() {
	refreshTime();
	findRinging();
}

function refreshTime() {
	new Date($.now());
	var dt = new Date();
	var seconds = dt.getSeconds();
	var minutes = dt.getMinutes();
	var hours = dt.getHours();
	var day = dt.getDate();
	var month = dt.getMonth() + 1;
	var year = dt.getFullYear();
	if (seconds < 10) {
		seconds = "0" + seconds;
	} else {
		seconds = seconds;
	}
	if (minutes < 10) {
		minutes = "0" + minutes;
	}
	if (hours < 10) {
		hours = "0" + hours;
	}

	// day of the week
	const currentDate = new Date();
	const weekdays = ["Neděle", "Pondělí", "Úterý", "Středa", "Čtvrtek", "Pátek", "Sobota"];
	const currentDayIndex = currentDate.getDay();
	const currentDayOfWeek = weekdays[currentDayIndex];

	$("#dayOfWeek").html(currentDayOfWeek);
	$("#date").html(day + "." + month + "." + year);
	$("#actualtime").html(hours + ":" + minutes + ":" + seconds);
}

// ringing
function Ringing(bHour, bMinute, eHour, eMinute) {
	this.bHour = bHour;
	this.bMinute = bMinute;
	this.eHour = eHour;
	this.eMinute = eMinute;
	this.bMinutes = this.bMinute + this.bHour * 60;
	this.eMinutes = this.eMinute + this.eHour * 60;
}
var ringing = [];
ringing.push(new Ringing(7, 10, 7, 55));
ringing.push(new Ringing(8, 0, 8, 45));
ringing.push(new Ringing(8, 55, 9, 40));
ringing.push(new Ringing(9, 50, 10, 35));
ringing.push(new Ringing(10, 50, 11, 35));
ringing.push(new Ringing(11, 45, 12, 30));
ringing.push(new Ringing(12, 40, 13, 25));
ringing.push(new Ringing(13, 35, 14, 20));
ringing.push(new Ringing(14, 25, 15, 10));
ringing.push(new Ringing(15, 15, 16, 0));
ringing.push(new Ringing(16, 5, 16, 50));
function findRinging() {
	var d = new Date();
	var hour = d.getHours();
	var minute = d.getMinutes();
	var minutes = minute + hour * 60;
	//document.getElementById("datum").innerHTML = "Dnes je <strong>"+d.getDate()+"."+(d.getMonth()+1)+"."+d.getFullYear()+"</strong>";
	var lesson = false;
	if (minutes >= 950 || minutes < 400) {
		document.getElementById("ringing").innerHTML = "Na další hodinu zvoní v 7:10";
		$("#lessonState").html("KONEC VYUČOVÁNÍ");
	} else {
		for (var i = 0; i < ringing.length; i++) {
			if (ringing[i].bMinutes <= minutes && minutes < ringing[i].eMinutes) {
				//document.getElementById("ringing").innerHTML = ;
				if (ringing[i].eMinutes - minutes <= 45 && ringing[i].eMinutes - minutes > 4) {
					$("#ringing").text("Na přestávku zvoní za " + (ringing[i].eMinutes - minutes) + " minut.");
				} else if (ringing[i].eMinutes - minutes == 1) {
					$("#ringing").text("Na přestávku zvoní za " + (ringing[i].eMinutes - minutes) + " minutu.");
				} else {
					$("#ringing").text("Na přestávku zvoní za " + (ringing[i].eMinutes - minutes) + " minuty.");
				}
				$("#lessonState").html(i + ". HODINA");
				lesson = true;
				break;
			}
		}

		if (!lesson) {
			var zvon = findNearRinging(minutes);
			if (ringing[zvon].bMinutes - minutes <= 10 && ringing[zvon].bMinutes - minutes > 4) {
				$("#ringing").html("<b>Zvoní za " + (ringing[zvon].bMinutes - minutes) + " minut na " + zvon + ". hodinu.</b>");
			} else if (ringing[zvon].bMinutes - minutes == 1) {
				$("#ringing").html("<b>Zvoní za " + (ringing[zvon].bMinutes - minutes) + " minutu na " + zvon + ". hodinu.</b>");
			} else {
				$("#ringing").html("<b>Zvoní za " + (ringing[zvon].bMinutes - minutes) + " minuty na " + zvon + ". hodinu.</b>");
			}
			if (ringing[zvon].bMinutes >= 15) {
				$("#lessonState").html("VELKÁ PŘESTÁVKA");
			} else {
				$("#lessonState").html("PŘESTÁVKA");
			}
		}
	}
}
function findNearRinging(minutes) {
	var zvon = 0;
	for (var i = 1; i < ringing.length; i++) {
		if (ringing[zvon].bMinutes - minutes < 0) {
			zvon++;
		} else if (ringing[zvon].bMinutes - minutes > ringing[i].bMinutes - minutes) {
			zvon = i;
		}
	}
	return zvon;
}
