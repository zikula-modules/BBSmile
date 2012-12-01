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
class BBSmile_HookHandlers extends Zikula_Hook_AbstractHandler
{

    /**
     * Zikula_View instance
     * @var object
     */
    private $view;

    /**
     * Post constructor hook.
     *
     * @return void
     */
    public function setup()
    {
        $this->view = Zikula_View::getInstance("BBSmile");
    }
    
    /**
     * Display 'hidden' htm required to assist the transform hook?
     * @param Zikula_DisplayHook $hook 
     */
    public function uiView(Zikula_DisplayHook $hook)
    {
        // nothing to do atm
    }

    /**
     * Display smilies and provide interface for their use in an edit object form
     * 
     * @param Zikula_DisplayHook $hook
     * 
     * @return string (html) 
     */
    public function uiEdit(Zikula_DisplayHook $hook)
    {

        // some initialization stuff
        $assign = (isset($params['assign']) && !empty($params['assign'])) ? $params['assign'] : 'smilies';
        $type = (isset($params['type']) && !empty($params['type'])) ? $params['type'] : '';

        $active_smilies = array();
        $smilies = array();

        // Get all Smilies
        $all_smilies = ModUtil::getVar('BBSmile', 'smilie_array');

        foreach ($all_smilies as $key => $smilie) {
            // Check if the type of the smilie is the wanted type
            if ($smilie['active'] == 1) {
                $active_smilies[$key] = $smilie;
            }
        }
        // if there is no type then return all active smilies
        if ($type == '') {
            $smilies = $active_smilies;
        } else {
            // Get only the smilies with the wanted type
            // map words to number
            if ($type == 'standard') {
                $type = 0;
            } else {
                // eg. $type == "auto" or all other values
                $type = 1;
            }

            foreach ($active_smilies as $key => $smilie) {
                // Check if the typ od the smilie is the wanted type and if the smilie is active
                if ($smilie['type'] == $type && $smilie['active'] == 1) {
                    $smilies[$key] = $smilie;
                }
            }
        }

        // Asign the smilies to smarty
        $this->view->assign($assign, $smilies);
        $this->view->assign($assign . '_count', count($smilies));


        $hook->setResponse(new Zikula_Response_DisplayHook(BBSmile_Version::PROVIDER_UIAREANAME, $this->view, 'hook/display_bbsmiles.tpl'));

        return;
    }

    /**
     * the hook filter function
     */
    public static function uifilter(Zikula_FilterHook $hook)
    {

        // Security check
        if (!SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADD)) {
            return;
        }

        $data = ModUtil::apiFunc('BBSmile', 'user', 'transform', array('text' => $hook->getData()));

        $hook->setData($data);
        return;
    }

}
