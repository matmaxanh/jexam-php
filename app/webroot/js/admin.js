// Only define the OWS namespace if not defined.
if (typeof(OWS) === 'undefined') {
	var OWS = {};
}

OWS.editors = {};
// An object to hold each editor instance on page
OWS.editors.instances = {};

/**
 * Generic submit form
 */
OWS.submitform = function(task, form) {
	if (typeof(form) === 'undefined') {
		form = document.getElementById('adminForm');
	}

	if (typeof(task) !== 'undefined') {
		form.task.value = task;
	}

	// Submit the form.
	if (typeof form.onsubmit == 'function') {
		form.onsubmit();
	}
	if (typeof form.fireEvent == "function") {
		form.fireEvent('submit');
	}
	form.submit();
};

/**
 * Default function. Usually would be overriden by the component
 */
OWS.submitbutton = function(pressbutton) {
	OWS.submitform(pressbutton);
};

/**
 * Verifies if the string is in a valid email format
 *
 * @param string
 * @return boolean
 */
OWS.isEmail = function(text) {
	var regex = new RegExp("^[\\w-_\.]*[\\w-_\.]\@[\\w]\.+[\\w]+[\\w]$");
	return regex.test(text);
};

/**
 * Render messages send via JSON
 *
 * @param	object	messages	JavaScript object containing the messages to render
 * @return	void
 */
OWS.renderMessages = function(messages) {
	OWS.removeMessages();
};


/**
 * Remove messages
 *
 * @return	void
 */
OWS.removeMessages = function() {
};

/**
 * Pops up a new window in the middle of the screen
 */
OWS.popupWindow = function(mypage, myname, w, h, scroll) {
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl
			+ ',scrollbars=' + scroll + ',resizable';
	var win = window.open(mypage, myname, winprops);
	win.window.focus();
};


