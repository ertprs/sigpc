<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
if(isset($_GET["charset"])){ $CHARSET = $_GET["charset"]; }
if(!isset($SCRIPTOFF)){ $SCRIPTOFF = "1"; }// 0 1
if(!isset($CHARSET)){ $CHARSET = "UTF-8"; }// UTF-8 ISO-8859-1
header("Content-Type: text/html; charset=".$CHARSET."",true);

#Evitando cache de arquivo   
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');   
header('Last-Modified: '. gmdate('D, d M Y H:i:s') .' GMT');   
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0',false);   
header('Pragma: no-cache');   
header("Cache: no-cache");     
header('Expires: 0'); 
// */

if(isset($_GET["scriptoff"])){ $SCRIPTOFF = "0"; }//desliga scripts}
if($SCRIPTOFF == "1"){
if(isset($_GET["xml"])){//verifia se desliga para gerar XML
	header("Content-Type: text/xml");
}else{
?>
<script>
$(document).ready(function() {
	var mobile = false,
	tooltipOnlyForDesktop = true,
	notifyActivatedSelector = 'button-active';

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
		mobile = true;
	}
	

	// Tooltips (only for desktop) (bootstrap tooltips)
	if(tooltipOnlyForDesktop)
	{
		if(!mobile)
		{
			$('[rel=tooltip]').tooltip();
		}
	}
	
	
	$('textarea.autolinha').autogrow();


	// Notifications
	$(".notify").click(function(){
		var $el = $(this);
		var title = $el.attr('data-notify-title'),
		message = $el.attr('data-notify-message'),
		time = $el.attr('data-notify-time'),
		sticky = $el.attr('data-notify-sticky'),
		overlay = $el.attr('data-notify-overlay');

		$.gritter.add({
			title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
			text: 	(typeof message !== 'undefined') ? message : 'Body',
			image: 	(typeof image !== 'undefined') ? image : null,
			sticky: (typeof sticky !== 'undefined') ? sticky : false,
			time: 	(typeof time !== 'undefined') ? time : 3000
		});
	});

	// masked input
	if($('.mask_date').length > 0){
		$(".mask_date").mask("99/99/9999");	
	}
	if($('.mask_hora').length > 0){
		$(".mask_hora").mask("99:99");	
	}
	if($('.mask_phone').length > 0){
		$(".mask_phone").mask("(+999) 999 99 99 99");
	}
	if($('.mask_cpf').length > 0){
		$(".mask_cpf").mask("999.999.999-99");	
	}
	if($('.mask_cnpj').length > 0){
		$(".mask_cnpj").mask("99.999.999/9999-99");	
	}
	if($('.mask_cep').length > 0){
		$(".mask_cep").mask("99999-999");	
	}
	if($('.mask_protocolo').length > 0){
		$(".mask_protocolo").mask("9999.99.99/9999999-999999");	
	}
	if($('.mask_code9').length > 0){
		$(".mask_code9").mask("9999.99.99/999999999-999999");	
	}
	if($('.mask_productNumber').length > 0){
		$(".mask_productNumber").mask("aaa-9999-a");	
	}
	if($('.mask_nverificador').length > 0){
		$(".mask_nverificador").mask("9999.999.999-999");	
	}	
	
	//valore
	if($('.mask_valor').length > 0){
		$('.mask_valor').priceFormat({
			prefix: 'R$ ',
			centsSeparator: ',',
			thousandsSeparator: '.'
		});
	}
	
	// tag-input
	if($(".tagsinput").length > 0){
		$('.tagsinput').each(function(e){
			$(this).tagsInput({width:'auto', height:'auto'});
		});
	}
	
	// datepicker
	if($('.datepick').length > 0){
		$('.datepick').datepicker({autoclose: true});
	}

	// daterangepicker
	if($('.daterangepick').length > 0){
		$('.daterangepick').daterangepicker();
	}

	// timepicker
	if($('.timepick').length > 0){
		$('.timepick').timepicker({
			defaultTime: 'current',
			minuteStep: 1,
			disableFocus: true,
			template: 'dropdown'
		});
	}
	// colorpicker
	if($('.colorpick').length > 0){
		$('.colorpick').colorpicker();	
	}
	// uniform
	if($('.uniform-me').length > 0){
		$('.uniform-me').uniform({
			radioClass : 'uni-radio',
			buttonClass : 'uni-button'
		});
	}
	// Chosen (chosen)
	if($('.chosen-select').length > 0)
	{
		$('.chosen-select').each(function(){
			var $el = $(this);
			var search = ($el.attr("data-nosearch") === "true") ? true : false,
			opt = {};
			if(search) opt.disable_search_threshold = 9999999;
			$el.chosen(opt);
		});
	}
	
	if($("a[rel^='prettyPhoto']").length > 0){
		$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'facebook',slideshow:3000, autoplay_slideshow: false});
	}

	if($(".select2-me").length > 0){
		$(".select2-me").select2();
	}

	// multi-select
	if($('.multiselect').length > 0)
	{
		$(".multiselect").each(function(){
			var $el = $(this);
			var selectableHeader = $el.attr('data-selectableheader'),
			selectionHeader  = $el.attr('data-selectionheader');
			if(selectableHeader != undefined)
			{
				selectableHeader = "<div class='multi-custom-header'>"+selectableHeader+"</div>";
			}
			if(selectionHeader != undefined)
			{
				selectionHeader = "<div class='multi-custom-header'>"+selectionHeader+"</div>";	
			}
			$el.multiSelect({
				selectionHeader : selectionHeader,
				selectableHeader : selectableHeader
			});
		});
	}

	// spinner
	if($('.spinner').length > 0){
		$('.spinner').spinner();
	}
	if($('.spinnerPositivo').length > 0){
		$('.spinnerPositivo').spinner({min:0});
	}

	// Validation
	if($('.form-validate').length > 0)
	{
		$('.form-validate').each(function(){
			var id = $(this).attr('id');
			$("#"+id).validate({
				errorElement:'span',
				errorClass: 'help-block error',
				errorPlacement:function(error, element){
					element.parents('.controls').append(error);
				},
				highlight: function(label) {
					$(label).closest('.control-group').removeClass('error success').addClass('error');
				},
				success: function(label) {
					label.addClass('valid').closest('.control-group').removeClass('error success').addClass('success');
				}
			});
		});
	}
	
	// somente numero
	if($('.so_numero').length > 0){
		$(".so_numero").keypress(verificaNumero);
	}
	// somente numero com virgula
	if($('.virgula_numero').length > 0){
		$(".virgula_numero").keypress(verificaNumeroVirg);
	}
	// somente numero com virgula
	if($('.virgula_numero_d').length > 0){
		$(".virgula_numero_d").keypress(verificaNumeroVirgD);
	}
	// somente numero com ponto
	if($('.ponto_numero').length > 0){
		$(".ponto_numero").keypress(verificaNumeroPont);
	}
	// ponto e *
	if($('.ipfaixa_numero').length > 0){
		$(".ipfaixa_numero").keypress(verificaIpFaixa);	
	}

	
    $(".cssFonteMai").bind("blur change paste", function(e) {
		 var el = $(this);
		 setTimeout(function(){
		 var text = $(el).val();
		 el.val(text.toUpperCase());
		 }, 100);
    });	
    $(".cssFonteMin").bind("blur change paste", function(e) {
		 var el = $(this);
		 setTimeout(function(){
		 var text = $(el).val();
		 el.val(text.toLowerCase());
		 }, 100);
    });	
	$('.cssLetraNum').filter_input({regex:'[a-zA-Z0-9_]'});
	
});


function verificaNumero(e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
function verificaNumeroVirg(e) {
	if($(this).val().indexOf(',') != -1 && e.which == 44){ return false; }
	if (e.which != 44 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
function verificaNumeroVirgD(e) {
	if($(this).val().indexOf(',') != -1 && e.which == 44){ return false; }
	if($(this).val().indexOf('D') != -1 && e.which == 68){ return false; }
	if($(this).val().indexOf('d') != -1 && e.which == 100){ return false; }
	if (e.which != 68 && e.which != 100 && e.which != 44 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
function verificaNumeroPont(e) {
	if($(this).val().indexOf('.') != -1 && e.which == 46){ return false; }
	if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
function verificaIpFaixa(e) {
	if (e.which != 42 && e.which != 44 && e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
}
</script>
<?php
}//if($SCRIPTOFF == "1"){



}//desliga XML
?>