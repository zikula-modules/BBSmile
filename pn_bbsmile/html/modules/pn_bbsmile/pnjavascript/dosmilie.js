// $Id$

// dummy function for href
function addsmilies() {
    return;
}

function DoSmilie(SmilieCode) {
    var SmilieCode;
    var revisedMessage;
    var post = document.getElementById("post");
    var currentMessage = post.message.value;
    revisedMessage = currentMessage+SmilieCode;
    post.message.value=revisedMessage;
    post.message.focus();
    return;
}

