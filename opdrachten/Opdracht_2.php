<?php
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    if (isset($_POST['onveilig'])) {
        echo $message;
    }

    if (isset($_POST['veilig'])) {
        if (preg_match('/^\w{5,25}$/', $message)) {
            echo htmlentities($message);
        } else {
            echo "Dit bericht gaat niet getoont worden.";
        }
    }
}
?>
<div id="header">
    <div id="logo">
        <h1><a href="#">Opdrachten</a></h1>
    </div>
</div>
<div id="page">
    <div id="content"><div class="box">
            <h2>Opdracht 2</h2>
            <p>
            <form method="POST">
                <textarea name="message">Bericht hier.</textarea><br />
                <input type="submit" name="veilig" value="Veilig!" /><input type="submit" name="onveilig" value="Onveilig!" />
            </form>
            </p>
        </div>
    </div>
    <br class="clearfix" />
</div>
