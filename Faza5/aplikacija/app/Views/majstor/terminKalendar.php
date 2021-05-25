<?php
if (!isset($terminText)) {
    $terminText = "GRESKA";
}
if (!isset($id)) {
    $id = "GRESKA";
}
if (!isset($class)) {
    $class = "terminne";
}
?>
<?php
echo '<button class="btn-lg col-3 col-md-2 dugme ' . $class . '"
        id=' . $id . ' onclick="promeniTermin(this)">' . $terminText . '</button>';
?>