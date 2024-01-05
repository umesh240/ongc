<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle video upload
    print_r($_POST); die;
    
    //$videoData = file_get_contents("php://input");
    echo $videoData = $_POST["videoFile"];
    // Generate a unique file name and save the video to a folder
    $videoFileName = 'video_' . uniqid() . '.webm';
    file_put_contents('uploads/' . $videoFileName, $videoData);
    
    /*
    $videoFile = $_FILES["videoFile"];
        
    // Specify the path where you want to store the video file
    $videoPath = 'uploads/vc_' .  uniqid() .'_'.$videoFile['name'];
    
    // Move the uploaded file to the storage path
    Array($videoFile['tmp_name'], $videoPath);
    */
    echo "Video uploaded successfully.";
} else {
    echo "Invalid request.";
}
?>
