<?php
	header("charset=utf-8");
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$banco = "capital_buffet";


	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
	global $mysqli;
