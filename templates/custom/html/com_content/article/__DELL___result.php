<?php
	defined('_JEXEC') or die;

	if($_POST)
	{
		$cat_id = (int)$_POST['type_estate'] ;

		$tip_nedvizhimosti        = (int)$_POST['tip_nedvizhimosti'];
		$rajon                    = $_POST['rajon'];
		$mikrorajon               = (int)$_POST['mikrorajonyn'];
		$ploshchad_obshchaya_ot   =  (int)$_POST['ploshchad_obshchaya_ot'];
		$ploshchad_obshchaya_do   =  (int)$_POST['ploshchad_obshchaya_do'];
		$tsena_ot                 =  (int)$_POST['tsena_ot'];
		$tsena_do                 =  (int)$_POST['tsena_do'];
		$kol_vo_komnat_ot            =  (int)$_POST['kol_vo_komnat_ot'];
		$kol_vo_komnat_do            =  (int)$_POST['kol_vo_komnat_do'];
		$kol_vo_sanuzlov_ot          =  (int)$_POST['kol_vo_sanuzlov_ot'];
		$kol_vo_sanuzlov_do          =  (int)$_POST['kol_vo_sanuzlov_do'];
		$ploshchad_kukhni_ot         =  (int)$_POST['ploshchad_kukhni_ot'];
		$ploshchad_kukhni_do         =  (int)$_POST['ploshchad_kukhni_do'];
		$ploshchad_zhilaya_ot        =  (int)$_POST['ploshchad_zhilaya_ot'];
		$ploshchad_zhilaya_do        =  (int)$_POST['ploshchad_zhilaya_do'];
		$sostoyanie_remont        =  (int)$_POST['sostoyanie_remont'];
		$etazhnost_zdaniya_ot        =  (int)$_POST['etazhnost_zdaniya_ot'];
		$etazhnost_zdaniya_do        =  (int)$_POST['etazhnost_zdaniya_do'];
		$kolichestvo_sotok_zemli_ot  =  (int)$_POST['kolichestvo_sotok_zemli_ot'];
		$kolichestvo_sotok_zemli_do  =  (int)$_POST['kolichestvo_sotok_zemli_do'];
		$tip_kom_nedviz              =  (int)$_POST['tip_kom_nedviz'];
		$raspolz_kom_nedvz           =  (int)$_POST['raspolz_kom_nedvz'];

		$set_limit                   =  ($_POST['set_limit']) ? (int)$_POST['set_limit'] : 8 ;
		$order_sort                  =  null;

		switch ((int)$_POST['order_sort']){
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
	}

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

	$query->select($db->quoteName(['cat.parent_id','cat.title'],['cat_parent_id','cat_title']))
		->leftJoin(
			$db->quoteName('#__categories', 'cat')
			. ' ON '
			. $db->quoteName('cat.id') . ' = ' . $db->quoteName('c.catid')
		)

		->where('c.catid = '. (int)$cat_id )
		->orWhere('cat.parent_id = '. (int)$cat_id ) ;

	if($tip_nedvizhimosti)
	{
		$query->andWhere('type.value = ' . $tip_nedvizhimosti);
	}

	if($rajon)
	{
		$query->andWhere('rajon.value = ' . $rajon);
	}

	if($mikrorajon)
	{
		$query->andWhere([
			'mik_kievskij.value = ' . $mikrorajon,
			'mik_malinovskij.value = ' . $mikrorajon,
			'mik_ovidiopolskij.value = ' . $mikrorajon,
			'mik_primorskij.value = ' . $mikrorajon,
			'mik_suvorovskij.value = ' . $mikrorajon,
		]);
	}
	if($tsena_ot || $tsena_do )
	{
		$tsena_ot = ($tsena_ot) ? $tsena_ot : 0 ;
		$tsena_do = ($tsena_do) ? $tsena_do : 9999999999 ;
		$query->andWhere( 'tsena.value'. ' BETWEEN ' . $tsena_ot . ' AND ' . $tsena_do) ;
	}
	if($ploshchad_obshchaya_ot || $ploshchad_obshchaya_do)
	{
		$ploshchad_obshchaya_ot = ($ploshchad_obshchaya_ot) ? $ploshchad_obshchaya_ot : 0 ;
		$ploshchad_obshchaya_do = ($ploshchad_obshchaya_do) ? $ploshchad_obshchaya_do : 9999999999 ;
		$query->andWhere( 'pls_obshchaya_m.value'. ' BETWEEN ' . $ploshchad_obshchaya_ot . ' AND ' . $ploshchad_obshchaya_do) ;
	}
	if($kol_vo_komnat_ot || $kol_vo_komnat_do )
	{
		$kol_vo_komnat_ot = ($kol_vo_komnat_ot) ? $kol_vo_komnat_ot : 0 ;
		$kol_vo_komnat_do = ($kol_vo_komnat_do) ? $kol_vo_komnat_do : 9999999999 ;
		$query->andWhere( 'kol_komnat.value'. ' BETWEEN ' . $kol_vo_komnat_ot . ' AND ' . $kol_vo_komnat_do) ;
	}
	if($kol_vo_sanuzlov_ot || $kol_vo_sanuzlov_do)
	{
		$kol_vo_sanuzlov_ot = ($kol_vo_sanuzlov_ot) ? $kol_vo_sanuzlov_ot : 0 ;
		$kol_vo_sanuzlov_do = ($kol_vo_sanuzlov_do) ? $kol_vo_sanuzlov_do : 9999999999 ;
		$query->andWhere( 'kol_sanuzlov.value'. ' BETWEEN ' . $kol_vo_sanuzlov_ot . ' AND ' . $kol_vo_sanuzlov_do) ;
	}
	if($ploshchad_kukhni_ot || $ploshchad_kukhni_do)
	{
		$ploshchad_kukhni_ot = ($ploshchad_kukhni_ot) ? $ploshchad_kukhni_ot : 0 ;
		$ploshchad_kukhni_do = ($ploshchad_kukhni_do) ? $ploshchad_kukhni_do : 9999999999 ;
		$query->andWhere( 'pls_kukhni.value'. ' BETWEEN ' . $ploshchad_kukhni_ot . ' AND ' . $ploshchad_kukhni_do) ;
	}
	if($ploshchad_zhilaya_ot || $ploshchad_zhilaya_do)
	{
		$ploshchad_zhilaya_ot = ($ploshchad_zhilaya_ot) ? $ploshchad_zhilaya_ot : 0 ;
		$ploshchad_zhilaya_do = ($ploshchad_zhilaya_do) ? $ploshchad_zhilaya_do : 9999999999 ;
		$query->andWhere( 'pls_zhilaya.value'. ' BETWEEN ' . $ploshchad_zhilaya_ot . ' AND ' . $ploshchad_zhilaya_do) ;
	}

	if($sostoyanie_remont)
	{
		$query->andWhere('sost_remont.value = ' . $sostoyanie_remont);
	}
	if($tip_kom_nedviz)
	{
		$query->andWhere('tip_kom_ndvz.value = ' . $tip_kom_nedviz);
	}
	if($raspolz_kom_nedvz)
	{
		$query->andWhere('rasp_kom_ndvz.value = ' . $raspolz_kom_nedvz);
	}
	if($etazhnost_zdaniya_ot || $etazhnost_zdaniya_do)
	{
		$etazhnost_zdaniya_ot = ($etazhnost_zdaniya_ot) ? $etazhnost_zdaniya_ot : 0 ;
		$etazhnost_zdaniya_do = ($etazhnost_zdaniya_do) ? $etazhnost_zdaniya_do : 9999999999 ;
		$query->andWhere( 'etazhnost_zdn.value'. ' BETWEEN ' . $etazhnost_zdaniya_ot . ' AND ' . $etazhnost_zdaniya_do) ;
	}
	if($kolichestvo_sotok_zemli_ot || $kolichestvo_sotok_zemli_do)
	{
		$kolichestvo_sotok_zemli_ot = ($kolichestvo_sotok_zemli_ot) ? $kolichestvo_sotok_zemli_ot : 0 ;
		$kolichestvo_sotok_zemli_do = ($kolichestvo_sotok_zemli_do) ? $kolichestvo_sotok_zemli_do : 9999999999 ;
		$query->andWhere( 'kol_sotok.value'. ' BETWEEN ' . $kolichestvo_sotok_zemli_ot . ' AND ' . $kolichestvo_sotok_zemli_do) ;
	}

	$query->andWhere($db->quoteName('c.state') . ' = 1' );

	$query->group('id');
	$query->setLimit($set_limit);

	if($order_sort)
	{
		$query->order($order_sort);
	}

	$db->setQuery($query);
	$product =  $db->loadObjectList();


