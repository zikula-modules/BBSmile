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
class BBSmile_Controller_Admin extends Zikula_AbstractController
{

    public function postInitialize()
    {
        $this->view->setCaching(false)->add_core_data();
    }

    /**
     * Main Admin function
     */
    public function main()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getHomepageUrl());
        }

        $form = FormUtil::newForm('BBSmile', $this);
        return $form->execute('admin/modifyconfig.tpl', new BBSmile_Form_Handler_Admin_ModifyConfig());
    }

    /**
     * readsmilies
     *
     *
     */
    public function readsmilies()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getHomepageUrl());
        }

        $submit = $this->getPassedValue('submit', null, 'POST');

        if (!$submit) {
            return $this->view->fetch('admin/readsmilies.tpl');
        }
        // submit is set - update the Smilies
        
        $this->checkCsrfToken();

        $forcereload = $this->getPassedValue('forcereload', 0, 'POST');
        $forcereload = ($forcereload == 1) ? true : false;
        // @see adminapi.php#bbsmile_adminapi_updatesmilies()
        ModUtil::apiFunc('BBSmile', 'admin', 'updatesmilies', array('forcereload' => $forcereload));
        LogUtil::registerStatus($this->__('Smilies have been read from filesystem successfully.'));

        $this->redirect(ModUtil::url('BBSmile', 'admin', 'editsmilies'));
    }

    /**
     * editsmilies
     *
     *
     */
    public function editsmilies()
    {
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError(System::getHomepageUrl());
        }

        $submit = $this->getPassedValue('submit', null, 'POST');

        if (!$submit) {
            $smilies = $this->getVar('smilie_array');
            $this->view->assign('smilies', $smilies);
            return $this->view->fetch('admin/editsmiles.tpl');
        }
        // submit is set
        $this->checkCsrfToken();
        // Get input
        $keys = $this->getPassedValue('key', array(), 'POST');
        $shorts = $this->getPassedValue('short', array(), 'POST');
        $imgsrcs = $this->getPassedValue('imgsrc', array(), 'POST');
        $alts = $this->getPassedValue('alt', array(), 'POST');
        $aliases = $this->getPassedValue('alias', array(), 'POST');
        $types = $this->getPassedValue('smilietype', array(), 'POST');
        $active = $this->getPassedValue('active', array(), 'POST');

        $smilies = array();

        // Create an array with the input and deaktivate all smilies
        for ($i = 0; $i < sizeof($keys); $i++) {
            $smilies[$keys[$i]] = array(
                'type' => $types[$i],
                'short' => $shorts[$i],
                'imgsrc' => $imgsrcs[$i],
                'alt' => $alts[$i],
                'alias' => $aliases[$i],
                'active' => 0);
        }
        // And now set the active flag for all selected smilies
        for ($i = 0; $i < sizeof($active); $i++) {
            $smilies[$active[$i]]['active'] = 1;
        }

        $this->setVar('smilie_array', $smilies);

        LogUtil::registerStatus($this->__('The edited smilies have been saved.'));

        $this->redirect(ModUtil::url('BBSmile', 'admin', 'main'));
    }
    
    /**
     * Helper function to convert old getPassedValue method to Core 1.3.3-standard
     * 
     * @param string $variable
     * @param mixed $defaultValue
     * @param string $type
     * @return mixed 
     */
    private function getPassedValue($variable, $defaultValue, $type = 'POST')
    {
        if ($type == 'POST') {
            return $this->request->request->get($variable, $defaultValue);
        } else if ($type == 'GET') {
            return $this->request->query->get($variable, $defaultValue);
        } else {
            // else try GET then POST
            return $this->request->query->get($variable, $this->request->request->get($variable, $defaultValue));
        }
    }

}
