<!-- Question 1 
Jack operates a photo-sharing website where users can upload and download images. 

Non-members are restricted from downloading images if they have downloaded another image within the past 5 seconds.

In contrast, members are allowed to download two images consecutively without any waiting period. However, for their third download and beyond, they must wait 5 seconds since their last download, similar to non-members.
 
Write a function:
checkDownload($memberType)
The function accepts member type as input and returns the response depending on the aforementioned rules.
 
If the user tries to download again within the 5-second wait time, it should return a message "Too many downloads".
 
The waiting time validation should happen in the backend/frontend. (backend is preferred)

Expected outcomes:
Non-members:
00:00:00 execute checkDownload(‘nonmember’) returns "Your download is starting..."
00:00:03 execute checkDownload(‘nonmember’) returns "Too many downloads"
 

Members:
00:00:00 execute checkDownload(‘member’) returns "Your download is starting..."
00:00:03 execute checkDownload(‘member) returns "Your download is starting..."
00:00:05 execute checkDownload(‘member) returns "Too many downloads" -->

<?php
session_start();
// Function to check if a user is a member
function isMember() {
    return isset($_SESSION['is_member']) && $_SESSION['is_member'] === true;
}

function canDownload($isMember, $downloadCount, $lastDownloadTime) {
    if ($isMember) {
        // Members can download two times consecutively without waiting
        return $downloadCount < 2;
    } else {
        // Non-members need to wait 5 seconds between downloads
        return time() - $lastDownloadTime >= 5;
    }
}

// Check if the image filename is provided in the URL
if (isset($_GET['filename'])) {
    // Get the filename from the URL
    $filename = $_GET['filename'];

    // Path to the folder where images are stored
    $folder = 'images/';

    // Full path to the image file
    $filepath = $folder . $filename;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Check if the user is a member
        $isMember = isMember();

        // If session variables not set, initialize them
        if (!isset($_SESSION['download_count'])) {
            $_SESSION['download_count'] = 0;
        }
        if (!isset($_SESSION['last_download_time'])) {
            $_SESSION['last_download_time'] = 0;
        }

        // Increment download count for the current user
        $_SESSION['download_count']++;

        // Check if the user can download the image
        if (canDownload($isMember, $_SESSION['download_count'], $_SESSION['last_download_time'])) {
            // Send appropriate headers
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));

            // Update last download time
            $_SESSION['last_download_time'] = time();

            // Read the file and output it to the browser
            readfile($filepath);
            exit;
        } else {
            // If the user cannot download the image, show an error message
            $remainingTime = 5 - (time() - $_SESSION['last_download_time']);
            echo "<div id='countdown'>$remainingTime</div>";
        }
    } else {
        // If the file does not exist, show an error message
        echo "File not found.";
    }
} else {
    // If the filename is not provided, show an error message
    // echo "Filename not provided.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photo Sharing Website</title>
    <script>
        function startCountdown(time) {
            var countdownElement = document.getElementById('countdown');
            var remainingTime = time;

            var countdownInterval = setInterval(function() {
                countdownElement.innerHTML = remainingTime;
                remainingTime--;

                if (remainingTime < 0) {
                    clearInterval(countdownInterval);
                    // Reload the page after the countdown finishes to enable the download button
                    window.location.href = 'question1.php';
                }
            }, 1000);
        }
        window.onload = function() { 
            var countdown = document.getElementById('countdown');
            if (countdown) {
                startCountdown(parseInt(countdown.innerHTML));
            }
        };
        function downloadImage(filename) {
            // Redirect to the download script with the filename parameter
            window.location.href = 'question1.php?filename=' + filename;
        }
    </script>
</head>
<body>
    <h1>Welcome to Jack's Photo Sharing Website</h1>
    <label for="membership">Select Membership:</label>
    <select id="membership" onchange="changeMembership()">
        <option value="member">Member</option>
        <option value="non-member">Non-Member</option>
    </select>
    <p><img src="images/apple.jpg" alt="Apple" width="150px"></p>
    <button onclick="downloadImage('apple.jpg')">Download Image</button>
    
    <script>
        function changeMembership() {
            var membership = document.getElementById("membership").value;
            if (membership === "member") {
                <?php $_SESSION['is_member'] = true; ?>
            } else {
                <?php $_SESSION['is_member'] = false; ?>
            }
        }
    </script>
</body>
</html>
