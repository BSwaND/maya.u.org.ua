<?php
	defined('_JEXEC') or die;

	$set_limit =  ($_GET['set_limit']) ? $_GET['set_limit'] : 8 ;
	$limstart =  ($_GET['page']) ? $_GET['page'] : 0 ;

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where('rajon.value = ' . $this->item->jcfields[5]->rawvalue[0]);
	$query->andWhere($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.id') . ' != ' . $this->item->id );
	$query->group('id');

	// counter rows
	$db->setQuery($query)->query();
	$allRows = $db->getNumRows();

	$query->setLimit($set_limit, $limstart);

	if($order_sort)
	{
		$query->order($order_sort);
	}

	$db->setQuery($query);
	$product =  $db->loadObjectList();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination((int)$allRows, $limstart, $set_limit);