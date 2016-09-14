<?PHP 
    // Dados de envio e da mensagem 
    //ini_set("SMTP", "mx1.hostinger.com.br" );
    //ini_set("smtp_port","2525");
    //ini_set('sendmail_from', 'diego@diegoeckervaltrick.com');
    //ini_set("username","diego@diegoeckervaltrick.com"); 
    //ini_set("password","LQ7YWVajAq");

    ini_set("SMTP", "smtp.gmail.com" );
    ini_set("smtp_port","465");
    ini_set('sendmail_from', 'dvaltrick@gmail.com');
    ini_set("username","dvaltrick@gmail.com"); 
    ini_set("password","diego0208"); 

    $nome_remetente = $_POST['remetente'];
    $assunto = $_POST['assunto'];
    $email_remetente = $_POST['email'];
    $email_destinatario = "dvaltrick@gmail.com";
		
    // Conteudo do e-mail (você poderá usar HTML)
    $mensagem = $_POST['mensagem'];
	
    // Cabeçalho do e-mail. Não é necessário alterar geralmente...	
    $cabecalho =    "MIME-Version: 1.0\n";
    $cabecalho .=   "Content-Type: text/html; charset=UTF-8\n";
    $cabecalho .=   "From: \"{$nome_remetente}\" <{$email_remetente}>\n";

    // Dispara e-mail e retorna status para variável		
    $status_envio = mail($email_destinatario, $assunto, $mensagem, $cabecalho);
	
    // Se mensagem foi enviada pelo servidor…		
    if ($status_envio)
    {
	echo "Mensagem enviada!";
    }else
    {
	echo "Mensagem não enviada!". $email_destinatario.$mensagem.$nome_remetente.$assunto.$email_remetente;
    }	

?>