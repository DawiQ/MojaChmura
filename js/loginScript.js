$(document).ready(function(){
	
	$(".loginBox").slideDown(500);
	
	$("#btnAction").click( function(){
		$(".loginBox").toggle();
		$(".registrationBox").toggle();
		
		if( $(".loginBox").is(":visible") )
			$(this).val('Rejestracja');
		else
			$(this).val('Logowanie');
	});
	
});