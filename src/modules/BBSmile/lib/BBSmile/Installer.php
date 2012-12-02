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
class BBSmile_Installer extends Zikula_AbstractInstaller
{

    /**
     * init module
     */
    public function install()
    {
        // Set up module variables
        $this->setVar('smiliepath', 'modules/BBSmile/images/smilies');
        $this->setVar('activate_auto', '0');
        $this->setVar('remove_inactive', '1');
        $this->setVar('smiliepath_auto', 'modules/BBSmile/images/smilies_auto');
        $this->setVar('smilie_array', BBSmile_Util::getDefaultSmilies());

        // Set up module hooks
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // Initialisation successful
        return true;
    }

    /**
     * upgrade module
     */
    public function upgrade($oldversion)
    {
        /*
          switch($oldversion) {

          default:
          break;
          }
         */
        return true;
    }

    /**
     * delete module
     */
    public function uninstall()
    {
        // Remove module hooks
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // Remove module variables
        $this->delVars();

        // Deletion successful
        return true;
    }

}
