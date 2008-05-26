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
// changed to bbsmile: larsneo
// ----------------------------------------------------------------------

// include smilie alternative text defines
Loader::includeOnce('modules/bbsmile/pnlang/eng/smilies.php');

//
// A
//
define('_BBSMILE_ADDHOOK', 'Activate bbsmile for more modules');
define('_BBSMILE_ADMIN_BTN_CANCEL', 'Cancel');
define('_BBSMILE_ADMIN_BTN_SUBMIT', 'Apply');
define('_BBSMILE_ADMIN_CONFIGSAVED', 'bbsmile configuration updated');
define('_BBSMILE_ADMIN_CONFIRM_READFROMFILESYSTEM', 'Should the smilies be read out of the directory?');
define('_BBSMILE_ADMIN_EDITEDSMILIESSAVED', 'The edited smilies have been saved.');
define('_BBSMILE_ADMIN_HINT_IMAGEPATH', 'Enter the directory (relative), where the smilies are.No trailing slash and no backslashes!');
define('_BBSMILE_ADMIN_HINT_IMAGEPATH_AUTO', 'Enter the directory (relative), where the smilies are, which are included automatically. All files with the ending gif, jpg, jpeg or png are included out of this directory. No trailing slash and no backslashes!');
define('_BBSMILE_ADMIN_LABEL_ACTIVATE_AUTO', 'Activate auto smilies');
define('_BBSMILE_ADMIN_LABEL_IMAGEPATH', 'Path to the smilies');
define('_BBSMILE_ADMIN_LABEL_IMAGEPATH_AUTO', 'Path to the automatically included smilies');
define('_BBSMILE_ADMIN_LABEL_READFROMFILESYSTEM', 'With confirmation all smilies out of the directory are read. Smilies without a image in the directory will be deleted. Changes on smilie information will be kept.');
define('_BBSMILE_ADMIN_LABEL_READSMILIESFROMFILESYSTEM', 'Read smilies from filesystem');
define('_BBSMILE_ADMIN_LABEL_REMOVE_INACTIVE', 'Remove inactive smilie shortcuts');
define('_BBSMILE_ADMIN_LABEL_SMILIETABLE', 'Currently defined Smilies');
define('_BBSMILE_ADMIN_NOACCESS', 'You do not have access to this module');
define('_BBSMILE_ADMIN_SMILIESREADFROMFILESYSTEM', 'Smilies have been read from filesystem sucsessfully.');
define('_BBSMILE_ADMIN_SMILIETABLE_ACTIVE', 'Active');
define('_BBSMILE_ADMIN_SMILIETABLE_ALIAS', 'Aliases for this smilie');
define('_BBSMILE_ADMIN_SMILIETABLE_ALIAS_HINT', 'Aliases are seperated by ",". Don\'t uses spaces.');
define('_BBSMILE_ADMIN_SMILIETABLE_ALT', 'alternative text');
define('_BBSMILE_ADMIN_SMILIETABLE_FILENAME', 'Filename');
define('_BBSMILE_ADMIN_SMILIETABLE_SHORT', 'Shortcut/Trigger');
define('_BBSMILE_ADMIN_SMILIETABLE_SMILIE', 'Smilie');
define('_BBSMILE_ADMIN_START', 'Start');
define('_BBSMILE_ADMIN_TITLE', 'bbsmile Administration');
define('_BBSMILE_ADMIN_TITLE_CONFIG', 'Modify Configuration');
define('_BBSMILE_ADMIN_TITLE_EDITSMILIES', 'Edit the defined smilies');
define('_BBSMILE_ADMIN_TITLE_READSMILIESFROMFILESYSTEM', 'Read smilies out of the directory');
define('_BBSMILE_ARGSERROR', '[bbsmile] Internal error! Arguments missing!');

//
// C
//
define('_BBSMILE_CLICKOUTSIDETOCLOSE', 'Click outside this window to close it');
define('_BBSMILE_COULDNOTREGISTER', 'bbsmile was NOT installed!');
define('_BBSMILE_COULDNOTUNREGISTER', 'bbsmile was NOT removed!');

//
// F
//
define('_BBSMILE_FORCERELOAD', 'Force reload of smilies, all data will be overwritten!');

//
// G
//
define('_BBSMILE_GOTOHOMEPAGE', 'visit the bbsmile-project');

//
// I
//
define('_BBSMILE_ILLEGALSMILIEPATH', 'The path does not exists or the system cannot read it.');
define('_BBSMILE_ISHOOKEDWITH', 'Actually bbsmile is used with the following modules');

//
// M
//
define('_BBSMILE_MORESMILIES', 'More Smilies');

//
// N
//
define('_BBSMILE_NOAUTOSMILIES', 'Extended Smilies not yet activated!');
define('_BBSMILE_NOSCRIPTWARNING', 'Your browser does not support javascript or you turned it off. The bbsmile interface has been disabled.');
define('_BBSMILE_NOTHOOKED', '** bbsmile is not used with any module **');

//
// S
//
define('_BBSMILE_SHOWHIDE_SMILIES', 'show/hide smilies');
