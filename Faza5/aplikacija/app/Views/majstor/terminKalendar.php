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
?>
<button class="btn-lg terminne col-3 col-md-2" onclick="myFunction(this)"><?php echo $terminText ?></button>