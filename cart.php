<?php
    ob_start();
    session_start();
    require 'connection.php';
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Carrinho de Compras | Geral Desapego LDA</title>

        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <link href="myfilesEdVwCd/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/cart.css">
    </head>

    <body>
        <div class="result"></div>
        <article class="container_top">
            <p class="container_top_paragraph"><a href="index.php"><span class="fa fa-caret-square-left"></span> VOLTAR A LOJA</a></p>
        </article>

      
		<div id="cart">
			<?php require 'cartLoader.php' ?>
		</div>
        <div class="clear"></div>
        <script src="js/jquery.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>