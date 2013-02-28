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

Event.observe(window, 'load', function() {
    $$('.bbsmile_smilies').each(function(el) {
        el.removeClassName('bbsmile_smilies');
    });
    if($('smiliemodal')) {
        new Zikula.UI.Window($('smiliemodal'),{modal: true});
    }
    var textareaCount = $$('textarea').size();
    if (textareaCount > 1) {
        bbsmileLastFocus = $$('textarea').first();
        // setup onBlur() listener to track which element was last in focus
        $$('textarea', 'input', 'select').invoke('observe', 'blur', function(event) {
            bbsmileLastFocus = event.target;
        });
    } else {
        bbsmileLastFocus = $$('textarea').first();
    }
});
    
    
/**
 * Add smilie text to TEXTAREA
 */
function AddSmilie(SmilieCode) {

    // set textfield element to last focused element
    var textfield = bbsmileLastFocus;
    
    // if element is not a textarea then do nothing
    if (textfield.tagName != 'TEXTAREA') {
        alert('select a textarea first!') // needs translation
        Control.Modal.close()
        return;
    }

    Control.Modal.close()

    if(textfield==null) {
        alert("internal error: unknown textfieldname '" + textfieldname + "'supplied");
        return;
    }

    //
    // for Internet Explorer
    //
    if(typeof document.selection != 'undefined') {
        textfield.focus();
        var range = document.selection.createRange();
        //var insText = range.text;

        range.text = SmilieCode; //aTag + insText + eTag;
        range = document.selection.createRange();
        range.move('character', -SmilieCode.length);
    }
    //
    // for Gecko based browsers
    //
    else if(typeof textfield.selectionStart != 'undefined')
    {
        var start = textfield.selectionStart;
        var end = textfield.selectionEnd;
        var insText = textfield.value.substring(start, end);

        // insert Smilie
        textfield.value = textfield.value.substr(0, start) + SmilieCode + textfield.value.substr(end);

        // adjust cursorposition
        textfield.selectionStart = start + SmilieCode.length;
        textfield.selectionEnd = start + SmilieCode.length;
    }
    //
    // for all other browsers
    //
    else
    {
        // insert at end
        textfield.value = textfield.value + SmilieCode;
    }
    textfield.focus();

}