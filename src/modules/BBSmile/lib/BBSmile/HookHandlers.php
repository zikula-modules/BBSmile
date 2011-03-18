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

class BBSmile_HookHandlers extends Zikula_HookHandler
{

    /**
    * the hook function
    */
    public function uifilter(Zikula_Event $event)
    {
        // who called us
        $caller = $event['caller'];
        
        $data = ModUtil::apiFunc('BBSmile', 'user', 'transform', 
                                 array('text' => $event->getData()));
        $event->setData($data);
        return;     
    }
}
