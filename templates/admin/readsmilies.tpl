{adminheader}
<h3>
    <span class="fa fa-cogs"></span>&nbsp;{gt text="Reload smilies from filesystem"}
</h3>
<p class="alert alert-info">{gt text="With confirmation all smilies out of the directory are read. Smilies without a image in the directory will be deleted. Changes on smilie information will be kept."}</p>

<form class="form-horizontal" action="{modurl modname=$module type="admin" func="readsmilies"}" method="post" enctype="application/x-www-form-urlencoded">

    <fieldset>
        <legend>{gt text='Should the smilies be read out of the directory?'}</legend>
        <input type="hidden" name="csrftoken" value="{insert name="csrftoken"}" />
        {if $modvars.BBSmile.smiliepath_auto neq ''}
        <div class="form-group">
            <label class="col-lg-3 control-label">{gt text='Path to the smilies'}</label>
            <div class="col-lg-9">
                <p class='form-control-static'><em>{$modvars.BBSmile.smiliepath_auto}</em></p>
            </div>
        </div>
        {/if}
        <div class="form-group">
            <label class="col-lg-3 control-label" for="forcereload">{gt text='Force reload of smilies, all data will be overwritten!'}</label>
            <div class="col-lg-9">
                <input class='form-control' name="forcereload" id="forcereload" type="checkbox" value="1" />
            </div>
        </div>
    </fieldset>

    <div class="col-lg-offset-3 col-lg-9">
        {button type='submit' value='1' class='btn btn-success' __alt="Apply" __title="Apply" __text="Apply"}
    </div>

</form>

</div>