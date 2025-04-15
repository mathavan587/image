<?php
$name = "Mathavan.v";
$course = "Web Development";
$background = "certificate-template.jpg";

// Check image file
if (!file_exists($background)) {
    die("Error: Certificate background image not found.");
}

$image = @imagecreatefromjpeg($background);
if (!$image) {
    die("Error: Could not create image from background file.");
}

$black = imagecolorallocate($image, 0, 0, 0);

// Font and path check
$fontPath = __DIR__ . '/fonts/Roboto-Black.ttf';
if (!file_exists($fontPath)) {
    die("Error: Font file not found.");
}

// Font sizes
$fontSizeName = 70;
$fontSizeCourse = 50;

// Image dimensions
$imageWidth = imagesx($image);

// ==== CENTER NAME TEXT ====
$nameBox = imagettfbbox($fontSizeName, 0, $fontPath, $name);
$nameTextWidth = $nameBox[2] - $nameBox[0];
$nameX = ($imageWidth - $nameTextWidth) / 2;
$nameY = 900;

// ==== CENTER COURSE TEXT ====
$courseBox = imagettfbbox($fontSizeCourse, 0, $fontPath, $course);
$courseTextWidth = $courseBox[2] - $courseBox[0];
$courseX = ($imageWidth - $courseTextWidth) / 2;
$courseY = 980;

// Draw text
imagettftext($image, $fontSizeName, 0, $nameX, $nameY, $black, $fontPath, $name);
imagettftext($image, $fontSizeCourse, 0, $courseX, $courseY, $black, $fontPath, $course);

// Output image for download
$filename = "certificate_" . preg_replace("/[^a-zA-Z0-9]/", "_", $name) . ".jpg";
header("Content-Type: image/jpeg");
header("Content-Disposition: attachment; filename=\"$filename\"");
imagejpeg($image);
imagedestroy($image);
?>
