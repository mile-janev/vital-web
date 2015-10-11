$(document).ready(function(){
    tile();
    
    //Click on modal window
    $('#modalButton').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    $(".view-medication").click(function(){
        var id = $(this).attr("rel");
        var title = $(id).attr("rel");
        var content = $(id).html();
        $("#infoModalTitle").html(title);
        $("#infoModalContent").html(content);
    });

//$('#modalInfo').on('shown.bs.modal', function() {
//    alert('shown');
////    $("#txtname").focus();
//})

})

$(window).resize(function(){
    tile();
});

//$(window).on('shown.bs.modal', function(e) { 
//    e.preventDefault();
////    $('#code').modal('show');
//    alert('shown');
//});