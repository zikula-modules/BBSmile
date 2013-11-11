{adminheader}
<h3>
    <span class="fa fa-edit"></span>&nbsp;{gt text="Currently defined Smilies"}
</h3>
<p class="alert alert-info">{gt text='Aliases are seperated by ",". Please don\'t use spaces.'}</p>

<form class="form" action="{modurl modname=$module type="admin" func="editsmilies"}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="csrftoken" value="{insert name="csrftoken"}" />
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>{gt text="Smilie"}</th>
                    <th>{gt text="Shortcut/Trigger"}</th>
                    <th>{gt text="Filename"}</th>
                    <th>{gt text="alternative text"}</th>
                    <th>{gt text="Aliases for this smilie"}</th>
                    <th>{gt text="Active"}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$smilies key=key item=smilie}
                    <tr>
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
                            <input type="text" name="alt[]" class='form-control input-sm' value="{$smilie.alt|safehtml}" size="20" maxlength="20" />
                        </td>
                        <td>
                            <input type="text" name="alias[]" class='form-control input-sm' value="{$smilie.alias|safehtml}" size="20" maxlength="20" />
                        </td>
                        <td>
                            <input type="checkbox" name="active[]" value="{$key}" {if $smilie.active eq 1} checked="checked" {/if} />
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>

        <div class="col-lg-offset-3 col-lg-9">
            {button type='submit' value='1' class='btn btn-success' __alt="Apply" __title="Apply" __text="Apply"}
        </div>

    </div>
</form>

</div>