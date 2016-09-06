<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$valor = $_GET['valor'];   
		
	// Procura titulos no banco relacionados ao valor 
	$sql = "SELECT idCURSO,Descricao FROM CURSOS WHERE Descricao LIKE '%".$valor."%' LIMIT 10";   
	$result = mysql_query($sql,$con);
			
	echo '<div class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';
	// Exibe todos os valores encontrados 
	while ($cursos = mysql_fetch_row($result)) { 
		echo '<li class="table-view-cell widget uib_w_28" data-uib="ratchet/list_item" data-ver="0" onclick="selecionaCurso(this.id);" id="option_'.$cursos[0].'" value="'.$cursos[0].'">'.$cursos[1].'</li>';
		//echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />"; 
	}
	
	echo '</div>';

	mysql_close($con); 
	
	header("Content-Type: text/html; charset=ISO-8859-1",true); 
?>
