function caracteresEspeciais(texto){
	alert("Entrou");
	
	var tamanho = 0;
	var posicao = 0;
	var charEspec;
	var retorno = new String("");
	
	alert("Entrou");
	tamanho = texto.length;
	
	for(posicao = 0;posicao < tamanho; posicao++){
		charEspec = verificaCharLista(texto[posicao]);
		if(charEspec != ''){
			concat(retorno,charEspec);	
		}else{
			concat(retorno,texto[posicao]);
		}
	}
	
	return retorno;
	
}

function verificaCharLista(var caractere){
	switch(caractere){
		case '�': return '&aacute';
		case '�': return '&Aacute';
		case '�': return '&atilde';
		case '�': return '&Atilde';
		case '�': return '&acirc';
		case '�': return '&Acirc';
		case '�': return '&agrave';
		case '�': return '&Agrave';
		
		case '�': return '&eacute'; break;
		case '�': return '&Eacute'; break;
		case '�': return '&ecirc'; break;
		case '�': return '&Ecirc'; break;
		case '�': return '&egrave'; break;
		case '�': return '&Egrave'; break;
		
		case '�': return '&iacute'; break;
		case '�': return '&Iacute'; break;
		case '�': return '&icirc'; break;
		case '�': return '&Icirc'; break;
		case '�': return '&igrave'; break;
		case '�': return '&Igrave'; break;
		
		case '�': return '&oacute'; break;
		case '�': return '&Oacute'; break;
		case '�': return '&otilde'; break;
		case '�': return '&Otilde'; break;
		case '�': return '&ocirc'; break;
		case '�': return '&Ocirc'; break;
		case '�': return '&ograve'; break;
		case '�': return '&Ograve'; break;
		
		case '�': return '&uacute'; break;
		case '�': return '&Uacute'; break;
		case '�': return '&ucirc'; break;
		case '�': return '&Ucirc'; break;
		case '�': return '&ugrave'; break;
		case '�': return '&Ugrave'; break;
		default: return ''; break;
	}
		
}