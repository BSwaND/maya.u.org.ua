<?php
	define( '_JEXEC', 1 );
	define( 'DS', DIRECTORY_SEPARATOR );
	define( 'JPATH_BASE', $_SERVER[ 'DOCUMENT_ROOT' ] );

	require_once( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
	require_once( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );
	$mainframe = JFactory::getApplication('site');
	$session = JFactory::getSession();

	$atrProduct =  $_POST['dataIdProduct'];
	$atrProductDell =  $_POST['dataIdProductDell'];

	if($atrProductDell)
	{
		$session->clear('dataIdProduct');
	}

		$cookieIdProduct = $session->get('dataIdProduct') ;
		if(!$cookieIdProduct)
		{
			$session->set('dataIdProduct',  $atrProduct);
		} else{
			$cookieIdProduct .= ', '.$atrProduct;
			$session->set('dataIdProduct', $cookieIdProduct);
		}

		$countId = count(array_unique((explode(',', $cookieIdProduct))));


	//$session->clear('dataIdProduct');

	print_r($countId );
	//print_r($atrProductDell );

