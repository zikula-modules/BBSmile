<?php
// $Id: mh_admin_modifyconfighandler.class.php 166 2007-02-18 19:18:21Z landseer $
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Frank Schummertz
// Purpose of file:  BBSmile administration display functions
// ----------------------------------------------------------------------

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
            $url = ModUtil::url('BBSmile', 'admin', 'modifyconfig' );
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
            $ifield = & $view->pnFormGetPluginById('smiliepath');
            $ifield->setError(DataUtil::formatForDisplay($this->__('The path does not exists or the system cannot read it.')));
            $ok = false;
        }

        $osautosmiliepath = DataUtil::formatForOS($data['smiliepath_auto']);
        if(!file_exists($osautosmiliepath) || !is_readable($osautosmiliepath)) {
            $ifield = & $view->pnFormGetPluginById('smiliepath_auto');
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
