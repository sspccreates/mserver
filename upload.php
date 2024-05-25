<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['video']['name']);

        if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
            // Save the video path to the database
            // Assuming you have a database connection set up as $conn
            $videoPath = $uploadFile;
            $stmt = $conn->prepare("INSERT INTO videos (path) VALUES (?)");
            $stmt->bind_param("s", $videoPath);
            $stmt->execute();
            $stmt->close();

            echo 'Video successfully uploaded.';
        } else {
            echo 'Failed to move uploaded file.';
        }
    } else {
        echo 'No file uploaded or there was an upload error.';
    }
} else {
    echo 'Invalid request method.';
}
?>
