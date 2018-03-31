<?php

/* @var $this \yii\web\View */

?>

<link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
<script src="https://unpkg.com/video.js/dist/video.js"></script>
<script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>

<video id="example-video" width="600" height="300" class="video-js vjs-default-skin" controls>
    <source src="http://78.130.205.67:1935/live/mpegts.stream" type="application/x-mpegURL">
</video>

<script>
    var player = videojs('#example-video');
    player.play();
</script>

