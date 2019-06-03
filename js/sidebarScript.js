$(document).ready(function(){
	
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
	});
    
    $(".file").click( function(){
		//alert( $(this).text() );
		$(".bold").text( $(this).text() );
        $("#lastActivity").slideUp( 300 );
        $("#fileInfo").slideDown( 300 );
    });
	
	$(".submitComment").click(function(e){
		e.preventDefault();
		var comment = $( ".commentValue").val();
		
		$(".comments").prepend( '<div class="row"><b class="list-group-item col-2">Nowy user</b><p class="list-group-item  col-8 "> ' + comment + '</p></div>' );
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
