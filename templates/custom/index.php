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

	// Подключение своих стилей:
	JHtml::_('stylesheet', 'bootstrap-grid.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'animate.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'jquery.fancybox.min.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'swiper.min.css', array('version' => 'v=0', 'relative' => true));
	JHtml::_('stylesheet', 'style.css', array('version' => 'v=0', 'relative' => true));


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
				<a href="/" class="logo"><img src="/templates/custom/images/logo.png" alt="logo"></a>
				<div class="header-content">
					<div class="header-top">
						<a href="+380487000000" class="icon-tel">+380 (48) 700-00-00</a>
						<div class="messenger-links">
							<a href="tg://resolve/?domain=Maya_7000000" class="icon-telegram"></a>
							<a href="viber://chat?number=+380949523000" class="icon-viber"></a>
							<a href="whatsapp://send?phone=+380949523000" class="icon-whatsapp"></a>
						</div>
						<div class="compare-box">
							<a href="#" class="icon-balance"></a>
							<span class="counter">1</span>
						</div>
					</div>
					<div class="header-bottom">
						<jdoc:include type="modules" name="main-menu" style="none" />
						<i class="icon-search"></i>
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

</div>


<!--<jdoc:include type="modules" name="position-7" style="none" />-->
<!--<jdoc:include type="modules" name="position-2" style="none" />-->


<footer class="footer">
	<div class="container">
		<p>
			<span class="copy">©</span><?php echo date('Y');?>.
			<a href="https://sofona.com/" target="_blank">"Sofona.com".</a>
			<?php  echo JText::_('TPL_CUSTOM_XML_DESCRIPTION'); ?>
		</p>
	</div>
	<jdoc:include type="modules" name="footer" style="none" />
</footer>

<jdoc:include type="modules" name="mobile-menu" style="none" />

<!-- Подключение скриптов в конце документа -->
<!--<script src="/templates/--><?php //echo $this->template; ?><!--/js/jquery-3.3.1.min.js"></script>-->
<script src="/templates/<?php echo $this->template; ?>/js/wow.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/jquery.fancybox.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/swiper.min.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/script.js"></script>
<script src="/templates/<?php echo $this->template; ?>/js/custom.js"></script>
<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMap"></script>
</body>
</html>