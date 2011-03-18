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

class BBSmile_Controller_Admin extends Zikula_Controller
{
    public function postInitialize()
    {
        $this->view->setCaching(false)->add_core_data();
    }

    /**
    * the main administration function
    * This function is the default function, and is called whenever the
    * module is initiated without defining arguments.  As such it can
    * be used for a number of things, but most commonly it either just
    * shows the module menu and returns or calls whatever the module
    * designer feels should be the default function (often this is the
    * view() function)
    */
    public function main()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getVar('entrypoint', 'index.php'));
        }

        $form = FormUtil::newForm('BBSmile', $this);
        return $form->execute('bbsmile_admin_modifyconfig.tpl', new BBSmile_Form_Handler_Admin_ModifyConfig());

    }

    /**
    * readsmilies
    *
    *
    */
    public function readsmilies()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getVar('entrypoint', 'index.php'));
        }

        $submit = FormUtil::getPassedValue('submit', null, 'POST');

        if(!$submit) {
            return $this->view->fetch('bbsmile_admin_readsmilies.tpl');
        }
        // submit is set - update the Smilies
        $forcereload = FormUtil::getPassedValue('forcereload', 0, 'POST');
        $forcereload = ($forcereload==1) ? true : false;
        // @see adminapi.php#bbsmile_adminapi_updatesmilies()
        ModUtil::apiFunc('BBSmile', 'admin', 'updatesmilies', array('forcereload' => $forcereload));
        LogUtil::registerStatus($this->__('Smilies have been read from filesystem successfully.'));
        return System::redirect(ModUtil::url('BBSmile', 'admin', 'editsmilies'));
    }

    /**
    * editsmilies
    *
    *
    */
    public function editsmilies()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getVar('entrypoint', 'index.php'));
        }

        $submit = FormUtil::getPassedValue('submit', null, 'POST');

        if(!$submit) {
            $smilies = $this->getVar('smilie_array');
            $this->view->assign('smilies',$smilies);
            return $this->view->fetch('bbsmile_admin_editsmiles.tpl');
        }
        // submit is set
        // Get input
        $keys    = FormUtil::getPassedValue('key', array(), 'POST');
        $shorts  = FormUtil::getPassedValue('short', array(), 'POST');
        $imgsrcs = FormUtil::getPassedValue('imgsrc', array(), 'POST');
        $alts    = FormUtil::getPassedValue('alt', array(), 'POST');
        $aliases = FormUtil::getPassedValue('alias', array(), 'POST');
        $types   = FormUtil::getPassedValue('smilietype', array(), 'POST');
        $active  = FormUtil::getPassedValue('active', array(), 'POST');

        $smilies = array();

        // Create an array with the input and deaktivate all smilies
        for($i = 0; $i < sizeof($keys); $i++) {
        $smilies[$keys[$i]] = array(
            'type'   => $types[$i],
            'short'  => $shorts[$i],
            'imgsrc' => $imgsrcs[$i],
            'alt'    => $alts[$i],
            'alias'  => $aliases[$i],
            'active'  => 0);
        }
        // And now set the active flag for all selected smilies
        for ($i = 0; $i < sizeof($active); $i++) {
            $smilies[$active[$i]]['active'] = 1;
        }

      $this->setVar('smilie_array', $smilies);

      LogUtil::registerStatus($this->__('The edited smilies have been saved.'));
      return System::redirect(ModUtil::url('BBSmile', 'admin', 'main'));
    }
}
