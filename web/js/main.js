$(document).ready(function(){
    tile();
    
    if ($("#controller-view").html() != "connection/call") {
        checkForCall();
    }
    
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
    
    $(".reminder-done").click(function(){
        var toUrl = $("#url").html();
        var id = $(this).attr("rel");
        
        $.post(toUrl, 
            { 
                id: id
            },
            function(response){
                if (response.status == 'yes') {
                    if (response.new == 'no') {
                        $("#message-box").html("No new messages");
                        $("#message-box").removeAttr("data-target");
                    } else {
                        $("#message-box").html(response.new_label);
                        $("#infoModalContent").html(response.new_content);
                        $(".reminder-done").attr("rel", response.new_id);
                    }
                }
            }, 'json');
    });
    
    //Check for call start
    setInterval(function () {
        checkForCall();
    }, 5000);
    
    $("#callDismiss").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.post(url, 
        {
            
        },
        function(response){
            if (response.status == 'yes') {
                $('#modalCall').modal('hide');
            } else {
                console.log("error");
            }
        }, 'json')
    })
    //Check for call end
    
    //SOS click start
    $("#sos").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.post(url, 
        {
            
        },
        function(response){
            if (response.status == 'yes') {
                $('#modalCall').modal('hide');
            } else {
                console.log("error");
            }
        }, 'json')
    })
    //SOS click end
    
})

$(window).resize(function(){
    tile();
});