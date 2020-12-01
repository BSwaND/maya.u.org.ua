<?php

 $pdo_tst =  new PDO('mysql:host=195.138.64.213;dbname=maya-trach;port=63306', 'maya-trach', 'maya-trach');
 $tst = 'SELECT * FROM `y3x4d_osrs_properties`';

 //$tst = $pdo->prepare($pdo_tst);
// $tst->bindValue(':id', $id);
$tst->execute();
 $result = $tst->fetch(PDO::FETCH_ASSOC);

	print_r($result);


	/*
 
 {
		 $pdo = static::connect();
 $sql = 'SELECT * FROM `' . static::getTable() . '` WHERE `id` = :id';
 $stmt = $pdo->prepare($sql);
 $stmt->bindValue(':id', $id);
 $stmt->execute();
 $result =  $stmt->fetch(PDO::FETCH_ASSOC);
 $instants = new static();
 static::errorInfo($stmt);
 
 foreach ($result as $key=>$val){
			 $methodName = 'set'.$key;
 $instants->$methodName($val);
 }
		 return $instants;
 
