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

// include smilie alternative text defines
@include_once('modules/pn_bbsmile/pnlang/deu/smilies.php');

//
// A
//
define('_PNBBSMILE_ADMIN_BTN_CANCEL', 'Abbrechen');
define('_PNBBSMILE_ADMIN_BTN_SUBMIT', 'Übertragen');
define('_PNBBSMILE_ADMIN_CONFIGSAVED', 'pn_bbsmile Konfiguration geändert');
define('_PNBBSMILE_ADMIN_CONFIRM_READFROMFILESYSTEM', 'Sollen die Smilies jetzt aktualisiert werden?');
define('_PNBBSMILE_ADMIN_EDITEDSMILIESSAVED', 'Die editierten Smilies wurden gespeichert');
define('_PNBBSMILE_ADMIN_HINT_IMAGEPATH', 'Verzeichnis (relativ), das die Smiliegrafiken enthält. Ohne / am Ende und ohne Backslashes!');
define('_PNBBSMILE_ADMIN_HINT_IMAGEPATH_AUTO', 'Verzeichnis (relativ), das die automatisch eingebundenen Smiliegrafiken enthält. Alle Dateien, die die Endung gif,jpg,jpeg oder png haben, werden aus diesem verzeichnis automatisch hinzugefügt. Ohne / am Ende und ohne Backslashes!');
define('_PNBBSMILE_ADMIN_LABEL_ACTIVATE_AUTO', 'Soll das automatische Einbinden für Smilies aktiviert werden?');
define('_PNBBSMILE_ADMIN_LABEL_IMAGEPATH', 'Pfad zu den Smiliegrafiken');
define('_PNBBSMILE_ADMIN_LABEL_IMAGEPATH_AUTO', 'Pfad zu den automatisch eingebundenen Smiliegrafiken');
define('_PNBBSMILE_ADMIN_LABEL_READFROMFILESYSTEM', 'Mit dem Bestätigen werden alle Smilies aus dem unten genannten Verzeichnis eingelesen. Smilies, deren Bilder aus dem Verzeichnis gelöscht wurden, werden ebenfalls gelöscht. Änderung von schon bestehenden Smilies bleiben erhalten.');
define('_PNBBSMILE_ADMIN_LABEL_READSMILIESFROMFILESYSTEM', 'Lese Smilies vom Filesystem');
define('_PNBBSMILE_ADMIN_LABEL_REMOVE_INACTIVE', 'Inaktive Smiliekürzel entfernen');
define('_PNBBSMILE_ADMIN_LABEL_SMILIETABLE', 'Momentan definierten Smilies');
define('_PNBBSMILE_ADMIN_NOACCESS', 'Keine Berechtigung für dieses Modul');
define('_PNBBSMILE_ADMIN_SMILIESREADFROMFILESYSTEM', 'Smilies wurden neu eingelesen');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ACTIVE', 'Aktiv');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALIAS', 'Aliase zu dem Smilie');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALIAS_HINT', 'Aliase können mit "," getrennt werden. Allerdings OHNE Leerstellen.');
define('_PNBBSMILE_ADMIN_SMILIETABLE_ALT', 'Alternativtext');
define('_PNBBSMILE_ADMIN_SMILIETABLE_FILENAME', 'Dateiname');
define('_PNBBSMILE_ADMIN_SMILIETABLE_SHORT', 'Abkürzung/Trigger');
define('_PNBBSMILE_ADMIN_SMILIETABLE_SMILIE', 'Smilie');
define('_PNBBSMILE_ADMIN_TITLE', 'pn_bbsmile Administration');
define('_PNBBSMILE_ADMIN_TITLE_CONFIG', 'Konfiguration ändern');
define('_PNBBSMILE_ADMIN_TITLE_EDITSMILIES', 'Editiere die aktuell definierten Smilies');
define('_PNBBSMILE_ADMIN_TITLE_READSMILIESFROMFILESYSTEM', 'Lese Smilies aus dem Ordner neu ein');
define('_PNBBSMILE_ADMIN_V1_HINT', 'Bitte beachten: Der Smilie Hook muss für die Module, in denen die Funktion genutzt werden soll, in Administration->Module aktiviert werden.');
define('_PNBBSMILE_ARGSERROR', '[pn_bbsmile] Interner Fehler! Parameter fehlen!');

//
// C
//
define('_PNBBSMILE_COULDNOTREGISTER', 'pn_bbsmile NICHT installiert!');
define('_PNBBSMILE_COULDNOTUNREGISTER', 'pn_bbsmile NICHT entfernt!');

//
// F
//
define('_PNBBSMILE_FORCERELOAD', 'Neuladen erzwingen, alle Smilieeinstellungen werden überschrieben!');

//
// M
//
define('_PNBBSMILE_MORESMILIES', 'Weitere Smilies');

//
// N
//
define('_PNBBSMILE_NOSCRIPTWARNING', 'Ihr Browser unterstützt kein Javascript oder Javascript ist deaktiviert. Einige Features dieser Seite werden daher nicht funktionieren.');

//
// S
//
define('_PNBBSMILE_SHOWHIDE_SMILIES', 'Smilies ein-/ausblenden');

?>