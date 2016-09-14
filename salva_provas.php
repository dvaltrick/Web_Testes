<?PHP
	require 'funcoes.php';
	
	$con = conectaBanco();
	
	// Recebe o valor enviado 
	$valor = $_GET['valor'];   
	$usuario = $_GET['usuario'];
	$arr_pos = 0;
	
	$array_provas = array();
	$i = 0;
	$tamanho = strlen($valor);
	$strAux = '';
	
	for($i=0;$i<$tamanho;$i++){
		if($valor[$i] == '|'){
			$sql = "INSERT INTO PROVAS_USU (idPROVA,idUSUARIO,NotaCorteCurso,NotaObtida,InStatus) Values (".$strAux.",".$usuario.",0,0,0) ";
			$result = mysql_query($sql,$con);

			$strAux = '';
		}else{
			$strAux = $strAux.$valor[$i];
		}
	}
	
	echo '1|Sucesso;';
	
	mysql_close($con); 
	
?>
