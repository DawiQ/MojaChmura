$(document).ready(function(){
    
	var actual = $("#Dokumenty");
	actual.slideDown();
	
	$(".directory").click( function(){
		actual.slideUp( 300 );
		actual = $( "#" + $(this).text() );
		actual.slideDown( 300 );
	});
	
	
	
});