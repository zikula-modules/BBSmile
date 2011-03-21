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

class BBSmile_Api_User extends Zikula_AbstractApi
{

    /*
    * main transformation function
    */
    function transform($args)
    {
        $text = $args['text'];
        
        // check the user agent - if it is a bot, return immediately
        $robotslist = array ( "ia_archiver",
                  "googlebot",
                  "mediapartners-google",
                  "yahoo!",
                  "msnbot",
                  "jeeves",
                  "lycos");
        $useragent = System::serverGetVar('HTTP_USER_AGENT');
        for($cnt=0; $cnt < count($robotslist); $cnt++) {
            if(strpos(strtolower($useragent), $robotslist[$cnt]) !== false) {
                return $text;
            }
        }

        $smilies = $this->getVar('smilie_array');
        $remove_inactive = $this->getVar('remove_inactive');

        if(is_array($smilies) && count($smilies)>0) {
            // sort smilies, see http://code.zikula.org/BBSmile/ticket/1
            uasort($smilies, array($this, 'cmp_smiliesort'));
            $imagepath      = System::getBaseUrl() . DataUtil::formatForOS($this->getVar('smiliepath'));
            $imagepath_auto = System::getBaseUrl() . DataUtil::formatForOS($this->getVar('smiliepath_auto'));
            $auto_active = $this->getVar('activate_auto');
            // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
                // This is important!
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
    public function getall()
    {
        $handle=opendir('images/smilies');
        while ($file = readdir($handle)) {
            $filelist[] = $file;
        }
        asort($filelist);
        $icons = array();
        while (list ($key, $file) = each ($filelist)) {
            ereg('.gif|.jpg',$file);
            if ($file != '.' && $file != '..' && $file != 'index.tpl' && $file != '.svn' && $file != 'CVS') {
                $icons[] = array('imgsrc' => $file);
            }

        }
        return $icons;
    }
}

function cmp_smiliesort ($a, $b)
{
    return strlen($a['short']) > strlen($b['short']);
}
