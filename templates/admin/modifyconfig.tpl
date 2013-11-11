{adminheader}
<h3>
    <span class="fa fa-wrench"></span>&nbsp;{gt text="Settings"}
</h3>

{form cssClass="form-horizontal" role="form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text="General settings"}</legend>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="smiliepath" __text='Path to the smilies'}
        <div class="col-lg-9">
            {formtextinput size="40" maxLength="255" id="smiliepath" text=$modvars.BBSmile.smiliepath cssClass='form-control'}
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="activate_auto" __text='Show "more smilies" link'}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="activate_auto" checked=$modvars.BBSmile.activate_auto}
            </div>
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="smiliepath_auto" __text='Path to the automatically included smilies'}
        <div class="col-lg-9">
            {formtextinput size="40" maxLength="255" id="smiliepath_auto" text=$modvars.BBSmile.smiliepath_auto cssClass='form-control'}
        </div>
    </div>
    <div class="form-group">
        {formlabel class="col-lg-3 control-label" for="remove_inactive" __text='Remove inactive smilie shortcuts'}
        <div class="col-lg-9">
            <div class="checkbox">
                {formcheckbox id="remove_inactive" checked=$modvars.BBSmile.remove_inactive}
            </div>
        </div>
    </div>
</fieldset>

<div class="col-lg-offset-3 col-lg-9">
    {formbutton class="btn btn-success" commandName="save" __text="Save"}
    {formbutton class="btn btn-danger" commandName="cancel" __text="Cancel"}
</div>

{/form}

{adminfooter}