<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['video']['name']);

        if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
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
