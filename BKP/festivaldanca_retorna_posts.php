<?php

    require('conecta_banco.php');
    
    $idEvento = $_GET['EVENTO_ID'];

    $con = conectaBanco();
    
    $sql = "SELECT nrSeqPost, facebookid, facebook_user, dsPost, inCurtiu " .
           "  FROM evento_posts " . 
           " WHERE idEvento = " . $idEvento;

    $result = mysql_query($sql,$con);
		
    while($result_row = mysql_fetch_row($result))
    {
        echo  $result_row[0] . ";" . $result_row[1] . ";" . $result_row[2] . ";" . $result_row[3] . ";" . 
             $result_row[4] . ";";
    }
    
    mysql_close($con);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
