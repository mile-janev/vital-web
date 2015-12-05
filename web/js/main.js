$(document).ready(function(){
    tile();
    
    checkForSOS();
    
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
    //Check for call end
    
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
    
    //SOS click start
    $("#sos").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.post(url, 
        {
            
        },
        function(response){
            if (response.status == 'yes') {
                $('#modalSos').modal('show');
            } else {
                console.log("error");
            }
        }, 'json')
    })
    //SOS click end
    
    //Check for SOS start
    setInterval(function () {
        checkForSOS();
    }, 2000);
    //Check for SOS end
    
    //SOS Close doctor start
    $("#remove-sos").click(function(e){
        e.preventDefault();
        var url = $(this).attr("rel");
        var from_id = $("#from-sos").html();
        $.post(url, 
        {
            from_id: from_id
        },
        function(response){
            if (response.status == 'yes') {
                $('#modalSos').modal('hide');
            } else {
                $('#modalSos').modal('hide');
            }
        }, 'json')
    })
    //SOS Close doctor end
    
    //Calculate MEWS start
    $("#mews-button").click(function(e){
        e.preventDefault();
        
        var systolic = $("#mewsform-systolic").val();
        var heart = $("#mewsform-heart").val();
        var respiratory = $("#mewsform-respiratory").val();
        var temperature = $("#mewsform-temperature").val();
        var avpu = $("#mewsform-avpu").val();
        
        //"IF" for all OK, "ELSE" for errors
        if (
            $.trim(systolic) != "" && $.isNumeric(systolic) &&
            $.trim(heart) != "" && $.isNumeric(heart) &&
            $.trim(respiratory) != "" && $.isNumeric(respiratory) &&
            $.trim(temperature) != "" && $.isNumeric(temperature)
        ) {
            $("#mews-form .form-group").removeClass("has-error");
            $("#mews-form .form-group .help-block").html("");
            
            var mews = mews_calculate(systolic, heart, respiratory, temperature, avpu);
            $("#mews-value").html(mews);
            
            $("#mews-saved").css("display", "none");
            $("#mews-save").css("display", "block");
        } else {
            
            $("#mews-save").css("display", "none");
            $("#mews-saved").css("display", "none");
            
            //Systolic blood pressure errors
            if ($.trim(systolic) == "" || !$.isNumeric(systolic)) {
                $(".field-mewsform-systolic").removeClass("has-success").addClass("has-error");

                if ($.trim(systolic) == "") {
                    $(".field-mewsform-systolic .help-block").html("Systolic Blood Pressure cannot be blank.");
                } else if (!$.isNumeric(systolic)) {
                    $(".field-mewsform-systolic .help-block").html("Systolic Blood Pressure must be an integer.");
                }
            } else {
                $(".field-mewsform-systolic").removeClass("has-error").addClass("has-success");
                $(".field-mewsform-systolic .help-block").removeClass("help-block-error");
                $(".field-mewsform-systolic .help-block").html("");
            }
            
            //Heart rate errors
            if ($.trim(heart) == "" || !$.isNumeric(heart)) {
                $(".field-mewsform-heart").removeClass("has-success").addClass("has-error");

                if ($.trim(heart) == "") {
                    $(".field-mewsform-heart .help-block").html("Heart Rate cannot be blank.");
                } else if (!$.isNumeric(heart)) {
                    $(".field-mewsform-heart .help-block").html("Heart Rate must be an integer.");
                }
            } else {
                $(".field-mewsform-heart").removeClass("has-error").addClass("has-success");
                $(".field-mewsform-heart .help-block").removeClass("help-block-error");
                $(".field-mewsform-heart .help-block").html("");
            }
            
            //Respiratory rate errors
            if ($.trim(respiratory) == "" || !$.isNumeric(respiratory)) {
                $(".field-mewsform-respiratory").removeClass("has-success").addClass("has-error");

                if ($.trim(respiratory) == "") {
                    $(".field-mewsform-respiratory .help-block").html("Respiratory Rate cannot be blank.");
                } else if (!$.isNumeric(respiratory)) {
                    $(".field-mewsform-respiratory .help-block").html("Respiratory Rate must be an integer.");
                }
            } else {
                $(".field-mewsform-respiratory").removeClass("has-error").addClass("has-success");
                $(".field-mewsform-respiratory .help-block").removeClass("help-block-error");
                $(".field-mewsform-respiratory .help-block").html("");
            }
            
            //Temperature errors
            if ($.trim(temperature) == "" || !$.isNumeric(temperature)) {
                $(".field-mewsform-temperature").removeClass("has-success").addClass("has-error");

                if ($.trim(temperature) == "") {
                    $(".field-mewsform-temperature .help-block").html("Temperature cannot be blank.");
                } else if (!$.isNumeric(temperature)) {
                    $(".field-mewsform-temperature .help-block").html("Temperature Rate must be an integer.");
                }
            } else {
                $(".field-mewsform-temperature").removeClass("has-error").addClass("has-success");
                $(".field-mewsform-temperature .help-block").removeClass("help-block-error");
                $(".field-mewsform-temperature .help-block").html("");
            }
            
        }
    })
    //Calculate MEWS end
    
    
    // Save MEWS into DB start
     $("#mews-save").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        var user_id = $("#mewsform-patient").val();
        
        var systolic = $("#mewsform-systolic").val();
        var heart = $("#mewsform-heart").val();
        var respiratory = $("#mewsform-respiratory").val();
        var temperature = $("#mewsform-temperature").val();
        var avpu = $("#mewsform-avpu").val();
        
        $.post(url, 
        {
            user_id: user_id,
            systolic: systolic,
            heart: heart,
            respiratory: respiratory,
            temperature: temperature,
            avpu: avpu
        },
        function(response){
            $('#mews-save').css('display', 'none');
            if (response.status == 'yes') {
                $('#mews-saved').css('display', 'block');
            } else {
                $('#mews-saved').html('Error. Unable to save parameters.');
                $('#mews-saved').css('display', 'block');
            }
        }, 'json')
     })
    //Save MEWS into DB end
    
})

$(window).resize(function(){
    tile();
});