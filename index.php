<?php  
    require "crud.php";
    require 'connection.php';
   

    require_once "security.php";
    require_once "filter_number.php";
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Encontras aqui (Luanda e Namibe) roupas, vestuarios e artigos novos e usados ao preço mais baixo de Angola.">
        <meta name="keywords" content="Geral Desapego tem, calças, vestidos, blusas, berços.">
        
        <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/cart.css">
        <title>Geral Desapego</title>
    </head>

    <body>
        <div>

        <?php require_once "header.php"; ?>
            <main>
                </section> 

                <section id="produtos">

                    <article class="grupo_produtos">
                        <h2>Calças</h2>
                        <?php
                            $selectcalcas = new crud();
                            $selectcalcas->selectcalcas();

                            foreach($selectcalcas->selectcalcas() as $Show):
                            $key = "Ac$!fredy01";
                            ?>
                        <figure>
                            <img src="<?= strip_tags($Show['product_cover']) ?>" title="Produto: <?= security($Show['product_name']) ?>" alt="Produto: <?= security($Show['product_name']) ?>">

                            <figcaption class="preco_add">
                                <span class="preco">
                                    <?php echo strip_tags($Show['product_price']). " kz"; ?>
                                </span>

                                <span class="add">
                                    <a title="Ver mais informações sobre este produto" class="buy" data-value="<?= strip_tags($Show['product_link']); ?>" data-id="<?= filter_number($Show['product_id']); ?>">
                                        <span class="fa fa-shopping-cart"></span> 
                                        Adicionar ao Carrinho
                                    </a>
                            </figcaption>
                        </figure>

                        <?php endforeach; ?>
                    </article>

                    

                    <div class="clear"></div>
                </section>

            </main>
            
        </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/cart.js"></script>
    </body>
</html>