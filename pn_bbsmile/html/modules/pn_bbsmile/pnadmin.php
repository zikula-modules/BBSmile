<?php
// ----------------------------------------------------------------------
// POST-NUKE Content Management System
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
// but WIthOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Hinrich Donner
// changed to pn_bbsmile: larsneo
// ----------------------------------------------------------------------


// show admin choices
//
function pn_bbsmile_admin_main() {

    // get an authkey and the current settings
    //
    $authid     = pnSecGenAuthKey();
    $imagepath  = pnModGetVar('pn_bbsmile', 'smiliepath');

    // make an output
    //
    $result = "<align=\"center\" class=\"pn-normal\">"._PNBBSMILE_ADMIN_TITLE."\n"
        ."<align=\"center\" class=\"pn-normal\">"._PNBBSMILE_ADMIN_TITLE_CONFIG."\n";

    // How about some securety?
    //
    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        $result .= "<p class=\"pn-normal\">"._PNBBSMILE_ADMIN_NOACCESS."</p>\n";
        return $result;
    }

    // do we have an status message pending?
    //
    $status = pnGetStatusMsg();
    if (!empty($status)) {
        $result .= "<p class=\"pn-normal\"><hr noshade />".pnVarPrepForDisplay($status)."<hr noshade /></p>\n";
    }

    // show the little form
    //
    $result .= "<p class=\"pn-normal\">"._PNBBSMILE_ADMIN_V1_HINT."</p>\n"
        ."<p class=\"pn-normal\">"
        ."<form action=\"".pnModURL(pnModGetName(), 'admin', 'setconfig')."\" method=\"post\">\n"
        ."<input type=\"hidden\" name=\"authid\" value=\"$authid\">\n"
        ._PNBBSMILE_ADMIN_LABEL_IMAGEPATH.": "
        ."<input type=\"text\" name=\"imagepath\" value=\"".pnVarPrepForDisplay($imagepath)."\" size=\"40\" maxlength=\"255\"><br />\n"
        ."<font class=\"pn-sub\">"._PNBBSMILE_ADMIN_HINT_IMAGEPATH."<br /><br />\n"
        ."<input type=\"submit\" value=\""._PNBBSMILE_ADMIN_BTN_SUBMIT."\"></form></p>\n";

    // that's all folks
    //
    return $result;
}

// do save the changes
//
function pn_bbsmile_admin_setconfig() {

    // check auth
    //
    if (!pnSecConfirmAuthKey()) {
        pnSessionSetVar('errormsg', _BADAUTHKEY);
        pnRedirect(pnModURL(pnModGetName(), 'admin'));
        return true;
    }

    // save var
    //
    $imagepath = pnVarCleanFromInput('imagepath');
    pnModSetVar('pn_bbsmile', 'smiliepath', $imagepath);
    pnSessionSetVar('statusmsg', _PNBBSMILE_ADMIN_CONFIGSAVED);
    pnRedirect(pnModURL(pnModGetName(), 'admin'));
}


?>
