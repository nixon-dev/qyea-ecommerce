<?php
include("db_conn.php");

$query = "SELECT * FROM settings WHERE setting_id = '1'";
$result = mysqli_query($link, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $desc = $row['description'];
    $section_title = $row['section_title'];
    $section_desc = $row['section_desc'];
    $contact_1 = $row['contact1'];
    $contact_2 = $row['contact2'];
    $contact_3 = $row['contact3'];
    $contact_4 = $row['contact4'];
    $facebook = $row['facebook'];
    $twitter = $row['twitter'];
    $instagram = $row['instagram'];
    $youtube = $row['youtube'];
    $bio_title = $row['bio_title'];
    $bio_context = $row['bio_context'];
    $location = $row['location'];

} else {
    $title = "";
    $desc = "";
    $section_title = "";
    $section_desc = "";
    $contact_1 = "";
    $contact_2 = "";
    $contact_3 = "";
    $contact_4 = "";
    $facebook = "";
    $twitter = "";
    $instagram = "";
    $youtube = "";
    $bio_title = "";
    $bio_context = "";
    $location = "";
}

$imagequery = "SELECT * FROM imagesettings WHERE is_id = '1'";
$imageresult = mysqli_query($link, $imagequery);
if ($imageresult) {
    $irow = mysqli_fetch_assoc($imageresult);
    $slider1 = $irow["slider1"];
    $slider2 = $irow["slider2"];
    $shop1 = $irow["shop1"];
    $shop2 = $irow["shop2"];
    $shop3 = $irow["shop3"];
    $bg1 = $irow["background1"];
    $bg2 = $irow["background2"];
    $bg3 = $irow["background3"];
    $bg4 = $irow["background4"];
} else {
    echo 'Error';
}




?>