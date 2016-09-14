<?PHP
	require 'funcoes.php';
	
	$nomeComp  = "";	
	$nomeUsu   = "";
	$senha     = "";
	$email     = "";
	$tamanho   = 0;
	
	if(isset($_GET['nome'])){
		$nomeComp  = @$_GET['nome'];
		$nomeUsu   = @$_GET['usuario'];
		$senha     = @$_GET['senha'];
		$email     = @$_GET['email'];
		$curso     = @$_GET['curso'];
		
		$con = conectaBanco();	
				
		$sql = "Select count(*) from USUARIO Where usuario = '".$nomeUsu."' ";
			
		$result = mysql_query($sql,$con);
		$val = mysql_result($result,0);
		
		if($val == 0){	
            $sql = "INSERT INTO USUARIO(usuario,senha,nome,email,idCURSO) VALUES('".$nomeUsu."','".md5($senha)."','".$nomeComp."','".$email."','".$curso."');";
			
			if(mysql_query($sql,$con)){
			    $sql = "Select idUsuario from USUARIO Where usuario = '".$nomeUsu."' ";
			
				$result = mysql_query($sql,$con);
				$val = mysql_result($result,0);
				
				echo '1|'.$val.';';
			}else{
				echo '0|Problema na inserção do usuário;';
			} 
		}else{
			echo '0|O nome de usuário já existe;';
		}
		
		mysql_close($con);
	}
	
?>
