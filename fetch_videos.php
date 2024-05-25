<?php
// Assuming you have a database connection set up as $conn
$result = $conn->query("SELECT path FROM videos");
$videos = $result->fetch_all(MYSQLI_ASSOC);

foreach ($videos as $video) {
    echo '<video src="' . htmlspecialchars($video['path']) . '" controls></video>';
}
?>
