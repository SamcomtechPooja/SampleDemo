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
    <!--<link rel="stylesheet" href="css/style.css">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stylish-portfolio.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <meta name="description" content="Many-to-Many Video Conferencing using RTCMultiConnection"/>
    <meta name="keywords" content="WebRTC,RTCMultiConnection,Demos,Experiments,Samples,Examples"/>

    <style>
        audio,
        video {
            -moz-transition: all 1s ease;
            -ms-transition: all 1s ease;
            -o-transition: all 1s ease;
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
            vertical-align: top;
        }

        input {
            border: 1px solid #d9d9d9;
            border-radius: 1px;
            font-size: 2em;
            margin: .2em;
            width: 30%;
        }

        .setup {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
            font-size: 102%;
            height: 47px;
            margin-left: -9px;
            margin-top: 8px;
            position: absolute;
        }

        p {
            padding: 1em;
        }

        li {
            border-bottom: 1px solid rgb(189, 189, 189);
            border-left: 1px solid rgb(189, 189, 189);
            padding: .5em;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header" >
        <div class="row">
            <section class="experiment">
                <div class="row" style=" margin-top: 10%;" id="top">
                    <div class="col-md-8 col-md-offset-2">
                        <div style="text-align: center; ">
                            <img src="load.gif" style=" height: 30%; width: 15%;">
                            <br>
                            <h3 id="start2" style=" color: black; font-size: xx-large;
                                font-weight: 700;"> Waiting for call</h3>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="make-center" style="text-align: -webkit-center;" id="acceptrejectcall" >
                    <header class="header">
                        <div class="row" style=" margin-top: 10%;">
                            <div class="col-md-8 col-md-offset-2">
                                <div style="text-align: center; ">
                                    <img src="load.gif" style=" height: 30%; width: 15%;">
                                    <br><br><br>
                                    <button class="btn btn-success" id="invite-accept">Accept</button>
                                    <button class="btn btn-danger" id="invite-reject">Reject</button>
                                </div>
                                <br>
                            </div>
                        </div>
                    </header>
                </div>
                <div>
                    <table style="width: 100%;" id="rooms-list"></table>
                </div>
                <div id="videos-container"></div>
            </section>
        </div>
    </header>
    <audio id="ringtone" preload="auto" loop>
        <source src="mp3/ringtone03.mp3" type="audio/mpeg">
    </audio>
    <audio id="callended" preload="auto">
        <source src="mp3/callended01.mp3" type="audio/mpeg">
    </audio>
</div>
<!-- <script src="/dist/rmc3.min.js"></script> -->
<script src="js/rmc3.min.js"></script>

<!-- custom layout for HTML5 audio/video elements -->
<script src="js/getMediaElement.js"></script>

<!-- socket.io for signaling -->
<script src="js/socket.io.js"></script>
<script src="//js.pusher.com/3.2/pusher.min.js"></script>

<script>
    //$( document ).ready(function() {
        console.log( "ready!" );
        $('#top').show();
        $('#acceptrejectcall').hide();

        var pusher = new Pusher('cd750d21dbe741aa0b64', {
            encrypted: true
        });
        Pusher.logToConsole = true;
        var channel = pusher.subscribe("12345");
        channel.bind('my_event1', function (data)
        {
            console.log("Chanel my_event1 ==== " + data.message);
            $('#acceptrejectcall').show();
            $('#top').hide();
            /*var value1 = 'CallInitaited';
            if (value1 == data.message) {

            }*/
        });
   // });
    $('#invite-accept').click(function() {
        location.href="https://192.168.0.43/PeerJsWebRtc/sampledemo/sampledemo/Videochat.php#12345";
    });
   /* document.getElementById('invite-accept').onclick = function() {

    };
    document.getElementById('invite-reject').onclick = function() {
        location.reload();
    };*/

</script>

</body>

</html>
