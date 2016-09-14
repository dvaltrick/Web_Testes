<?PHP
	function conectaBanco(){
		$con = mysql_connect("mysql.hostinger.com.br","u224897785_diego","conto0208");
		if(!$con){
			echo 'Sem conexão com o banco de dados. Tente novamente mais tarde.';
		}
		
		$db_select=mysql_select_db('u224897785_conto');
		if (!$db_select)
		{
			die ("Base não pode ser selecionada: ". mysql_error());
		}
		
		return $con;
	}
	
	function montaCheckCategoria($colunas){
		$con = conectaBanco();
		$contador = 0;
		
		$sql = "SELECT codigo, categoria FROM categoria order by categoria ";
		$result = mysql_query($sql,$con);
		echo '<table>';
		echo '<tr>';
		while($result_row = mysql_fetch_row(($result))){
			if($contador == $colunas){
				echo '</tr><tr>';	
			}
			echo '<td class="categoriaCheck" ><input  type="checkbox" name="option_'.$result_row[0].'" value="'.$result_row[0].'">'.$result_row[1].'</td>';	
			$contador = $contador + 1;
		}	
		
		echo '</tr></table>';
		mysql_close($con);
	}
	
	function retornaStringCategorias(){
		$con       = conectaBanco();
		$contador  = 0;
		$stringRet = "|";
		
		$sql = "SELECT codigo, categoria FROM categoria order by categoria ";
		$result = mysql_query($sql,$con);
		while($result_row = mysql_fetch_row(($result))){
			if(@$_POST['option_'.$result_row[0]]){
				$stringRet = $stringRet.$result_row[0]."|"; 
			}
		}
		mysql_close($con);

		return $stringRet;
	}
	
	function montaSelecaoObra(){
		$con = conectaBanco();
		
		$sql = "SELECT sequencia, titulo FROM obra WHERE usuario = '".retornaUsuarioLogado()."' ";
		$result = mysql_query($sql,$con);
		while($result_row = mysql_fetch_row(($result))){
			echo '<option value="'.$result_row[0].'">'.$result_row[1].'</option>';
		}
		
		mysql_close($con);
	}
	
	function montaDadosUsuario(){
		$con = conectaBanco();
		
		$sql = "SELECT nomeCompleto, cidade, estado, email, dataNascimento, foto, extensao FROM usuario WHERE nomeUsuario = '".retornaUsuarioLogado()."' ";
        
		$result = mysql_query($sql,$con);
		
		?>
		<table class="dadosUsuario">	
		<?PHP
		while($result_row = mysql_fetch_row(($result)))
		{		
			echo '<tr><td>';
			$dados['imagem'] = $result_row[5];
			echo '<img class="imgUsuario" alt="embedded image" src="Fotos/'.$dados['imagem'].'">' ;			
			echo '</td></tr>';
			echo '<tr><td>';
			echo '<p>'.$result_row[0].'</p>';
			echo '</td></tr>';
			echo '<tr><td>';
			echo '<input type="button" value="Perfil" class="botaoLogin" />';
			echo '</td></tr>';
		}
		?>
		</table>
		<?PHP
		
		
		mysql_close($con);
	}
	
	function retornaUsuarioLogado(){
		session_start("euconto");
		return $_SESSION["nome_usuario"];
	}

	function retornaUsuarioLogadoSecao(){
		return $_SESSION["nome_usuario"];
	}
	
	function montaMenu(){
		echo '<li><a href="principal.php">Perfil</a></li>';
		echo '<li><a href="leitura.php">Leitura</a></li>';
		echo '<li><a href="obra.php">Obras</a></li>';
		echo '<li><a href="publicar.php">Publicar</a></li>';
		echo '<li><a href="sobre.php">Sobre</a></li>';
		echo '<li><a href="sair.php">Sair</a></li>';	
	}
	
	function montaListaObra(){
		$con = conectaBanco();

		$sql = "SELECT titulo, capa, sequencia FROM obra WHERE usuario = '".retornaUsuarioLogadoSecao()."' ORDER BY dataCriacao ";
		
		$result = mysql_query($sql,$con);
		
		while($result_row = mysql_fetch_row(($result)))
		{
			echo '<li class="listaLinhaImg">';
			echo '<table width=100%><tr width=100%><td valign=top width=96%><img align=left width=70px heigth=35px src="Capas/'.$result_row[1].'">'.$result_row[0].'</td>';
			echo '<td align=center valign=top width=4%>';
			echo '<ul>';
			echo '<li class="caixaVermelho">';
			echo '<a href="publicar.php?obraOrigem='.$result_row[2].'"><img width=30 height=30 src="img/caixa_2305_5328_128x128.png"/></a>';
			echo '</li>';
			echo '<li class="caixaVermelho">';
			echo '<a href="#"><img width=30 height=30 src="img/facebook_4124_facebook4.png" /></a>';
			echo '</li>';
			echo '</td></tr></table></li>';
		}
		
		mysql_close($con);
	}
	
	function uploadImagem($caminho,$foto){
	    // Pega extensão da imagem 
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);   
				
		// Gera um nome único para a imagem 
		$nome_imagem = md5(uniqid(time())) . "." . $ext[1];   
				
		// Caminho de onde ficará a imagem 
		$caminho_imagem = $caminho . "/" . $nome_imagem;   
				
		// Faz o upload da imagem para seu respectivo caminho 
		move_uploaded_file($foto["tmp_name"], $caminho_imagem);   
				
		// Retorna Nome da Imagem
		return $nome_imagem;
	}
?>