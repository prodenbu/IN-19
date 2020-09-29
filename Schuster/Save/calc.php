<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Prinz Markus von Anhalt">
    <meta name="description" content="Nonsense Webpage Index">
    <meta name="keywords" content="Lorem, ipsum, dolor">    
    <link rel="stylesheet" href="style/style.css">
    <title>Blog</title>
</head>
<h2>
    <nav>
        <a class="nav" href="index.html">Home</a> |
        <a class="nav" href="listen.html">Top 5 Zahlen</a> |
        <a class="nav" href="memes.html">Bildwitze</a> |
        <a class="active" href="#">Taschenrechner</a>
</h2>
</nav>

<body background="Bilder/wood.jpg">
<h1>Ein Wirklich funktionierender Taschenrechner</h1>
    <form action="" method="POST">
        <p><input type="number" id="" value="12"> + <input type="number" value="30" id=""></p>
        <p><input type="submit" value="Berechnen" name="submit"></p>
        <?php
            if (isset($_POST['submit'])) {
                echo '<p><h2>42</h2></p>';
            }
        ?>

    </form>
    <footer>
        <a href="impressum.html">Impressum</a> |
        <a href="https://cornhub.pw">Nicht klicken!!!</a> |
        <a href="https://www.pexels.com/de-de/foto/holz-textur-hintergrund-kiefer-82256/">Background Image</a>
    </footer>
</body>

</html>