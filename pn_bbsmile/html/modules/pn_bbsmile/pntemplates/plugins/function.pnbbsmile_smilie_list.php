<?php

/**
 * $id :  $
 *
 * Type: Function
 * Author: Thomas Pawlitzki
 *
 *@param params['assign'] The name of the variable, default smilies.
 *@return void
 */
function smarty_function_pnbbsmile_smilie_list($params, &$smarty)
{
	extract($params);
	unset($params);

	$assign = (!empty($assign)) ? $assign : 'smilies';
	$smarty->assign($assign, unserialize(pnModGetVar('pn_bbsmile', 'smilie_array')));
    return;
}

?>