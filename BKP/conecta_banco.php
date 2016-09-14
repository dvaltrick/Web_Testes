<?php
    function conectaBanco(){
        //$con = mysql_connect("localhost","root","");
	$con = mysql_connect("mysql.hostinger.com.br", "u717772537_diego", "festivaldiego");
        if(!$con){
            die ('FALHA DE CONEXÃO');
	}
		
	$db_select=mysql_select_db('u717772537_fstvl');
	if (!$db_select)
	{
		die ("BASE NÃO SELECIONADA");
	}
		
	return $con;
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

