<?php

	defined('_JEXEC') or die;

	$myScript = true; // если "true" - то отключаем все стандатрные скрипты и подключаем свои (в том числе и jQuery)
	$app  = JFactory::getApplication();
	$user = JFactory::getUser();
	$this->setHtml5(true);
	$params = $app->getTemplate(true)->params;
	$menu = $app->getMenu()->getActive();
	$document = JFactory::getDocument();
	$document->setGenerator('');
	$template_url = JUri::root().'templates/'.$this->template;
	$pageclass = '';
	if (is_object($menu))
		$pageclass = $menu->params->get('pageclass_sfx');

	$session = JFactory::getSession();

	
	$countIdSession = array_unique((explode(',', $session->get('dataIdProduct'))));
	$countIdSession = ($countIdSession[0]) ? count($countIdSession) : null ;

	// Подключение своих стилей:
	JHtml::_('stylesheet', 'bootstrap-grid.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'animate.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'jquery.fancybox.min.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'swiper.min.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'style.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'custom.css', array('version' => 'v=0', 'relative' => true));


	if ($myScript) { // при необходимости отключаем все скрипты и подключаем свежий jQuery (параметр выше)
		$this->_scripts = array();
		unset($this->_script['text/javascript']);
		JHtml::_('script', $template_url . '/js/jquery-3.3.1.min.js', array('version' => 'v=3.3.1'));
	}

	//Протокол Open Graph
	$pageTitle = $document->getTitle();
	$metaDescription = $document->getMetaData('description');
	$type = 'website';
	$view = $app->input->get('view', '');
	$id = $app->input->get('id', '');
	$image = JURI::base() . 'templates/custom/icon/logo.png';
	$title = !empty($pageTitle) ? $pageTitle : "default title";
	$desc = !empty($metaDescription) ? $metaDescription : "default description";

	if(!empty($view) && $view === 'article' && !empty($id))
	{
		$article = JControllerLegacy::getInstance('Content')->getModel('Article')->getItem($id);
		$type = 'article';
		$images = json_decode($article->images);
		$image = !empty($images->image_intro) ? JURI::base() . $images->image_intro : JURI::base() . $images->image_fulltext;
	}
	$document->addCustomTag('
    <meta property="og:type" content="'.$type.'" />
    <meta property="og:title" content="'.$title.'" />
    <meta property="og:description" content="'.$desc.'" />
    <meta property="og:image" content="'.$image.'" />
    <meta property="og:url" content="'.JURI :: current().'" />
');
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" prefix="og: http://ogp.me/ns#">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/templates/<?php echo $this->template; ?>/icon/favicon.ico"/>

	<jdoc:include type="head" />
</head>
<body class="<?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; ?>">

<div class="body-wrapper">
	<header class="header">
		<div class="container">
			<div class="flex between">
				<a href="/" class="logo icon-logo"></a>
				<div class="header-content">
					<div class="header-top">
						<a href="tel:+380487000000" class="icon-tel">+380 (48) 700-00-00</a>
						<div class="messenger-links">
							<a href="tg://resolve/?domain=Maya_7000000" class="icon-telegram"></a>
							<a href="viber://chat?number=+380949523000" class="icon-viber"></a>
							<a href="whatsapp://send?phone=+380949523000" class="icon-whatsapp"></a>
						</div>
						<div class="compare-box">
							<a href="/sravneniya" class="icon-balance"></a>
								<span class="<?= ($countIdSession) ? '' : null?> counter"><?= $countIdSession ?></span>
						</div>
					</div>
					<div class="header-bottom">
						<jdoc:include type="modules" name="main-menu" style="none" />
						<i class="icon-search show-search"></i>

						<jdoc:include type="modules" name="find" style="none" />
						<div class="burger-menu">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main>
		<jdoc:include type="component" />
	</main>


<footer class="footer">
	<div class="container">
		<div class="footer-top flex between">
			<div class="menu-block sitemap">
				<div class="title mb30">КАРТА САЙТА</div>
				<jdoc:include type="modules" name="footer-menu" style="none" />
			</div>
			<div class="menu-block flex between">
				<div class="menu-box">
					<div class="title mb30">ПРОДАЖА</div>
					<jdoc:include type="modules" name="footer-menu-sale" style="none" />
				</div>
				<div class="menu-box">
					<div class="title mb30">АРЕНДА</div>
					<jdoc:include type="modules" name="footer-menu-rent" style="none" />
				</div>				
			</div>
			<div class="regions-block">
				<div class="title mb15">РАЙОНЫ ОДЕССЫ</div>
				<div class="flex between">
					<a href="/rajony-odessy/primorskij-rajon/" class="region-item">
						<img src="/templates/custom/images/footer-pimorsky.jpg" alt="ПРИМОРСКИЙ РАЙОН">
						<span class="region-title">ПРИМОРСКИЙ РАЙОН</span>
					</a>
					<a href="/rajony-odessy/kievskij-rajon/" class="region-item">
						<img src="/templates/custom/images/footer-kievsky.jpg" alt="Киевский РАЙОН">
						<span class="region-title">Киевский РАЙОН</span>
					</a>
					<a href="/rajony-odessy/malinovskij-rajon/" class="region-item">
						<img src="/templates/custom/images/footer-malinovsky.jpg" alt="МАЛИНОВСКИЙ РАЙОН">
						<span class="region-title">МАЛИНОВСКИЙ РАЙОН</span>
					</a>
					<a href="/rajony-odessy/suvorovskij-rajon/" class="region-item">
						<img src="/templates/custom/images/footer-suvorovsky.jpg" alt="СУВОРОВСКИЙ РАЙОН">
						<span class="region-title">СУВОРОВСКИЙ РАЙОН</span>
					</a>
				</div>
			</div>
			<div class="links-block">
				<div class="title mb15">МЫ В СОЦСЕТЯХ:</div>
				<div class="flex social-links mb45">
					<a href="https://www.instagram.com/maya7000000/" class="icon-instagram" target="_blank"></a>
					<a href="https://www.facebook.com/%D0%A0%D0%B8%D1%8D%D0%BB%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F-%D0%BA%D0%BE%D0%BC%D0%BF%D0%B0%D0%BD%D0%B8%D1%8F-%D0%9C%D0%90%D0%98%D0%AF-278644515989790/?modal=admin_todo_tour" class="icon-facebook" target="_blank"></a>
					<a href="#" class="icon-youtube" target="_blank"></a>			
				</div>
				<div class="contact-links">
					<a href="https://goo.gl/maps/DNgbEWAugMEiC7AF8" class="icon-pin" target="_blank">г. Одесса, ул. Литературная 1</a>
					<a href="tel:+380487000000" class="icon-tel">+38 (048) 700 00 00</a>
				</div>
				

			</div>
		</div>
		<div class="footer-bottom">
			<div class="logo icon-logo"></div>
			<p class="copy">© 1997-<?php echo date('Y');?>.
			Майя - продажа недвижимости в Одессе. Все права защищены</p>
		</div>
	</div>
</footer>
</div>

<jdoc:include type="modules" name="mobile-menu" style="none" />

<div class="modal-form main-form-modal">
	<div class="form-wrapper">
		<div class="close">+</div>
		<p class="title small centered mb25"><b>Наше агенство готово вам помочь</b><br>оставьте свои координаты</p>
		<form id="mainForm" class="main-form" action="/templates/custom/html/telegram.php" method="post">			
			<div class="form-group">							
				<input id="nameMain" class="input" name="Имя" required="" type="text" />
				<label class="label" for="nameMain">Имя</label>
			</div>
			<div class="form-group">							
				<input id="phoneMain" class="input" name="Телефон" required="" type="tel" />
				<label class="label" for="phoneMain">Номер телефона</label>
			</div>
			<div class="form-group">							
				<textarea name="Комментарий" id="messageMain" cols="30" rows="5" class="input"></textarea>
				<label class="label" for="messageMain">Введите ваше сообщение</label>
			</div>
			<input type="hidden" name="host" value="<?php echo $_SERVER['HTTP_HOST']; ?>">
			<input type="hidden" name="uri" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<input type="hidden" id="mainFormLink" name="Ссылка" value="">
			<p class="fz12 centered mb25">*Ваши данные не будут передаваться третьим лицам</p> 
			<button class="btn" type="submit">Оставить заявку</button>
		</form>
	</div>
</div>
<?php if(isset($_GET['sended']) == 'true') : ?>
	<div class="modal-thanks modal-form open">
		<div class="wrapper">
			<div class="close">+</div>
			<i class="icon-check mb15"></i>
			<p class="title medium centered mb25">Благодарим за оставленную заявку! </p>
			<p class="centered">Наш менеджер свяжется с вами <br>в ближайшее время</p>
		</div>
	</div>
	
<?php endif ?>
<div class="contact-menu">
	<div class="icon-chat"></div>
	<a href="tel:+380487000000" class="link icon-tel"></a>
	<a href="tg://resolve/?domain=Maya_7000000" class="link icon-telegram"></a>
	<a href="viber://chat?number=+380949523000" class="link icon-viber"></a>
	<a href="whatsapp://send?phone=+380949523000" class="link icon-whatsapp"></a>
</div>

<!-- Подключение скриптов в конце документа -->
<script src="/templates/<?php echo $this->template; ?>/js/wow.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/jquery.fancybox.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/swiper.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/jquery.cookie.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/jquery.inputmasks.min.js"></script>
<?/*<script src="/templates/<?php echo $this->template; ?>/uForm/js/script.js"></script>*/?>
<script src="/templates/<?php echo $this->template; ?>/js/script.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/custom.js"></script>
<!--<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMap"></script>-->
<!--<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMapItem"></script>-->
<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMap&libraries=&v=weekly"></script>

</body>
</html>       