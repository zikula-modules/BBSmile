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
// changed to pn_bbsmile: larsneo, pnRendered by landseer
// ----------------------------------------------------------------------


// show admin choices
//
function pn_bbsmile_admin_main() 
{
    if (!pnSecAuthAction(0, 'pn_bbsmile::', '::', ACCESS_ADMIN)) {
        return _PNBBSMILE_ADMIN_NOACCESS;
    }

    $submit = pnVarCleanFromInput('submit');
    if(!$submit) {   
        $pnr =& new pnRender('pn_bbsmile');
        $pnr->assign('imagepath', pnModGetVar('pn_bbsmile', 'smiliepath'));
        return $pnr->fetch('pn_bbsmile_admin_main.html');
    } else {
        $imagepath = pnVarCleanFromInput('imagepath');
        pnModSetVar('pn_bbsmile', 'smiliepath', $imagepath);
        pnSessionSetVar('statusmsg', pnVarPrepForDisplay(_PNBBSMILE_ADMIN_CONFIGSAVED));
        pnRedirect(pnModURL('pn_bbsmile', 'admin'));
    }
}

?>