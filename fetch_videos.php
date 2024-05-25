<?php
$uploadDir = 'uploads/';
$videos = array_diff(scandir($uploadDir), array('.', '..'));

foreach ($videos as $video) {
    echo '<video src="' . htmlspecialchars($uploadDir . $video) . '" controls></video>';
}
?>
