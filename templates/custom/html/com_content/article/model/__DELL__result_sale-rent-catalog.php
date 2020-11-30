<?php
	defined('_JEXEC') or die;

	if($_POST)
	{
		include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	}

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');
	
	$query->where($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.id') . ' != ' . $this->item->id );


	// категория "продажа"
	if($this->item->id == 21)
	{
		$query->andWhere('c.catid = ' . 12);
	}
	if($this->item->id == 24)
	{
		$query->andWhere('c.catid = ' . 10);
	}
	if($this->item->id == 25)
	{
		$query->andWhere('c.catid = ' . 14);
	}
	if($this->item->id == 26)
	{
		$query->andWhere('c.catid = ' . 16);
	}


	// категория "аренда"
	if($this->item->id == 27)
	{
		$query->andWhere('c.catid = ' . 13);
	}
	if($this->item->id == 28)
	{
		$query->andWhere('c.catid = ' . 11);
	}
	if($this->item->id == 29)
	{
		$query->andWhere('c.catid = ' . 15);
	}
	if($this->item->id == 30)
	{
		$query->andWhere('c.catid = ' . 17);
	}






	$query->group('id');
	$query->setLimit($set_limit);

	if($order_sort)
	{
		$query->order($order_sort);
	}

	$db->setQuery($query);
	$product =  $db->loadObjectList();

//	echo '<pre style="font-size: 12px; width: 80%; margin: auto; background: #eee; padding: 20px;">';
////	print_r($this->item);
//	//print_r($product);
//	echo '</pre>';

