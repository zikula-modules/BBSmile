{*  $Id$  *}
{include file="bbsmile_admin_header.tpl"}
<h2>{gt text='Read smilies from filesystem'}</h2>

<p class="z-informationmsg">{gt text="With confirmation all smilies out of the directory are read. Smilies without a image in the directory will be deleted. Changes on smilie information will be kept."}</p>

<form class="z-form" action="{modurl modname="bbsmile" type="admin" func="readsmilies"}" method="post" enctype="application/x-www-form-urlencoded">

    <fieldset>
        <legend>{gt text='Should the smilies be read out of the directory?'}</legend>
        <input type="hidden" name="authid" value="{secgenauthkey module="bbsmile"}" />
        {if $zcore.bbsmile.smiliepath_auto neq ''}
        <div class="z-formrow">
            <label>{gt text='Path to the smilies'}</label>
            <span style="font-weight:bold;">{$zcore.bbsmile.smiliepath_auto}</span>
        </div>
        {/if}
        <div class="z-formrow">
            <label for="forcereload">{gt text='Force reload of smilies, all data will be overwritten!'}</label>
            <input name="forcereload" id="forcereload" type="checkbox" value="1" />
        </div>
    </fieldset>

    <div class="z-formbuttons">
        <input name="submit" type="submit" value="{gt text="Apply"}" />
    </div>

</form>

{include file="bbsmile_admin_footer.tpl"}
