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


?>
