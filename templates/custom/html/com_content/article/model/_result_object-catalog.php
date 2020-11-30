<?php
	defined('_JEXEC') or die;

	if($_POST)
	{
	}

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.id') . ' != ' . $this->item->id );
	$query->andWhere($db->quoteName('c.state') . ' = 1' );

	if($this->item->jcfields[26]->rawvalue == 1)
	{
		$query->andWhere('recommendation.value = ' . 1);
	}

	if($this->item->jcfields[30]->rawvalue == 1)
	{
		$query->andWhere('goryachij_obekt.value = ' . 1);
	}

	if($this->item->jcfields[31]->rawvalue == 1)
	{
		$query->andWhere('eksklyz.value = ' . 1);
	}

	if($this->item->id == 16)     // новые объекты
	{
		$query->andWhere('cat.parent_id = ' . 8);
		$query->orWhere('cat.parent_id = ' . 9);
		$query->order('c.publish_up DESC ');
	}

	$query->group('id');
	$query->setLimit($set_limit);

	if($order_sort)
	{
		$query->order($order_sort);
	}

	$db->setQuery($query);
	$product =  $db->loadObjectList();