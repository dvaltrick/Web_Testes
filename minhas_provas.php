<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$usuario = $_GET['usuario'];

	$sql = "SELECT a.idPROVA, b.Descricao,c.Sigla, b.AnoProva, b.Periodo, c.Nome FROM PROVAS_USU a\n"
    . " LEFT JOIN PROVAS b on b.idPROVA = a.idPROVA\n"
    . " LEFT JOIN UNIVERSIDADE c on c.idUNIVER = b.idUNIVER\n"
    . "where a.idUSUARIO = ".$usuario. " ; " ;
	
	// Procura titulos no banco relacionados ao valor 
	$result = mysql_query($sql,$con);
			
	echo '<div class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';
	// Exibe todos os valores encontrados 
	while ($provas = mysql_fetch_row($result)) { 
		echo '<li onclick="comecaProva(this.id);" class="table-view-cell widget uib_w_28" data-uib="ratchet/list_item" data-ver="0" id="minha_prova_'.$provas[0].'" value="'.$provas[0].'">';
		
		echo '  <a href="#" class="list-group-item"  ';
		
		if($provas[2] != ''){
			echo '    <h5 class="list-group-item-heading">'.$provas[2].' - '.$provas[3].'/'.$provas[4].'</h5> ';
		    echo '    <p class="list-group-item-text">'.$provas[1].'</p>';  
		}else{
			echo '    <h5 class="list-group-item-heading">'.$provas[1].' - '.$provas[3].'/'.$provas[4].'</h5> ';		
		}
		echo '  </a>';
		echo '</li>';
		//echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />"; 
	}
	echo '</div>';
	echo '</br> ';
	echo '<a onclick="comecaProva();" class="btn widget uib_w_49 btn-default d-margins btn-block btn-primary" data-uib="ratchet/button" data-ver="0">Começar<span class="icon icon-plus button-icon-right" data-position="right"></span></a>';
	
	
	mysql_close($con); 
	
	header("Content-Type: text/html; charset=ISO-8859-1",true); 
?>
