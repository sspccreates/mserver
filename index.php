<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Scroll</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .video-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="video-list" class="video-container"></div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload Video</button>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upload-form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="video">Choose video</label>
                            <input type="file" class="form-control-file" id="video" name="video" accept="video/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            loadVideos();

            $('#upload-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#uploadModal').modal('hide');
                        loadVideos();
                    },
                    error: function() {
                        alert('Failed to upload video.');
                    }
                });
            });

            function loadVideos() {
                $.ajax({
                    url: 'fetch_videos.php',
                    method: 'GET',
                    success: function(data) {
                        $('#video-list').html(data);
                        initializeVideoScrolling();
                    }
                });
            }

            function initializeVideoScrolling() {
                const videos = $('#video-list video');
                let currentVideoIndex = 0;

                function playNextVideo() {
                    if (currentVideoIndex < videos.length) {
                        const video = videos[currentVideoIndex];
                        video.play();
                        video.onended = function() {
                            currentVideoIndex++;
                            playNextVideo();
                        };
                    }
                }

                playNextVideo();
            }
        });
    </script>
</body>
</html>
