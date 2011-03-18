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

class BBSmile_Form_Handler_Admin_ModifyConfig extends Zikula_Form_Handler
{
    function initialize(Zikula_Form_View $view)
    {
        $view->caching = false;
        $view->add_core_data();
        return true;
    }


    function handleCommand(Zikula_Form_View $view, &$args)
    {
        if ($args['commandName'] == 'cancel') {
            $url = ModUtil::url('BBSmile', 'admin', 'main' );
            return $view->redirect($url);
        }

        // Security check
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(ModUtil::url('BBSmile', 'admin', 'main'));
        }

        // check for valid form
        if (!$view->isValid()) {
            return false;
        }

        $ok = true;
        $data = $view->getValues();

        $ossmiliepath = DataUtil::formatForOS($data['smiliepath']);
        if(!file_exists($ossmiliepath) || !is_readable($ossmiliepath)) {
            $ifield = $this->view->getPluginById('smiliepath');
            $ifield->setError(DataUtil::formatForDisplay($this->__('The path does not exists or the system cannot read it.')));
            $ok = false;
        }

        $osautosmiliepath = DataUtil::formatForOS($data['smiliepath_auto']);
        if(!file_exists($osautosmiliepath) || !is_readable($osautosmiliepath)) {
            $ifield = $this->view->getPluginById('smiliepath_auto');
            $ifield->setError(DataUtil::formatForDisplay($this->__('The path does not exists or the system cannot read it.')));
            $ok = false;
        }

        if($ok == false) {
            return false;
        }

        $this->setVar('smiliepath',       $data['smiliepath']);
        $this->setVar('smiliepath_auto',  $data['smiliepath_auto']);
        $this->setVar('activate_auto',    $data['activate_auto']);
        $this->setVar('remove_inactive',  $data['remove_inactive']);

        LogUtil::registerStatus($this->__('BBSmile configuration updated'));

        return true;
    }

}
