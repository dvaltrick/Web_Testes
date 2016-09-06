<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$usuario  = $_GET['usuario'];
	$prova    = $_GET['prova'];
	$resposta = $_GET['resposta'];
	
	$sql = "SELECT MAX(idQUESTAO) "
    . " FROM QUESTOES_PROVA_USU "
    . " where idUSUARIO = ".$usuario
    . " and idPROVA = ".$prova;	

	$result = mysql_query($sql,$con);
	$questao = mysql_result($result,0);
	$questao = $ult_questao + 1;
	
	$sql = "SELECT idOpcaoCorreta FROM QUESTOES WHERE idQUESTAO = ".$questao." and idPROVA = ".$prova ;
	$result = mysql_query($sql,$con);
	$correto = mysql_result($result,0);
	
	if($correto == $resposta){
		$certo = 1;
	}else{
		$certo = 0;
	}
	
	$sql = "INSERT INTO QUESTOES_PROVA_USU (idPROVA,idUSUARIO, idQUESTAO, inResult) VALUES (".$prova.", ".$usuario.", ".$questao.", ".$certo.")" ;
	if(mysql_query($sql,$con)){
		$sql = "SELECT a.idQuestao, b.Descricao, a.Texto "
		. " FROM QUESTOES a "
		. " left join MATERIAS b on b.idMATERIA = a.idMATERIA "
		. " WHERE a.idPROVA = ".$prova
		. " and a.idQUESTAO = ".$questao;
		$result = mysql_query($sql,$con);
		
		while ($questao_res = mysql_fetch_row($result)) { 
			echo ' <div class="grid grid-pad urow uib_row_6 caixa_tit" data-uib="layout/row" data-ver="0"> ';
			echo '         <span class="uib_shim"></span> ';
			echo '         <div class="col uib_col_9 col-0" data-uib="layout/col" data-ver="0"> ';
			echo '             <div class="widget-container content-area vertical-col"> ';
			echo '                 <div class="widget uib_w_48 d-margins TIT_DASH" data-uib="media/text" data-ver="0"> ';
			echo '                     <div class="widget-container left-receptacle"></div> ';
			echo '                     <div class="widget-container right-receptacle"></div> ';
			echo '                     <div> ';
			echo '                         <p id="label_questao">'.$questao_res[0].' - '.$questao_res[1].'</p> ';
			echo '                     </div> ';
			echo '                 </div><span class="uib_shim"></span> ';
			echo '             </div> ';
			echo '         </div> ';
			echo '     </div> ';
			echo '     </br> ';
			echo $questao_res[2];
			echo '     </br> ';
						
		}
	
		$sql = "SELECT CodApresent, Texto,idALTERNATIVA FROM ALTERNATIVA WHERE idQUESTAO = ".$questao." and idPROVA = ".$prova. " and idALTERNATIVA in (".$correto.",".$resposta.") " ;
		$result = mysql_query($sql,$con);
		echo '</br> ';
		echo '<div  class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';
			
		while ($alternativas = mysql_fetch_row($result)) { 
			if($correto == $alternativas[2]){
				$style = ' CORRETO';
			}else{
				$style = ' ERRADO';
			}	

    		echo '<li class="table-view-cell widget uib_w_28 '.$style.'" data-uib="ratchet/list_item" data-ver="0"  id="option_'.$alternativas[0].'" value="'.$alternativas[0].'">';	
			echo '  <a href="#" class="list-group-item"  ';
			echo '    <p class="list-group-item-text">'.$alternativas[0].') '.$alternativas[1].'</p>';  
			echo '  </a>';
			echo '</li>';
		
		}
		echo ' </div> '; 

		 
	}
	
	mysql_close($con); 
	
	header("Content-Type: text/html; charset=ISO-8859-1",true); 
?>
	