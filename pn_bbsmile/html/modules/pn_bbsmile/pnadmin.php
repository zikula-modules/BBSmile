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
 * the main administration function
 * This function is the default function, and is called whenever the
 * module is initiated without defining arguments.  As such it can
 * be used for a number of things, but most commonly it either just
 * shows the module menu and returns or calls whatever the module
 * designer feels should be the default function (often this is the
 * view() function)
 */
function pn_bbsmile_admin_main()
{
    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_PNBBSMILE_ADMIN_NOACCESS);
    }

    $pnRender =& new pnRender('pn_bbsmile');
    $pnRender->caching = false;
    return $pnRender->fetch('pn_bbsmile_admin_main.html');
}

// show admin choices
//
function pn_bbsmile_admin_modifyconfig()
{
    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_PNBBSMILE_ADMIN_NOACCESS);;
    }

    $submit = pnVarCleanFromInput('submit');
    if(!$submit) {

        $pnRender =& new pnRender('pn_bbsmile');
        $pnRender->caching = false;
        $pnRender->assign('imagepath', pnModGetVar('pn_bbsmile', 'smiliepath'));
        $pnRender->assign('imagepath_auto', pnModGetVar('pn_bbsmile', 'smiliepath_auto'));

        $activate_auto_value = pnModGetVar('pn_bbsmile', 'activate_auto');
        $activate_auto = "";
        if ($activate_auto_value)
            $activate_auto = 'checked="checked"';
        $pnRender->assign('activate_auto', $activate_auto);

        $displayhook_value = pnModGetVar('pn_bbsmile', 'displayhook');
        $displayhook = "";
        if ($displayhook_value)
            $displayhook = 'checked="checked"';
        $pnRender->assign('displayhook', $displayhook);

        $remove_inactive_value = pnModGetVar('pn_bbsmile', 'remove_inactive');
        $remove_inactive = "";
        if ($remove_inactive_value)
            $remove_inactive = 'checked="checked"';
        $pnRender->assign('remove_inactive', $remove_inactive);

        // that's all folks
        return $pnRender->fetch('pn_bbsmile_admin_modifyconfig.html');

    } else { // submit is set

        // save vars
        $imagepath = pnVarCleanFromInput('imagepath');
        pnModSetVar('pn_bbsmile', 'smiliepath', $imagepath);

        $imagepath_auto = pnVarCleanFromInput('imagepath_auto');
        pnModSetVar('pn_bbsmile', 'smiliepath_auto', $imagepath_auto);

        $activate_auto = pnVarCleanFromInput('activate_auto');
        if (empty($activate_auto)) $activate_auto = 0;
        pnModSetVar('pn_bbsmile','activate_auto',$activate_auto);

        $remove_inactive = pnVarCleanFromInput('remove_inactive');
        if (empty($remove_inactive)) $remove_inactive = 0;
        pnModSetVar('pn_bbsmile', 'remove_inactive', $remove_inactive);

        $displayhook = pnVarCleanFromInput('displayhook');
        if (empty($displayhook)) $displayhook = 0;
        pnModSetVar('pn_bbsmile', 'displayhook', $displayhook);

        pnSessionSetVar('statusmsg', _PNBBSMILE_ADMIN_CONFIGSAVED);
        pnRedirect(pnModURL('pn_bbsmile', 'admin'));

    }
}

// This function shows the confitm dialog, where the user can synchronize
// the smilies stored in the filesystem with the smilies stored in the modVar.
function pn_bbsmile_admin_readsmilies() {

    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_PNBBSMILE_ADMIN_NOACCESS);;
    }

    if(!pnModAPILoad('pn_bbsmile', 'admin')) {
        return _FAILEDTOLOAD;
    }
    $submit = pnVarCleanFromInput('submit');

    if(!$submit) {

        $pnRender =& new pnRender('pn_bbsmile');
        $pnRender->caching = false;
        $pnRender->assign('imagepath_auto', pnModGetVar('pn_bbsmile', 'smiliepath_auto'));
        return $pnRender->fetch('pn_bbsmile_admin_readsmilies.html');

    } else { // submit is set

        // Update the Smilies
        $forcereload = pnVarCleanFromInput('forcereload');
        $forcereload = ($forcereload==1) ? true : false;
        // @see adminapi.php#pn_bbsmile_adminapi_updatesmilies()
        pnModAPIFunc('pn_bbsmile', 'admin', 'updatesmilies', array('forcereload' => $forcereload));

        pnSessionSetVar('statusmsg', _PNBBSMILE_ADMIN_SMILIESREADFROMFILESYSTEM);
        pnRedirect(pnModURL('pn_bbsmile', 'admin'));
        return true;

    }

}

// This function displays the list of all smilies out of the modVar for a edit view
function pn_bbsmile_admin_editsmilies() {

    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_PNBBSMILE_ADMIN_NOACCESS);;
    }

    $submit = pnVarCleanFromInput('submit');

    if(!$submit) {

        $pnr =& new pnRender('pn_bbsmile');
        $pnRender->caching = false;

        $imagepath = pnModGetVar('pn_bbsmile','smiliepath');
        $pnr->assign('imagepath',$imagepath);

        $imagepath_auto = pnModGetVar('pn_bbsmile','smiliepath_auto');
        $pnr->assign('imagepathauto',$imagepath_auto);

        $smilies = unserialize(pnModGetVar('pn_bbsmile','smilie_array'));
        $pnr->assign('smilies',$smilies);

        return $pnr->fetch('pn_bbsmile_admin_editsmiles.html');

    } else { // submit is set

        // Get input
        list($keys, $shorts, $imgsrcs, $alts, $aliases, $types, $active )
            = pnVarCleanFromInput('key', 'short', 'imgsrc', 'alt', 'alias', 'smilietype','active');

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

        pnModSetVar('pn_bbsmile','smilie_array',serialize($smilies));
        pnSessionSetVar('statusmsg', _PNBBSMILE_ADMIN_EDITEDSMILIESSAVED);
        pnRedirect(pnModURL('pn_bbsmile', 'admin'));
    }

}

?>