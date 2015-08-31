jQuery(document).ready(function(){
    tile();
    
    //Click on modal window
    $('#modalButton').click(function(){
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
    });
})

jQuery(window).resize(function(){
    tile();
});