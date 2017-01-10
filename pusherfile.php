<?php
require('Pusher.php');

$unique = $_POST["unique"];
$msg = $_POST["message"];

$options = array(
    'encrypted' => true
);
$pusher = new Pusher(
    'cd750d21dbe741aa0b64',
    '6a9c97ce5f2b677a67dc',
    '257555',
    $options
);

$data['message'] = $msg;
$pusher->trigger($unique, 'my_event1', $data);

/*$pusher = new Pusher("APP_KEY", "APP_SECRET", "APP_ID");

app_id = "272473"
key = "f188ef04ad4ad8ba6a18"
secret = "1b61a13ea5bdf5f12970"

$data['message'] = $msg;
$pusher->trigger($unique, 'my_event1', $data);*/

?>