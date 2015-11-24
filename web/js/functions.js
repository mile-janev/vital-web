function tile() {
    var windowWidth = jQuery(window).width();
    if (windowWidth > 767) {
        var maxHeight = 150;
        jQuery(".tile").css("height", "auto");
        jQuery('.tile').each(function() {
            var thisHeight = jQuery(this).height();
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });
        jQuery(".tile").css("height", maxHeight + "px");
    } else {
        jQuery(".tile").css("height", "auto");
    }
}

function format_time(time) {
    
    var minutes = Math.floor(time / 60);
    
    var seconds = time - minutes * 60;
    
    var hours = Math.floor(time / 3600);
    time = time - hours * 3600;
    
    var finalTime = str_pad_left(minutes,'0',2)+':'+str_pad_left(seconds,'0',2);
    
    return finalTime;
    
}

function str_pad_left(string,pad,length) {
    return (new Array(length+1).join(pad)+string).slice(-length);
}

function checkForCall() {
    var userLogged = $("#userLogged").html();
    var url = $("#ajaxUrl").html();
    if (userLogged == "1") {
        jQuery.post(url, 
        { 

        },
        function(response){
            if (response.call == 'yes') {
                $("#modalCall #infoModalContent").html("New call from " + response.caller);
                $('#modalCall').modal('show');
            }
        }, 'json')
    }
}

function checkForSOS() {
    var sosNoteShow = $("#sosNote").html();
    var urlSos = $("#sosNote").attr("rel");
    if ($.trim(sosNoteShow) == "1") {
        jQuery.post(urlSos, 
        { 

        },
        function(response){
            if (response.status == 'yes') {
                $("#modalSos #from-sos").html(response.from_id);
                $("#modalSos #infoModalTitle").html("SOS from " + response.patient);
                $("#modalSos #infoModalContent").html(response.sos + " at " + response.time);
                $('#modalSos').modal('show');
            }
        }, 'json')
    }
}