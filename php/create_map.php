<?php
require(dirname(__DIR__).'/php/set_variables.php');

for ($i = 1; $i <= $DAYS; $i++) {
    $point = searchForDay($points, $i);
    $x = $MARGIN + (($WIDTH - 2 * $MARGIN) / ($DAYS + 1)) * $point['day'];
    $arr = valueToPosition($point['temperature'], $HEIGHT, $MARGIN);
    $y = $arr['pos'];
    $id = $point['id'];

    echo "<area shape='circle' coords='$x, $y, 9' onclick='fun($id)'>";
}
?>