{bbsmile_smilie_list assign="autosmilies" type="auto"}
{if $autosmilies_count > 0}
<p>{gt text="Click outside this window to close it"}</p>
<table>
    <tr>
        {assign var="col" value="0"}
        {foreach name=element item=smilie from=$autosmilies}
    {if $col == 5}</tr><tr>{assign var="col" value="0"}{/if}
        <td>
            <a href="javascript:void(0);" onclick="AddSmilie('{$textfieldid}', ' {$smilie.short} ')" title="{$smilie.short}">
                <img src="{getbaseurl}{$modvars.BBSmile.smiliepath_auto}/{$smilie.imgsrc}" alt="Smilie {$smilie.alt}" />
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

{/if}
