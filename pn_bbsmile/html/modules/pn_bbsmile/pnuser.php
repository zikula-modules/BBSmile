<?php
// $Id$
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
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
    pnRedirect('index.php');
    return true;
}

/**
 * bbsmile
 * returns a html snippet with buttons for inserting bbsmiles into a text
 *
 * @param    $args['textfieldid']  id of the textfield for inserting smilies
 */
function pn_bbsmile_user_bbsmiles($args)
{
    extract($args);
    unset($args);

    if(!isset($textfieldid) || empty($textfieldid)) {
        return _MODARGSERROR . ' (textfieldid)';
    }

    // if we have more than one textarea we need to distinguish them, so we simply use
    // a counter stored in a session var until we find a better solution
    $counter = pnSessionGetVar('bbsmile_counter');
    if($counter==false) {
        $counter = 1;
    } else {
        $counter++;
    }
    pnSessionSetVar('bbsmile_counter', $counter);

    $pnr =& new pnRender('pn_bbsmile');
    $pnr->caching = false;
    $pnr->add_core_data();
    $pnr->assign('counter', $counter);
/*
    $pnr->assign('imagepath', pnModGetVar('pn_bbsmile', 'smiliepath'));
    $pnr->assign('activate_auto', pnModGetVar('pn_bbsmile', 'activate_auto'));
    $pnr->assign('imagepath_auto', pnModGetVar('pn_bbsmile', 'smiliepath_auto'));
*/
    $pnr->assign('textfieldid', $textfieldid);

    $headers[] = '<script type="text/javascript" src="modules/pn_bbsmile/pnjavascript/dosmilie.js"></script>';
    $headers[] = '<link rel="stylesheet" type="text/css" href="modules/pn_bbsmile/pnstyle/style.css" />';

    global $additional_header;
    if(!is_array($additional_header)) {
        $additional_header = array();
    }
    $values = array_flip($additional_header);
    foreach($headers as $header) {
        if(!array_key_exists($header, $values)) {
            $additional_header[] = $header;
        }
    }

    $templatefile = pnVarPrepForOS(pnModGetName()) . '.html';
    if($pnr->template_exists($templatefile)) {
        return $pnr->fetch($templatefile);
    }
    return $pnr->fetch('pn_bbsmile_user_bbsmiles.html');
}

/* THIS FUNCTION NEEDS SOME WORK - DO NOT USE IT ATM !! */
function pn_bbsmile_user_popup($args)
{
    extract($args);

    $pnr =& new pnRender('pn_bbsmile');
    $pnr->caching = false;
    $pnr->assign('imagepath', pnModGetVar('pn_bbsmile', 'smiliepath'));
    $pnr->assign('imagepath_auto', pnModGetVar('pn_bbsmile', 'smiliepath_auto'));

    $file = "modules/pn_bbsmile/pnjavascript/dosmilie.js";
    if(file_exists($file) && is_readable($file)) {
        $pnr->assign('jsheader', "<script type=\"text/javascript\" src=\"$file\"></script>");
    }
    return $pnr->fetch('pn_bbsmile_user_bbsmiles_popup.html');
}

?>