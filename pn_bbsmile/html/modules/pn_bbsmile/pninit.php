<?php
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
 * init module
*/
function pn_bbsmile_init() {

    // Set up module variables
    //
    // - where are the smilies stored
    pnModSetVar('pn_bbsmile', 'smiliepath',    'images/smilies');

    // Set up module hooks
    if (!pnModRegisterHook('item',
                           'transform',
                           'API',
                           'pn_bbsmile',
                           'user',
                           'transform')) {
        pnSessionSetVar('errormsg', _PNBBSMILE_COULDNOTREGISTER);
        return false;
    }

    // Initialisation successful
    return true;
}

/**
 * upgrade module
*/
function pn_bbsmile_upgrade($oldversion) {

    return true;
}

/**
 * delete module
*/
function pn_bbsmile_delete() {

    // Remove module hooks
    if (!pnModUnregisterHook('item',
                             'transform',
                             'API',
                             'pn_bbsmile',
                             'user',
                             'transform')) {
        pnSessionSetVar('errormsg', _PNBBSMILE_COULDNOTUNREGISTER);
        return false;
    }

    // Remove module variables
    pnModDelVar('pn_bbsmile', 'smiliepath');

    // Deletion successful
    return true;
}

?>