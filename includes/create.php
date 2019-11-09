<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PASTE.YTHEPAUT.COM</title>

        <meta name="description" content="PASTE.YTHEPAUT.COM" />
        <meta name="author" content="Yohann THEPAUT" />
        <meta property="og:site_name" content="PASTE.YTHEPAUT.COM" />
        <meta property="og:image" content="favicon.ico" />
        <meta property="og:description" content="PASTE.YTHEPAUT.COM" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://paste.ythepaut.com/" />
        <meta property="og:locale" content="fr_FR" />
        <meta name="keywords" content="paste, paste ythepaut, ythepaut" />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://kit.fontawesome.com/902b444792.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <script src="./js/index.js"></script>

        <div class="menu">
            <div class="logo">
                <a href="/lisezmoi"><img alt="paste.ythepaut.com" src="./img/logo.png" /></a>
            </div>
            <hr />
            <div class="buttons">
                <button onclick="document.getElementById('create').submit();" style="width: 100%;" title="Sauvegarder"><i class="fas fa-save"></i></button>
            </div>
        </div>

        <div id="lignes">></div>

        <form action="./actions/create.php" method="POST" id="create">
            <textarea id="paste" name="paste" oninput="auto_grow(this);" spellcheck="false" maxlength="1000000" required></textarea>
        </form>

        <script>auto_grow(document.getElementById("paste"));</script>
    </body>
</html>