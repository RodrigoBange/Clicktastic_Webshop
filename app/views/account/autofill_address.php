<?php
    if (isset($user->country)) {
        ?>
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function timer() {
            await sleep(1000);
            setDefaultCountry();
        }

        function setDefaultCountry() {
            var country = "<?php echo htmlspecialchars($user->country) ?>";
        $('#country').val(country);
        }

        timer();
    <?php
    }
    ?>
