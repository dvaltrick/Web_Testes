<?PHP
	require 'funcoes.php';

	$titulo    = "";
	$obra      = $_GET['obraOrigem'];
	$categoria = "";
	$sinopse   = "";
	$texto     = "";
	
	if(isset($_POST['titulo'])){
		$titulo    = $_POST['titulo'];
		$categoria = retornaStringCategorias();
		$sinopse   = $_POST['sinopse'];
		$texto     = $_POST['texto'];
		$usuario   = retornaUsuarioLogado();
	
		$con = conectaBanco();
		
		$sql        = "Select Max(codigoPublicacao) as Total from publicacao Where usuario = '".$usuario."' and seqObra = ".$obra."  ";
		$result     = mysql_query($sql,$con);
		$sequencia  = mysql_result($result,0) + 1;
		
		$sql = "INSERT INTO publicacao VALUES('".$usuario."',".$sequencia.",".$obra.",'".$titulo."','".
		                                         $sinopse."','".$texto."',null,'".$categoria."',CURRENT_DATE)";
												 
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
		
	<table width=75%>
		<tr>
			<td width=20% valign=top>
				<?PHP
					@montaDadosUsuario();
				?>
			</td>
			<td width=80% valign=top>
				<table width=100% class="tableCadInterno">
					<form action="publicar.php?obraOrigem=<?PHP echo $obra; ?>" method=post>
					<tr>
						<td width=20% align=right>
							<p>T&iacute;tulo:</p>
						</td>
						<td width=80% align=left>
							<input type="Text" id="titulo" name="titulo" />
						</td>
					</tr>
					<tr>
						<td align=right>
							<p>Categoria:</p>
						</td>
						<td align=left>
							<?PHP
								@montaCheckCategoria(4);
							?>
						</td>
					</tr>
					<tr>
						<td align=right>
							<p>Sinopse:</p>
						</td>
						<td align=left>
							<textarea rows=3 cols="70" id="sinopse" name="sinopse" ></textarea>
						</td>
					</tr>
					<tr>
						<td align=right>
							<p>Texto:</p>
						</td>
						<td align=left>
							<textarea rows=7 cols="70" id="texto" name="texto" ></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" class="botaoVermelho" id="cancelar" name="cancelar" value="Cancelar" onclick="history.back(1)" />
						</td>
						<td>
							<input type="submit" class="botaoVermelho" id="publicar" name="publicar" value="Publicar"/>
						</td>
					</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>