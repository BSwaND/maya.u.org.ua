<?php
	defined('_JEXEC') or die;

	if($_POST)
	{
	}

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where('rajon.value = ' . $this->item->jcfields[5]->rawvalue[0]);
	$query->andWhere($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.id') . ' != ' . $this->item->id );   

	$query->group('id');
	$query->setLimit($set_limit);

	if($order_sort)
	{
		$query->order($order_sort);
	}

	$db->setQuery($query);
	$product =  $db->loadObjectList();
	