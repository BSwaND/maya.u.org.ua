<?php
	defined('_JEXEC') or die;

	$session = JFactory::getSession();

	$arrIdProduct = array_unique((explode(',', $session->get('dataIdProduct'))));
	$arrIdProduct = array_reverse($arrIdProduct);

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where($db->quoteName('c.state') . ' = 1');

	if ($arrIdProduct[0] ) {
		$query->andWhere($db->quoteName('c.id') . ' = ' . $arrIdProduct[0]);
		foreach ($arrIdProduct as $key => $val) {
			if(!$key[0] && !empty($val) ){
				$query->orWhere($db->quoteName('c.id') . ' = ' . $val);
			}
		}
		$query->group('id');

		// counter rows
		$db->setQuery($query)->query();
		$allRows = $db->getNumRows();

		$query->setLimit(6);

		$db->setQuery($query);
		$product = $db->loadObjectList();

	}