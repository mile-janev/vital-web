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
                $("#modalCall #callModalContent").html("New call from " + response.caller);
                $('#modalCall').modal('show');
            } else {
                $("#modalCall #callModalContent").html("Missed call from " + response.caller);
                $('#modalCall').modal('hide');
            }
        }, 'json')
    }
}

function checkCallStatus() {
    var url = $("#ajaxCheckCallStatus").html();
    var called = $("#called").html();
    jQuery.post(url, 
    { 
        called: called
    },
    function(response){
        if (response.status == 'dismissed') {
            var callFinished = $("#call-dismissed").attr("href");
            window.location.href = callFinished;
        }
    }, 'json')
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
                $("#modalSos #sosModalTitle").html("SOS from " + response.patient);
                $("#modalSos #sosModalContent").html(response.sos + " at " + response.time);
                $('#modalSos').modal('show');
            }
        }, 'json')
    }
}

function mews_calculate(systolic, heart, respiratory, temperature, avpu) {
    var mews = parseInt(avpu);
    
    if (systolic <= 70) {
        mews += 3;
    } else if ( (systolic >= 71 && systolic <= 100) || systolic >= 200) {
        mews += 2;
    }
    
    if (heart >= 130) {
        mews += 3;
    } else if ( heart <= 40 || (heart >= 111 && heart <= 129) ) {
        mews += 2;
    } else if ( (heart >= 41 && heart <= 50) || (heart >= 101 && heart <= 110) ) {
        mews += 1;
    }
    
    if (respiratory >= 30) {
        mews += 3;
    } else if ( respiratory < 9 || (respiratory >= 21 && respiratory <= 29) ) {
        mews += 2;
    } else if (respiratory >= 15 && respiratory <= 20) {
        mews += 1;
    }
    
    if (temperature < 35 || temperature >= 38.5) {
        mews += 2;
    }
    
    return mews;
}