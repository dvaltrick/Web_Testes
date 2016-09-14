<?PHP
	require 'funcoes.php';  
	
	$titulo    = "";
	$categoria = "";
	$sinopse   = "";
	$capa      = "";
	
	if(isset($_POST['titulo'])){
		$titulo    = $_POST['titulo'];
		$categoria = retornaStringCategorias();
		$sinopse   = $_POST['sinopse'];
		$capa      = uploadImagem('Capas',$_FILES['capa']);
		$usuario   = retornaUsuarioLogado();
		
		$con = conectaBanco();
		
		$sql        = "Select count(*) from obra Where usuario = '".$usuario."' ";
		$result     = mysql_query($sql,$con);
		$sequencia  = mysql_result($result,0) + 1;

		$sql = "INSERT INTO obra Values('".$usuario."',".$sequencia.",'".$titulo."','".$sinopse."','".$capa."','".$categoria."',CURRENT_DATE)";
		if(mysql_query($sql,$con)){
			header("Location: obra.php");
		}
		mysql_close($con);
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<header>
  <link rel="stylesheet" href="style/style.css">
  <script type="text/javascript" src="js/rotina.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</header>
<body>
	<?PHP montaCabecalho(); ?>
	<?PHP montaMenu(); ?>
	
	<table width=60%>
		<tr>
			<td width=20% valign=top>
				<?PHP
					@montaDadosUsuario();
				?>
			</td>
			<td width=80% valign=top >
				<table width=100% class="tableCadInterno">
					<form action="criaObra.php" method=post enctype="multipart/form-data" name="criaObra">
						<tr>
							<td align=right width=40%>
								<p>T&iacute;tulo:</p>		
							</td>
							<td align=left width=60%>
								<input type="text" size=45px id="titulo" name="titulo" />
							</td>
						</tr>	
						<tr>
							<td align=right width=40%>
								<p>Categoria:</p>		
							</td>
							<td align=left width=60%>
								<?PHP montaCheckCategoria(4); ?>
							</td>
						</tr>	
						<tr>
							<td align=right width=40%>
								<p>Sinopse:</p>		
							</td>
							<td align=left width=60%>
								<textarea id="sinopse" name="sinopse" rows="4" cols="50"> </textarea>
							</td>
						</tr>	
						<tr>
							<td align=right width=40%>
								<p>Capa:</p>		
							</td>
							<td align=left width=60%>
								<input type="file" id="capa" name="capa" size="chars"/>
							</td>
						</tr>	
						<tr>
							<td align=right width=40%>
								<input type="button" value="Cancelar" class="botaoVermelho" onclick="history.back(1)" />	
							</td>
							<td align=left width=60%>
								<input type="submit" value="Salvar" class="botaoVermelho" />	
							</td>

						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
	
	</body>
</html>