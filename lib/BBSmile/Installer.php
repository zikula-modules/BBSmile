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
        $this->setVar('activate_auto', '1');
        $this->setVar('remove_inactive', '1');
        $this->setVar('smiliepath_auto', 'modules/BBSmile/images/smilies_auto');
        $this->setVar('smilie_array', BBSmile_Util::getDefaultSmilies());

        // load the 'auto' smilies
        ModUtil::loadApi($this->name, 'admin', true);
        ModUtil::apiFunc($this->name, 'admin', 'updatesmilies', array('forcereload' => 1));

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
        switch ($oldversion) {
            case '2.1':
                // reset all modvars to default
                $this->setVar('smiliepath', 'modules/BBSmile/images/smilies');
                $this->setVar('activate_auto', '1');
                $this->setVar('remove_inactive', '1');
                $this->setVar('smiliepath_auto', 'modules/BBSmile/images/smilies_auto');
                $this->setVar('smilie_array', BBSmile_Util::getDefaultSmilies());
                // load the 'auto' smilies
                ModUtil::loadApi($this->name, 'admin', true);
                ModUtil::apiFunc($this->name, 'admin', 'updatesmilies', array('forcereload' => 1));
                // create hook
                HookUtil::registerProviderBundles($this->version->getHookProviderBundles());
            case '3.0.0': // current version
        }
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
