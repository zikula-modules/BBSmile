{*  $Id$  *}
{include file="bbsmile_admin_header.tpl"}
<h2>{gt text='Settings'}</h2>

{form cssClass="z-form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text="General settings"}</legend>
    <div class="z-formrow">
        {formlabel for="smiliepath" __text='Path to the smilies'}
        {formtextinput size="40" maxLength="255" id="smiliepath" text=$pncore.bbsmile.smiliepath}
    </div>
    <div class="z-formrow">
        {formlabel for="activate_auto" __text='Activate auto smilies'}
        {formcheckbox id="activate_auto" checked=$pncore.bbsmile.activate_auto}
    </div>
    <div class="z-formrow">
        {formlabel for="smiliepath_auto" __text='Path to the automatically included smilies'}
        {formtextinput size="40" maxLength="255" id="smiliepath_auto" text=$pncore.bbsmile.smiliepath_auto}
    </div>
    <div class="z-formrow">
        {formlabel for="remove_inactive" __text='Remove inactive smilie shortcuts'}
        {formcheckbox id="remove_inactive" checked=$pncore.bbsmile.remove_inactive}
    </div>
</fieldset>

<div class="z-formbuttons">
    {formbutton id="submit" commandName="submit" __text="Apply"}
</div>

{/form}

{include file="bbsmile_admin_footer.tpl"}