<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$valor   = $_GET['valor'];   
	$usuario = $_GET['usuario'];
	if(isset($_GET['filtro'])){
		$filtro  = $_GET['filtro'];
	}else{
		$filtro  = "";	
	}
	$contador = 0;
		
	if($valor == "OPT_ENEM"){
		$sql = "SELECT a.idPROVA, '', a.descricao, a.anoprova, a.periodo ".
		       "  FROM PROVAS a ".
			   " WHERE a.idUNIVER = 0 ".
			   "   AND not exists (select b.idPROVA from PROVAS_USU b where b.idPROVA = a.idPROVA and b.idUSUARIO = ".$usuario.") ".
			   " order by a.anoprova desc, a.periodo desc"; 
	
		// Procura titulos no banco relacionados ao valor 
		$result = mysql_query($sql,$con);
				
		echo '<div class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';
		// Exibe todos os valores encontrados 
		while ($cursos = mysql_fetch_row($result)) { 
			$contador = $contador + 1;
			echo '<li onclick="selecionaProva(this.id);" class="table-view-cell widget uib_w_28" data-uib="ratchet/list_item" data-ver="0" id="option_'.$cursos[0].'" value="'.$cursos[0].'">';
			
			echo '  <a href="#" class="list-group-item"  ';
			echo '    <h5 class="list-group-item-heading">'.$cursos[2].'</h5> ';
			echo '    <p class="list-group-item-text">'.$cursos[1].'</p>';  
			echo '    <span class="badge">'.$cursos[3].'/'.$cursos[4].'</span> ';
			echo '  </a>';
			echo '</li>';
			//echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id."')\">" . $noticias->titulo . "</a><br />"; 
		}
		
		echo '</div>';
		if($contador == 0){
			echo 'Não existem novas provas nessa categoria.';
		}else{
			echo '</br> ';
			echo '<a onclick="insereProvasSelecionadas();" class="btn widget uib_w_49 btn-default d-margins btn-block btn-primary" data-uib="ratchet/button" data-ver="0">Adicionar<span class="icon icon-plus button-icon-right" data-position="right"></span></a>';
		}
		
	}
	
	if($valor == "OPT_FACULDADE"){
		if(strlen($filtro) > 0){ 
			$sql_filtro = " where Nome like '%".$filtro."%' or Sigla like '%".$filtro."%' " ;
		}else{
			$sql_filtro = "";
		}
		
		$sql = "SELECT idUNIVER, Nome, Sigla from UNIVERSIDADE " .
		       $sql_filtro.
			   " Order by Sigla"; 
		
		// Procura titulos no banco relacionados ao valor 
		$result = mysql_query($sql,$con);
				
		echo '<div class="table-view widget uib_w_27 d-margins" data-uib="ratchet/list_group" data-ver="0">';
		// Exibe todos os valores encontrados 
		while ($cursos = mysql_fetch_row($result)) {  
			$contador = $contador + 1;
			echo '<li onclick="marcaUniver(this.id);" class="table-view-cell widget uib_w_28" data-uib="ratchet/list_item" data-ver="0" id="option_'.$cursos[0].'" value="'.$cursos[0].'">';
			
			echo '  <a href="#" class="list-group-item"  ';
			echo '    <h5 class="list-group-item-heading">'.$cursos[2].'</h5> ';
			echo '    <p class="list-group-item-text">'.$cursos[1].'</p>';  
			echo '  </a>';
			echo '</li>';
		}
		
		echo '</div>';
		if($contador == 0){
			echo 'Não existem universidades para adicionar.';
		}else{
			echo '</br> ';
			echo '<a onclick="buscaProvasUniver();" class="btn widget uib_w_49 btn-default d-margins btn-block btn-primary" data-uib="ratchet/button" data-ver="0">Buscar<span class="icon icon-search button-icon-right" data-position="right"></span></a>';
		}
		
	}
	
	
	
	mysql_close($con); 
	
	header("Content-Type: text/html; charset=ISO-8859-1",true); 
?>
