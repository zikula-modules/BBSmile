{ajaxheader modname='BBSmile' ui=true filename='dosmilie.js'}
{pageaddvar name='stylesheet' value='modules/BBSmile/style/style.css'}

<noscript>
    <p class="noscript">{gt text='Your browser does not support javascript or you turned it off. The BBSmile interface has been disabled.'}</p>
</noscript>
<div id="bbsmile" class="bbsmile_smilies">
    {bbsmile_smilie_list assign="smilies" type="standard"}
    <div class="bb_standardsmilies z-formnote">
        {* default smilies *}
        {foreach item=smilie from=$smilies}
        <a href="javascript:void(0);" onclick="AddSmilie(' {$smilie.short} ')" title="{$smilie.short}">
            <img class="bb_smilie" src="{$baseurl}{$modvars.BBSmile.smiliepath}/{$smilie.imgsrc}" alt='Smilie {$smilie.alt}' />
        </a>
        {/foreach}
    </div>

    {if $modvars.BBSmile.activate_auto}
    <div class="bb_showhidesmilies z-formnote">
        <a href="{$baseurl}index.php?module=BBSmile&amp;type=ajax&amp;func=loadsmilies" id="smiliemodal">{gt text='More Smilies'}</a>&nbsp;<img class="hidden" id="loadsmilieindicator" src="images/ajax/indicator.white.gif" alt="ajaxindicator" />
    </div>
    {/if}
</div>