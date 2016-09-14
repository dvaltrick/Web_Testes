<?PHP
	require 'funcoes.php';  
	
?>
<html>
<header>
  <link rel="stylesheet" href="style/style.css">
  <script type="text/javascript" src="js/rotina.js"></script>
</header>
<body>
	<?PHP montaCabecalho(); ?>
	<?PHP montaMenu(); ?>
		
	<table width=80%>
		<tr>
			<td width=100% colspan=2>
			</td>
		</tr>
		<tr>
			<td width=20% valign=top>
				<?PHP
					@montaDadosUsuario();
				?>
			</td>
			<td width=60%>
				<div id="obra">
					<ul class="lista">
						<?PHP montaListaObra(); ?>
					</ul>	
				</div>
			</td>
			<td valign=top>
				<form action="criaObra.php" method=post>
					<input type="submit" value="Criar Nova Obra" class="botaoVermelho" />
				</form>
			</td>
		</tr>
	</table>

	</body>
</html>