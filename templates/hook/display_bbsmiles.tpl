{pageaddvar name='javascript' value='modules/BBSmile/javascript/dosmilie.js'}
{pageaddvar name='stylesheet' value='modules/BBSmile/style/style.css'}

<div id="bbsmile">
    {bbsmile_smilie_list assign="smilies" type="standard"}
    <div class="bb_standardsmilies">
        {* default smilies *}
        {foreach item=smilie from=$smilies}
        <a href="javascript:void(0);" onclick="AddSmilie(' {$smilie.short} ')" title="{$smilie.short}">
            <img class="bb_smilie" src="{$baseurl}{$modvars.BBSmile.smiliepath}/{$smilie.imgsrc}" alt='Smilie {$smilie.alt}' />
        </a>
        {/foreach}
        {if $modvars.BBSmile.activate_auto}
            <a data-target="#bbSmileModal" role='button' data-toggle="modal" class='btn btn-xs btn-success'>{gt text='More Smilies'}</a>
        {/if}
    </div>
</div>
<noscript>
    <p class="noscript">{gt text='Your browser does not support javascript or you turned it off. The BBSmile interface has been disabled.'}</p>
</noscript>

<!-- MODAL -->
<div class="modal" id="bbSmileModal" tabindex="-1" role="dialog" aria-labelledby="bbSmileModalLabel" aria-hidden="true" data-remote="{$baseurl}index.php?module=BBSmile&amp;type=ajax&amp;func=loadsmilies">
    <!-- entire content replaced after load -->
    <div class="modal-dialog">
        <div class="modal-content alert alert-info">
            <i class="fa fa-spinner fa-spin fa-lg"></i> {gt text='loading'}
        </div>
    </div>
</div>
<!-- /MODAL -->