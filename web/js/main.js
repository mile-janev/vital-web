$(document).ready(function(){
    tile();
    
    //Click on modal window
    $('#modalButton').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
    
    //Click on modal window
    $('.modalLog').click(function(){
        $('#modal .modal-title').html($(this).attr('title'));
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('rel'));
    });
    
    //Modal info popup add title and content
    $(".view-medication").click(function(){
        var id = $(this).attr("rel");
        var title = $(id).attr("rel");
        var content = $(id).html();
        $("#infoModalTitle").html(title);
        $("#infoModalContent").html(content);
    });
    
})

$(window).resize(function(){
    tile();
});