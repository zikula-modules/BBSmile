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
    $result = str_replace(':-)',        "<img src=\"$imagepath/icon_smile.gif\" border=\"0\" alt=\":-)\" />",        $result);
    $result = str_replace(':cry:',      "<img src=\"$imagepath/icon_frown.gif\" border=\"0\" alt=\":cry:\" />",        $result);
    $result = str_replace(':-(',        "<img src=\"$imagepath/icon_frown.gif\" border=\"0\" alt=\":-(\" />",        $result);
    $result = str_replace(':-D',        "<img src=\"$imagepath/icon_biggrin.gif\" border=\"0\" alt=\":-D\" />",        $result);
    $result = str_replace(';-)',        "<img src=\"$imagepath/icon_wink.gif\" border=\"0\" alt=\";-)\" />",        $result);
    $result = str_replace(':wink:',     "<img src=\"$imagepath/icon_wink.gif\" border=\"0\" alt=\":wink:\" />",        $result);
    $result = str_replace(':-o',        "<img src=\"$imagepath/icon_eek.gif\" border=\"0\" alt=\":-o\" />",        $result);
    $result = str_replace(':-O',        "<img src=\"$imagepath/icon_eek.gif\" border=\"0\" alt=\":-O\" />",        $result);
    $result = str_replace('8-)',        "<img src=\"$imagepath/icon_cool.gif\" border=\"0\" alt=\"(-)\" />",        $result);
    $result = str_replace(':-?',        "<img src=\"$imagepath/icon_confused.gif\" border=\"0\" alt=\":-?\" />",        $result);
    $result = str_replace(':lol:',      "<img src=\"$imagepath/icon_lol.gif\" border=\"0\" alt=\":lol:\" />",        $result);
    $result = str_replace(':oops:',     "<img src=\"$imagepath/icon_redface.gif\" border=\"0\" alt=\":oops:\" />",        $result);
    $result = str_replace(':-p',        "<img src=\"$imagepath/icon_razz.gif\" border=\"0\" alt=\":-p\" />",        $result);
    $result = str_replace(':-P',        "<img src=\"$imagepath/icon_razz.gif\" border=\"0\" alt=\":-P\" />",        $result);
    $result = str_replace(':roll:',     "<img src=\"$imagepath/icon_rolleyes.gif\" border=\"0\" alt=\":roll:\" />",        $result);
    $result = str_replace(':-|',        "<img src=\"$imagepath/icon_mad.gif\" border=\"0\" alt=\":-|\" />",        $result);
    $result = str_replace(':-x',         "<img src=\"$imagepath/icon_mad.gif\" border=\"0\" alt=\":-x\" />",        $result);
    $result = str_replace(':evil:',     "<img src=\"$imagepath/icon26.gif\" border=\"0\" alt=\":evil:\" />",        $result);
    $result = str_replace(':devil:',    "<img src=\"$imagepath/icon26.gif\" border=\"0\" alt=\":devil:\" />",        $result);

    return $result;
}

?>
