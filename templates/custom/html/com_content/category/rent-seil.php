<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  com_content
	 *
	 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;

	JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

	JHtml::_('behavior.caption');

	$dispatcher = JEventDispatcher::getInstance();

	$this->category->text = $this->category->description;
	$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
	$this->category->description = $this->category->text;

	$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
	$afterDisplayTitle = trim(implode("\n", $results));

	$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
	$beforeDisplayContent = trim(implode("\n", $results));

	$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
	$afterDisplayContent = trim(implode("\n", $results));


	$set_limit =  ($_GET['set_limit']) ? $_GET['set_limit'] : 8 ;
	$limstart =  ($_GET['page']) ? $_GET['page'] : 0 ;


	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where($db->quoteName('c.state') . ' = 1' );
	$query->andWhere('cat.parent_id = ' . $this->get('category')->id);
	$query->orWhere('c.catid = ' . $this->get('category')->id);
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

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/_body-article.php');



//		echo '<pre style="font-size: 12px; width: 80%; margin: auto; background: #eee; padding: 20px;">';
//		print_r($this->get('category')->id);
//		print_r($product);
//		echo '</pre>';

