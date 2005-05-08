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

// new ShowHide, taken from pnUpper
function getFormObject(name, form) {
    var myobj = null;
    if (document.getElementById) myobj = document.getElementById(name);
    else if (document.all) myobj = document.all[name];
    else myobj = document.forms[form][name];
    if (!myobj) alert('Internal error with field ' + name + '!!');
    else return myobj;
}


function ShowHide(id) {
    var myobj = getFormObject(id, '');
    if (myobj.style) {
        if (myobj.style.display == "none") { myobj.style.display = ""; }
        else { myobj.style.display = "none"; }
    }
    else {
        myobj.visibility = "show";
    }
}


