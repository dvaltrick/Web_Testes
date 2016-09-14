<?PHP
	function conectaBanco(){
		$con = mysql_connect("mysql.hostinger.com.br","u717772537_vesti","diego0208");
		if(!$con){
			echo 'Sem conexão com o banco de dados. Tente novamente mais tarde.';
		}
		
		$db_select=mysql_select_db('u717772537_vesti');
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
				$contador = 0;
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
		echo '<div id="menu" ><ul>' ;
		echo '<li><a href="principal.php">Perfil</a></li>';
		echo '<li><a href="leitura.php">Leitura</a></li>';
		echo '<li><a href="obra.php">Obras</a></li>';
		//echo '<li><a href="publicar.php">Publicar</a></li>';
		echo '<li><a href="sobre.php">Sobre</a></li>';
		echo '<li><a href="sair.php">Sair</a></li>';	
		echo '</ul></div>';
	}
	
	function montaCabecalho(){
		echo '<head> <h1 class="tituloPrincipal">Eu Conto</h1> </head>';
	}
	
	function montaListaObra(){
		$con = conectaBanco();

		$sql = "SELECT titulo, capa, sequencia FROM obra WHERE usuario = '".retornaUsuarioLogadoSecao()."' ORDER BY dataCriacao ";
		
		$result = mysql_query($sql,$con);
		
		while($result_row = mysql_fetch_row(($result)))
		{
			echo '<li class="listaLinhaImg">';
			echo '<a href="verObra.php?obraOrigem='.$result_row[2].'" ><table width=100%><tr width=100%><td valign=top width=96%><img align=left width=70px heigth=35px src="Capas/'.$result_row[1].'">'.$result_row[0].'</td>';
			echo '<td align=center valign=top width=4%>';
			echo '<ul>';
			echo '<li class="caixaVermelho">';
			echo '<a href="publicar.php?obraOrigem='.$result_row[2].'" alt="Publicar" ><img width=30 height=30 src="img/caixa_2305_5328_128x128.png"/></a>';
			echo '</li>';
			echo '<li class="caixaVermelho">';
			echo '<a href="#"><img width=30 height=30 src="img/facebook_4124_facebook4.png" /></a>';
			echo '</li>';
			echo '</td></tr></table></a></li>';
		}
		
		mysql_close($con);
	}
	
	function montaListaPublicacoes($usuario,$obra){
		$con = conectaBanco();

		$sql = "Select titulo from publicacao Where usuario = '".$usuario."' and seqObra = ".$obra." ";
		
		$result = mysql_query($sql,$con);
		
		while($result_row = mysql_fetch_row(($result)))
		{
			echo '<li class="listaLinha">'.$result_row[0].'</li>';
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

	function montaQuestao($prova,$questao){
		echo 'ENTROU 1';
		$sql = "SELECT a.idQuestao, a.Texto, a.idOpcaoCorreta, b.Descricao "
		. " FROM QUESTOES a "
		. " left join MATERIAS b on b.idMATERIA = a.idMATERIA "
		. " WHERE a.idPROVA = ".$prova
		. " and a.idQUESTAO = ".$questao;
		echo 'ENTROU 2';
		$result = mysql_query($sql,$con);
		echo 'ENTROU 3';
		while ($questao = mysql_fetch_row($result)) { 
			echo ' <div class="grid grid-pad urow uib_row_6 caixa_tit" data-uib="layout/row" data-ver="0"> ';
			echo '         <span class="uib_shim"></span> ';
			echo '         <div class="col uib_col_9 col-0" data-uib="layout/col" data-ver="0"> ';
			echo '             <div class="widget-container content-area vertical-col"> ';
			echo '                 <div class="widget uib_w_48 d-margins TIT_DASH" data-uib="media/text" data-ver="0"> ';
			echo '                     <div class="widget-container left-receptacle"></div> ';
			echo '                     <div class="widget-container right-receptacle"></div> ';
			echo '                     <div> ';
			echo '                         <p id="label_questao" value="'.$questao[0].'">'.$questao[0].' - '.$questao[3].'</p> ';
			echo '                     </div> ';
			echo '                 </div><span class="uib_shim"></span> ';
			echo '             </div> ';
			echo '         </div> ';
			echo '     </div> ';
			echo '     </br> ';
			echo $questao[1];
			echo '     </br> ';
			
		}
		
		return 0;
	
	}
	
?>