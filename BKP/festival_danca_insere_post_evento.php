<?php
    
    require('conecta_banco.php');
    
    $idEvento = $_GET['EVENTO_ID'];
    $facebookid = $_GET['USER_ID'];
    $facebook_user = $_GET['USER_NAME'];
    $post = $_GET['POST'];
    
    $con = conectaBanco();
    
    $sql = "SELECT count(*) " .
           "  FROM evento_posts " . 
           " WHERE idEvento = " . $idEvento;
    
    $result = mysql_query($sql,$con);
		
    while($result_row = mysql_fetch_row($result))
    {
        $newSeq = $result_row[0];
    }
    
    $dtAlteracao = getdate();
    
    $sql = "INSERT INTO evento_posts VALUES (".$idEvento.",".
                                               $newSeq.",".
                                               "'".$facebookid."',".
                                               "'".$facebook_user."',".
                                               "'".$post."',".
                                               "0,".
                                               "'".$dtAlteracao."' );"; 
    
    if(mysql_query($sql,$con)){
        echo $newSeq.";".$dtAlteracao.";";
    }else{
        echo "0;0;";
    }
    
    mysql_close($con);
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>