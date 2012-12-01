{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="edit" size="small"}
    <h3>{gt text='Currently defined Smilies'}</h3>
</div>

<p class="z-informationmsg">{gt text='Aliases are seperated by ",". Please don\'t use spaces.'}</p>

<form class="z-form" action="{modurl modname="BBSmile" type="admin" func="editsmilies"}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="authid" value="{secgenauthkey module="BBSmile"}" />
        <table class="z-admintable">
            <thead>
                <tr>
                    <th class="bb_tablehead">{gt text="Smilie"}</th>
                    <th class="bb_tablehead">{gt text="Shortcut/Trigger"}</th>
                    <th class="bb_tablehead">{gt text="Filename"}</th>
                    <th class="bb_tablehead">{gt text="alternative text"}</th>
                    <th class="bb_tablehead">{gt text="Aliases for this smilie"}</th>
                    <th class="bb_tablehead">{gt text="Active"}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$smilies key=key item=smilie}
                    <tr class="{cycle values=z-odd,z-even}">
                        <td>
                            <img src="{if $smilie.type eq 0}{$modvars.BBSmile.smiliepath}{else}{$modvars.BBSmile.smiliepath_auto}{/if}/{$smilie.imgsrc|safehtml}" alt="{$smilie.alt|safehtml}" />
                            <input type="hidden" name="key[]" value="{$key}" />
                            <input type="hidden" name="smilietype[]" value="{$smilie.type|safehtml}" />
                        </td>
                        <td>
                            {$smilie.short}
                            <input type="hidden" name="short[]" value="{$smilie.short|safehtml}" />
                        </td>
                        <td>
                            {$smilie.imgsrc}
                            <input type="hidden" name="imgsrc[]" value="{$smilie.imgsrc|safehtml}" />
                        </td>
                        <td>
                            <input type="text" name="alt[]" value="{$smilie.alt|safehtml}" size="20" maxlength="20" />
                        </td>
                        <td>
                            <input type="text" name="alias[]" value="{$smilie.alias|safehtml}" size="20" maxlength="20" />
                        </td>
                        <td>
                            <input type="checkbox" name="active[]" value="{$key}" {if $smilie.active eq 1} checked="checked" {/if} />
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
            
        <div class="z-buttons z-formbuttons">
            {button src="button_ok.png" set="icons/extrasmall" __alt="Apply" __title="Apply" __text="Apply"}
        </div>

    </div>
</form>

</div>