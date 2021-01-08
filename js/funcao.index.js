$(document).ready(function() {
	loaderFoco('main','div_principalContent_load','Attendez le chargement ...'); $("#div_principalContent_load").height($(document).height());
	shortcut.add("Ctrl+M",function(){ $('#div_mapamenugeral').fadeIn(); });
	
	// Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });
});

$.doTimeout('vTimerTimeActive', 5000, function(){
	faisher_ajax('divTimeActive', '0', 'geral/index_time_ajax.php', 'ajax=time', 'get', 'ADD');
	
	return true;
});//TIMER

//acoes de sessao ativa
$(document).keyup(function(e){ ativarSession(); });
$(document).click(function(){ ativarSession(); });
$(document).scroll(function(){ ativarSession(); });
$(document).mousemove(function(event){ ativarSession(); });