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
 */
function pn_bbsmile_user_bbsmiles($args)
{
    extract($args);

    // load language file
    if(!pnModAPILoad('pn_bbsmile', 'user')) {
        $smarty->trigger_error("loading pn_bbsmile api failed", e_error);
        return;
    } 

    $pnr =& new pnRender('pn_bbsmile');
    $pnr->assign('imagepath', pnModGetVar('pn_bbsmile', 'smiliepath'));
    
    $file = "modules/pn_bbsmile/pnjavascript/dosmilie.js";
    if(file_exists($file) && is_readable($file)) {
        $pnr->assign('jsheader', "<script type=\"text/javascript\" src=\"$file\"></script>");
    }    
    return $pnr->fetch('pn_bbsmile_user_bbsmiles.html');
}

?>