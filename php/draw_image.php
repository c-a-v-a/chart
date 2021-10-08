<?php
require('./set_variables.php');

// Set headers for images
header ('Content-Type: image/png');

// Info text
$temperature_text = imagestringup($chart, 3, 5, $HEIGHT / 2 + $MARGIN / 2, "temperature", $white);
$days_text = imagestring($chart, 3, $WIDTH / 2 - $MARGIN / 2, $HEIGHT - $MARGIN / 2, "days", $white);

// Chart X and Y axis
$yAxis = imageline($chart, $MARGIN, $MARGIN, $MARGIN, $HEIGHT - $MARGIN, $white);
$xAxis = imageline($chart, $MARGIN, $HEIGHT - $MARGIN, $WIDTH - $MARGIN, $HEIGHT - $MARGIN, $white);

// Grid
$dotted_arr = [$white, $white, $black, $black];
imagesetstyle($chart, $dotted_arr);

// Text
// Vertical text and horizontal lines
$i = $MARGIN;

foreach ($temps as &$text) {
    // Horizontal lines
    imageline($chart, $MARGIN, $i, $WIDTH - $MARGIN, $i, IMG_COLOR_STYLED);

    // Text
    imagestring($chart, 2, 30, $i - 6, $text, $white);    
    $i += ($HEIGHT - 2 * $MARGIN) / count($temps);
}

// Horizontal text, vertical lines and points
$i = $MARGIN + ($WIDTH - 2 * $MARGIN) / ($DAYS + 1);

foreach (range(1, $DAYS, 1) as &$text) {
    // Vertical lines
    imageline($chart, $i, $MARGIN, $i, $HEIGHT - $MARGIN, IMG_COLOR_STYLED);

    // Text
    if ($text > 9) {
        imagestring($chart, 2, $i - 4, $HEIGHT - $MARGIN + 10, $text, $white);
    }
    else {
        imagestring($chart, 2, $i - 2, $HEIGHT - $MARGIN + 10, $text, $white);
    }

    $i += ($WIDTH - 2 * $MARGIN) / ($DAYS + 1);
}

// Draw points on chart
$x = $MARGIN + ($WIDTH - 2 * $MARGIN) / ($DAYS + 1);
for ($i = 1; $i <= $DAYS; $i++) {
    $point = searchForDay($points, $i);
    $arr = valueToPosition($point['temperature'], $HEIGHT, $MARGIN);
    $pos = $arr['pos'];

    imagefilledellipse($chart, $x, $pos, 8, 8, $colors[$arr["color"]]);
    $x += ($WIDTH - 2 * $MARGIN) / ($DAYS + 1);
}

// Red helper line
imageline($chart, $MARGIN, $MARGIN + ($HEIGHT - 2 * $MARGIN) / count($temps), $WIDTH - $MARGIN, $MARGIN + ($HEIGHT - 2 * $MARGIN) / count($temps), $red);

// Render
imagepng($chart);
imagedestroy($chart);
