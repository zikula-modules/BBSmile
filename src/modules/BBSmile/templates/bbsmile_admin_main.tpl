{include file="bbsmile_admin_header.tpl"}

<strong>{gt text="Actually BBSmile is used with the following modules"}:</strong>
<ul>
    {foreach item=mod from=$hookedmodules}
    <li><a href="{modurl modname=modules type=admin func=hooks id=$mod.id}" title="{$mod.description}">{$mod.displayname}</a></li>
    {foreachelse}
    <li style="list-style-type: none;">{gt text="** BBSmile is not used with any module **"}</li>
    {/foreach}
</ul>
<p><a href="{modurl modname='Extensions' type='admin' func='main'}" title="{gt text="Activate BBSmile for more modules"}">{gt text="Activate BBSmile for more modules"}</a></p>

{include file="bbsmile_admin_footer.tpl"}
