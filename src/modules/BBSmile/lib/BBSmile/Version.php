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

	/**
	 * Define Hook Bundles
	 */
    protected function setupHookBundles()
    {

    	// first bundle does not work at the moment TODO
    /*	$bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.bbsmile.ui_hooks.smilies', 'ui_hooks', $this->__('BBSmile - Show smilies'));
    	$bundle->addServiceHandler('display_view','BBSmile_HookHandlers','uiEdit', 'bbsmile.smilies');
    	
    	$this->registerHookProviderBundle($bundle); */
    	
    	$bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.bbsmile.filter_hooks.smilies', 'filter_hooks', $this->__('BBSmile - Transform Smilies'));
    	$bundle->addServiceHandler('filter','BBSmile_HookHandlers', 'uifilter', 'bbsmile.smilies');
        
        $this->registerHookProviderBundle($bundle);

        //... repeat as many times as necessary
    }

}
