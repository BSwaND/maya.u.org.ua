<?php
	defined('_JEXEC') or die;
	
	$db    = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select($db->quoteName(['c.id','c.title', 'c.catid','c.introtext','c.fulltext', 'c.images','c.publish_up','c.alias']))
		->from($db->quoteName('#__content','c'));


	$query->select($db->quoteName(['type.value','type.field_id'],['type_field_value','type_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'type')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('type.item_id')
		. 'AND '
		. $db->quoteName('type.field_id') . ' = ' . 4);

	$query->select($db->quoteName(['rajon.value','rajon.field_id'],['rajon_field_value','rajon_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'rajon')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('rajon.item_id')
		. 'AND '
		. $db->quoteName('rajon.field_id') . ' = ' . 5);

	$query->select($db->quoteName(['mik_kievskij.value','mik_kievskij.field_id'],['mik_kievskij_field_value','mik_kievskij_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'mik_kievskij')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('mik_kievskij.item_id')
		. 'AND '
		. $db->quoteName('mik_kievskij.field_id') . ' = '. 6);

	$query->select($db->quoteName(['mik_malinovskij.value','mik_malinovskij.field_id'],['mik_malinovskij_field_value','mik_malinovskij_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'mik_malinovskij')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('mik_malinovskij.item_id')
		. 'AND '
		. $db->quoteName('mik_malinovskij.field_id') . ' = '. 7);

	$query->select($db->quoteName(['mik_ovidiopolskij.value','mik_ovidiopolskij.field_id'],['mik_ovidiopolskij_field_value','mik_ovidiopolskij_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'mik_ovidiopolskij')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('mik_ovidiopolskij.item_id')
		. 'AND '
		. $db->quoteName('mik_ovidiopolskij.field_id') . ' = '. 8);

	$query->select($db->quoteName(['mik_primorskij.value','mik_primorskij.field_id'],['mik_primorskij_field_value','mik_primorskij_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'mik_primorskij')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('mik_primorskij.item_id')
		. 'AND '
		. $db->quoteName('mik_primorskij.field_id') . ' = '. 9);

	$query->select($db->quoteName(['mik_suvorovskij.value','mik_suvorovskij.field_id'],['mik_suvorovskij_field_value','mik_suvorovskij_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'mik_suvorovskij')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('mik_suvorovskij.item_id')
		. 'AND '
		. $db->quoteName('mik_suvorovskij.field_id') . ' = '. 10);


	// не работает еще
	$query->select($db->quoteName(['pls_obshchaya_m.value','pls_obshchaya_m.field_id'],['pls_obshchaya_m_field_value','pls_obshchaya_m_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'pls_obshchaya_m')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('pls_obshchaya_m.item_id')
		. 'AND '
		. $db->quoteName('pls_obshchaya_m.field_id') . ' = '. 11);

	$query->select($db->quoteName(['tsena.value','tsena.field_id'],['tsena_field_value','tsena_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'tsena')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('tsena.item_id')
		. 'AND '
		. $db->quoteName('tsena.field_id') . ' = '. 12);

	$query->select($db->quoteName(['kol_komnat.value','kol_komnat.field_id'],['kol_komnat_field_value','kol_komnat_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'kol_komnat')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('kol_komnat.item_id')
		. 'AND '
		. $db->quoteName('kol_komnat.field_id') . ' = '. 13);

	$query->select($db->quoteName(['kol_sanuzlov.value','kol_sanuzlov.field_id'],['kol_sanuzlov_field_value','kol_sanuzlov_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'kol_sanuzlov')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('kol_sanuzlov.item_id')
		. 'AND '
		. $db->quoteName('kol_sanuzlov.field_id') . ' = '. 14);

	$query->select($db->quoteName(['pls_kukhni.value','pls_kukhni.field_id'],['pls_kukhni_field_value','pls_kukhni_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'pls_kukhni')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('pls_kukhni.item_id')
		. 'AND '
		. $db->quoteName('pls_kukhni.field_id') . ' = '. 15);

	$query->select($db->quoteName(['pls_zhilaya.value','pls_zhilaya.field_id'],['pls_zhilaya_field_value','pls_zhilaya_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'pls_zhilaya')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('pls_zhilaya.item_id')
		. 'AND '
		. $db->quoteName('pls_zhilaya.field_id') . ' = '. 16);

	$query->select($db->quoteName(['sost_remont.value','sost_remont.field_id'],['sost_remont_field_value','sost_remont_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'sost_remont')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('sost_remont.item_id')
		. 'AND '
		. $db->quoteName('sost_remont.field_id') . ' = '. 17);

	$query->select($db->quoteName(['adres.value','adres.field_id'],['adres_field_value','adres_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'adres')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('adres.item_id')
		. 'AND '
		. $db->quoteName('adres.field_id') . ' = '. 18);

	$query->select($db->quoteName(['etaz.value','etaz.field_id'],['etaz_field_value','etaz_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'etaz')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('etaz.item_id')
		. 'AND '
		. $db->quoteName('etaz.field_id') . ' = '. 19);

	$query->select($db->quoteName(['kol_sotok.value','kol_sotok.field_id'],['kol_sotok_field_value','kol_sotok_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'kol_sotok')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('kol_sotok.item_id')
		. 'AND '
		. $db->quoteName('kol_sotok.field_id') . ' = '. 20);

	$query->select($db->quoteName(['koordinaty.value','koordinaty.field_id'],['koordinaty_field_value','koordinaty_sotok_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'koordinaty')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('koordinaty.item_id')
		. 'AND '
		. $db->quoteName('koordinaty.field_id') . ' = '. 21);

	$query->select($db->quoteName(['obs_ploshchad_uchs.value','obs_ploshchad_uchs.field_id'],['obs_ploshchad_uchs_field_value','obs_ploshchad_uchs_sotok_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'obs_ploshchad_uchs')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('obs_ploshchad_uchs.item_id')
		. 'AND '
		. $db->quoteName('obs_ploshchad_uchs.field_id') . ' = '. 22);

	$query->select($db->quoteName(['tip_kom_ndvz.value','tip_kom_ndvz.field_id'],['tip_kom_ndvz_field_value','tip_kom_ndvz_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'tip_kom_ndvz')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('tip_kom_ndvz.item_id')
		. 'AND '
		. $db->quoteName('tip_kom_ndvz.field_id') . ' = '. 23);

	$query->select($db->quoteName(['rasp_kom_ndvz.value','rasp_kom_ndvz.field_id'],['rasp_kom_ndvz_field_value','rasp_kom_ndvz_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'rasp_kom_ndvz')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('rasp_kom_ndvz.item_id')
		. 'AND '
		. $db->quoteName('rasp_kom_ndvz.field_id') . ' = '. 24);

	$query->select($db->quoteName(['etazhnost_zdn.value','etazhnost_zdn.field_id'],['etazhnost_zdn_field_value','etazhnost_zdn_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'etazhnost_zdn')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('etazhnost_zdn.item_id')
		. 'AND '
		. $db->quoteName('etazhnost_zdn.field_id') . ' = '. 25);

	$query->select($db->quoteName(['recommendation.value','recommendation.field_id'],['recommendation_field_value','recommendation_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'recommendation')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('recommendation.item_id')
		. 'AND '
		. $db->quoteName('recommendation.field_id') . ' = '. 26);

	$query->select($db->quoteName(['goryachij_obekt.value','goryachij_obekt.field_id'],['goryachij_obekt_field_value','goryachij_obekt_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'goryachij_obekt')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('goryachij_obekt.item_id')
		. 'AND '
		. $db->quoteName('goryachij_obekt.field_id') . ' = '. 30);

	$query->select($db->quoteName(['eksklyz.value','eksklyz.field_id'],['eksklyz_field_value','eksklyz_field_id']));
	$query->leftJoin(
		$db->quoteName('#__fields_values', 'eksklyz')
		. ' ON '
		. $db->quoteName('c.id') . ' = ' . $db->quoteName('eksklyz.item_id')
		. 'AND '
		. $db->quoteName('eksklyz.field_id') . ' = '. 31);


	$query->select($db->quoteName(['cat.parent_id','cat.title'],['cat_parent_id','cat_title']))
		->leftJoin(
			$db->quoteName('#__categories', 'cat')
			. ' ON '
			. $db->quoteName('cat.id') . ' = ' . $db->quoteName('c.catid')
		);

