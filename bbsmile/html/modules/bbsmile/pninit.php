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
 * init module
*/
function pn_bbsmile_init() {

    // Set up module variables
    //
    // - where are the smilies stored
    pnModSetVar('pn_bbsmile', 'smiliepath',      'modules/pn_bbsmile/pnimages/smilies');
    pnModSetVar('pn_bbsmile', 'activate_auto',   '0');
    pnModSetVar('pn_bbsmile', 'remove_inactive', '1');
    pnModSetVar('pn_bbsmile', 'smiliepath_auto', 'modules/pn_bbsmile/pnimages/smilies_auto');

    // Generate the smile array
    pnModAPIFunc('pn_bbsmile','admin','updatesmilies',array(), true);


    // Set up module hooks
    // transform hook
    if (!pnModRegisterHook('item',
                           'transform',
                           'API',
                           'pn_bbsmile',
                           'user',
                           'transform')) {
        return LogUtil::registerError(_PNBBSMILE_COULDNOTREGISTER . ' (transform hook)');
    }
    // Initialisation successful
    return true;
}

/**
 * upgrade module
*/
function pn_bbsmile_upgrade($oldversion)
{
	switch($oldversion) {
	    case '1.13':
            pnModSetVar('pn_bbsmile', 'smiliepath',       'modules/pn_bbsmile/pnimages/smilies');
	        pnModSetVar('pn_bbsmile', 'activate_auto',    '0');
            pnModSetVar('pn_bbsmile', 'remove_inactive',  '1');
	        pnModSetVar('pn_bbsmile', 'smiliepath_auto',  'modules/pn_bbsmile/pnimages/smilies_auto');
	        pnModAPIFunc('pn_bbsmile','admin','updatesmilies',array());
        case '1.14':
            // display hook
            if (!pnModRegisterHook('item',
                                   'display',
                                   'GUI',
                                   'pn_bbsmile',
                                   'user',
                                   'smilies')) {
                return LogUtil::registerError(_PNBBSMILE_COULDNOTREGISTER . ' (display hook)');
            }
            pnModSetVar('pn_bbsmile', 'displayhook', '1');
        case '1.15':
            if (!pnModUnregisterHook('item',
                                     'display',
                                     'GUI',
                                     'pn_bbsmile',
                                     'user',
                                     'smilies')) {
                return LogUtil::registerError(_PNBBSMILE_COULDNOTUNREGISTER . ' (display hook)');
            }
            pnModDelVar('pn_bbsmile', 'displayhook');
        case '2.0':
            // .8 only version
        default:
            break;
    }
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
        return LogUtil::registerError(_PNBBSMILE_COULDNOTUNREGISTER . ' (transform hook)');
    }

    // Remove module variables
    pnModDelVar('pn_bbsmile');

    // Deletion successful
    return true;
}
