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

class BBSmile_Version extends Zikula_Version
{
	public function getMetaData()
	{
		$meta['oldnames']         = array('bbsmile');
		$meta['version']          = '3.0.0';
		$meta['id']               = '163';
		$meta['description']      = $this->__('Smilie Hook (Autoincluded)');
		$meta['displayname']      = $this->__('BBSmile Hook');
		$meta['url']              = $this->__('bbsmile');
		$meta['securityschema']   = array('bbsmile::' => '::');
		return $meta;
	}
}
