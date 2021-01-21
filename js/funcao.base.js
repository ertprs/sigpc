
$(document).ready(function(){ ajustaDivFull(); });
$(window).resize(function(){ ajustaDivFull(); });
function ajustaDivFull(){
	pg_w = $(document).width();
	pg_h = $(document).height();
	$(".fulldiv").width(pg_w); $(".fulldiv").height(pg_h);
	$(".fulldiv_w").width(pg_w); $(".fulldiv_h").height(pg_h);
	$("#div_principalContent_load").height($(document).height());
}


function dinamicBox(box_id){
	box = $('#'+box_id);
	content = $('#'+box_id+'-content');
	if(content.is(":visible")){
		content.slideUp(); box.find(".actions-icon span").html('Expandir/exibir');
	}else{
		content.slideDown(); box.find(".actions-icon span").html('Ocultar/reduzir');
	}
	box.find(".actions-icon i").toggleClass('icon-angle-up').toggleClass("icon-angle-down");
}//dinamicBox


function faisher_ajaxAba(aba, titu, faisher, var_get){
	var marcadorAba = aba.substring(0, 2);
	var id_li = marcadorAba+'-'+faisher; 
	$("#abaActive").val(id_li);	$("#idFaisher").val(faisher);//define aba ativa
	$("#div_principalContent_load").show();
	if($('#ul_aba'+aba+' #'+id_li+'').size()){
		$.get("ajax/faisher.php?faisher="+faisher+"&"+var_get+"",{ }, function(data){
				//$(".menuTab").removeClass("menuTab-ativo");//desativa abas
				//$("#ul_aba"+aba+" #"+id_li+"").addClass("menuTab-ativo");//ativa aba atual
				//$(".principalContent, #div_principalContent_load").hide();
				//$("#content_"+id_li+", #aba"+aba+"").fadeIn();//exibe div dados e gia menuabas
				$("#content_"+id_li+"").empty().html(data);//carrega dados
				selecAba(id_li);
		});
	}else{
		$.get("ajax/faisher.php?faisher="+faisher+"&"+var_get+"",{ }, function(data){
				$(".menuTab").removeClass("menuTab-ativo");//desativa abas
				$(".principalContent, #div_principalContent_load").hide();
				$("#content_"+id_li+", #aba"+aba+"").fadeIn();//exibe div dados e gia menuabas
				$("#ul_aba"+aba+"").append('<li class="menuTab menuTab-ativo" data-id="'+aba+'" id="'+id_li+'"><a href="#" onClick="return false;"><span onClick="selecAba(\''+id_li+'\');return false;"><span class="glyphicon-imac"></span>&nbsp;'+titu+'</span> <i class="icon-remove btn" onClick="fechaAba(\''+id_li+'\');"></i></a></li>');//carrega aba
				$("#div_principalContent").append('<div class="principalContent" id="content_'+id_li+'">'+data+'</div>');//carrega dados
		});
	}//else
	$.doTimeout('vTimerabaQTD', 500, function(){ $('#abaQTD').html($('.menuTab').size()); });//TIMER
}//funcao

function selecAba(id_li){
	$("#abaActive").val(id_li);	$("#idFaisher").val(id_li.substring(id_li.lastIndexOf('-') + 1));
	var aba = $("#"+id_li+"").attr('data-id');//pega id da aba
	$("#div_principalContent_load").show();
	if($('#ul_aba'+aba+' #'+id_li+'').size()){
		$(".menuTab").removeClass("menuTab-ativo");//desativa abas
		classMenuTop(aba);//seleciona o menu ativo
		$('#titulo_principal').html($('#html_titulo-'+id_li).html());//titulo principal
		$('#sys_mapa').html($('#html_mapa-'+id_li).html());//mapa principal
		$("#ul_aba"+aba+" #"+id_li+"").addClass("menuTab-ativo");//ativa aba atual
		$(".principalContent, #div_principalContent_load").hide();
		$("#content_"+id_li+", #aba"+aba+"").fadeIn();//exibe div dados e gia menuabas
	}else{
		$(".menuTab").removeClass("menuTab-ativo");//desativa abas
		classMenuTop('Inicio');//seleciona o menu ativo
		$('#titulo_principal').html($('#html_titulo-In-home').html());//titulo principal
		$('#sys_mapa').html($('#html_mapa-In-home').html());//mapa principal
		$("#ul_abaInicio #In-home").addClass("menuTab-ativo");//ativa aba atual
		$(".principalContent, #div_principalContent_load").hide();
		$("#content_In-home, #abaInicio").fadeIn();//exibe div dados e gia menuabas
	}//else
	$.doTimeout('vTimerabaQTD', 500, function(){ $('#abaQTD').html($('.menuTab').size()); });//TIMER
}//funcao

function fechaAba(id_li){
	if(id_li != "In-home"){
		var aba = $("#"+id_li+"").attr('data-id');//pega id da aba
		var qtdLI = $('#ul_aba'+aba+' .menuTab').length;
		if(qtdLI == 1){
			$("#aba"+aba+"").fadeOut();//exibe div dados e gia menuabas
		}
		$("#content_"+id_li+"").fadeOut(function(){ $(this).remove(); });//destroe conteudo
		$("#ul_aba"+aba+" #"+id_li+"").fadeOut(function(){ $(this).remove(); });//destroe aba
		if($("#abaActive").val() == id_li){
			$("#div_principalContent_load").show();
			$(".menuTab").removeClass("menuTab-ativo");//desativa abas
			classMenuTop('Inicio');//seleciona o menu ativo
			$('#titulo_principal').html($('#html_titulo-In-home').html());//titulo principal
			$('#sys_mapa').html($('#html_mapa-In-home').html());//mapa principal
			$("#ul_abaInicio #In-home").addClass("menuTab-ativo");//ativa aba atual
			$(".principalContent, #div_principalContent_load").hide();
			$("#content_In-home, #abaInicio").fadeIn();//exibe div dados e gia menuabas
		}
		$("#abaActive").val('In-home'); $("#idFaisher").val('home');
	}//'In-home'
	$.doTimeout('vTimerabaQTD', 500, function(){ $('#abaQTD').html($('.menuTab').size()); });//TIMER
}//funcao


function loaderFoco(v_divprincipal,v_divloader,v_msg,v_popup){
	if(v_msg != "" && v_msg != null){ v_msgi = v_msg; }else{ v_msgi = ""; }
	if(v_popup != "" && v_popup != null){ v_popup = v_popup; }else{ v_popup = "0"; }
	$("#"+v_divloader).remove();	
	var vtop = Number($("#"+v_divprincipal).css('padding-top').replace('px',''));
	var vleft = Number($("#"+v_divprincipal).css('padding-left').replace('px',''));
	var width = $("#"+v_divprincipal).width()+Number($("#"+v_divprincipal).css('padding-left').replace('px',''))+Number($("#"+v_divprincipal).css('padding-right').replace('px',''));
	var height = $("#"+v_divprincipal).height()+Number($("#"+v_divprincipal).css('padding-top').replace('px',''))+Number($("#"+v_divprincipal).css('padding-bottom').replace('px',''));
	var line_height = height/2;
	$('#'+v_divprincipal).prepend('<div style="position:relative; top:-'+vtop+'px; left:-'+vleft+'px;"><div id="'+v_divloader+'" style="line-height:'+line_height+'px; position:absolute; color:#FFF; top:0; left:0; z-index:999; background:url(img/shadows/b50.png) repeat; text-align:center; display:none;"><img src="img/ajax-loader.gif">&nbsp;&nbsp;<span id="'+v_divloader+'msg">'+v_msgi+'</span></div></div>');
	$("#"+v_divloader).css('width', width+'px');
	$("#"+v_divloader).css('height', height+'px');
	/*
	height = $("#"+v_divprincipal).height()-10;
	$('#'+v_divprincipal).append('<div id="'+v_divloader+'" style="line-height:'+height+'px; position:absolute; color:#FFF; top:20px; left:20px; z-index:9999; background:url(img/shadows/b50.png) repeat; text-align:center; display:none;"><img src="img/ajax-loader.gif">&nbsp;&nbsp;<span id="'+v_divloader+'msg">'+v_msgi+'</span></div>');
	if(v_popup == "0"){
		$("#"+v_divloader).css('left', $("#"+v_divprincipal).offset().left+2+'px');
		$("#"+v_divloader).css('top', $("#"+v_divprincipal).offset().top-40+'px');
	}
	$("#"+v_divloader).css('width', $("#"+v_divprincipal).width()-4+'px');
	$("#"+v_divloader).css('height', $("#"+v_divprincipal).height()-4+'px');//*/
}//loaderFoco

function ancoraHtml(v_id,v_recuo){
	if(v_recuo == "" || v_recuo == null){ v_recuo = 0; }
    $('html, body').stop().animate({ scrollTop: $(v_id).offset().top-v_recuo }, 500);
}//ancoraHtml

function valHtml(v_nome,id_controle){
	if(id_controle == "" || id_controle == null){ id_controle = ""; }else{ id_controle = id_controle+" "; }
	var vari = "0";
	$(id_controle+"input[name='"+v_nome+"']:checked").each(function(i){ vari = $(this).val(); });
	return vari;
}//valHtml

function verGeoMapaPopup(v_lt,v_lg){
	pmodalHtml('<i class="icon-map-marker" style="color:#F90;"></i> GEOLOCALIZAÇÃO NO MAPA','<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m8!1m3!1d7643.744000408132!2d'+v_lg+'!3d'+v_lt+'!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m0!4m3!3m2!1d'+v_lt+'!2d'+v_lg+'!5e0!3m2!1spt-BR!2sbr!4v1453638829512" width="600" height="395" frameborder="0" style="border:0; width:100%;" allowfullscreen></iframe> ','html');	
}//verGeoMapaPopup

function classMenuTop(v_select){
	$('#menu_principalTop li').removeClass('active');
	$('#menu_principalTop #li_top'+v_select).addClass('active');
}//function classMenuTop

function exibMensagem(v_idEnd,v_tipo,v_msg,v_timer,v_acao){
	if(v_timer != "" && v_timer != null){ v_timer = v_timer; }else{ v_timer = 10000; }
	if(v_acao != "" && v_acao != null){ v_acao = v_acao; }else{ v_acao = "html"; }
   	var div_aleat = 'div_aleat'+parseInt(Math.random()*99999);
	$("#"+div_aleat).remove();
	var tipo = "alert-warning";
	if(v_tipo == "sucesso"){ tipo = "alert-success"; }
	if(v_tipo == "info"){ tipo = "alert-info"; }
	if(v_tipo == "erro"){ tipo = "alert-danger"; }
	//incluir hora
	var leg = '';
	if(v_acao != "append"){
		now = new Date();
		leg = '<div style="float:right"><div style="position:absolute; font-size:10px;"><i class="fa fa-clock-o"></i> '+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds()+'</div>';
	}	
	var html = '<div class="alert '+tipo+'" style="margin:10px;" id="'+div_aleat+'"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>'+v_msg+leg+'</div></div>';
	if(v_acao == "append"){
		$('#'+v_idEnd).append(html);
	}else{
		$('#'+v_idEnd).html(html);
	}
	//TIMER
	$.doTimeout('vTimer'+div_aleat, v_timer, function(){ $('#'+div_aleat).fadeOut(2000,function(){ $("#"+div_aleat).remove(); }); });//TIMER
}//exibMensagem

function exibNotificacao(title,message,time,sticky,overlay){
		$.gritter.add({
			title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
			text: 	(typeof message !== 'undefined') ? message : 'Body',
			image: 	(typeof image !== 'undefined') ? image : null,
			sticky: (typeof sticky !== 'undefined') ? sticky : false,
			time: 	(typeof time !== 'undefined') ? time : 3000
		});
}
function escondeNotificacao(){
		$('.gritter-item-wrapper').fadeOut();
}

function pmodalHtmlAlerta(v_mensagem,v_titu,v_bt){
	if(v_titu == "" || v_titu == null){ v_titu = "ALERTA"; }
	if(v_bt == "" || v_bt == null){ v_bt = "Ok"; }
	$('#pModalAlerta #pModalTituloAlerta').html(v_titu);
	$('#pModalAlerta #pModalConteudoAlerta').html(v_mensagem);
	$('#pModalAlerta #pModalBtAlerta').html(v_bt);
	$('#pModalAlerta').modal('show');
}//pmodalHtmlAlert

function pmodalHtml(v_titulo,v_conteudo,v_tipo,v_get,v_class){
	if(v_get == "" || v_get == null){ v_get = ""; }
	if(v_class == "" || v_class == null){ v_class = ""; }
	$('#pModalConteudo').show();
	//$('#pModalOutraPG').hide();
	$('#pModalLoadermsg').html('');
	$("[rel=tooltip]").tooltip('hide');
	$("#pModal").draggable({ handle: "#pModalTitulo" }); 
	if(v_tipo == "html"){
    	$('#pModalTitulo').html(v_titulo);
		if(v_get == "append"){	$('#pModalConteudo div').hide(); $('#pModalConteudo').append(v_conteudo); }else{ $('#pModalConteudo').html(v_conteudo); }
    	$('#pModalRodape').html('<button class="btn" data-dismiss="modal">Sair</button>');
    }
	if((v_tipo == "get") || (v_tipo == "post")){
		//$('#pModalOutraPG').show();
    	$('#pModalTitulo').html(v_titulo);
    	$('#pModalConteudo').html('<div class="content '+v_class+'" style="padding:3px;" id="pModalConteudoOn"></div>');
		faisher_ajax('pModalConteudoOn', 'pModalLoader', v_conteudo, v_get, v_tipo);
    	$('#pModalRodape').html('');
		$('#pModalPage').val(v_conteudo);
		$('#pModalGet').val(v_get);
		$('#pModalClass').val(v_class);
    }
	pmodalDisplay('show');
}//pmodalHtml
function pmodalDisplay(v_acao){
	if(v_acao == 'show'){
		//ativa verificação de hide rolagem
		var p_scroll = $(window).scrollTop();
		$(window).bind('scroll', function(){
			if($('#pModal').is(':visible') == true){ $(window).scrollTop(p_scroll); }else{ $(window).unbind('scroll'); }
		});		
		/*$("body").css("overflow", "hidden");
		$.doTimeout('vTimerpModal', 500, function(){
			if($('#pModal').is(':visible') == true){ return true; }else{ $.doTimeout('vTimerpModal'); $("body").css("overflow", "auto"); }
		});//TIMER */
		
		var v_w = Number($(window).width()); 
		if($(window).width() >= "1500"){
			$('#pModal').css('width','1500'); $('#pModal').css('margin-left','-760px');
		}else if($(window).width() >= "1400"){
			$('#pModal').css('width','1400'); $('#pModal').css('margin-left','-700px');
		}else if($(window).width() >= "1300"){
			$('#pModal').css('width','1300'); $('#pModal').css('margin-left','-660px');
		}else if($(window).width() >= "1100"){
			$('#pModal').css('width','1100px'); $('#pModal').css('margin-left','-570px');
		}else if($(window).width() >= "1100"){
			$('#pModal').css('width','1100px'); $('#pModal').css('margin-left','-570px');
		}else if($(window).width() >= "900"){
			$('#pModal').css('width','980px'); $('#pModal').css('margin-left','-470px');
			//verifica se tem numero de processo/oficio
		}else if($(window).width() >= "765"){
			$('#pModal').css('width','840px'); $('#pModal').css('margin-left','-370px');
		}else{ i_height = 450; v_m = v_w-15;
			$('#pModal').css('width',v_m+'px'); $('#pModal').css('margin','0px');
		}		
		
		/*var v_w = Number($(window).width());
		if($(window).width() >= "950"){ $('#pModal').css('width','950px'); $('#pModal').css('margin-left','-400px');
		}else{ //v_m = v_w-15;
			$('#pModal').css('width',v_m+'px'); $('#pModal').css('margin-left','-5px');
		}
		*/
		$('#pModal').modal('show');
	}else{
		$('#pModalLock').hide();
		$('#pModal').modal('hide');
		$('#pModalOutraPG').hide();		
	}
}//pmodalDisplay



function pmodalHtml2(v_titulo,v_conteudo,v_tipo,v_get,v_class){
	if(v_get == "" || v_get == null){ v_get = ""; }
	if(v_class == "" || v_class == null){ v_class = ""; }
	$('#pModalConteudo2').show();
	//$('#pModalOutraPG').hide();
	$('#pModalLoadermsg2').html('');
	$("[rel=tooltip]").tooltip('hide');
	$("#pModal").draggable({ handle: "#pModalTitulo2" }); 
	if(v_tipo == "html"){
    	$('#pModalTitulo2').html(v_titulo);
		if(v_get == "append"){	$('#pModalConteudo2 div').hide(); $('#pModalConteudo2').append(v_conteudo); }else{ $('#pModalConteudo2').html(v_conteudo); }
    	$('#pModalRodape2').html('<button class="btn" data-dismiss="modal">Sair</button>');
    }
	if((v_tipo == "get") || (v_tipo == "post")){
		//$('#pModalOutraPG').show();
    	$('#pModalTitulo2').html(v_titulo);
    	$('#pModalConteudo2').html('<div class="content '+v_class+'" style="padding:3px;" id="pModalConteudoOn2"></div>');
		faisher_ajax('pModalConteudoOn2', 'pModalLoader2', v_conteudo, v_get, v_tipo);
    	$('#pModalRodape2').html('');
		$('#pModalPage2').val(v_conteudo);
		$('#pModalGet2').val(v_get);
		$('#pModalClass2').val(v_class);
    }
	pmodalDisplay2('show');
}//pmodalHtml
function pmodalDisplay2(v_acao){
	if(v_acao == 'show'){
		//ativa verificação de hide rolagem
		var p_scroll = $(window).scrollTop();
		$(window).bind('scroll', function(){
			if($('#pModal2').is(':visible') == true){ $(window).scrollTop(p_scroll); }else{ $(window).unbind('scroll'); }
		});		
		/*$("body").css("overflow", "hidden");
		$.doTimeout('vTimerpModal', 500, function(){
			if($('#pModal').is(':visible') == true){ return true; }else{ $.doTimeout('vTimerpModal'); $("body").css("overflow", "auto"); }
		});//TIMER */
		/*
		var v_w = Number($(window).width()); 
		if($(window).width() >= "1500"){
			$('#pModal').css('width','1500'); $('#pModal').css('margin-left','-760px');
		}else if($(window).width() >= "1400"){
			$('#pModal').css('width','1400'); $('#pModal').css('margin-left','-700px');
		}else if($(window).width() >= "1300"){
			$('#pModal').css('width','1300'); $('#pModal').css('margin-left','-660px');
		}else if($(window).width() >= "1100"){
			$('#pModal').css('width','1100px'); $('#pModal').css('margin-left','-570px');
		}else if($(window).width() >= "1100"){
			$('#pModal').css('width','1100px'); $('#pModal').css('margin-left','-570px');
		}else if($(window).width() >= "900"){
			$('#pModal').css('width','980px'); $('#pModal').css('margin-left','-470px');
			//verifica se tem numero de processo/oficio
		}else if($(window).width() >= "765"){
			$('#pModal').css('width','840px'); $('#pModal').css('margin-left','-370px');
		}else{ i_height = 450; v_m = v_w-15;
			$('#pModal').css('width',v_m+'px'); $('#pModal').css('margin','0px');
		}		
		*/
		/*var v_w = Number($(window).width());
		if($(window).width() >= "950"){ $('#pModal').css('width','950px'); $('#pModal').css('margin-left','-400px');
		}else{ //v_m = v_w-15;
			$('#pModal').css('width',v_m+'px'); $('#pModal').css('margin-left','-5px');
		}
		*/
		$('#pModal2').modal('show');
	}else{
		$('#pModalLock2').hide();
		$('#pModal2').modal('hide');
		$('#pModalOutraPG2').hide();		
	}
}//pmodalDisplay2


function pfullcontentHtml(v_titulo,v_conteudo,v_tipo,v_get){
	if(v_get == "" || v_get == null){ v_get = ""; }
	$('#pFullContent #pFullContent_content').html('');
	//$('#pModalOutraPG').hide();
	$('#pFullContent #pFullContent_loadermsg').html('');
	$("[rel=tooltip]").tooltip('hide');
    $('#pFullContent #pFullContent_titu').html(v_titulo);
	if(v_tipo == "html"){
		$('#pFullContent #pFullContent_content').html(v_conteudo);
    }
	if((v_tipo == "get") || (v_tipo == "post")){
		faisher_ajax('pFullContent #pFullContent_content', 'pFullContent #pFullContent_loader', v_conteudo, v_get, v_tipo);
    }
	pfullcontentDisplay('show');
}//pfullcontentHtml
$(window).resize(function(){ pfullcontentDisplay('hide'); });
function pfullcontentDisplay(v_acao){
	if(v_acao == 'show'){
		//ativa verificação de hide rolagem
		$("body").css("overflow", "hidden");
		$('#pFullContent_loader').css('width',$(window).width()+'px');
		$('#pFullContent_content').css('width',$(window).width()+'px');
		$.doTimeout('vTimerpFullContent', 500, function(){
			if($('#pFullContent').is(':visible') == true){ return true; }else{ $.doTimeout('vTimerpFullContent'); $("body").css("overflow", "auto"); }
		});//TIMER		
		var vw = Number($(window).height());
		var vwi = Number($("#pFullContent #pFullContent_header").outerHeight());
		res = (vw-vwi)-43;
		$('#pFullContent #pFullContent_loader').css('height',res+'px');
		$('#pFullContent #pFullContent_content').css('height',res+'px');
		$('#pFullContent').fadeIn();
	}else{
		$('#pFullContent').fadeOut();
	}
}//pfullcontentDisplay

function topCentralAjuda(){
	pmodalHtml('<i class="icon-question-sign"></i> CENTRAL DE AJUDA','geral/geral_ajuda_ajax.php','get','ajax=d_top&topico='+$('#idFaisher').val());
   	$('#pModalRodape').html('<button class="btn" data-dismiss="modal">Sair</button>');
}//topCentralAjuda


/* FUNCOES DE APOIO AO SELECT2*/
function formatSelect2HTML(state) {//retorno de html
    var originalOption = state.element;
    return state.text;
}

//ler log de registros
function lerLog(v_div,v_tb,v_id){
	faisher_ajax(v_div, v_div+'_load', './geral/lerLog_ajax.php', 'ajax=ler&tb='+v_tb+'&id='+v_id+'&div='+v_div, 'get', 'ADD');	
}//lerLog

//ver valor de campo
function valCampo(v_name,v_form){
	if((v_form == null) || (v_form == "")){ v_form = ""; }else{ v_form = "#"+v_form+" "; }
	var v_chek = $(v_form+"input[name='"+v_name+"']:checked").val();
	if((v_chek == null) || (v_chek == "")){ v_chek = "0"; }
	return v_chek;
}//valCampo

//rolagem faisher
function rolagemFaisher(v_id,v_tipo,v_container){
	if(v_tipo == "" || v_tipo == null){
		var settings = { contentWidth: '0px' };
	}
	if(v_tipo == "setas"){
		var settings = { showArrows: true,contentWidth: '0px' };
	}
	if(v_tipo == "setasH"){
		var settings = { showArrows: true,animateScroll: true };
	}
	if(v_tipo == "anima"){
		var settings = { animateScroll: true };
	}
	if(v_tipo == "setasanima"){
		var settings = { showArrows: true,animateScroll: true,contentWidth: '0px' };
	}
	if(v_container != "" && v_container != null){
		v_height = Number(v_container);
		if(v_height >= "1"){ }else{ v_height = $("#"+v_container).height(); }
		$('#'+v_id).jScrollPane(settings).data('jsp').scrollTo(0,v_height);
	}else{
		$('#'+v_id).jScrollPane(settings).data('jsp').reinitialise();
	}
}//rolagemFaisher


function SelectText(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;    
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();        
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}//SelectText


function openWindow(mypage, myname, w, h, scroll, resizable){
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 4;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable='+resizable
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) { win.window.focus();} 
}//openWindow

//ativar bloqueio
function bloqSession(){
	setCookieF('SYS_LOGIN_BLOQ', '0');
	pmodalDisplay('hide'); $(".modal-backdrop").hide();//corrige se popup aberto
	$("#divLoginBloq").fadeIn();
		//ativa verificação de hide rolagem
		$("body").css("overflow", "hidden");
		$.doTimeout('vTimerdivLoginBloq', 500, function(){
			if($('#divLoginBloq').is(':visible') == true){ return true; }else{ $.doTimeout('vTimerdivLoginBloq'); $("body").css("overflow", "auto"); }
		});//TIMER
	$("#divLoginBloq .divload").html('Session verrouillée :)');
	$("#divLoginBloq #bloqPassFull").val('');
}//bloqSession
function ativarSession(){
	if((getCookieF('SYS_LOGIN_BLOQ') != "0") && (Number($('#timeActive').val()) >= 1)){ setCookieF('SYS_LOGIN_BLOQ', $('#timeActive').val()); }
}//ativarSession

//funcoes de campo sort
function sortList(content_id,element_id){
	var list = "";
	$("#"+content_id+" #sort-"+element_id).parent().find( '.sortItem').each( function(){
		if(list != ""){ list += ","; } list += $(this).val();
	});	
	$("#"+content_id+" #"+element_id).val(list);
	if(list == ""){ $("#"+content_id+" #sort-"+element_id).hide(); }else{ $("#"+content_id+" #sort-"+element_id).fadeIn(); }
}
function sortRemove(content_id,element_id,id){
	$("#"+content_id+" #sort-"+element_id+"-"+id).fadeOut(1000,function(){$(this).remove(); sortList(content_id,element_id); });
}
function sortAdd(content_id,element_id,id,titu,content,v_cor){
	if(v_cor == "" || v_cor == null){ v_cor = "lightgrey"; }
	$("#"+content_id+" #sort-"+element_id).append('<div class="box box-color box-small box-bordered '+v_cor+'" id="sort-'+element_id+'-'+id+'"><div class="box-title" rel="tooltip" data-placement="bottom" data-original-title="Clique e arraste para ordenar"><h3><i class="icon-resize-vertical"></i> '+titu+' <input type="hidden" value="'+id+'" class="sortItem"/> </h3><div class="actions"> <a href="#" class="btn btn-mini content-remove" onclick="sortRemove(\''+content_id+'\',\''+element_id+'\',\''+id+'\');return false;" rel="tooltip" data-placement="left" data-original-title="Remover"><i class="icon-remove"></i></a></div></div> <div class="box-content">'+content+'</div></div>');
	sortList(content_id,element_id);
}



//protege dados POST decode PHP função: marcadorBASE64_
function marcadorBASE64_encode(v_dados){
    return "BASE64_"+encodeURIComponent(btoa(v_dados));
}//marcadorBASE64_encode


//funcoes de campo sort com cont ordem
function sortListO(content_id,element_id){
	var list = ""; var cont = 0;
	$("#"+content_id+" #sort-"+element_id).parent().find( '.sortItem').each( function(){
		cont++; cont_a = $(this).attr('data-id');
		if(list != ""){ list += ","; } list += cont+"-"+$(this).val()+"-"+cont_a;
	});	
	$("#"+content_id+" #"+element_id).val(list);
	if(list == ""){ $("#"+content_id+" #sort-"+element_id).hide(); }else{ $("#"+content_id+" #sort-"+element_id).fadeIn(); }
}
function sortRemoveO(content_id,element_id,cont){
	$("#"+content_id+" #sort-"+element_id+"-"+cont).fadeOut(1000,function(){$(this).remove(); sortListO(content_id,element_id); });
}
function sortAddO(content_id,element_id,cont,id,titu,content,v_cor){
	if(v_cor == "" || v_cor == null){ v_cor = "lightgrey"; }
	$("#"+content_id+" #sort-"+element_id).append('<div class="box boxSort box-color box-small box-bordered '+v_cor+'" id="sort-'+element_id+'-'+cont+'"><div class="box-title" rel="tooltip" data-placement="bottom" data-original-title="Clique e arraste para ordenar"><h3><i class="icon-resize-vertical"></i> '+titu+' <input type="hidden" value="'+id+'" data-id="'+cont+'" class="sortItem"/> </h3><div class="actions"> <a href="#" class="btn btn-mini content-remove" onclick="sortRemoveO(\''+content_id+'\',\''+element_id+'\',\''+cont+'\');return false;" rel="tooltip" data-placement="left" data-original-title="Remover"><i class="icon-remove"></i></a></div></div> <div class="box-content">'+content+'</div></div>');
	sortListO(content_id,element_id);
}//sortAddO

//enviar dados POST prettyPhoto iframe
function prettyPhotoForm(formId,v_titu,v_descri,v_load,v_autoclose,v_acao){
	if(v_load == "" || v_load == null){ var v_load = ""; }
	if(v_autoclose == "" || v_autoclose == null){ var v_autoclose = ""; }
	if(v_acao == "" || v_acao == null){ var v_acao = ""; }
	if(v_acao=="scroll"){
		$("body").css("overflow", "hidden");
		$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false,callback: function(){$("body").css("overflow", "auto");}});
	}else{
		$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false});
	}
	$.prettyPhoto.open('iframe=true&width=100%&height=100%',v_titu,v_descri);
	$.doTimeout('vTimerprettyPhotoForm', 500, function(){
		var formTarget = formId+"Target";
		var vw = $("#pp_full_res iframe").attr('width');
		var vh = $("#pp_full_res iframe").attr('height');
		if(v_load != ""){
			var d_html = '<div id="'+formTarget+'_load" style="color:rgb(255, 255, 255); background:url(img/shadows/b50.png) repeat; text-align:center; width:98%; height:'+vh+'px; position:absolute;"><br><br><br><br><br><img src="img/ajax-loader.gif"><br>'+v_load+'</div><iframe src="" width="'+vw+'" height="'+vh+'" frameborder="no" id="'+formTarget+'" name="'+formTarget+'"></iframe>';
		}else{
			var d_html = '<iframe src="" width="'+vw+'" height="'+vh+'" frameborder="no" id="'+formTarget+'" name="'+formTarget+'"></iframe>';
		}
		$("#pp_full_res").html(d_html);
		$("#"+formId).attr('target',formTarget);
		$("#"+formId).submit();
		if(v_load != ""){
			$('#'+formTarget).on('load', function () {
				$('#'+formTarget+'_load').hide();
				$('#'+formTarget).fadeIn();
				if(v_autoclose == "0"){ $.prettyPhoto.close(); if(v_acao=="scroll"){$("body").css("overflow", "auto");} }
			});
			if(v_autoclose == "down"){ $(window).blur(function(){ $.prettyPhoto.close(); if(v_acao=="scroll"){$("body").css("overflow", "auto");} }); }
		}
		if((v_autoclose != "") && (v_autoclose >= 1)){
			$.doTimeout('vTimerprettyPhotoFormLoad', (v_autoclose*1000), function(){ $.prettyPhoto.close(); if(v_acao=="scroll"){$("body").css("overflow", "auto");} });
		}
	});//TIMER 
}//prettyPhotoForm


/* campo CKeditor -----------------------------------------------------------------*/
(function($) {
  var defaults;
  $.event.fix = (function(originalFix) {
    return function(event) {
      event = originalFix.apply(this, arguments);
      if (event.type.indexOf('copy') === 0 || event.type.indexOf('paste') === 0) {
        event.clipboardData = event.originalEvent.clipboardData;
      }
      return event;
    };
  })($.event.fix);
  defaults = {
    callback: $.noop,
    matchType: /image.*/
  };
  return $.fn.pasteImageReader = function(options) {
    if (typeof options === "function") {
      options = {
        callback: options
      };
    }
    options = $.extend({}, defaults, options);
    return this.each(function() {
      var $this, element;
      element = this;
      $this = $(this);
      return $this.bind('paste', function(event) {
        var clipboardData, found;
        found = false;
        clipboardData = event.clipboardData;
        return Array.prototype.forEach.call(clipboardData.types, function(type, i) {
          var file, reader;
          if (found) {
            return;
          }
          if (type.match(options.matchType) || clipboardData.items[i].type.match(options.matchType)) {
            file = clipboardData.items[i].getAsFile();
            reader = new FileReader();
            reader.onload = function(evt) {
              return options.callback.call(element, {
                dataURL: evt.target.result,
                event: evt,
                file: file,
                name: file.name
              });
            };
            reader.readAsDataURL(file);
            return found = true;
          }
        });
      });
    });
  };
})(jQuery);//*/
function campoCKEDITOR(ckEditorID,v_height,v_layout){
	if(v_height == "" || v_height == null){ v_height = "200"; }	
	if(v_layout == "" || v_layout == null){ v_layout = "padrao"; }
	if(v_layout == "img"){
	CKEDITOR.replace(ckEditorID,{
			toolbar :
			[
			  { items : [ 'Source', '-', 'Maximize', 'ShowBlocks', '-', 'Undo', 'Redo', '-', 'Image', '-', 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Table', 'HorizontalRule', 'SpecialChar', '-', 'CopyFormatting', 'RemoveFormat', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
				'/',
			  { items : [ 'FontSize', 'TextColor', 'BGColor', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Styles', 'Format', 'Font' ] }
			],
			height: v_height,
			extraAllowedContent: '*(*);*{*};style'
			//allowedContent: true
	});
	
	CKEDITOR.dialog.add('image', function (api) {
	  var bytesToSize = function(bytes) {
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (bytes == 0) return '0 Byte';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	  };
	  var regexGetSize = /^\s*(\d+)((px)|\%)?\s*$/i,
		  regexGetSizeOrEmpty = /(^\s*(\d+)((px)|\%)?\s*$)|^$/i,
		  pxLengthRegex = /^\d+px$/;
	
	  var maxsize = 1024000;
	  var numbering = function (id) {
		return CKEDITOR.tools.getNextId() + '_' + id;
	  },
		  previewImageId = numbering('previewImage'),
		  errorBoxId = numbering('previewImage');
	  
	  return {
		title: 'Selecione uma imagem para adicionar',
		minWidth: 400,
		minHeight: 250,
		contents: [
		  {
			id: 'imagesInfos',
			label: 'Informação sobre a imagem',
			title: 'Informação sobre a imagem',
			elements: [
			  {
				type: 'html',
				id: 'htmlError',
				style: 'width:95%; text-align: center;',
				html: '<div><span style="color: red;" id="' + errorBoxId + '"/></div>'
			  },
			  {
				id: 'datas',
				type: 'textarea',
				hidden: true,
				validate: function (e) {
				  var isValid = this.getValue() ? true : false;
				  if (!isValid)
					this.getDialog().errorBox.setText('A imagem não pode estar vazia.');
				  return isValid;
				},
				required: true
			  },
			  {
				type: 'file',
				label: 'Imagem',
				id: 'file',
				onChange: function (e) {
				  var filesSelected = this.getInputElement().$.files;
				  if (filesSelected.length > 0 && filesSelected[0].size < maxsize && filesSelected[0].type.match('image*')) {
					e.sender.getDialog().errorBox.setText('');
					var fileToLoad = filesSelected[0];
					var fileReader = new FileReader();
					fileReader.onload = function (fileLoadedEvent) {
					  var image = new Image();
					  image.src = fileLoadedEvent.target.result;
					  image.onload = function () {
						e.sender.getDialog().getContentElement('imagesInfos', 'width').setValue(this.width);
						e.sender.getDialog().getContentElement('imagesInfos', 'height').setValue(this.height);
					  };
					//alert("SYNC: "+JSON.stringify(fileLoadedEvent.target.result));
					//alert('V: '+e.sender.getDialog().getContentElement('imagesInfos', 'datas').getValue());
					  e.sender.getDialog().getContentElement('imagesInfos', 'datas').setValue(fileLoadedEvent.target.result);
					  e.sender.getDialog().preview.setAttribute('src', fileLoadedEvent.target.result);
					};
					fileReader.readAsDataURL(fileToLoad);
				  } else if (!filesSelected[0].type.match('image*')) {
					e.sender.getDialog().errorBox.setText('O arquivo deve ser uma imagem.');
				  } else if (filesSelected[0].size >= maxsize) {
					e.sender.getDialog().errorBox.setText('A imagem não deve exceder '+bytesToSize(maxsize)+'.');
				  }
				}
			  }, {
				type: 'hbox',
				widths: ['50%', '50%'],
				align: 'left',
				children: [
				  {
					type: 'vbox',
					height: '250px',
					children: [{
					  id: 'width',
					  type: 'text',
					  label: 'Largura (width)',
					  validate: function () {
						var aMatch = this.getValue().match(regexGetSizeOrEmpty),
							isValid = !!(aMatch && parseInt(aMatch[1], 10) !== 0);
						if (!isValid)
						  this.getDialog().errorBox.setText('A largura não é válida.');
						return isValid;
					  }
					}/*,
							   {
								 id: 'height',
								 type: 'text',
								 label: 'Altura (height)',
								 validate: function () {
								   var aMatch = this.getValue().match(regexGetSizeOrEmpty),
									   isValid = !!(aMatch && parseInt(aMatch[1], 10) !== 0);
								   if (!isValid)
									 this.getDialog().errorBox.setText('A altura não é válida.');
								   return isValid;
								 }
							   }*/]
				  },
				  {
					type: 'html',
					id: 'htmlPreview',
					style: 'width:95%;',
					html: '<div><img id="' + previewImageId + '" src="" style="width:200px!important; max-width:100%!important;max-height:100%!important;" /></div>'
				  }
				]
			  }
			]
		  }
		],
		onShow: function (e) {
		  var editor = this.getParentEditor(),
			  sel = editor.getSelection(),
			  element = sel && sel.getSelectedElement();
	
		  this.originalElement = editor.document.createElement('img');
		  this.preview = CKEDITOR.document.getById(previewImageId);
		  this.errorBox = CKEDITOR.document.getById(errorBoxId);
	
		  this.errorBox.setText('');
	
		  if (element && element.getName() == 'img') {
			this.imageEditMode = element.getName();
			this.imageElement = element;
			this.getContentElement('imagesInfos', 'datas').setValue(element.$.src);
			this.getContentElement('imagesInfos', 'width').setValue(element.$.width);
			//this.getContentElement('imagesInfos', 'height').setValue(element.$.height);
			this.preview.setAttribute('src', element.$.src);
		  }else {
			this.preview.setAttribute('src', '');
		  }
	
		  if (!this.imageEditMode) {
			this.imageElement = editor.document.createElement('img');
		  }
		},
		onOk: function (e) {
		  var imageDatas = this.getContentElement('imagesInfos', 'datas');
		  var imageWidth = this.getContentElement('imagesInfos', 'width');
		 // var imageHeight = this.getContentElement('imagesInfos', 'height');
		  var sOptions = '';
	
		  sOptions+= imageWidth.getValue()? ' width="' + imageWidth.getValue() + '"':'';
		  //sOptions+= imageHeight.getValue()? ' height="' + imageHeight.getValue() + '"':'';
		  console.log(sOptions);
		  var imgHtml = CKEDITOR.dom.element.createFromHtml('<img src="' + imageDatas.getValue() + '"' + sOptions + ' />');
		  api.ui.editor.insertElement(imgHtml);
		}
	  };
	});
	CKEDITOR.instances[ckEditorID].on( 'contentDom', function(){
	  var oEditor = CKEDITOR.instances[ckEditorID];
	  $( oEditor.window.getFrame().$ ).contents().find( 'html' ).pasteImageReader(function(results) {
		var dataURL = results.dataURL;
		var newElement = CKEDITOR.dom.element.createFromHtml( '<img src="' + dataURL + '" />', oEditor.document);
			oEditor.insertElement( newElement );
		});
	});
	
	}else if(v_layout == "menor"){
	CKEDITOR.replace(ckEditorID,{
			toolbar :
			[
			  { items : [ 'Source', '-', 'Maximize', '-', 'Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt', '-', 'HorizontalRule', 'SpecialChar', '-', 'CopyFormatting', 'RemoveFormat', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
			  { items : [ 'FontSize', 'TextColor', 'BGColor', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Format', 'Font' ] }
			],
			height: v_height,
			extraAllowedContent: '*(*);*{*};style'
	});
	
	}else{//v_layout
	CKEDITOR.replace(ckEditorID,{
			toolbar :
			[
			  { items : [ 'Source', '-', 'Maximize', 'ShowBlocks', '-', 'Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Table', 'HorizontalRule', 'SpecialChar', '-', 'CopyFormatting', 'RemoveFormat', '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
				'/',
			  { items : [ 'FontSize', 'TextColor', 'BGColor', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Styles', 'Format', 'Font' ] }
			],
			height: v_height,
			extraAllowedContent: '*(*);*{*};style'
	});
	
	}//else{//v_layout

}//campoCKEDITOR








/* CLASSE DE CRIPTOGRAFIA - ( fCriptoJS 1.0 11/08/2016) ------------------------------------------------------------------>>>*/
/*  //DA SENHA: 16, 24 ou 32 - caracteres
	//ENCRIPTAR
	fCripto = new fCriptoJS(); fCripto.setPass("senha de acesso");
	var crypt = fCripto.encrypt("dados a encriptar");
	//DESCRIPTAR 
	fCripto = new fCriptoJS(); fCripto.setPass("senha de acesso");
	var decrypt = fCripto.decrypt("dados a descriptar");
*/
function fCriptoJS() {
	var Pass;
	var Key;
	var Text;
	var Algo = 'rijndael-256';
	var Salt;
	// Definir senha
	this.setPass = function(_Pass) {
		Pass = _Pass;
		geraKey();
	}
	this.encrypt = function(data) {
		if (!data) {
			return false;
		}
		// Resolver problema de acentuação
		data = Base64._utf8_encode(data);
		// Criptando
		var crypt = mcrypt.Encrypt(data,'',Key,Algo,'ecb');		
		// Converter string cryptada para Hex
		crypt = toHex(crypt);		
		// Equivalente a base64_encode php
		crypt = Base64.encode(crypt);		
		// Equivalente a urlencode php
		crypt = encodeURIComponent(crypt);
    	crypt = crypt.replace(/%/g, "_-_");
		return crypt.trim();		
	}	
	this.decrypt = function(data) {
		if (!data) {
			return false;
		}
		// equivalente urldecode php
		data = decodeURIComponent(data); 		
		// equivalente base64_decode php
		data = Base64.decode(data); 
		// Necessario realizar esta conversão para decrypt
		data = hexToString(data);
		// decryptando
		var decrypt = mcrypt.Decrypt(data,'',Key,Algo,'ecb'); 		
		//Resolver problema de acentuação
		decrypt = Base64._utf8_decode(decrypt);	
	    decrypt = decrypt.replace(/_-_/g, "%");			
		return decrypt.trim();
	}
	geraKey = function() {
		Key = Pass.substr(0, mcrypt.get_key_size(Algo,'ecb'));
	}
}//fCriptoJS



//função de cripto string
function criptoString(string,chave){
	fCripto = new fCriptoJS();
	fCripto.setPass(chave);
	return fCripto.encrypt(string);	
}//criptoString
