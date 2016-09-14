<?PHP
	require 'funcoes.php';
	
	$usuario = $_GET['usuario'];
	$senha   = $_GET['senha'];
	
	$con = conectaBanco();
	
	$sql = "SELECT hashSenha FROM usuario WHERE nomeUsuario = '".$usuario."' ";
	
	$result = mysql_query($sql,$con);
	$val = mysql_result($result,0);
		
	if($val == md5($senha)){
	    session_start("euconto");
		$_SESSION["nome_usuario"] = $usuario;
		
		header("Location: principal.php");
	}else{
		header("Location: index.html");
	}
	
	mysql_close($con);
	
?>