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

	}

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/chank/order_sort.php');
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');

	$query->where('c.catid = '. (int)$cat_id ) ;
	$query->orWhere('cat.parent_id = '. (int)$cat_id ) ;

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


