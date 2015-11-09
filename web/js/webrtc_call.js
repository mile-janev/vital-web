$(document).ready(function(){
    $("#done").attr("href", $("#call-end").html());
    $("#done .text").html("Hang up");
    $("#done img").attr("src", "/images/end_call.png").css("height", "36px");
    
    var counter = 0;
    setInterval(function () {
        ++counter;
        var time = format_time(counter);
        $("#call-time").html(time);
    }, 1000);
})

function format_time (time) {
    
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

// create our webrtc connection
var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    // immediately ask for camera access
    autoRequestMedia: true,
    debug: false,
    detectSpeakingEvents: true,
    autoAdjustMic: false,
    nick: myNick
});

// when it's ready, join if we got a room from the URL
webrtc.on('readyToCall', function() {
    // you can name it anything
    if (room)
        webrtc.joinRoom(room);
});

function showVolume(el, volume) {
    if (!el)
        return;
    if (volume < -45)
        volume = -45; // -45 to -20 is
    if (volume > -20)
        volume = -20; // a good range
    el.value = volume;
}

// we got access to the camera
webrtc.on('localStream', function(stream) {
    var button = document.querySelector('form>button');
    if (button)
        button.removeAttribute('disabled');
    $('#localVolume').show();
});
// we did not get access to the camera
webrtc.on('localMediaError', function(err) {
});

// local screen obtained
webrtc.on('localScreenAdded', function(video) {
    video.onclick = function() {
        video.style.width = video.videoWidth + 'px';
        video.style.height = video.videoHeight + 'px';
    };
//    document.getElementById('localScreenContainer').appendChild(video);
//    $('#localScreenContainer').show();
});
// local screen removed
webrtc.on('localScreenRemoved', function(video) {
    document.getElementById('localScreenContainer').removeChild(video);
//    $('#localScreenContainer').hide();
});

// a peer video has been added
webrtc.on('videoAdded', function(video, peer) {
    console.log('video added', peer);
    var remotes = document.getElementById('remotes');
    if (remotes) {
        $("#local").css("position", "absolute");
        
        var container = document.createElement('div');
        container.className = 'videoContainer';
        container.id = 'container_' + webrtc.getDomId(peer);
        container.appendChild(video);

        // suppress contextmenu
        video.oncontextmenu = function() {
            return false;
        };

        // resize the video on click
        video.onclick = function() {
            container.style.width = video.videoWidth + 'px';
            container.style.height = video.videoHeight + 'px';
        };

        // show the remote volume
        var vol = document.createElement('meter');
        vol.id = 'volume_' + peer.id;
        vol.className = 'volume';
        vol.min = -45;
        vol.max = -20;
        vol.low = -40;
        vol.high = -25;
        container.appendChild(vol);

        // show the ice connection state
        if (peer && peer.pc) {
            var connstate = document.createElement('div');
            connstate.className = 'connectionstate';
            container.appendChild(connstate);
            peer.pc.on('iceConnectionStateChange', function(event) {
                switch (peer.pc.iceConnectionState) {
                    case 'checking':
                        connstate.innerText = 'Connecting to peer...';
                        break;
                    case 'connected':
                    case 'completed': // on caller side
                        $(vol).show();
                        connstate.innerText = 'Connection established.';
                        break;
                    case 'disconnected':
                        connstate.innerText = 'Disconnected.';
                        break;
                    case 'failed':
                        connstate.innerText = 'Connection failed.';
                        break;
                    case 'closed':
                        connstate.innerText = 'Connection closed.';
                        break;
                }
            });
        }
        remotes.appendChild(container);
    }
});
// a peer was removed
webrtc.on('videoRemoved', function(video, peer) {
    console.log('video removed ', peer);
    var remotes = document.getElementById('remotes');
    var el = document.getElementById(peer ? 'container_' + webrtc.getDomId(peer) : 'localScreenContainer');
    if (remotes && el) {
        remotes.removeChild(el);
    }
});

// local p2p/ice failure
webrtc.on('iceFailed', function(peer) {
    var connstate = document.querySelector('#container_' + webrtc.getDomId(peer) + ' .connectionstate');
    console.log('local fail', connstate);
    if (connstate) {
        connstate.innerText = 'Connection failed.';
        fileinput.disabled = 'disabled';
    }
});

// remote p2p/ice failure
webrtc.on('connectivityError', function(peer) {
    var connstate = document.querySelector('#container_' + webrtc.getDomId(peer) + ' .connectionstate');
    console.log('remote fail', connstate);
    if (connstate) {
        connstate.innerText = 'Connection failed.';
        fileinput.disabled = 'disabled';
    }
});

var button = document.getElementById('screenShareButton'),
        setButton = function(bool) {
            button.innerText = bool ? 'share screen' : 'stop sharing';
        };
if (!webrtc.capabilities.screenSharing) {
    button.disabled = 'disabled';
}
webrtc.on('localScreenRemoved', function() {
    setButton(true);
});

setButton(true);

button.onclick = function() {
    if (webrtc.getLocalScreen()) {
        webrtc.stopScreenShare();
        setButton(true);
    } else {
        webrtc.shareScreen(function(err) {
            if (err) {
                setButton(true);
            } else {
                setButton(false);
            }
        });

    }
};