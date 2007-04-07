<?php
// $Id$
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
// Original Author of file: Hinrich Donner
// changed to pn_bbsmile: larsneo
// ----------------------------------------------------------------------

/**
 * @package PostNuke_Utility_Modules
 * @subpackage pn_bbsmile
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * main funcion
 * The main function is not used in the pn_bbsmile module, we just rediret to index.php
 *
 */
function pn_bbsmile_user_main()
{
    return pnRedirect('index.php');
}

/**
 * bbsmile
 * returns a html snippet with buttons for inserting bbsmiles into a text
 *
 * @param    $args['textfieldid']  id of the textfield for inserting smilies
 */
function pn_bbsmile_user_bbsmiles($args)
{
    if(!isset($args['textfieldid']) || empty($args['textfieldid'])) {
        return LogUtil::registerError(_MODARGSERROR . ' (textfieldid)');
    }

    // if we have more than one textarea we need to distinguish them, so we simply use
    // a counter stored in a session var until we find a better solution
    $counter = SessionUtil::getVar('bbsmile_counter');
    if($counter==false) {
        $counter = 1;
    } else {
        $counter++;
    }
    SessionUtil::setVar('bbsmile_counter', $counter);

    $pnr = new pnRender('pn_bbsmile', false);
    $pnr->add_core_data();
    $pnr->assign('counter', $counter);
    $pnr->assign('textfieldid', $args['textfieldid']);

    PageUtil::addVar('javascript', 'modules/pn_bbsmile/pnjavascript/dosmilie.js');
    PageUtil::addVar('stylesheet', ThemeUtil:getModuleStylesheet('pn_bsmile'));
    
    $templatefile = pnVarPrepForOS(pnModGetName()) . '.html';
    if($pnr->template_exists($templatefile)) {
        return $pnr->fetch($templatefile);
    }
    return $pnr->fetch('pn_bbsmile_user_bbsmiles.html');
}

?>