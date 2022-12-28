<?php

    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
        $_SESSION['cart'] = rand(100000, 1000000000);
    }
    $session = strip_tags($_SESSION['cart']);
    $select_carrinho =$pdo->prepare("SELECT * FROM cart_temporary WHERE cart_session = ?");
    $select_carrinho->bindParam(1, $session);
    $select_carrinho->execute();

    $Count = $select_carrinho->rowCount();
?>

<style>
    #carrinho_mobile 
    {
        display: block;
    }

    #li_carrinho 
    {
        display: none;
    }  
    
    /*Tablet 768px*/
    @media screen and (min-width: 768px) 
    {

        #li_carrinho
        {
        display: block;
        }

        #carrinho_mobile 
        {
            display: none;
        }
    }
</style>
<header id="headerhome">

    <nav>
        <a href="#" class="open" style="display: flex; align-items: center;"><span id="txt_menu" style="color: #fff; font-weight: bolder;">Menu</span><img src="img/mi.png" alt="Menu Hamburguer"></a>
        <ul id="ulhome" class="menu">
            <li class="closee" style="color: red; font: 1.5em bolder;">Close</li>
            <li><a href="index.php">Home</a></li>
            <li id="li_carrinho" class="carinho_container">
                <span id="counter">
                    <a href="cart.php" id="icone_carrinho_header" style="color: black;"><span class="fa fa-shopping-cart"><span id="quantidade_items_carrinho"><?= $Count;?></span></span><span class="qtd"> </span></a>
                </span>
            </li>  
        </ul>
    </nav>

    <article id="carrinho_mobile" class="carinho_container">
        <span id="countermobile">
            <a href="cart.php" id="icone_carrinho_header" style="color: black;"><span class="fa fa-shopping-cart"><span id="quantidade_items_carrinho"><?= $Count;?></span></span><span class="qtd"> </span></a>
        </span> 
    </article>
</header>
<script src="js/menu.js"></script>

