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

class BBSmile_Controller_User extends Zikula_AbstractController
{

	/**
	* main funcion
	* The main function is not used in the bbsmile module, we just rediret to index.php
	*
	*/
	public function main()
	{
	    return System::redirect(System::getVar('entrypoint', 'index.php'));
	}

	/**
	* bbsmile
	* returns a html snippet with buttons for inserting bbsmiles into a text
	*
	* @param    $args['textfieldid']  id of the textfield for inserting smilies
	*/
	public function bbsmiles($args)
	{
		if(!isset($args['textfieldid']) || empty($args['textfieldid'])) {
			return LogUtil::registerArgsError();
		}

		// if we have more than one textarea we need to distinguish them, so we simply use
		// a counter stored in a session var until we find a better solution
		$counter = SessionUtil::getVar('bbsmile_counter', 0);
		$counter++;
		SessionUtil::setVar('bbsmile_counter', $counter);

		$this->view->assign('counter', $counter);
		$this->view->assign('textfieldid', $args['textfieldid']);

		PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBSmile'));
		
		$templatefile = DataUtil::formatForOS(ModUtil::getName()) . '.tpl';
		if($this->view->template_exists($templatefile)) {
		    return $this->view->fetch($templatefile);
		}
		$this->view->add_core_data();
		return $this->view->fetch('bbsmile_user_bbsmiles.tpl');
	}
}
