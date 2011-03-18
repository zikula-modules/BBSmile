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
 
/**
 * Smarty modifier to apply the bbsmile transform hooks
 * 
 * Available parameters:

 * Example
 * 
 *   <!--[$MyVar|bbsmile]-->
 * 
 * 
 * @author       Frank Schummertz
 * @author       The pnForum team
 * @since        16. Sept. 2003
 * @param        array    $string     the contents to transform
 * @return       string   the modified output
 */
function smarty_modifier_bbsmile($string)
{
    return = ModUtil::apiFunc('BBSmile', 'user', 'transform', array('text' =>  $string));
}
