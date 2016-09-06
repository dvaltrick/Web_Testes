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
		case 'á': return '&aacute';
		case 'Á': return '&Aacute';
		case 'ã': return '&atilde';
		case 'Ã': return '&Atilde';
		case 'â': return '&acirc';
		case 'Â': return '&Acirc';
		case 'à': return '&agrave';
		case 'À': return '&Agrave';
		
		case 'é': return '&eacute'; break;
		case 'É': return '&Eacute'; break;
		case 'ê': return '&ecirc'; break;
		case 'Ê': return '&Ecirc'; break;
		case 'è': return '&egrave'; break;
		case 'È': return '&Egrave'; break;
		
		case 'í': return '&iacute'; break;
		case 'Í': return '&Iacute'; break;
		case 'î': return '&icirc'; break;
		case 'Î': return '&Icirc'; break;
		case 'ì': return '&igrave'; break;
		case 'Ì': return '&Igrave'; break;
		
		case 'ó': return '&oacute'; break;
		case 'Ó': return '&Oacute'; break;
		case 'õ': return '&otilde'; break;
		case 'Õ': return '&Otilde'; break;
		case 'ô': return '&ocirc'; break;
		case 'Ô': return '&Ocirc'; break;
		case 'ò': return '&ograve'; break;
		case 'Ò': return '&Ograve'; break;
		
		case 'ú': return '&uacute'; break;
		case 'Ú': return '&Uacute'; break;
		case 'û': return '&ucirc'; break;
		case 'Û': return '&Ucirc'; break;
		case 'ù': return '&ugrave'; break;
		case 'Ù': return '&Ugrave'; break;
		default: return ''; break;
	}
		
}