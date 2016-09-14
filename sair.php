<?PHP
	session_unset($_SESSION["nome_usuario"]);
	session_destroy();
	header('Location: index.html');
?>