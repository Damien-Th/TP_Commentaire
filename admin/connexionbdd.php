<?php

try
{
	$bdd = new PDO('mysql:host=localhost:3306;dbname=test;charset=utf8', 'xxx', 'xxx');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
