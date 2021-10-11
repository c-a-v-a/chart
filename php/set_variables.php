<?php
/**
 * Function that returns get parameter or default value.
 * @param string $index - name of get parameter.
 * @param int|string $default - default value used when get param is not set.
 */
function getOrDefault(string $index, int|string $default): int|string {
    if (!array_key_exists($index, $_GET)) {
        return $default;
    } else {
        return $_GET[$index];
    }
}

/**
 * Function that converts value to position on Y axis.
 * @param string $value - temperature value.
 */
function valueToPosition(string $value, int $height, int $margin): array {
    if ($value == "null") {
        return ["pos" => $height - $margin, "color" => "gray"];
    }
    if ($value == "c") {
        return ["pos" => $height - $margin, "color" => "red"];
    }

    $temp = floatval($value);

    if ($temp > 37.2 || $temp < 36) {
        return ["pos" => $height - $margin, "color" => "red"];
    } else {
        $pos = $height - $margin - (($temp - 36) / 0.2 * ($height - 2 * $margin) / 6);
        return ["pos" => $pos, "color" => "blue"];
    }
}

/**
 * Function that searches data table to find record from given day.
 * @param array $array - data table.
 * @param int $day - day to find.
 */
function searchForDay($array, int $day): array {
    foreach ($array as $element) {
        if ($element['day'] == $day) {
            return $element;
        }
    }

    return ["day" => "null", "temperature" => "null"];
}

// Get width
$WIDTH = getOrDefault('w', 700);
$HEIGHT = getOrDefault('h', 350);
$DAYS = getOrDefault('d', 28);
$MARGIN = getOrDefault('m', 70);

// Create image
$chart = imagecreatetruecolor($WIDTH, $HEIGHT);

// Colors
$black = imagecolorallocate($chart, 0, 0, 0);
$red = imagecolorallocate($chart, 255, 0, 0);
$blue = imagecolorallocate($chart, 100, 100, 255);
$gray = imagecolorallocate($chart, 100, 100, 100);
$white = imagecolorallocate($chart, 255, 255, 255);

// Temperature scale
$temps = ['.2', '37.0', '.8', '.6', '.4', '36.2'];

// Points colors
$colors = [
    "red" => $red,
    "blue" => $blue,
    "gray" => $gray,
];

// Get points
$points = [];

try {
    $conn = new PDO('mysql:host=localhost;dbname=chart', 'cava', '');
    $sql = 'SELECT id, day, temperature FROM data ORDER BY day';
    $points = $conn->query($sql);
} catch (PDOException $e) {
    die("Could not connect to db");
}