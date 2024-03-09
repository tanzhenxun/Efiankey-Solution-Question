


<?php 

function specdate($date1 , $date2){
    $Date1 = new DateTime($date1);
    $Date2 = new DateTime($date2);
    $interval = $Date1->diff($Date2)->format("%a");
    $dayType = ($interval % 2 == 0) ? 'even' : 'odd';
    return "Number of days between $date1 and $date2 is $interval. The day is $dayType.";
}
$date1 ="2024-02-20" ;
$date2 = "2024-02-25";
echo specdate($date1 , $date2);

?>