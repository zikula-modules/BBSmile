<?php

/**
 * BBSmile
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBSmile
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class BBSmile_Version extends Zikula_AbstractVersion
{

    const PROVIDER_UIAREANAME = 'provider.bbsmile.ui_hooks.smilies';
    const PROVIDER_FILTERAREANAME = 'provider.bbsmile.filter_hooks.smilies';

    public function getMetaData()
    {
        $meta = array();
        $meta['oldnames'] = array('bbsmile');
        $meta['version'] = '3.0.0';
        $meta['core_min'] = '1.3.6';
        $meta['description'] = $this->__('Smilie Hook (Autoincluded)');
        $meta['displayname'] = $this->__('BBSmile Hook');
        $meta['url'] = $this->__('bbsmile');
        $meta['securityschema'] = array('BBSmile::' => '::');
        $meta['capabilities'] = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
        return $meta;
    }

    /**
     * Define Hook Bundles
     */
    protected function setupHookBundles()
    {
        $bundle = new Zikula_HookManager_ProviderBundle($this->name, self::PROVIDER_UIAREANAME, 'ui_hooks', $this->__('BBSmile - Show smilies'));
        // form_edit hook is used to add smiley selector and other code to new object form (validate and process hooks unneeded)
        $bundle->addServiceHandler('form_edit', 'BBSmile_HookHandlers', 'uiEdit', 'bbsmile.smilies');
        $this->registerHookProviderBundle($bundle);

        $bundle = new Zikula_HookManager_ProviderBundle($this->name, self::PROVIDER_FILTERAREANAME, 'filter_hooks', $this->__('BBSmile - Transform Smilies'));
        // filter hook is used to transform the altered text in the hooked object to display the smilies
        $bundle->addServiceHandler('filter', 'BBSmile_HookHandlers', 'uifilter', 'bbsmile.smilies');
        $this->registerHookProviderBundle($bundle);
    }

}
