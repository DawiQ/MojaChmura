$(document).ready(function(){
	
	var fileName = '';
	
	$( ".commentValue").val('');
	
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
	
	$(".goodJob").slideDown( 500 );
	
	$(".goodJob i").click( function(){
		$(this).parent().slideUp(500);
    });
	
	$(".closeFilePanel").click(function(){
        $("#fileInfo").slideUp( 300 );
        $("#lastActivity").slideDown( 300 );
		$(".dirUps, .fileUps").toggle();
	});
    
    $(".file").click( function(){
		//alert( $(this).text() );
		$(".bold").text( $(this).text() );
		
		$("#fileNameComment").val( $.trim( $(this).text() ) );
		
        $("#lastActivity").slideUp( 300 );
		
		fileName = $.trim( $(this).text() );
		
        $("#fileInfo").slideDown( 300 );
		$(".dirUps, .fileUps").toggle();
		
		info = [];
		info[0] = categoryId;
		info[1] = $.trim( $(this).text() );
		
		jQuery.ajax({
			url: 'getFileInfo.php',
			method: 'POST',
			data: {info: info}
		}).done(function (response) {
			$(".fileInfo").html( response );
		}).fail(function () {
		});

		jQuery.ajax({
			url: 'selectComments.php',
			method: 'POST',
			data: {info: info}
		}).done(function (response) {
			$(".comments").html( response );
		}).fail(function () {
		});
    });
	
	$('#formularzKomentarz').submit( function(e){
		e.preventDefault();
		
		var comment = $( ".commentValue").val();
		
		jQuery.ajax({
			url: 'addComment.php',
			method: 'POST',
			data: $('#formularzKomentarz').serialize()
		}).done(function (response) {
			$(".comments").prepend( response );
		}).fail(function () {
		});
	});
	
	$(".submitComment").click(function(e){
		e.preventDefault();
		var comment = $( ".commentValue").val();
		
		jQuery.ajax({
			url: 'addComment.php',
			method: 'POST',
			data: $('#formularzKomentarz').serialize()
		}).done(function (response) {
			$(".comments").prepend( response );
		}).fail(function () {
		});
		
	});
	
});

$(function () {
        $("#treeview").shieldTreeView({
            dataSource: dataSrc
        });

        for (var key in folderData) {
            $(".pb-filemng-template-body").append(
                '<div class="col-xs-6 col-sm-6 col-md-3 pb-filemng-body-folders">' +
                folderData[key].icon + '<br />' + 
                '<p class="pb-filemng-paragraphs">' + folderData[key].text + '</p>' + 
                '</div>'
            );
        }
    })
