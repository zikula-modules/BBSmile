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
class BBSmile_Api_Admin extends Zikula_AbstractApi
{
    /**
     * Class BBSmile_Api_Admin 
     */
    
    /**
     * This function synchronizes the smilies stored in the directory with
     * the smilies stored in the modVar ('BBSmile', 'smilie_array).
     * The function checks if there is a smilie in the directory which is
     * not in the modVar. If the smilie is in the modVar, the info in the
     * modVar are kept. Otherwise the new smilie is added with the default info.
     * This function has to be called to include new smilies which are stored in the
     * auto-directory of the module.
     *
     * @params $args['forcereload'] bool
     */
    public function updatesmilies($args)
    {
        $forcereload = (isset($args['forcereload'])) ? $args['forcereload'] : false;
        // Get the new array
        $new_smilies = $this->load_smilies();

        // on forcereload simply replace old value
        if ($forcereload) {
            $this->setVar('smilie_array', $new_smilies);
            return true;
        }

        // Get the old array
        $old_smilies = $this->getVar('smilie_array');

        // Combine old array and new array
        // First create a new array
        // check if the new smilie is in the old array
        // If it is included then save the old definition
        // Else save the new definition
        $smilies = array();
        foreach ($new_smilies as $key => $new_smilie) {
            if (array_key_exists($key, $old_smilies)) {
                // Store the old one
                $smilies[$key] = $old_smilies[$key];
            } else {
                // Store the new one
                $smilies[$key] = $new_smilie;
            }
        }

        // Save the array
        $this->setVar('smilie_array', $smilies);
        
        // Return success
        return true;
    }

    /**
     * get all smilies
     */
    public function load_smilies()
    {
        // default smilies
        $icons = BBSmile_Util::getDefaultSmilies();
        
        if ($this->getVar('activate_auto') == 1) {
            $smiliepath_auto = DataUtil::formatForOS($this->getVar('smiliepath_auto'));
            $handle = opendir($smiliepath_auto);
            if ($handle <> false) {
                while ($file = readdir($handle)) {
                    if ($file != '.' && $file != '..' && $file != 'index.tpl' && $file != 'CVS') {
                        if (preg_match("/(.*?)(.gif|.jpg|.jpeg|.png)$/i", $file, $matches) <> 0) {
                            $icons[$matches[1]] = array('type' => 1,
                                'imgsrc' => $matches[0],
                                'alt' => $matches[1],
                                'alias' => '',
                                'short' => ":" . $matches[1] . ":",
                                'active' => '1');
                        }
                    }
                }
            }
        }
        return $icons;
    }

    /**
     * get available admin panel links
     *
     * @return array array of admin links
     */
    public function getlinks()
    {
        $links = array();
        if (SecurityUtil::checkPermission('BBSmile::', '::', ACCESS_ADMIN)) {
            $links[] = array(
                'url' => ModUtil::url('BBSmile', 'admin', 'main'),
                'text' => $this->__('Settings'),
                'icon' => 'wrench'
            );
            $links[] = array(
                'url' => ModUtil::url('BBSmile', 'admin', 'readsmilies'),
                'text' => $this->__('Reload smilies out of the directory'),
                'icon' => 'cogs'
            );
            $links[] = array(
                'url' => ModUtil::url('BBSmile', 'admin', 'editsmilies', array('aid' => -1)),
                'text' => $this->__('Edit the defined smilies'),
                'icon' => 'edit'
            );
        }
        return $links;
    }

}