<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$usuario = $_GET['usuario'];
	$prova   = $_GET['prova'];

	$sql = "SELECT MAX(idQUESTAO) "
    . " FROM QUESTOES_PROVA_USU "
    . " where idUSUARIO = ".$usuario
    . " and idPROVA = ".$prova;	

	$result = mysql_query($sql,$con);
	$ult_questao = mysql_result($result,0);
	$ult_questao = $ult_questao + 1;
	
	$sql = "SELECT a.idQuestao, a.Texto, a.idOpcaoCorreta, b.Descricao "
    . " FROM QUESTOES a "
    . " left join MATERIAS b on b.idMATERIA = a.idMATERIA "
    . " WHERE a.idPROVA = ".$prova
    . " and a.idQUESTAO = ".$ult_questao;
	$result = mysql_query($sql,$con);
	
	while ($questao = mysql_fetch_row($result)) { 
		echo ' <div class="grid grid-pad urow uib_row_6 caixa_tit" data-uib="layout/row" data-ver="0"> ';
        echo '         <span class="uib_shim"></span> ';
        echo '         <div class="col uib_col_9 col-0" data-uib="layout/col" data-ver="0"> ';
        echo '             <div class="widget-container content-area vertical-col"> ';
        echo '                 <div class="widget uib_w_48 d-margins TIT_DASH" data-uib="media/text" data-ver="0"> ';
        echo '                     <div class="widget-container left-receptacle"></div> ';
        echo '                     <div class="widget-container right-receptacle"></div> ';
        echo '                     <div> ';
        echo '                         <p id="label_questao" value="'.$questao[0].'">'.$questao[0].' - '.$questao[3].'</p> ';
        echo '                     </div> ';
        echo '                 </div><span class="uib_shim"></span> ';
        echo '             </div> ';
        echo '         </div> ';
        echo '     </div> ';
		echo '     </br> ';
		echo $questao[1];
		echo '     </br> ';
	 	 
	}
	
	$sql = "SELECT idAlternativa, CodApresent, Texto "
    . " FROM ALTERNATIVA "
    . " WHERE idPROVA = " .$prova
	. "   AND idQUESTAO = ".$ult_questao
    . " order by idALTERNATIVA ";
	
	$result = mysql_query($sql,$con);

	echo '<div class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';

	while ($alternativas = mysql_fetch_row($result)) { 
		echo '<li onclick="marcaQuestao(this.id);" class="table-view-cell widget uib_w_28" data-uib="ratchet/list_item" data-ver="0" id="option_'.$alternativas[0].'" value="'.$alternativas[0].'">';
		
		echo '  <a href="#" class="list-group-item"  ';
		echo '    <p class="list-group-item-text">'.$alternativas[1].') '.$alternativas[2].'</p>';  
		echo '  </a>';
		echo '</li>';
	
	}
	echo ' </div> '; 
	
	echo '<a onclick="respondeQuestao();" class="btn widget uib_w_49 btn-default d-margins btn-block btn-primary" data-uib="ratchet/button" data-ver="0">Responder<span class="icon icon-check button-icon-right" data-position="right"></span></a>';
	
	mysql_close($con); 
	
	header("Content-Type: text/html; charset=ISO-8859-1",true); 
?>
	