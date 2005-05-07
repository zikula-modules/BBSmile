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

define('_PNBBSMILE_FORCERELOAD',               'Force reload of smilies, all data will be overwritten!');
define('_PNBBSMILE_ADMIN_BTN_SUBMIT',          'Apply');
define('_PNBBSMILE_ADMIN_BTN_CANCEL',          'Cancel');
define('_PNBBSMILE_ADMIN_CONFIGSAVED',         'bbsmile configuration updated');
define('_PNBBSMILE_ADMIN_HINT_IMAGEPATH',      'Enter the directory (relative), where the smilies are.No trailing slash and no backslashes!');
define('_PNBBSMILE_ADMIN_LABEL_IMAGEPATH',     'Path to the smilies');
define('_PNBBSMILE_ADMIN_NOACCESS',            'You do not have access to this module');
define('_PNBBSMILE_ADMIN_TITLE',               'BBsmile Administration');
define('_PNBBSMILE_ADMIN_TITLE_CONFIG',        'Modify Configuration');
define('_PNBBSMILE_ADMIN_V1_HINT',             'Please note that the smilie hook function need to be activated for the specific module within administration -> modules.');

define('_PNBBSMILE_ADMIN_HINT_IMAGEPATH_AUTO', 'Enter the directory (relative), where the smilies are, which are included automatically. All files with the ending gif, jpg, jpeg or png are included out of this directory. No trailing slash and no backslashes!');
define('_PNBBSMILE_ADMIN_LABEL_IMAGEPATH_AUTO','Path to the automatically included smilies');

define('_PNBBSMILE_ADMIN_LABEL_ACTIVATE_AUTO','Should the auto include of smilies be activated?');

define('_PNBBSMILE_ADMIN_LABEL_SMILIETABLE','Currently defined Smilies');
define('_PNBBSMILE_ADMIN_SMILIETABLE_SMILIE','Smilie');
define('_PNBBSMILE_ADMIN_SMILIETABLE_SHORT','Shortcut/Trigger');
define('_PNBBSMILE_ADMIN_SMILIETABLE_FILENAME','filename');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALT','alterbative text');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALIAS','Aliases for this smilie');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALIAS_HINT','Aliase are seperted by ",". Don\'t uses spaces.');
define('_PNBBSMILE_ADMIN_TITLE_EDITSMILIES','Edit the defined smilies');
define('_PNBBSMILE_ADMIN_EDITEDSMILIESSAVED','The edited smilies has been saved.');

define('_PNBBSMILE_ADMIN_TITLE_READSMILIESFROMFILESYSTEM','Read smilies out of the directory');
define('_PNBBSMILE_ADMIN_LABEL_READFROMFILESYSTEM','With confirmation all smilies out of the directory are read. Smilies without a image in the directory will be deleted. Changes on smilie information will be kept.');
define('_PNBBSMILE_ADMIN_CONFIRM_READFROMFILESYSTEM','Should the smilies be read out of the directory?');
define('_PNBBSMILE_ADMIN_SMILIESREADFROMFILESYSTEM','Smilies has been read out sucsessfully.');
define('_PNBBSMILE_ADMIN_LABEL_READSMILIESFROMFILESYSTEM','Read smilies from filesystem');


?>