<script>
    function myFunction(objButton) {
        var x = Math.floor(Math.random() * 10);
        if (x >= 5)
            objButton.classList.toggle("terminzauzet")
        else
            objButton.classList.toggle("terminda")
        console.log("proslo")
    }
</script>
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
        id=' . $id . ' onclick="myFunction(this)">' . $terminText . '</button>';
?>