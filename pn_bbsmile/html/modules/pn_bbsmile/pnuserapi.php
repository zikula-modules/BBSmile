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

// the hook function
//
function pn_bbsmile_userapi_transform($args) {

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

// the wrapper for a string var (simple up to now)
//
function pn_bbsmile_transform($text) {

    $result = $text;

    $imagepath = pnModGetVar('pn_bbsmile', 'smiliepath');

    // make the smilies
    //
    $result = str_replace(':-)',        "<img src=\"$imagepath/icon_smile.gif\" alt=\":-)\" />",        $result);
    $result = str_replace(':cry:',      "<img src=\"$imagepath/icon_frown.gif\" alt=\":cry:\" />",        $result);
    $result = str_replace(':-(',        "<img src=\"$imagepath/icon_frown.gif\" alt=\":-(\" />",        $result);
    $result = str_replace(':-D',        "<img src=\"$imagepath/icon_biggrin.gif\" alt=\":-D\" />",        $result);
    $result = str_replace(';-)',        "<img src=\"$imagepath/icon_wink.gif\" alt=\";-)\" />",        $result);
    $result = str_replace(':wink:',     "<img src=\"$imagepath/icon_wink.gif\" alt=\":wink:\" />",        $result);
    $result = str_replace(':-o',        "<img src=\"$imagepath/icon_eek.gif\" alt=\":-o\" />",        $result);
    $result = str_replace(':-O',        "<img src=\"$imagepath/icon_eek.gif\" alt=\":-O\" />",        $result);
    $result = str_replace('8-)',        "<img src=\"$imagepath/icon_cool.gif\" alt=\"(-)\" />",        $result);
    $result = str_replace(':-?',        "<img src=\"$imagepath/icon_confused.gif\" alt=\":-?\" />",        $result);
    $result = str_replace(':lol:',      "<img src=\"$imagepath/icon_lol.gif\" alt=\":lol:\" />",        $result);
    $result = str_replace(':oops:',     "<img src=\"$imagepath/icon_redface.gif\" alt=\":oops:\" />",        $result);
    $result = str_replace(':-p',        "<img src=\"$imagepath/icon_razz.gif\" alt=\":-p\" />",        $result);
    $result = str_replace(':-P',        "<img src=\"$imagepath/icon_razz.gif\" alt=\":-P\" />",        $result);
    $result = str_replace(':roll:',     "<img src=\"$imagepath/icon_rolleyes.gif\" alt=\":roll:\" />",        $result);
    $result = str_replace(':-|',        "<img src=\"$imagepath/icon_mad.gif\" alt=\":-|\" />",        $result);
    $result = str_replace(':-x',         "<img src=\"$imagepath/icon_mad.gif\" alt=\":-x\" />",        $result);
    $result = str_replace(':evil:',     "<img src=\"$imagepath/icon26.gif\" alt=\":evil:\" />",        $result);
    $result = str_replace(':devil:',    "<img src=\"$imagepath/icon26.gif\" alt=\":devil:\" />",        $result);

    return $result;
}

?>
