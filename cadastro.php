<?PHP
	require 'funcoes.php';
	
	$nomeComp  = "";	
	$nomeUsu   = "";
	$senha     = "";
	$confSenha = "";
	$email     = "";
	$dataNasc  = "";
	$arquivo   = ""; 
	$tamanho   = 0;
	$tipo      = "";
	$nome      = "";
	$estado    = "";
	$cidade    = "";
	
	if(isset($_POST['nomeComp'])){
		$nomeComp  = @$_POST['nomeComp'];
		$nomeUsu   = @$_POST['nomeUsu'];
		$senha     = @$_POST['senha'];
		$confSenha = @$_POST['confSenha'];
		$email     = @$_POST['email'];
		$dataNasc  = @$_POST['dataNasc'];
		$conteudo  = uploadImagem('Fotos',@$_FILES['foto']);
		//$arquivo   = @$_FILES['foto']['tmp_name']; 
		//$tamanho   = @$_FILES['foto']['size'];
		//$tipo      = @$_FILES['foto']['type'];
		//$nome      = @$_FILES['foto']['name'];
		$estado    = @$_POST['uf'];
		$cidade    = @$_POST['cidade'];
		
		if($nomeUsu == ""){
			echo "Insira seu nome de usuário corretamente.";
		}	

		if($senha == ""){
			echo "Insira uma senha corretamente.";
		}	
			
		$con = conectaBanco();	
			
		/*if ( $arquivo != "" ){
			$fp = fopen($arquivo, "rb");
			$conteudo = fread($fp, $tamanho);
			$conteudo = addslashes($conteudo);
			fclose($fp); 
		} else{
			$conteudo = "";
		}*/
		
		$sql = "Select count(*) from usuario Where nomeUsuario = '".$nomeUsu."' ";
			
		$result = mysql_query($sql,$con);
		$val = mysql_result($result,0);
		
		if($val == 0){
			$dataArr = explode('/',$dataNasc);
			$datatext = $dataArr[2].'-'.$dataArr[1].'-'.$dataArr[0];
			
			$extensaoAux = explode('/',$tipo);
			$extensao    = $extensaoAux[1];
			
			$sql = "INSERT INTO usuario(nomeUsuario,hashSenha,nomeCompleto,dataNascimento,estado, cidade, email, foto, extensao) VALUES('".
										$nomeUsu."','".md5($senha)."','".$nomeComp."','".$datatext."','".
										$estado."','".$cidade."','".$email."','".$conteudo."','".$extensao."');";
										
			if(mysql_query($sql,$con)){
				header("Location: index.html");
			} 
		}else{
			echo "<footer><p>Nome de usuário já cadastrado.</p></footer>";
		}
		
		mysql_close($con);
	}
	
?>

<html>
<header>
  <link rel="stylesheet" href="style/style.css">
  <script type="text/javascript" src="js/rotina.js"></script>
</header>
<body>
	<head>
	   <h1 class="titulo">Eu Conto</h1>
	</head>
	<form action="cadastro.php" method="post" enctype="multipart/form-data">
	<table class="login">
		<th colspan=2>
			<p class="subtitulo">Cadastro de Usuário</p>
		</th>
		<tr>
			<td align=right width=40%>
				<p>Nome Completo:</p>
			</td>
			<td align=left>
				<input type="text" size=45px id="nomeComp" name="nomeComp" />
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>E-mail:</p>
			</td>
			<td align=left>
				<input type="text" size=45px id="email" name="email"/>
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>Data Nascimento:</p>
			</td>
			<td align=left>
				<input type="date" id="dataNasc" name="dataNasc"/>
			</td>
		</tr>
		<tr>
			<td align=right >
				<p>Estado/Cidade:</p>
			</td>
			<td align=left>
				<select id="uf" name="uf">
					<option value="AC">Acre</option>
					<option value="AL">Alagoas</option>
					<option value="AP">Amapá</option>
					<option value="AM">Amazonas</option>
					<option value="BA">Bahia</option>
					<option value="CE">Ceará</option>
					<option value="DF">Distrito Federal</option>
					<option value="ES">Espírito Santo</option>
					<option value="GO">Goiás</option>
					<option value="MA">Maranhão</option>
					<option value="MT">Mato Grosso</option>
					<option value="MS">Mato Grosso do Sul</option>
					<option value="MG">Minas Gerais</option>
					<option value="PA">Pará</option>
					<option value="PB">Paraíba</option>
					<option value="PR">Paraná</option>
					<option value="PE">Pernambuco</option>
					<option value="PI">Piauí</option>
					<option value="RJ">Rio de Janeiro</option>
					<option value="RN">Rio Grande do Norte</option>
					<option value="RS">Rio Grande do Sul</option>
					<option value="RO">Rondônia</option>
					<option value="RR">Rorâima</option>
					<option value="SC">Santa Catarina</option>
					<option value="SP">São Paulo</option>
					<option value="SE">Sergipe</option>
					<option value="TO">Tocantins</option>
				</select>
				<input type="text" id="cidade" name="cidade"/>
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>Foto:</p>
			</td>
			<td align=left>
                <input type="file" id="foto" name="foto" size="chars"/>
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>Nome Usuário:</p>
			</td>
			<td align=left>
				<input type="text" id="nomeUsu" name="nomeUsu" />
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>Senha:</p>
			</td>
			<td align=left>
				<input type="password" id="senha" name="senha"/>
			</td>
		</tr>
		<tr>
			<td align=right>
				<p>Confirma Senha:</p>
			</td>
			<td align=left>
				<input type="password" id="confSenha" name="confSenha"/>
			</td>
		</tr>
		<tr>
		  <td colspan=1>
			<input type="button" class="botaoLogin" value="Voltar" onclick="voltar();" />
		  </td>
		  <td>
			<input type="submit" class="botaoLogin" value="Confirma" onclick="validaCadastro();" />
		  </td>
		</tr>
	</table>
	</form>
</body>
</html>