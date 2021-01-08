/*
SCRIPT - Breno Cruvinel - breno.cruvinel09@gmail.com
Vesao 3.1
*/
/*
Funcao 1 - Exemplo de utilização:
<a href="#" onclick="faisher_ajax('conteudo', 'carregando', 'pagina.php', 'var=1');">link</a>
*/
function faisher_ajax(div_principal, id_carregando, file_c, var_get, tmetodo, appeend, modalhide){
	if(tmetodo == ""){ tmetodo='get'; }
	if(appeend == ""){ appeend='off'; }
	$.ajax({
	   type: tmetodo, //Tipo do envio das informações GET ou POST
	   url: file_c, //url para onde será enviada as informações digitadas
	   data: var_get, /*parâmetros que serão carregados para a url selecionada (via POST). o form serialize passa de uma só vez todas as informações que estão dentro do formulário. Facilita, mas pode atrapalhar quando não for aplicado adequadamente a sua   aplicação*/
	   cache: false,
	  // async: true,
	
	   beforeSend: function(){
		  //Ação que será executada após o envio, no caso, chamei um gif loading para dar a impressão de garregamento na página
		  if(id_carregando != "0"){
			$("#"+id_carregando+"").show();
			if(appeend == "ON" || appeend == "ADD" || modalhide == "ADD"){ $("[rel=tooltip]").tooltip('hide'); }else{ $("#"+div_principal+"").hide(); }
		  }
	   },
	   //function(data) vide item 4 em $.get $.post
	   success: function(data){
		  //Tratamento dos dados de retorno.
			$("#"+id_carregando+"").hide();
			if(modalhide != "" || modalhide != "ADD"){ $("#"+modalhide+"").modal('hide'); }
			$("#"+div_principal+"").fadeIn();
			if(appeend == "ADD"){ $("[rel=tooltip]").tooltip('hide'); }
			if(appeend == "ON"){ $("#"+div_principal+"").append(data); }else{ $("#"+div_principal+"").empty().html(data); }
	   },
	
	   // Se acontecer algum erro é executada essa função
	   error: function(erro){
			$("#"+id_carregando+"").hide();
			if(modalhide != "" || modalhide != "ADD"){ $("#"+modalhide+"").modal('hide'); }
			$("#"+div_principal+"").fadeIn();
			$("#"+div_principal+"").empty().html('<center>Erro ao carregar a pagina!<br>Verifique sua conexão com a internet e tente novamente.</center>');
	   }
	});

}



function faisher_ajax_final(div_principal, id_carregando, file_c, var_get){
	//carrega os dados ao carregar a pagina sem clicar em nada
	if(id_carregando != "0"){
					$("#"+id_carregando+"").show();
	//				$("#"+div_principal+"").hide();
	}

					$.get(""+file_c+"?"+var_get+"",{
					   }, function(data) {
						$("#"+id_carregando+"").hide();
	//					$("#"+div_principal+"").fadeIn();
						
						//$("#"+div_principal+"").empty().append(data);
						$("#"+div_principal+"").append(data);
					});

}//funcao




/*
Funcao 3 - Exemplo de utilização:
//inserir divs dinamicamente em conteudo passando parametros simples
<a href="#" onClick="addDivDinamica('[id div que vai receber]', '[id div que vai ser criada]');return false;">nova</a>
<div id="testen"></div>
*/
 function addDivDinamica(divName, divNova){
//   var newdiv = document.createElement('div');
//   newdiv.setAttribute('id',divNova);
  // newdiv.innerHTML = '<br>Aqui:->';
//   document.getElementById(divName).appendChild(newdiv);
	var html_nova = "<div id='"+divNova+"'>xx</div>";
   $('#'+divName).append(html_nova);
 }
 //fim Função 3
 
 
 function urlencode( str ) {
    var histogram = {}, tmp_arr = [];
    var ret = (str+'').toString();
    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };
    // The histogram is identical to the one in urldecode.
    histogram["'"]   = '%27';
    histogram['(']   = '%28';
    histogram[')']   = '%29';
    histogram['*']   = '%2A';
    histogram['~']   = '%7E';
    histogram['!']   = '%21';
    histogram['%20'] = '+';
    histogram['\u20AC'] = '%80';
    histogram['\u0081'] = '%81';
    histogram['\u201A'] = '%82';
    histogram['\u0192'] = '%83';
    histogram['\u201E'] = '%84';
    histogram['\u2026'] = '%85';
    histogram['\u2020'] = '%86';
    histogram['\u2021'] = '%87';
    histogram['\u02C6'] = '%88';
    histogram['\u2030'] = '%89';
    histogram['\u0160'] = '%8A';
    histogram['\u2039'] = '%8B';
    histogram['\u0152'] = '%8C';
    histogram['\u008D'] = '%8D';
    histogram['\u017D'] = '%8E';
    histogram['\u008F'] = '%8F';
    histogram['\u0090'] = '%90';
    histogram['\u2018'] = '%91';
    histogram['\u2019'] = '%92';
    histogram['\u201C'] = '%93';
    histogram['\u201D'] = '%94';
    histogram['\u2022'] = '%95';
    histogram['\u2013'] = '%96';
    histogram['\u2014'] = '%97';
    histogram['\u02DC'] = '%98';
    histogram['\u2122'] = '%99';
    histogram['\u0161'] = '%9A';
    histogram['\u203A'] = '%9B';
    histogram['\u0153'] = '%9C';
    histogram['\u009D'] = '%9D';
    histogram['\u017E'] = '%9E';
    histogram['\u0178'] = '%9F';
    // Begin with encodeURIComponent, which most resembles PHP's encoding functions
    ret = encodeURIComponent(ret);
    for (search in histogram) {
        replace = histogram[search];
        ret = replacer(search, replace, ret) // Custom replace. No regexing
    }
    // Uppercase for full PHP compatibility
    return ret.replace(/(\%([a-z0-9]{2}))/g, function(full, m1, m2) {
        return "%"+m2.toUpperCase();
    });
    return ret;
}
 
 
function urldecode( str ) {
    var histogram = {};
    var ret = str.toString();
    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };
    // The histogram is identical to the one in urlencode.
    histogram["'"]   = '%27';
    histogram['(']   = '%28';
    histogram[')']   = '%29';
    histogram['*']   = '%2A';
    histogram['~']   = '%7E';
    histogram['!']   = '%21';
    histogram['%20'] = '+';
    histogram['\u20AC'] = '%80';
    histogram['\u0081'] = '%81';
    histogram['\u201A'] = '%82';
    histogram['\u0192'] = '%83';
    histogram['\u201E'] = '%84';
    histogram['\u2026'] = '%85';
    histogram['\u2020'] = '%86';
    histogram['\u2021'] = '%87';
    histogram['\u02C6'] = '%88';
    histogram['\u2030'] = '%89';
    histogram['\u0160'] = '%8A';
    histogram['\u2039'] = '%8B';
    histogram['\u0152'] = '%8C';
    histogram['\u008D'] = '%8D';
    histogram['\u017D'] = '%8E';
    histogram['\u008F'] = '%8F';
    histogram['\u0090'] = '%90';
    histogram['\u2018'] = '%91';
    histogram['\u2019'] = '%92';
    histogram['\u201C'] = '%93';
    histogram['\u201D'] = '%94';
    histogram['\u2022'] = '%95';
    histogram['\u2013'] = '%96';
    histogram['\u2014'] = '%97';
    histogram['\u02DC'] = '%98';
    histogram['\u2122'] = '%99';
    histogram['\u0161'] = '%9A';
    histogram['\u203A'] = '%9B';
    histogram['\u0153'] = '%9C';
    histogram['\u009D'] = '%9D';
    histogram['\u017E'] = '%9E';
    histogram['\u0178'] = '%9F';
    for (replace in histogram) {
        search = histogram[replace]; // Switch order when decoding
        ret = replacer(search, replace, ret) // Custom replace. No regexing   
    }
    // End with decodeURIComponent, which most resembles PHP's encoding functions
    ret = decodeURIComponent(ret);
    return ret;
}