/**
 * BBSmile
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBSmile
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

// var tracks element with last focus
var bbsmileLastFocus = '';

if (window.addEventListener) { // modern browsers
    window.addEventListener('load' , initBBSmile, false);
} else if (window.attachEvent) { // ie8 and even older browsers
    window.attachEvent('onload', initBBSmile);
} else { // fallback, not truly necessary
    window.onload = initBBSmile;
}


function initBBSmile() {
    bbsmileLastFocus = jQuery('textarea').first();
    var textareaCount = jQuery('textarea').size();
    if (textareaCount > 1) {
        // setup onBlur() listener to track which element was last in focus
        jQuery('textarea', 'input', 'select').blur(function(event) {
            bbsmileLastFocus = event.target;
        });
    }
}

/**
 * Add smilie text to TEXTAREA
 */
function AddSmilie(SmilieCode) {

    // set textfield element to last focused element
    var textfield = bbsmileLastFocus;

    // if element is not a textarea then do nothing
    if (!textfield.is('TEXTAREA')) {
        alert('select a textarea first!') // needs translation
        jQuery('#bbSmileModal').modal('hide');
        return;
    }

    jQuery('#bbSmileModal').modal('hide');

    if(textfield==null) {
        alert("internal error: unknown textfieldname '" + textfield.attr('id') + "'supplied");
        return;
    }

    textfield.insertAtCaret(SmilieCode);
    return;
}

/**
 * Insert the provided text at point of the caret
 *
 * function taken from http://stackoverflow.com/a/2819568/2600812
 * submitted there by Aniebiet Udoh (http://stackoverflow.com/users/339391/aniebiet-udoh)
 */
jQuery.fn.extend({
    insertAtCaret: function(myValue){
        return this.each(function(i) {
            if (document.selection) {
                //For browsers like Internet Explorer
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            }
            else if (this.selectionStart || this.selectionStart == '0') {
                //For browsers like Firefox and Webkit based
                var startPos = this.selectionStart;
                var endPos = this.selectionEnd;
                var scrollTop = this.scrollTop;
                this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                this.focus();
                this.selectionStart = startPos + myValue.length;
                this.selectionEnd = startPos + myValue.length;
                this.scrollTop = scrollTop;
            } else {
                this.value += myValue;
                this.focus();
            }
        });
    }
});