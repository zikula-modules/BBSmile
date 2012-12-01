{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="gears" size="small"}
    <h3>{gt text='Read smilies from filesystem'}</h3>
</div>

<p class="z-informationmsg">{gt text="With confirmation all smilies out of the directory are read. Smilies without a image in the directory will be deleted. Changes on smilie information will be kept."}</p>

<form class="z-form" action="{modurl modname="BBSmile" type="admin" func="readsmilies"}" method="post" enctype="application/x-www-form-urlencoded">

    <fieldset>
        <legend>{gt text='Should the smilies be read out of the directory?'}</legend>
        <input type="hidden" name="csrftoken" value="{insert name="csrftoken"}" />
        {if $modvars.BBSmile.smiliepath_auto neq ''}
        <div class="z-formrow">
            <label>{gt text='Path to the smilies'}</label>
            <span style="font-weight:bold;">{$modvars.BBSmile.smiliepath_auto}</span>
        </div>
        {/if}
        <div class="z-formrow">
            <label for="forcereload">{gt text='Force reload of smilies, all data will be overwritten!'}</label>
            <input name="forcereload" id="forcereload" type="checkbox" value="1" />
        </div>
    </fieldset>

    <div class="z-buttons z-formbuttons">
        {button src="button_ok.png" set="icons/extrasmall" __alt="Apply" __title="Apply" __text="Apply"}
    </div>

</form>

</div>