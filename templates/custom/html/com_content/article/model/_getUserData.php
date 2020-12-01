<?php
	defined('_JEXEC') or die;

	$db    = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select($db->quoteName(['field_id','item_id','value']))
		->from($db->quoteName('#__fields_values'))
		->where('item_id = '. $idUser);


	$db->setQuery($query);
	$userFild =  $db->loadObjectList('field_id');

