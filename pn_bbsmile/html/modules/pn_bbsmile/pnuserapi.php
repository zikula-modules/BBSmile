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

/*
 * main transformation function
 */
function pn_bbsmile_transform($text)
{
    $smilies = unserialize(pnModGetVar('pn_bbsmile','smilie_array'));
    $remove_inactive = pnModGetVar('pn_bbsmile', 'remove_inactive');

    if(is_array($smilies) && count($smilies)>0) {
        $imagepath = pnModGetVar('pn_bbsmile', 'smiliepath');
        $imagepath_auto = pnModGetVar('pn_bbsmile', 'smiliepath_auto');
        $auto_active = pnModGetVar('pn_bbsmile','activate_auto');
    	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	    // This is important!<p align="center"></p>
    	$text = ' ' . $text;
        foreach ($smilies as $smilie) {
            // check if smilie is active
	        if ($smilie['active'] == 1) {
                // check if alt is a define
                $smilie['alt'] = (defined($smilie['alt'])) ? constant($smilie['alt']) : $smilie['alt'];

                if($smilie['type'] == 0) {
                    $text = str_replace($smilie['short'], ' <img src="' . $imagepath . '/' . $smilie['imgsrc'] . '" alt="' . $smilie['alt'] . '" /> ', $text);
                } else {
                    if($auto_active == 1) {
                        $text = str_replace($smilie['short'], ' <img src="' . $imagepath_auto . '/' . $smilie['imgsrc'] . '" alt="' . $smilie['alt'] . '" /> ', $text);
                    }
                }

                if(!empty($smilie['alias'])) {
                    $aliases = explode(",", trim($smilie['alias']));
                    if(is_array($aliases) && count($aliases)>0) {
                        foreach($aliases as $alias) {
                            if($smilie['type'] == 0) {
                                $text = str_replace($alias, ' <img src="' . $imagepath . '/' . $smilie['imgsrc'] . '" alt="' . $smilie['alt'] . '" /> ', $text);
                            } else {
                                if($auto_active == 1) {
                                    $text = str_replace($alias, ' <img src="' . $imagepath_auto . '/' . $smilie['imgsrc'] . '" alt="' . $smilie['alt'] . '" /> ', $text);
                                }
                            }
                        }
                    }
                }
            } else {// End of if smilie is active
                $text = str_replace($smilie['short'], '', $text);
            }
        }  // foreach
    	// Remove our padding from the string..
	    $text = substr($text, 1);
    } // End of if smilies is array and not empty
    return $text;
}

/**
 * get all old smilies- only needed by Messages module right now
 */
function pn_bbsmile_userapi_getall()
{
	$handle=opendir('images/smilies');
	while ($file = readdir($handle)) {
		$filelist[] = $file;
	}
	asort($filelist);
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