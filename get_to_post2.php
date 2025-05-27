<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Resetting password</title>
</head>
<body>
    <form id="form" action="reset2.php" method="post">
        <input type="hidden" name="email" id="email">
        <input type="hidden" name="signature" id="signature">
        <input type="hidden" name="timestamp" id="timestamp">
    </form>

    <script type="text/javascript">
        const form = document.getElementById("form");
        const email_element = document.getElementById("email");
        const signature_element = document.getElementById("signature");
        const timestamp_element = document.getElementById("timestamp");

        const email = window.location.hash.split('&')[0].split('=')[1];
        const signature = window.location.hash.split('&')[1].split('=')[1];
        const timestamp = window.location.hash.split('&')[2].split('=')[1];

        email_element.value = email;
        signature_element.value = signature;
        timestamp_element.value = timestamp;

        history.replaceState(null, "", window.location.pathname + window.location.search);

        form.submit();
    </script>
</body>
</html>
