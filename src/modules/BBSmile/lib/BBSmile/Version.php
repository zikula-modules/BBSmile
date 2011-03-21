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
	public function getMetaData()
	{
		$meta['oldnames']         = array('bbsmile');
		$meta['version']          = '3.0.0';
		$meta['id']               = '163';
		$meta['description']      = $this->__('Smilie Hook (Autoincluded)');
		$meta['displayname']      = $this->__('BBSmile Hook');
		$meta['url']              = $this->__('bbsmile');
		$meta['securityschema']   = array('BBSmile::' => '::');
        $meta['capabilities']     = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
    	return $meta;
	}

    protected function setupHookBundles()
    {
        $bundle = new Zikula_Version_HookProviderBundle('modulehook_area.bbsmile.bbsmile', $this->__('BBSmile filter hook'));
        $bundle->addHook('hookhandler.bbsmile.ui.filter', 'ui.filter', 'BBSmile_HookHandlers', 'uifilter', 'bbsmile.service');
        // add other hooks as needed
        $this->registerHookProviderBundle($bundle);

        //... repeat as many times as necessary
    }

}
