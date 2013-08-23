{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text='Settings'}</h3>
</div>

{form cssClass="z-form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text="General settings"}</legend>
    <div class="z-formrow">
        {formlabel for="smiliepath" __text='Path to the smilies'}
        {formtextinput size="40" maxLength="255" id="smiliepath" text=$modvars.BBSmile.smiliepath}
    </div>
    <div class="z-formrow">
        {formlabel for="activate_auto" __text='Show "more smilies" link'}
        {formcheckbox id="activate_auto" checked=$modvars.BBSmile.activate_auto}
    </div>
    <div class="z-formrow">
        {formlabel for="smiliepath_auto" __text='Path to the automatically included smilies'}
        {formtextinput size="40" maxLength="255" id="smiliepath_auto" text=$modvars.BBSmile.smiliepath_auto}
    </div>
    <div class="z-formrow">
        {formlabel for="remove_inactive" __text='Remove inactive smilie shortcuts'}
        {formcheckbox id="remove_inactive" checked=$modvars.BBSmile.remove_inactive}
    </div>
</fieldset>

<div class="z-formbuttons z-buttons">
    {formbutton class="z-bt-ok" commandName="save" __text="Save"}
    {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}

{adminfooter}