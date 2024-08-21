<script type="text/javascript">
    
    var countDownDate = new Date("<?php echo date("M d, Y H:i:s", strtotime("+1 minutes")) ?>").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            alert("Waktu habis!");
            document.location.href = 'home.php';
        }
    }, 1000);

</script>

