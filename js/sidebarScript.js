$(document).ready(function(){
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
	
	$(".goodJob").slideDown( 500 );
	
	$(".goodJob i").click( function(){
		$(this).parent().slideUp(500);
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