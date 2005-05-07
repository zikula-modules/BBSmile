// $Id$

// new function
function AddSmilie(textfieldname, SmilieCode) {
    var SmilieCode;
    var revisedMessage;
    var textfield = document.getElementById(textfieldname);
    var currentMessage = textfield.message.value;
    revisedMessage = currentMessage+SmilieCode;
    textfield.message.value=revisedMessage;
    textfield.message.focus();
    return;
}

// old function wrapper
function DoSmilie(SmilieCode) {
    return AddSmilie('post', SmilieCode);
}

function ShowHide(id, visibility) {
	obj = document.getElementById(id);
	obj.style.display = visibility;
}
