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
 * the hook function
*/
function pn_bbsmile_userapi_transform($args) 
{
    extract($args);

    // Argument check
    if ((!isset($objectid)) ||
        (!isset($extrainfo))) {
        pnSessionSetVar('errormsg', _PNBBSMILE_ARGSERROR);
        return;
    }

    if (is_array($extrainfo)) {
        foreach ($extrainfo as $text) {
            $result[] = pn_bbsmile_transform($text);
        }
    } else {
        $result = pn_bbsmile_transform($text);
    }

    return $result;
}

/**
 * the wrapper for a string var (simple up to now)
*/
function pn_bbsmile_transform($text) 
{
    $result = $text;

    $imagepath = pnModGetVar('pn_bbsmile', 'smiliepath');

    // make the smilies
    //
    $result = str_replace(':-)',        "<img src=\"$imagepath/icon_smile.gif\" alt=\"Smilie\" />",        $result);
    $result = str_replace(':cry:',      "<img src=\"$imagepath/icon_frown.gif\" alt=\"Smilie\" />",      $result);
    $result = str_replace(':-(',        "<img src=\"$imagepath/icon_frown.gif\" alt=\"Smilie\" />",        $result);
    $result = str_replace(':-D',        "<img src=\"$imagepath/icon_biggrin.gif\" alt=\"Smilie\" />",      $result);
    $result = str_replace(';-)',        "<img src=\"$imagepath/icon_wink.gif\" alt=\"Smilie\" />",         $result);
    $result = str_replace(':wink:',     "<img src=\"$imagepath/icon_wink.gif\" alt=\"Smilie\" />",      $result);
    $result = str_replace(':-o',        "<img src=\"$imagepath/icon_eek.gif\" alt=\"Smilie\" />",          $result);
    $result = str_replace(':-O',        "<img src=\"$imagepath/icon_eek.gif\" alt=\"Smilie\" />",          $result);
    $result = str_replace('8-)',        "<img src=\"$imagepath/icon_cool.gif\" alt=\"Smilie\" />",         $result);
    $result = str_replace(':-?',        "<img src=\"$imagepath/icon_confused.gif\" alt=\"Smilie\" />",     $result);
    $result = str_replace(':lol:',      "<img src=\"$imagepath/icon_lol.gif\" alt=\"Smilie\" />",        $result);
    $result = str_replace(':oops:',     "<img src=\"$imagepath/icon_redface.gif\" alt=\"Smilie\" />",   $result);
    $result = str_replace(':-p',        "<img src=\"$imagepath/icon_razz.gif\" alt=\"Smilie\" />",         $result);
    $result = str_replace(':-P',        "<img src=\"$imagepath/icon_razz.gif\" alt=\"Smilie\" />",         $result);
    $result = str_replace(':roll:',     "<img src=\"$imagepath/icon_rolleyes.gif\" alt=\"Smilie\" />",  $result);
    $result = str_replace(':-|',        "<img src=\"$imagepath/icon_mad.gif\" alt=\"Smilie\" />",          $result);
    $result = str_replace(':-x',        "<img src=\"$imagepath/icon_mad.gif\" alt=\"Smilie\" />",          $result);
    $result = str_replace(':evil:',     "<img src=\"$imagepath/icon26.gif\" alt=\"Smilie\" />",         $result);
    $result = str_replace(':devil:',    "<img src=\"$imagepath/icon26.gif\" alt=\"Smilie\" />",        $result);

    return $result;
}

/**
 * get all smilies
 */
function pn_bbsmile_userapi_getall() 
{
	$handle=opendir(pnModGetVar('pn_bbsmile', 'smiliepath'));
	while ($file = readdir($handle)) {
		$filelist[] = $file;
	}
	asort($filelist);
	$a = 1;
	$count = 1;
	$icons = array();
	while (list ($key, $file) = each ($filelist)) {
		ereg('.gif|.jpg',$file);
		if ($file != '.' && $file != '..' && $file != 'index.html'  && $file != 'CVS') {
			$icons[] = array('imgsrc' => $file);
		}

	}
	return $icons;
}

?>