<?php
// $Id: global.php 83 2007-08-22 19:19:55Z landseer $
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

// include smilie alternative text defines
Loader::includeOnce('modules/pn_bbsmile/pnlang/fra/smilies.php');

// new
define('_PNBBSMILE_NOAUTOSMILIES', 'Extended Smilies not yet activated!');

//
// A
//
define('_PNBBSMILE_ADMIN_BTN_SUBMIT', 'Appliquer');
define('_PNBBSMILE_ADMIN_CONFIGSAVED', 'La configuration de bbsmile a été mise à jour');
define('_PNBBSMILE_ADMIN_HINT_IMAGEPATH', 'Entrer le répertoire (relatif) où se trouvent les émoticons. Pas de slash terminal ni de backslash !');
define('_PNBBSMILE_ADMIN_LABEL_IMAGEPATH', 'Chemin vers les émoticons');
define('_PNBBSMILE_ADMIN_NOACCESS', 'Vous n\'avez pas accès à ce module');
define('_PNBBSMILE_ADMIN_TITLE', 'Administration de bbsmile ');
define('_PNBBSMILE_ADMIN_TITLE_CONFIG', 'Modifier la configuration');
define('_PNBBSMILE_ADMIN_V1_HINT', 'Notez que bbsmilies doit être activé pour être utilisé par un module spécifique par <a href="index.php?name=Modules&type=admin&func=view">administration -> modules</a>.');
define('_PNBBSMILE_ARGSERROR', '[pn_bbsmile] Erreur interne ! Argument manquant !');

//
// C
//
define('_PNBBSMILE_COULDNOTREGISTER', 'pn_bbsmile n\a pas été installé !');
define('_PNBBSMILE_COULDNOTUNREGISTER', 'pn_bbsmile n\'a pas été supprimé !');

