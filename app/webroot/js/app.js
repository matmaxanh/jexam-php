// Only define the OWS namespace if not defined.
if (typeof(OWS) === 'undefined') {
	var OWS = {};
}

OWS.checkSelectAnswer = function(elementId) {
	var showalert = true;
	$("#" + elementId  + " input[type=radio], #" + elementId + " input[type=checkbox]").each(function(){
		if($(this).attr('checked')){
			showalert = false;
		}
	});
	if(showalert){
		alert(OWS.message.selectAnswer);
		return false;
	}
};
OWS.displayTime = function(seconds){
    window.start = parseFloat(seconds);
    // Calculate the number of hours left
    var hours = Math.floor(window.start / 3600),
    	minutes = Math.floor((window.start - (hours * 3600)) / 60),
    	secs = Math.floor((window.start - (hours * 3600) - (minutes * 60))),
    	timertext;
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        //minutes = "0" + minutes;
    }
    if (secs < 10) {
        secs = "0" + secs;
    }
    if(hours != "00"){
    	timertext = hours + ":" + minutes + ":" + secs;
    }else{
    	timertext = minutes + ":" + secs;
    }
    return timertext;
};