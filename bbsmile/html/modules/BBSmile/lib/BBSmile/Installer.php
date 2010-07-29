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

class BBSmile_Installer extends Zikula_Installer
{


	/**
	* init module
	*/
	public function install() {

	    // Set up module variables
	    //
	    // - where are the smilies stored
	    ModUtil::setVar('bbsmile', 'smiliepath',      'modules/Bbsmile/images/smilies');
	    ModUtil::setVar('bbsmile', 'activate_auto',   '0');
	    ModUtil::setVar('bbsmile', 'remove_inactive', '1');
	    ModUtil::setVar('bbsmile', 'smiliepath_auto', 'modules/Bbsmile/images/smilies_auto');

	    // Generate the smile array
	    ModUtil::apiFunc('bbsmile','admin','updatesmilies',array(), true);


	    // Set up module hooks
	    // transform hook
	    if (!ModUtil::registerHook('item',
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
	public function upgrade($oldversion)
	{
		switch($oldversion) {
		    case '1.13':
		    ModUtil::setVar('pn_bbsmile', 'smiliepath',       'modules/Bbsmile/images/smilies');
			ModUtil::setVar('pn_bbsmile', 'activate_auto',    '0');
		    ModUtil::setVar('pn_bbsmile', 'remove_inactive',  '1');
			ModUtil::setVar('pn_bbsmile', 'smiliepath_auto',  'modules/Bbsmile/images/smilies_auto');
			ModUtil::apiFunc('pn_bbsmile','admin','updatesmilies',array());
		case '1.14':
		    // display hook
		    if (!ModUtil::registerHook('item',
					  'display',
					  'GUI',
					  'pn_bbsmile',
					  'user',
					  'smilies')) {
			return LogUtil::registerError(_BBSMILE_COULDNOTREGISTER . ' (display hook)');
		    }
		    ModUtil::setVar('pn_bbsmile', 'displayhook', '1');
		case '1.15':
		    if (!ModUtil::unregisterHook('item',
					    'display',
					    'GUI',
					    'pn_bbsmile',
					    'user',
					    'smilies')) {
			LogUtil::registerError(_BBSMILE_COULDNOTUNREGISTER . ' (display hook)');
			return '1.15';
		    }
		    ModUtil::delVar('pn_bbsmile', 'displayhook');
		case '1.17':
		case '1.18':
		    // .8 only version
		case '2.0':

		    ModUtil::setVar('bbsmile', 'smiliepath', str_replace('pn_bbsmile', 'bbsmile', ModUtil::getVar('pn_bbsmile', 'smiliepath')));
		    ModUtil::setVar('bbsmile', 'smiliepath_auto', str_replace('pn_bbsmile', 'bbsmile', ModUtil::getVar('pn_bbsmile', 'smiliepath_auto')));
		    ModUtil::setVar('bbsmile', 'activate_auto', ModUtil::getVar('pn_bbsmile', 'activate_auto'));
		    ModUtil::setVar('bbsmile', 'remove_inactive', ModUtil::getVar('pn_bbsmile', 'remove_inactive'));
		    $smilie_array = ModUtil::getVar('pn_bbsmile', 'smilie_array');
		    if(@unserialize($smilie_array)!=='') {
			$smilie_array = unserialize($smilie_array);
		    }
		    ModUtil::setVar('bbsmile', 'smilie_array', $smilie_array);

		    ModUtil::delVar('pn_bbsmile');

			// update hooks
			$tables = DBUtil::getTables();
			$hookstable  = $tables['hooks'];
			$hookscolumn = $tables['hooks_column'];
			$sql = 'UPDATE ' . $hookstable . ' SET ' . $hookscolumn['smodule'] . '=\'bbsmile\' WHERE ' . $hookscolumn['smodule'] . '=\'pn_bbsmile\'';
			$res = DBUtil::executeSQL ($sql);
			if ($res === false) {
				LogUtil::registerError(_BBSMILE_FAILEDTOUPGRADEHOOK . ' (smodule)');
				return '2.0';
			}

			$sql = 'UPDATE ' . $hookstable . ' SET ' . $hookscolumn['tmodule'] . '=\'bbsmile\' WHERE ' . $hookscolumn['tmodule'] . '=\'pn_bbsmile\'';
			$res   = DBUtil::executeSQL ($sql);
			if ($res === false) {
				LogUtil::registerError(_BBSMILE_FAILEDTOUPGRADEHOOK . ' (tmodule)');
				return '2.0';
			}

		default:
		    break;
	    }
	    return true;
	}

	/**
	* delete module
	*/
	public function uninstall() {

	    // Remove module hooks
	    if (!ModUtil::unregisterHook('item',
				    'transform',
				    'API',
				    'bbsmile',
				    'user',
				    'transform')) {
		return LogUtil::registerError(_BBSMILE_COULDNOTUNREGISTER . ' (transform hook)');
	    }

	    // Remove module variables
	    ModUtil::delVar('bbsmile');

	    // Deletion successful
	    return true;
	}
}
