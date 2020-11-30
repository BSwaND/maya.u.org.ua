<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  mod_custom
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;


	$db    = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select('*')
		->from($db->quoteName('#__fields'))
		->where('state = 1' );

	$db->setQuery($query);
	$fields =  $db->loadObjectList('name');


	$optin_tip_nedvizhimosti = json_decode( $fields['tip-nedvizhimosti']->fieldparams);
	$optin_rajon = json_decode( $fields['rajon']->fieldparams);
	$optin_mikrorajony_kievskij = json_decode( $fields['mikrorajony-kievskij']->fieldparams);
	$optin_mikrorajony_malinovskij = json_decode( $fields['mikrorajony-malinovskij']->fieldparams);
	$optin_mikrorajony_ovidiopolskij = json_decode( $fields['mikrorajony-ovidiopolskij']->fieldparams);
	$optin_mikrorajony_primorskij = json_decode( $fields['mikrorajony-primorskij']->fieldparams);
	$optin_mikrorajony_suvorovskij = json_decode( $fields['mikrorajony-suvorovskij']->fieldparams);
	$optin_sostoyanie_remont = json_decode( $fields['sostoyanie-remont']->fieldparams);
	$tip_kommercheskoj_nedvizhimosti = json_decode( $fields['tip-kommercheskoj-nedvizhimosti']->fieldparams);
	$raspolozhenie_kommercheskoj_nedvizhimosti = json_decode( $fields['raspolozhenie-kommercheskoj-nedvizhimosti']->fieldparams);

	$mikrorajonynAllArr = [];
	foreach ($optin_mikrorajony_kievskij->options as $key => $val )
	{
		$mikrorajonynAllArr[$val->value] = $val->name;
	}
	foreach ($optin_mikrorajony_malinovskij->options as $key => $val )
	{
		$mikrorajonynAllArr[$val->value] = $val->name;
	}
	foreach ($optin_mikrorajony_ovidiopolskij->options as $key => $val )
	{
		$mikrorajonynAllArr[$val->value] = $val->name;
	}
	foreach ($optin_mikrorajony_primorskij->options as $key => $val )
	{
		$mikrorajonynAllArr[$val->value] = $val->name;
	}
	foreach ($optin_mikrorajony_suvorovskij->options as $key => $val )
	{
		$mikrorajonynAllArr[$val->value] = $val->name;
	}


	if($_GET && false) {
		echo '<pre>';
		print_r($_GET);
		echo '</pre>';
	}

?>

<form action="/poisk" method="GET" class="filter-form">
	<input type="hidden" name="set_limit" value="8">
	<input type="hidden" name="order_sort" value="1">
			<div class="flex between">
				<div class="form-group">
					<div class="flex mb20 operation-type-select">
						<label class="operation-label <?= ($_GET['type_estate'] == 9 || empty($_GET['type_estate'])) ? 'active' : null?>"">
						<span class="operation-label-text">Аренда</span>
						<input class="operation-input" type="radio" name="type_estate" value="9" id="type_estate_1"  checked >
						</label>
						<label class="operation-label <?= ($_GET['type_estate'] == 8) ? 'active' : null?>">
							<span class="operation-label-text">Продажа</span>
							<input class="operation-input" type="radio" name="type_estate" value="8" id="type_estate_2" <?= ($_GET['type_estate'] == 8) ? 'checked' : null?>>
						</label>
					</div>

					<div class="main-search flex mb25" id="mainSearch">
						<div class="field-box">
							<p class="label">Тип недвижимости:</p>
							<div class="select" id="objectType">
								<div class="select-title">
									<?php $optionsId = 'options'. $_GET['tip_nedvizhimosti'] ?>
									<?= ($optin_tip_nedvizhimosti->options->$optionsId->name || $_GET['tip_nedvizhimosti'] === '0') ? $optin_tip_nedvizhimosti->options->$optionsId->name : 'Вся недвижимость' ?>
								</div>
								<div class="select-content">
									<label class="select-label"  for="tip_nedvizhimosti_0">
										<input class="select-input" type="radio" name="tip_nedvizhimosti" value="0" id="tip_nedvizhimosti_0"  <?= (!isset($_GET['tip_nedvizhimosti']) || $_GET['tip_nedvizhimosti'] === '0' ) ? 'checked' : null ?>>
										Вся недвижимость
									</label>
									<?php
										foreach ($optin_tip_nedvizhimosti->options as $key => $val){
											if($val->value)	{  ?>
												<label class="select-label" for="tip_nedvizhimosti_<?= $val->value ?>">
													<input class="select-input"  type="radio" name="tip_nedvizhimosti" value="<?= $val->value ?>" id="tip_nedvizhimosti_<?= $val->value ?>"  <?= ($_GET['tip_nedvizhimosti'] && $_GET['tip_nedvizhimosti'] === $val->value ) ? 'checked' : null ?>>
													<?= $val->name ?>
												</label>
											<?php	} ?>
										<?php	}
									?>
								</div>
							</div>
						</div>
						
						<div class="field-box">
							<p class="label">Район:</p>
							<div class="select" id="region">
								<div class="select-title">
									<?php $optionsId = 'options'. $_GET['rajon'] ?>
									<?= ($optin_rajon->options->$optionsId->name || $_GET['rajon'] === '0') ? $optin_rajon->options->$optionsId->name : $optin_rajon->options->options0->name ?>
								</div>
								<div class="select-content">
									<?php
										foreach ($optin_rajon->options as $key => $val){ ?>
											<label  class="select-label" data-region="<?= $val->value ?>" for="rajon_<?= $val->value ?>" >
												<input class="select-input"  type="radio" name="rajon" value="<?= $val->value ?>" id="rajon_<?= $val->value ?>"  <?= ($_GET['rajon'] && $_GET['rajon'] === $val->value ) ? 'checked' : null ?>>
												<?= $val->name ?>
											</label>
										<?php	} ?>
								</div>
							</div>
						</div>
						<div class="field-box">
							<p class="label">Микрорайон:</p>
							<div class="select" id="mRegion">
								<div class="select-title" data-default="0">
									<?= ($mikrorajonynAllArr[$_GET['mikrorajonyn']]) ? $mikrorajonynAllArr[$_GET['mikrorajonyn']] :	$mikrorajonynAllArr[0]	?>
								</div>
								<div class="select-content">
									<?php
										foreach ($mikrorajonynAllArr as $key => $val){ ?>
											<label class="select-label"  data-region="<?= substr($key, 0,1) ?>">
												<input class="select-input" type="radio" name="mikrorajonyn" value="<?= $key ?>"   <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val ) ? 'checked' : null ?>>
												<?= $val ?>
											</label>
										<?php	}	?>
								</div>
							</div>
						</div>
						<div class="field-box total-area">
							<p class="label">Площадь общая (м²):</p>
							<div class="flex between">
								<input class="input-number" type="text" name="ploshchad_obshchaya_ot" placeholder="от_____"  value="<?= ($_GET['ploshchad_obshchaya_ot'] ? $_GET['ploshchad_obshchaya_ot'] : null)?>">
								<input class="input-number" type="text" name="ploshchad_obshchaya_do" placeholder="до_____"  value="<?= ($_GET['ploshchad_obshchaya_do'] ? $_GET['ploshchad_obshchaya_do'] : null)?>">
							</div>
						</div>
						<div class="field-box">
							<p class="label">Цена:</p>
							<div class="flex between">
								<input class="input-number"  type="text" name="tsena_ot" value="<?= ($_GET['tsena_ot'] ? $_GET['tsena_ot'] : null)?>" placeholder="от_____" >
								<input class="input-number"  type="text" name="tsena_do" value="<?= ($_GET['tsena_do'] ? $_GET['tsena_do'] : null)?>" placeholder="до_____" >
							</div>
						</div>
					</div>
					<div class="advanced-search" id="advancedSearch">
						<div class="flex">
							<div class="field-box flat house">
								<p class="label">Комнат:</p>
								<div class="flex between">
									<input class="input-number"  type="text" name="kol_vo_komnat_ot" value="<?= ($_GET['kol_vo_komnat_ot'] ? $_GET['kol_vo_komnat_ot'] : null)?>" placeholder="от_____" >
									<input class="input-number"  type="text" name="kol_vo_komnat_do" value="<?= ($_GET['kol_vo_komnat_do'] ? $_GET['kol_vo_komnat_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box flat house">
								<p class="label">Санузлов:</p>
								<div class="flex between">
									<input class="input-number" type="text" name="kol_vo_sanuzlov_ot" value="<?= ($_GET['kol_vo_sanuzlov_ot'] ? $_GET['kol_vo_sanuzlov_ot'] : null)?>" placeholder="от_____" >
									<input class="input-number" type="text" name="kol_vo_sanuzlov_do" value="<?= ($_GET['kol_vo_sanuzlov_do'] ? $_GET['kol_vo_sanuzlov_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box flat">
								<p class="label">Этаж: ()НЕТ</p>
								<div class="flex between">
									<input class="input-number"  type="text" name="etazhnost_zdaniya_ot" id="etazhnost_zdaniya_ot" value="<?= ($_GET['etazhnost_zdaniya_ot'] ? $_GET['etazhnost_zdaniya_ot'] : null)?>" placeholder="от_____">
									<input class="input-number"  type="text" name="etazhnost_zdaniya_do" id="etazhnost_zdaniya_do" value="<?= ($_GET['etazhnost_zdaniya_do'] ? $_GET['etazhnost_zdaniya_do'] : null)?>" placeholder="до_____">
								</div>
							</div>

							<div class="field-box flat house">
								<p class="label">Площадь жилая (м²):</p>
								<div class="flex between">
									<input class="input-number" type="text" name="ploshchad_zhilaya_ot" value="<?= ($_GET['ploshchad_zhilaya_ot'] ? $_GET['ploshchad_zhilaya_ot'] : null)?>" placeholder="от_____" >
									<input class="input-number" type="text" name="ploshchad_zhilaya_do" value="<?= ($_GET['ploshchad_zhilaya_do'] ? $_GET['ploshchad_zhilaya_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box flat">
								<p class="label">Площадь кухни (м²):</p>
								<div class="flex between">
									<input class="input-number" type="text" name="ploshchad_kukhni_ot" id="ploshchad_kukhni_ot" value="<?= ($_GET['ploshchad_kukhni_ot'] ? $_GET['ploshchad_kukhni_ot'] : null)?>" placeholder="от_____" >
									<input class="input-number" type="text" name="ploshchad_kukhni_do" id="ploshchad_kukhni_do" value="<?= ($_GET['ploshchad_kukhni_do'] ? $_GET['ploshchad_kukhni_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box house land-area">
								<p class="label">Площадь участка (сотки):</p>
								<div class="flex between">
									<input class="input-number"  type="text" name="kolichestvo_sotok_zemli_ot" id="kolichestvo_sotok_zemli_ot" value="<?= ($_GET['kolichestvo_sotok_zemli_ot'] ? $_GET['kolichestvo_sotok_zemli_ot'] : null)?>" placeholder="от_____">
									<input class="input-number"  type="text" name="kolichestvo_sotok_zemli_do" id="kolichestvo_sotok_zemli_do" value="<?= ($_GET['kolichestvo_sotok_zemli_do'] ? $_GET['kolichestvo_sotok_zemli_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box house commerce">
								<p class="label">Этажность:</p>
								<div class="flex between">
									<input class="input-number"  type="text" name="etazhnost_zdaniya_ot" value="<?= ($_GET['etazhnost_zdaniya_ot'] ? $_GET['etazhnost_zdaniya_ot'] : null)?>" placeholder="от_____">
									<input class="input-number"  type="text" name="etazhnost_zdaniya_do" value="<?= ($_GET['etazhnost_zdaniya_do'] ? $_GET['etazhnost_zdaniya_do'] : null)?>" placeholder="до_____">
								</div>
							</div>
							<div class="field-box flat house commerce">
								<p class="label">Состояние (ремонт):</p>
								<div class="select">
									<div class="select-title">
										<?php $optionsId = 'options'. $_GET['sostoyanie_remont'] ?>
										<?= ($optin_sostoyanie_remont->options->$optionsId->name || $_GET['sostoyanie_remont'] === '0') ? $optin_sostoyanie_remont->options->$optionsId->name :  $optin_sostoyanie_remont->options->options0->name ?>
									</div>
									<div class="select-content">
										<?php
											foreach ($optin_sostoyanie_remont->options as $key => $val){  ?>
												<label class="select-label" >
													<input class="select-input"  type="radio" name="sostoyanie_remont" value="<?= $val->value ?>" <?= ($_GET['sostoyanie_remont'] && $_GET['sostoyanie_remont'] === $val->value ) ? 'checked' : null ?>>
													<?= $val->name ?>
												</label>
											<?php	}	?>
									</div>
								</div>
							</div>
							<div class="field-box commerce">
								<p class="label">Тип объекта:</p>
								<div class="select" id="">
									<div class="select-title">
										<?php $optionsId = 'options'. $_GET['tip_kom_nedviz'] ?>
										<?= ($tip_kommercheskoj_nedvizhimosti->options->$optionsId->name || $_GET['tip_kom_nedviz'] === '0') ? $tip_kommercheskoj_nedvizhimosti->options->$optionsId->name :  $tip_kommercheskoj_nedvizhimosti->options->options0->name ?>
									</div>
									<div class="select-content">
										<?php
											foreach ($tip_kommercheskoj_nedvizhimosti->options as $key => $val){ ?>
												<label  class="select-label" >
													<input class="select-input"  type="radio" name="tip_kom_nedviz" value="<?= $val->value ?>"   <?= ($_GET['tip_kom_nedviz'] && $_GET['tip_kom_nedviz'] === $val->value ) ? 'checked' : null ?>>
													<?= $val->name ?>
												</label>
											<?php	}	?>
									</div>
								</div>
							</div>
							<div class="field-box commerce">
								<p class="label">Расположение:</p>
								<div class="select" id="">
									<div class="select-title">
										<?php $optionsId = 'options'. $_GET['raspolz_kom_nedvz'] ?>
										<?= ($raspolozhenie_kommercheskoj_nedvizhimosti->options->$optionsId->name || $_GET['raspolz_kom_nedvz'] === '0') ? $raspolozhenie_kommercheskoj_nedvizhimosti->options->$optionsId->name :  $raspolozhenie_kommercheskoj_nedvizhimosti->options->options0->name ?>
									</div>
									<div class="select-content">
										<?php
											foreach ($raspolozhenie_kommercheskoj_nedvizhimosti->options as $key => $val){ ?>
												<label class="select-label">
													<input class="select-input" type="radio" name="raspolz_kom_nedvz" value="<?= $val->value ?>"  <?= ($_GET['raspolz_kom_nedvz'] && $_GET['raspolz_kom_nedvz'] === $val->value ) ? 'checked' : null ?>>
													<?= $val->name ?>
												</label>
											<?php	}	?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="btn-box">
					<div class="show-advanced-search">Расширенный поиск</div>
					<button type="submit" class="btn icon-search">ПОИСК</button>
				</div>
			</div>
		</form>


<?php /*
<form action="/poisk" method="post" >
	<div>
		<label for="type_estate_1">Аренда</label>
		<input type="radio" name="type_estate" value="9" id="type_estate_1"  checked >
		<label for="type_estate_2">Покупка</label>
		<input type="radio" name="type_estate" value="8" id="type_estate_2" <?= ($_GET['type_estate'] == 8) ? 'checked' : null?>>
	</div>
	<hr>
	
	<div class="">
		Тип недвижимости <br>
		<div id="tip_nedvizhimosti">
			<label for="tip_nedvizhimosti_0">
				<input type="radio" name="tip_nedvizhimosti" value="0" id="tip_nedvizhimosti_0"  <?= (!isset($_GET['tip_nedvizhimosti']) || $_GET['tip_nedvizhimosti'] === '0' ) ? 'checked' : null ?>>
				Вся недвижимость
			</label>
			<?php
				foreach ($optin_tip_nedvizhimosti->options as $key => $val){
					if($val->value)	{  ?>
						<label for="tip_nedvizhimosti_<?= $val->value ?>">
							<input type="radio" name="tip_nedvizhimosti" value="<?= $val->value ?>" id="tip_nedvizhimosti_<?= $val->value ?>"  <?= ($_GET['tip_nedvizhimosti'] && $_GET['tip_nedvizhimosti'] === $val->value ) ? 'checked' : null ?>>
							<?= $val->name ?>
						</label>
					<?php	} ?>
				<?php	}
			?>
		</div>

	</div>
	<hr>

	<div class="">
		Район: <br>
		<div id="rajon">
			<label for="rajon_0">
				<input type="radio" name="rajon" value="0" id="rajon_0"  <?= (!isset($_GET['rajon']) || $_GET['rajon'] === '0') ? 'checked' : null ?>>
				Все районы
			</label>
			<?php
				foreach ($optin_rajon->options as $key => $val){
					if($val->value)	{  ?>
						<label for="rajon_<?= $val->value ?>">
							<input type="radio" name="rajon" value="<?= $val->value ?>" id="rajon_<?= $val->value ?>"  <?= ($_GET['rajon'] && $_GET['rajon'] === $val->value ) ? 'checked' : null ?>>
							<?= $val->name ?>
						</label>
					<?php	} ?>
				<?php	}
			?>
		</div>
	</div>
	<hr>


	<div class="">
		Микрорайон -ОБЩИЙ СПИСОК: <br>
		<div _name="mikrorajony_kievskij" id="mikrorajony_kievskij">
			<label for="mikrorajony_kievskij_0">
				<input type="radio" name="mikrorajonyn" value="0" id="mikrorajony_kievskij_0"  <?= (!isset($_GET['mikrorajonyn']) || $_GET['mikrorajonyn'] ==='0' ) ? 'checked' : null ?>>
				Все микрорайоны
			</label>

			<div class="" id="mikrorajony_kievskij">    <?php //mikrorajony_kievskij ?>
				<?php
					foreach ($optin_mikrorajony_kievskij->options as $key => $val){
						if($val->value)	{  ?>
							<label for="mikrorajony_kievskij_<?= $val->value ?>">
								<input type="radio" name="mikrorajonyn" value="<?= $val->value ?>" id="mikrorajony_kievskij_<?= $val->value ?>"  <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val->value ) ? 'checked' : null ?>>
								<?= $val->name ?>
							</label>
						<?php	} ?>
					<?php	}	?>
			</div>
			<div class="" id="mikrorajony_malinovskij">    <?php //mikrorajony-malinovskij ?>
				<?php
					foreach ($optin_mikrorajony_malinovskij->options as $key => $val){
						if($val->value)	{  ?>
							<label for="mikrorajony_malinovskij<?= $val->value ?>">
								<input type="radio" name="mikrorajonyn" value="<?= $val->value ?>" id="mikrorajony_malinovskij<?= $val->value ?>"  <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val->value ) ? 'checked' : null ?>>
								<?= $val->name ?>
							</label>
						<?php	}	?>
					<?php	}	?>
			</div>
			<div class="" id="mikrorajony_ovidiopolskij">    <?php //mikrorajony_ovidiopolskij ?>
				<?php
					foreach ($optin_mikrorajony_ovidiopolskij->options as $key => $val){
						if($val->value)	{  ?>
							<label for="mikrorajony_ovidiopolskij<?= $val->value ?>">
								<input type="radio" name="mikrorajonyn" value="<?= $val->value ?>" id="mikrorajony_ovidiopolskij<?= $val->value ?>"  <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val->value ) ? 'checked' : null ?>>
								<?= $val->name ?>
							</label>
						<?php	}	?>
					<?php	}	?>
			</div>
			<div class="" id="mikrorajony_primorskij">    <?php //mikrorajony_primorskij ?>
				<?php
					foreach ($optin_mikrorajony_primorskij->options as $key => $val){
						if($val->value)	{  ?>
							<label for="mikrorajony_primorskij<?= $val->value ?>">
								<input type="radio" name="mikrorajonyn" value="<?= $val->value ?>" id="mikrorajony_primorskij<?= $val->value ?>"  <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val->value ) ? 'checked' : null ?>>
								<?= $val->name ?>
							</label>
						<?php	}	?>
					<?php	}	?>
			</div>
			<div class="" id="mikrorajony_suvorovskij">    <?php //mikrorajony_suvorovskij ?>
				<?php
					foreach ($optin_mikrorajony_suvorovskij->options as $key => $val){
						if($val->value)	{  ?>
							<label for="mikrorajony_suvorovskij<?= $val->value ?>">
								<input type="radio" name="mikrorajonyn" value="<?= $val->value ?>" id="mikrorajony_suvorovskij<?= $val->value ?>"  <?= ($_GET['mikrorajonyn'] && $_GET['mikrorajonyn'] === $val->value ) ? 'checked' : null ?>>
								<?= $val->name ?>
							</label>
						<?php	}	?>
					<?php	}	?>
			</div>
		</div>
	</div>
	<hr>


	<div class="">
		ploshchad-obshchaya-m2: <br>
		<input type="text" name="ploshchad_obshchaya_ot" placeholder="от_____" id="ploshchad_obshchaya_ot" value="<?= ($_GET['ploshchad_obshchaya_ot'] ? $_GET['ploshchad_obshchaya_ot'] : null)?>">
		<input type="text" name="ploshchad_obshchaya_do" placeholder="до_____" id="ploshchad_obshchaya_do" value="<?= ($_GET['ploshchad_obshchaya_do'] ? $_GET['ploshchad_obshchaya_do'] : null)?>">
	</div>

	<div class="">
		tsena_ot: <br>
		<input type="text" name="tsena_ot" value="<?= ($_GET['tsena_ot'] ? $_GET['tsena_ot'] : null)?>" placeholder="от_____"   id="tsena_do">
		<input type="text" name="tsena_do" value="<?= ($_GET['tsena_do'] ? $_GET['tsena_do'] : null)?>" placeholder="до_____" id="tsena_do">
	</div>

	<div class="">
		kol-vo-komnat: <br>
		<input type="text" name="kol_vo_komnat_ot"id="kol_vo_komnat_ot" value="<?= ($_GET['kol_vo_komnat_ot'] ? $_GET['kol_vo_komnat_ot'] : null)?>" placeholder="от_____" >
		<input type="text" name="kol_vo_komnat_do"id="kol_vo_komnat_do" value="<?= ($_GET['kol_vo_komnat_do'] ? $_GET['kol_vo_komnat_do'] : null)?>" placeholder="до_____">
	</div>

	<div class="">
		kol_vo_sanuzlov: <br>
		<input type="text" name="kol_vo_sanuzlov_ot" id="kol_vo_sanuzlov_ot" value="<?= ($_GET['kol_vo_sanuzlov_ot'] ? $_GET['kol_vo_sanuzlov_ot'] : null)?>" placeholder="от_____" >
		<input type="text" name="kol_vo_sanuzlov_do" id="kol_vo_sanuzlov_do" value="<?= ($_GET['kol_vo_sanuzlov_do'] ? $_GET['kol_vo_sanuzlov_do'] : null)?>" placeholder="до_____">
	</div>

	<div class="">
		ploshchad_kukhni: <br>
		<input type="text" name="ploshchad_kukhni_ot" id="ploshchad_kukhni_ot" value="<?= ($_GET['ploshchad_kukhni_ot'] ? $_GET['ploshchad_kukhni_ot'] : null)?>" placeholder="от_____" >
		<input type="text" name="ploshchad_kukhni_do" id="ploshchad_kukhni_do" value="<?= ($_GET['ploshchad_kukhni_do'] ? $_GET['ploshchad_kukhni_do'] : null)?>" placeholder="до_____">
	</div>

	<div class="">
		ploshchad_zhilaya: <br>
		<input type="text" name="ploshchad_zhilaya_ot" id="ploshchad_zhilaya_ot" value="<?= ($_GET['ploshchad_zhilaya_ot'] ? $_GET['ploshchad_zhilaya_ot'] : null)?>" placeholder="от_____" >
		<input type="text" name="ploshchad_zhilaya_do" id="ploshchad_zhilaya_do" value="<?= ($_GET['ploshchad_zhilaya_do'] ? $_GET['ploshchad_zhilaya_do'] : null)?>" placeholder="до_____">
	</div>
	<hr>

	<div class="">
		sostoyanie-remont: <br>
		<div id="sostoyanie_remont">
			<label for="sostoyanie_remont_0">
				<input type="radio" name="sostoyanie_remont" value="0" id="sostoyanie_remont_0"  <?= (!isset($_GET['sostoyanie_remont']) || $_GET['sostoyanie_remont'] ==='0' ) ? 'checked' : null ?>>
				Все ремонты
			</label>
			<?php
				foreach ($optin_sostoyanie_remont->options as $key => $val){
					if($val->value)	{  ?>
						<label for="sostoyanie_remont_<?= $val->value ?>">
							<input type="radio" name="sostoyanie_remont" value="<?= $val->value ?>" id="sostoyanie_remont_<?= $val->value ?>"  <?= ($_GET['sostoyanie_remont'] && $_GET['sostoyanie_remont'] === $val->value ) ? 'checked' : null ?>>
							<?= $val->name ?>
						</label>
					<?php	}	?>
				<?php	}
			?>
		</div>
	</div>
	<hr>

	<div class="">
		tip-kommercheskoj-nedvizhimosti: <br>
		<div id="tip_kom_nedviz">
			<label for="tip_kom_nedviz_0">
				<input type="radio" name="tip_kom_nedviz" value="0" id="tip_kom_nedviz_0"  <?= (!isset($_GET['tip_kom_nedviz']) || $_GET['tip_kom_nedviz'] ==='0' ) ? 'checked' : null ?>>
				Все ремонты
			</label>
			<?php
				foreach ($tip_kommercheskoj_nedvizhimosti->options as $key => $val){
					if($val->value)	{  ?>
						<label for="tip_kom_nedviz_<?= $val->value ?>">
							<input type="radio" name="tip_kom_nedviz" value="<?= $val->value ?>" id="tip_kom_nedviz_<?= $val->value ?>"  <?= ($_GET['tip_kom_nedviz'] && $_GET['tip_kom_nedviz'] === $val->value ) ? 'checked' : null ?>>
							<?= $val->name ?>
						</label>
					<?php	}	?>
				<?php	}
			?>
		</div>
	</div>
	<hr>
	<div class="">
		raspolozhenie_kommercheskoj_nedvizhimosti: <br>
		<div id="raspolz_kom_nedvz">
			<label for="raspolz_kom_nedvz_0">
				<input type="radio" name="raspolz_kom_nedvz" value="0" id="raspolz_kom_nedvz_0"  <?= (!isset($_GET['tip_kom_nedviz']) || $_GET['tip_kom_nedviz'] ==='0' ) ? 'checked' : null ?>>
				Все расположения
			</label>
			<?php
				foreach ($raspolozhenie_kommercheskoj_nedvizhimosti->options as $key => $val){
					if($val->value)	{  ?>
						<label for="raspolz_kom_nedvz_<?= $val->value ?>">
							<input type="radio" name="raspolz_kom_nedvz" value="<?= $val->value ?>" id="raspolz_kom_nedvz_<?= $val->value ?>"  <?= ($_GET['raspolz_kom_nedvz'] && $_GET['raspolz_kom_nedvz'] === $val->value ) ? 'checked' : null ?>>
							<?= $val->name ?>
						</label>
					<?php	}	?>
				<?php	}
			?>
		</div>
	</div>
	<hr>

	<div class="">
		etazhnost_zdaniya: <br>
		<input type="text" name="etazhnost_zdaniya_ot" id="etazhnost_zdaniya_ot" value="<?= ($_GET['etazhnost_zdaniya_ot'] ? $_GET['etazhnost_zdaniya_ot'] : null)?>" placeholder="от_____">
		<input type="text" name="etazhnost_zdaniya_do" id="etazhnost_zdaniya_do" value="<?= ($_GET['etazhnost_zdaniya_do'] ? $_GET['etazhnost_zdaniya_do'] : null)?>" placeholder="до_____">
	</div>

	<div class="">
		kolichestvo_sotok_zemli: <br>
		<input type="text" name="kolichestvo_sotok_zemli_ot" id="kolichestvo_sotok_zemli_ot" value="<?= ($_GET['kolichestvo_sotok_zemli_ot'] ? $_GET['kolichestvo_sotok_zemli_ot'] : null)?>" placeholder="от_____">
		<input type="text" name="kolichestvo_sotok_zemli_do" id="kolichestvo_sotok_zemli_do" value="<?= ($_GET['kolichestvo_sotok_zemli_do'] ? $_GET['kolichestvo_sotok_zemli_do'] : null)?>" placeholder="до_____">
	</div>

	<!--	<div class="">-->
	<!--		etazhnost_zdaniya: <br>-->
	<!--		<input type="text" name="etazhnost_zdaniya_ot" id="etazhnost_zdaniya_ot" value="--><?//= ($_GET['etazhnost_zdaniya_ot'] ? $_GET['etazhnost_zdaniya_ot'] : null)?><!--" placeholder="от_____">-->
	<!--		<input type="text" name="etazhnost_zdaniya_do" id="etazhnost_zdaniya_do" value="--><?//= ($_GET['etazhnost_zdaniya_do'] ? $_GET['etazhnost_zdaniya_do'] : null)?><!--" placeholder="до_____">-->
	<!--	</div>-->

	<br>
	<input type="submit" value="KS GO">
</form>

 */
