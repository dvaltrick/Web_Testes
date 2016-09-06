<?PHP
	require 'funcoes.php';  
	
	$con       = conectaBanco();
	$usuario   = retornaUsuarioLogado();
	$obra      = $_GET['obraOrigem'];	
		
	$sql        = "Select capa, titulo, sinopse from obra Where usuario = '".$usuario."' and sequencia = ".$_GET['obraOrigem']." ";
	$result     = mysql_query($sql,$con);
	$result_row = mysql_fetch_row(($result));	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<header>
  <link rel="stylesheet" href="style/style.css">
  <script type="text/javascript" src="js/rotina.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</header>
<body style="overflow-y:auto">
	<?PHP montaCabecalho(); ?>
	<?PHP montaMenu(); ?>
	
	<table width=100%>
		<tr>
			<td width=20% valign=top>
				<?PHP
					@montaDadosUsuario();
				?>
			</td>
			<td width=80% valign=top >
				<table class="dadosObra">
					<tr>
						<td valign=top width=20%>
							<img width="100%" height="250px" src="<?PHP echo "Capas/".$result_row[0] ?>"/>
						</td>
						<td valign=top width=70%>
							<p><?PHP echo  $result_row[1];?></p><br>
							<p><?PHP echo  $result_row[2];?></p><br>
						</td>
						<td valign=top>
							<ul class="icones">
								<li>
								   <a href="#" ><img src="img/attach_document.ico" alt="Adicionar capítulo"/></a> 
								</li> 
								<li>
								   <a href="#" ><img src="img/tools.ico"alt="Editar"/></a>
								</li>
								<li>
								   <a href="#" ><img src="img/waste.ico" alt="Excluir"/></a>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td colspan=3>
							<ul class="lista">
								<?PHP
									montaListaPublicacoes($usuario,$obra);
								?>
							</ul>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
	</table>
</body>
</html>