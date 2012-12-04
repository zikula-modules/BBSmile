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
class BBSmile_Controller_Ajax extends Zikula_AbstractController
{

    /**
     * loadsmilies
     * returns a html snippet for selecting autosmilies
     *
     */
    public function loadsmilies()
    {
        echo $this->view->fetch('ajax/bbsmiles.tpl');
        System::shutdown();
    }

}
