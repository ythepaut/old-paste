<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PASTE.YTHEPAUT.COM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/902b444792.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/atom-one-dark.css">
        <script src="./js/highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>


    </head>
    <body>
        <script src="./js/index.js"></script>
        
        <div class="menu">
            <div class="logo">
                <a href="/lisezmoi" title="A propos"><img alt="paste.ythepaut.com" src="./img/logo.png" /></a>
            </div>
            <hr />
            <div class="buttons">
                <button style="width: 20%;" onclick="window.location.href = './'"><i class="fas fa-file-medical" title="Nouveau paste"></i></button>
                <button style="width: 20%;" onclick="window.location.href = './raw/<?php echo($_GET['uid']); ?>'"><i class="fas fa-code" title="Raw"></i></button>
                <button style="width: 20%;" onclick="copyStringToClipboard(document.getElementById('code').textContent.replace('&nbsp;',' '));window.alert('Le paste a été copié dans le presse-papier.');"><i class="fas fa-copy" title="Copier le code"></i></button>
                <button style="width: 20%;" onclick="copyStringToClipboard(window.location.href);window.alert('Le lien de ce paste a été copié dans le presse-papier.');"><i class="fas fa-share-alt" title="Partager"></i></button>
                <button style="width: 20%;"><i class="fas fa-flag" title="Signaler"></i></button>
            </div>
        </div>


        <div id="lignes"><?php
            $code = file_get_contents("./raw/" . $_GET['uid']);
            $code = gzuncompress($code);
            $codeEx = explode("\n", $code);
            for ($line = 0; $line < count($codeEx); $line++) {
                echo($line + 1 . "<br />");
            }
            
        ?></div>

        <pre><code id="code" <?php if (strpos($_SERVER['REQUEST_URI'], 'lisezmoi') !== false || strpos($_SERVER['REQUEST_URI'], 'antispam') !== false) { echo('class="hljs plaintext"'); }?>>
            <?php
            $code = file_get_contents("./raw/" . $_GET['uid']);
            $code = gzuncompress($code);
            $code = str_replace("<", "&lt;", $code);
            $code = str_replace(">", "&gt;", $code);
            $code = str_replace(" ", "&nbsp;", $code);
            $code = str_replace("\"", "&quot;", $code);
            $code = str_replace("&", "&amp;", $code);
            //$code = str_replace("\n", "<br />", $code);
            echo($code);
            ?>
        </code></pre>



        <script>document.getElementById("code").innerHTML = (document.getElementById("code").textContent).substring(13, document.getElementById("code").textContent.length - 8);</script>
    </body>
</html>