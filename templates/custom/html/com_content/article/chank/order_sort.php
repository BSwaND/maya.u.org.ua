<?php
	defined('_JEXEC') or die;

	$set_limit                   =  ($_GET['set_limit']) ? (int)$_GET['set_limit'] : 8 ;
	$order_sort                  =  null;

	switch ((int)$_GET['order_sort']){
		case 1:
			$order_sort = ' c.publish_up ASC ';
			break;
		case 2:
			$order_sort = ' CAST(tsena.value AS INTEGER)  ASC ';
			break;
		case 3:
			$order_sort = ' CAST(tsena.value AS INTEGER) DESC ';
			break;
		default:
			$order_sort = 'c.publish_up ASC ';
	}