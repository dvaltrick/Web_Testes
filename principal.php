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
	<table>
		<tr>
			<td width=20% valign=top>
				<?PHP
					@montaDadosUsuario();
				?>
			</td>
			<td width=80% valign=top>
				<table>
					<tr>
						<td valign=top>
							<ul class="lista">
								<li class="listaTitulo"><p>Minhas Publicações</p></li>
								<li class="listaLinha">Teste 1</li>
								<li class="listaLinha">Teste 2</li>
								<li class="listaLinha">Teste 3</li>
								<li class="listaLinha">Teste 4</li>
								<li class="listaLinha">Teste 5</li>
							</ul>
						</td>
						<td valign=top>
							<ul class="lista">
								<li class="listaTitulo"><p>Favoritos</p></li>
								<li class="listaLinha">A Batalha do Apocalipse</li>
								<li class="listaLinha">O Guia do Mochileiro das Galaxias</li>
								<li class="listaLinha">Anjos e Demônios</li>
								<li class="listaLinha">O Hobbit</li>
								<li class="listaLinha">O Código Da Vinci</li>
								<li class="listaLinha">O Ladrão de Raios</li>
								<li class="listaLinha">Ponto de Impacto</li>
								<li class="listaLinha">A Farça</li>
							</ul>
						</td>
						<td valign=top> 
							<ul class="lista">
								<li class="listaTitulo"><p>Autores</p></li>
								<li class="listaLinha">Diego Ecker Valtrick</li>
								<li class="listaLinha">Kélen Klein Heffel</li>
							</ul>
						</td>
					</tr>
				</table>
			</td>
			<td width=30%>
			</td>
		</tr>
	</table>
</body>
</html>