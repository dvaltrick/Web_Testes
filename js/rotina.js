function validaCadastro(){
    if(document.getElementById("nomeComp").value == ""){
		alert("Insira seu nome completo corretamente.");
		return false;
	}

    if(document.getElementById("email").value == ""){
		alert("Insira um email corretamente.");
		return false;
	}
	
    if(document.getElementById("nomeUsu").value == ""){
		alert("Insira um nome de usu�rio corretamente.");
		return false;
	}
	
    if(document.getElementById("senha").value == ""){
		alert("Insira uma senha corretamente.");
		return false;
	}
	
	if(document.getElementById("senha").value != document.getElementById("confSenha").value){
	   alert("A senha est� diferente da confirma��o. Digite corretamente para continuar.");
	   document.getElementById("senha").value = "";
	   document.getElementById("confSenha").value = "";
	   return false;
	}
	
	return true;
}

function voltar(){
   javascript:history.go(-1);
}