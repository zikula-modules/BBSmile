<?php

/**
 * BBSmile
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBSmile
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class BBSmile_Util
{
    public static function getDefaultSmilies()
    {
         $icons = array(
            'icon_biggrin.gif' => array('type' => 0,
                'imgsrc' => 'icon_biggrin.gif',
                'alt' => 'icon_biggrin',
                'short' => ':-D',
                'alias' => '',
                'active' => '1'),
            'icon_confused.gif' => array('type' => 0,
                'imgsrc' => 'icon_confused.gif',
                'alt' => 'icon_confused',
                'short' => ':-?',
                'alias' => '',
                'active' => '1'),
            'icon_cool.gif' => array('type' => 0,
                'imgsrc' => 'icon_cool.gif',
                'alt' => 'icon_cool',
                'short' => '8-)',
                'alias' => '',
                'active' => '1'),
            'icon_eek.gif' => array('type' => 0,
                'imgsrc' => 'icon_eek.gif',
                'alt' => 'icon_eek',
                'short' => ':-O',
                'alias' => '',
                'active' => '1'),
            'icon_evil.gif' => array('type' => 0,
                'imgsrc' => 'icon_evil.gif',
                'alt' => 'icon_evil',
                'short' => ':evil:',
                'alias' => ':devil:',
                'active' => '1'),
            'icon_frown.gif' => array('type' => 0,
                'imgsrc' => 'icon_frown.gif',
                'alt' => 'icon_frown',
                'short' => ':-(',
                'alias' => '',
                'active' => '1'),
            'icon_lol.gif' => array('type' => 0,
                'imgsrc' => 'icon_lol.gif',
                'alt' => 'icon_lol',
                'short' => ':lol:',
                'alias' => '',
                'active' => '1'),
            'icon_mad.gif' => array('type' => 0,
                'imgsrc' => 'icon_mad.gif',
                'alt' => 'icon_mad',
                'short' => ':-x',
                'alias' => '',
                'active' => '1'),
            'icon_razz.gif' => array('type' => 0,
                'imgsrc' => 'icon_razz.gif',
                'alt' => 'icon_razz',
                'short' => ':-P',
                'alias' => '',
                'active' => '1'),
            'icon_redface.gif' => array('type' => 0,
                'imgsrc' => 'icon_redface.gif',
                'alt' => 'icon_redface',
                'short' => ':oops:',
                'alias' => '',
                'active' => '1'),
            'icon_rolleyes.gif' => array('type' => 0,
                'imgsrc' => 'icon_rolleyes.gif',
                'alt' => 'icon_rolleyes',
                'short' => ':roll:',
                'alias' => '',
                'active' => '1'),
            'icon_smile.gif' => array('type' => 0,
                'imgsrc' => 'icon_smile.gif',
                'alt' => 'icon_smile',
                'short' => ':-)',
                'alias' => '',
                'active' => '1'),
            'icon_wink.gif' => array('type' => 0,
                'imgsrc' => 'icon_wink.gif',
                'alt' => 'icon_wink',
                'short' => ';-)',
                'alias' => '',
                'active' => '1'));
         
         return $icons;
    }
}