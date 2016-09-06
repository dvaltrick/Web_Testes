<?php
    require('conecta_banco.php');
    
    $con = conectaBanco();
    
    $sql = "SELECT idEvento, dsNomeEvento ,dsObservacao , dtEvento , inCurtiuEvento , inTipoEvento, dtAlteracao " .
           "  FROM eventos ";
    
    if(isset($_GET['DATA_ALTERACAO'])){
        $sql = $sql . " WHERE dtAlteracao > " . $_GET['DATA_ALTERACAO']  ;
    }
    
    $result = mysql_query($sql,$con);
		
    while($result_row = mysql_fetch_row($result))
    {
        echo  $result_row[0] . ";" . $result_row[1] . ";" . $result_row[2] . ";" . $result_row[3] . ";" . 
             $result_row[4] . ";" . $result_row[5] . ";";
    }
    mysql_close($con);
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>