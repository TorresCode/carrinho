<article class="container_main" id="loader">
    <?php
        $Cart = $pdo->prepare("SELECT cart_id, cart_session, cart_quantity, cart_value, cart_status, product_id, cart_total, product_stock, product_cover, product_name FROM cart_temporary WHERE cart_session = :sessio AND cart_status = :statu");
        $Cart->bindValue(":sessio", $_SESSION['cart']);
        $Cart->bindValue(":statu", 1);
        $Cart->execute();
    
        $Lines = $Cart->rowCount();

        if($Lines == 0){
            echo '
                <div class="cart_empty">
                    <p>Seu carrinho está vazio, adicionar agora!</p>
                </div>
            ';
        }else{
            $total = 0;

        foreach($Cart as $Sh){
            $total += $Sh['cart_total'];
    ?>
                <section class="container_cart">
                    <div class="cart_img">
                        <a href="index.php" title="Produto:"><img src="<?= $Sh['product_cover']; ?>" title="Produto: " alt="Produto: "></a>
                    </div>

                    <div class="cart_title">
                        <p><?= strip_tags(mb_strtoupper($Sh['product_name'])); ?></p>
                    </div>
					
					<div class="cart_quantity">
						<p class="minus" data-id="<?= $Sh['cart_id']; ?>"><span class="fa fa-minus-circle">-</span></p>
						<span><input class="quantity loader" id="quantity" name="quantity" type="text" value="<?= $Sh['cart_quantity']; ?>" id="quantity" readonly></span>
						<p class="plus" data-id="<?= $Sh['cart_id']; ?>"><span class="fa fa-plus-circle">+</span></p>
					</div>

					<div class="cart_value">
						<p class="value" id="loader1"><span class="price"><?=  number_format($Sh['cart_value'], 2, ".", "."); ?> KZ</span></p>
					</div>

					<div>
						<p><a href="delete.php?del=<?= $Sh['cart_id']?>" title="Remover este produto do carrinho"> <img src="img/exx.png" alt=""> </a></p>
					</div>
					
                    <div class="clear"></div>
                </section>
                <?php } ?>
                <section class="container_cart">
                    <div class="cart_values" id="loader2">
                        <p><span style="color: red;">VALOR TOTAL: <span class="result_final"><?= number_format($total, 2, ",", ".") ?> KZ</span></span></p>
                    </div>
                </section>
                <?php } ?>
            </article>