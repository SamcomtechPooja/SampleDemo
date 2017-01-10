<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <title>Video Conference</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <meta name="description" content="Many-to-Many Video Conferencing using RTCMultiConnection"/>
    <meta name="keywords" content="WebRTC,RTCMultiConnection,Demos,Experiments,Samples,Examples"/>

    <style>
        * {
            word-wrap:break-word;
        }
        audio,
        video {
            -moz-transition: all 1s ease;
            -ms-transition: all 1s ease;
            -o-transition: all 1s ease;
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
            vertical-align: top;
        }
        button,
        input,
        select {
            font-weight: normal;
            padding: 2px 4px;
            text-decoration: none;
            display: inline-block;
            text-shadow: none;
            font-size: 16px;
            outline: none;
        }

        .make-center {
            text-align: center;
            padding: 5px 10px;
        }

        img, input, textarea {
            max-width: 100%
        }

        @media all and (max-width: 500px) {
            .fork-left, .fork-right, .github-stargazers {
                display: none;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a id="logout" href="javascript:void(0)" >Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <header class="header" id="top">
        <div class="row" style=" margin-top: 10%;">
            <section class="experiment">
                <div class="make-center" style="text-align: -webkit-center;">
                    <div class="make-center">
                        <input type="text" id="room-id" autocorrect=off autocapitalize=off size=20 style="display: none;">
                        <button id="open-room" class="btn btn-lg btn-primary">Make a call</button>
                        <!--<button id="join-room">Join Room</button>-->
                        <button id="close-room" class="btn btn-lg btn-danger">Hangup</button>
                        <button id="open-or-join-room" style="display: none;">Auto Open Or Join Room</button>

                        <div id="room-urls" style="text-align: center;display: none;
                        background: #F1EDED;margin: 15px -10px;border: 1px solid rgb(189, 189, 189);
                        border-left: 0;border-right: 0;display: none;"></div>
                    </div>
                </div>
                <div>
                    <table style="width: 100%;" id="rooms-list"></table>
                </div>
                <div id="videos-container"></div>
            </section>
        </div>
    </header>
</div>
<!-- <script src="/dist/rmc3.min.js"></script> -->
<script src="js/rmc3.min.js"></script>

<!-- custom layout for HTML5 audio/video elements -->
<script src="js/getMediaElement.js"></script>

<!-- socket.io for signaling -->
<script src="js/socket.io.js"></script>
<script src="//js.pusher.com/3.2/pusher.min.js"></script>

<script>

    document.getElementById('close-room').onclick = function() {
        location.reload();
    }
    document.getElementById('open-room').onclick = function() {
        /*disableInputButtons();*/
        /*open-room*/
        var roomval = document.getElementById('room-id').value;
        var pusher = new Pusher('cd750d21dbe741aa0b64', {
            encrypted: true
        });
        var channel1 = pusher.subscribe(roomval);
        console.log("channel1--- "+channel1);
        Pusher.logToConsole = true;
        $.ajax({
            type: 'POST',
            data: {unique:roomval , message: 'CallInitaited'},
            url: 'pusherfile.php',
            success: function (data) {
                console.log("Message Sent");
            }
        });
        connection.open(document.getElementById('room-id').value, function() {
            var roomURLsDiv = document.getElementById('open-room');
            roomURLsDiv.style.display = 'none';
            showRoomURL(connection.sessionid);
        });
    };
    var connection = new RTCMultiConnection();

    // comment-out below line if you do not have your own socket.io server
    connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

    connection.socketMessageEvent = 'video-conference-demo';

    connection.session = {
        audio: true,
        video: true
    };

    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: true,
        OfferToReceiveVideo: true
    };

    connection.videosContainer = document.getElementById('videos-container');
    connection.onstream = function(event) {
        var width = parseInt(connection.videosContainer.clientWidth / 2) - 20;
        var mediaElement = getMediaElement(event.mediaElement, {
            title: event.userid,
            buttons: ['full-screen'],
            width: width,
            showOnMouseEnter: false
        });

        connection.videosContainer.appendChild(mediaElement);

        setTimeout(function() {
            mediaElement.media.play();
        }, 5000);

        mediaElement.id = event.streamid;
        rotateVideo(event.mediaElement);
        scaleVideos();
    };
    function rotateVideo(mediaElement) {
        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
        setTimeout(function() {
            mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
        }, 1000);
    }
    function scaleVideos() {
        var videos = document.querySelectorAll('video'),
            length = videos.length,
            video;

        var minus = 130;
        var windowHeight = 700;
        var windowWidth = 600;
        var windowAspectRatio = windowWidth / windowHeight;
        var videoAspectRatio = 4 / 3;
        var blockAspectRatio;
        var tempVideoWidth = 0;
        var maxVideoWidth = 0;

        for (var i = length; i > 0; i--) {
            blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
            if (blockAspectRatio <= windowAspectRatio) {
                tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
            } else {
                tempVideoWidth = windowWidth / i;
            }
            if (tempVideoWidth > maxVideoWidth)
                maxVideoWidth = tempVideoWidth;
        }
        for (var i = 0; i < length; i++) {
            video = videos[i];
            if (video)
                video.width = maxVideoWidth - minus;
        }
    }

    /*connection.onstreamended = function(event) {
        var mediaElement = document.getElementById(event.streamid);
        if(mediaElement) {
            mediaElement.parentNode.removeChild(mediaElement);
        }
    };*/
    connection.onstreamended = function(e) {
        e.mediaElement.style.opacity = 0;
        rotateVideo(e.mediaElement);
        setTimeout(function() {
            if (e.mediaElement.parentNode) {
                e.mediaElement.parentNode.removeChild(e.mediaElement);
            }
            scaleVideos();
        }, 1000);
    };

    function disableInputButtons() {
        $('#room-id').hide();

        /*document.getElementById('open-or-join-room').disabled = true;
        document.getElementById('open-room').disabled = true;
        document.getElementById('join-room').disabled = true;
         document.getElementById('room-id').disabled = true;*/
    }

    // ......................................................
    // ......................Handling Room-ID................
    // ......................................................

    function showRoomURL(roomid)
    {
        var roomHashURL = '#' + roomid;
        var roomQueryStringURL = '?roomid=' + roomid;

        var html = '<h2>Unique URL for your room:</h2><br>';

        html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
        html += '<br>';
        html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

        var roomURLsDiv = document.getElementById('room-urls');
        roomURLsDiv.innerHTML = html;

        roomURLsDiv.style.display = 'none';
    }

    (function() {
        var params = {},
            r = /([^&=]+)=?([^&]*)/g;

        function d(s) {
            return decodeURIComponent(s.replace(/\+/g, ' '));
        }
        var match, search = window.location.search;
        while (match = r.exec(search.substring(1)))
            params[d(match[1])] = d(match[2]);
        window.params = params;
    })();

    var roomid = '12345';
    /*if (localStorage.getItem(connection.socketMessageEvent)) {
        roomid = localStorage.getItem(connection.socketMessageEvent);
    } else {
        roomid = connection.token();
    }*/
    document.getElementById('room-id').value = roomid;
    document.getElementById('room-id').onkeyup = function() {
        localStorage.setItem(connection.socketMessageEvent, this.value);
    };

    var hashString = location.hash.replace('#', '');
    if(hashString.length && hashString.indexOf('comment-') == 0) {
        hashString = '';
    }

    var roomid = params.roomid;
    if(!roomid && hashString.length) {
        roomid = hashString;
        console.log("roomid--- "+roomid);
    }

    if(roomid && roomid.length)
    {
        console.log("roomid.length--- "+roomid.length);
        document.getElementById('room-id').value = roomid;
        localStorage.setItem(connection.socketMessageEvent, roomid);

        // auto-join-room
        (function reCheckRoomPresence() {
            connection.checkPresence(roomid, function(isRoomExists) {
                console.log("isRoomExists--- "+isRoomExists);
                if(isRoomExists) {
                    connection.join(roomid);
                    var roomURLsDiv = document.getElementById('open-room');
                    roomURLsDiv.style.display = 'none';
                    return;
                }
                setTimeout(reCheckRoomPresence, 5000);
            });
        })();
        disableInputButtons();
    }
</script>

</body>

</html>
