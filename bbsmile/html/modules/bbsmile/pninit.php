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
// changed to bbsmile: larsneo
// ----------------------------------------------------------------------

/**
 * @package Zikula_Utility_Modules
 * @subpackage bbsmile
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * init module
*/
function bbsmile_init() {

    // Set up module variables
    //
    // - where are the smilies stored
    pnModSetVar('bbsmile', 'smiliepath',      'modules/bbsmile/pnimages/smilies');
    pnModSetVar('bbsmile', 'activate_auto',   '0');
    pnModSetVar('bbsmile', 'remove_inactive', '1');
    pnModSetVar('bbsmile', 'smiliepath_auto', 'modules/bbsmile/pnimages/smilies_auto');

    // Generate the smile array
    pnModAPIFunc('bbsmile','admin','updatesmilies',array(), true);


    // Set up module hooks
    // transform hook
    if (!pnModRegisterHook('item',
                           'transform',
                           'API',
                           'bbsmile',
                           'user',
                           'transform')) {
        return LogUtil::registerError(_BBSMILE_COULDNOTREGISTER . ' (transform hook)');
    }
    // Initialisation successful
    return true;
}

/**
 * upgrade module
*/
function bbsmile_upgrade($oldversion)
{
	switch($oldversion) {
	    case '1.13':
            pnModSetVar('pn_bbsmile', 'smiliepath',       'modules/bbsmile/pnimages/smilies');
	        pnModSetVar('pn_bbsmile', 'activate_auto',    '0');
            pnModSetVar('pn_bbsmile', 'remove_inactive',  '1');
	        pnModSetVar('pn_bbsmile', 'smiliepath_auto',  'modules/bbsmile/pnimages/smilies_auto');
	        pnModAPIFunc('pn_bbsmile','admin','updatesmilies',array());
        case '1.14':
            // display hook
            if (!pnModRegisterHook('item',
                                   'display',
                                   'GUI',
                                   'pn_bbsmile',
                                   'user',
                                   'smilies')) {
                return LogUtil::registerError(_BBSMILE_COULDNOTREGISTER . ' (display hook)');
            }
            pnModSetVar('pn_bbsmile', 'displayhook', '1');
        case '1.15':
            if (!pnModUnregisterHook('item',
                                     'display',
                                     'GUI',
                                     'pn_bbsmile',
                                     'user',
                                     'smilies')) {
                return LogUtil::registerError(_BBSMILE_COULDNOTUNREGISTER . ' (display hook)');
            }
            pnModDelVar('pn_bbsmile', 'displayhook');
        case '1.22':
            // .8 only version
        case '2.0':
            $oldvars = pnModGetVar('pn_bbsmile');
            foreach ($oldvars as $varname => $oldvar) {
                pnModSetVar('bbsmile', $varname, $oldvar);
            }
            pnModDelVar('pn_bbsmile');

            // get list of hooked modules
            $hookedmods = pnModAPIFunc('modules', 'admin', 'gethookedmodules', array('hookmodname' => 'pn_bbcode'));
            
            // remove hook
            if (!pnModUnregisterHook('item',
                                     'transform',
                                     'API',
                                     'pn_bbsmile',
                                     'user',
                                     'transform')) {
                return LogUtil::registerError(_BBSMILE_COULDNOTUNREGISTER . ' (transform hook)');
            } 
            // add hook
            if (!pnModRegisterHook('item',
                                   'transform',
                                   'API',
                                   'bbsmile',
                                   'user',
                                   'transform')) {
                return LogUtil::registerError(_BBSMILE_COULDNOTREGISTER . ' (transform hook)');
            }
            
            // attach bbcode to previous hooked modules
            foreach ($hookedmods as $hookedmod => $dummy) {
                pnModAPIFunc('modules' ,'admin', 'enablehooks', 
                             array('callermodname' => $hookedmod,
                                   'hookmodname'   => 'bbsmile'));
            }
        default:
            break;
    }
    return true;
}

/**
 * delete module
*/
function bbsmile_delete() {

    // Remove module hooks
    if (!pnModUnregisterHook('item',
                             'transform',
                             'API',
                             'bbsmile',
                             'user',
                             'transform')) {
        return LogUtil::registerError(_BBSMILE_COULDNOTUNREGISTER . ' (transform hook)');
    }

    // Remove module variables
    pnModDelVar('bbsmile');

    // Deletion successful
    return true;
}
