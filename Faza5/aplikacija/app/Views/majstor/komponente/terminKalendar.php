<?php
if (!isset($terminText)) {
    $terminText = "GRESKA";
}
if (!isset($id)) {
    $id = "GRESKA";
}
if (!isset($class)) {
    $class = "terminne";
} else {
    $class = "btn-lg col-3 col-md-2 dugme " . $class;
}
?>
<button class='<?php echo $class ?>' id='<?php echo $id ?>' onclick=promeniTermin(this)>
    <?php echo $terminText ?>
</button>