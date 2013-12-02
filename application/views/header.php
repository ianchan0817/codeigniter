<!DOCTYPE HTML>
<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta -->
<?php 
	$names = array_keys($meta);
	$values = array_values($meta);
	for ($pos = 0; $pos < count($meta); $pos++):
?>
<meta name="<?=$names[$pos]?>" content="<?=$values[$pos]?>">	
<?php endfor; ?>

<!-- Javascript -->
<?php foreach($javascript as $row): ?>
<script type="text/javascript" src="<?=base_url("assets/js/$row.js")?>"></script>
<?php endforeach; ?>

<!-- CSS -->
<?php foreach($css as $row): ?>
<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/$row.css")?>">
<?php endforeach; ?>

</head>

<body>
<header>
	<h1>Header</h1>
</header>

<nav>
<ul>
    <li><?=anchor("language/english", "EN", array('title'=>'english'))?></li>
    <li><?=anchor("language/zh_tw", "ZH", array('title'=>'traditional chinese'))?></li>
</ul>
</nav>

<div id="container">
 