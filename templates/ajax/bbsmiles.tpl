{bbsmile_smilie_list assign="autosmilies" type="auto"}
{if $autosmilies_count > 0}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="bbSmileModalLabel">{gt text="Smilies"}</h3>
            </div>
            <div class="modal-body">
                <table class='table table-striped'>
                    <tr>
                        {assign var="col" value="0"}
                        {foreach name=element item=smilie from=$autosmilies}
                        {if $col == 5}</tr><tr>{assign var="col" value="0"}{/if}
                        <td>
                            <a href="javascript:void(0);" onclick="AddSmilie(' {$smilie.short} ')" title="{$smilie.short}">
                                <img src="{$baseurl}{$modvars.BBSmile.smiliepath_auto}/{$smilie.imgsrc}" alt="Smilie {$smilie.alt}" />
                            </a>
                        </td>
                        {assign var="col" value="`$col+1`"}
                        {/foreach}
                        {assign var="remainder" value="`5-$col`"}
                        {section name=emptyElement loop=$remainder}
                        <td>&nbsp;</td>
                        {/section}
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
{else}
    <p>{gt text='No more smilies to list!'}</p>
{/if}