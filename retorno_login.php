<?PHP
	require 'funcoes.php';

	$usuario = $_GET['usuario'];
	$senha   = $_GET['senha'];
	
	$con = conectaBanco();
	
	$sql = "SELECT senha FROM USUARIO WHERE usuario = '".$usuario."' ";
	
	$result = mysql_query($sql,$con);
	$val = mysql_result($result,0);
	$usuario_id = mysql_result($result,1);
	
	if($val == md5($senha)){
	    $sql = "SELECT idUSUARIO FROM USUARIO WHERE usuario = '".$usuario."' ";
		$result = mysql_query($sql,$con);
		$usuario_id = mysql_result($result,0);
	
		echo '1|'.$usuario_id.';';
	}else{
		echo '0|Usuário ou senha inválido;';
	}
	
	mysql_close($con);

?>
