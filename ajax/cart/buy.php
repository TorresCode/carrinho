<?php session_start();
    require "../../connection.php";

    $message = null;
    $Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $PostFilters = array_map("strip_tags", $Post);

    foreach($PostFilters as $index => $value){}
    $product = str_replace('-', '', mb_strtolower($index));

    usleep(500000);

    if(!$_SESSION['cart'] || empty($_SESSION['cart'])){
        $_SESSION['cart'] = rand(100000, 1000000000);
    }

    $Product = $pdo->prepare("SELECT product_id, product_cover, product_name, product_stock, product_price, product_link, product_status FROM products WHERE product_link = :link AND product_status = :statu");
    $Product->bindValue(":link", $index);
    $Product->bindValue(":statu", 1);
    $Product->execute();

    foreach($Product as $Show){}

    $product_id = strip_tags($Show['product_id']);
    $product_cover = strip_tags($Show['product_cover']);
    $product_name = strip_tags($Show['product_name']);
    $product_stock = strip_tags($Show['product_stock']);
    $product_price = strip_tags($Show['product_price']);


    //Verify if the product have estoque.
    if($product_stock == 0){
        $message = [
            "message" => 'Oops! Produto sem estoque',
            "status" => 'error',
            "redirect" => ''
        ];
        echo json_encode($message);
        return;
    }

    //Verify if the product foi cad 
    $Cart = $pdo->prepare("SELECT cart_id, cart_session, cart_quantity, cart_status, product_id FROM cart_temporary WHERE cart_session = :sessio AND cart_status = :st AND product_id = :productId");
    $Cart->bindValue(":sessio", $_SESSION['cart']);
    $Cart->bindValue(":productId", $product_id);
    $Cart->bindValue(":st", 1);
    $Cart->execute();

    $Lines = $Cart->rowCount();

    foreach($Cart as $Sh){}

    if($Lines == 0){
        $stock = $product_stock - 1;

        $Create = $pdo->prepare("INSERT INTO cart_temporary (product_id, product_cover, product_name, product_stock, cart_value, cart_quantity, cart_total, cart_status, cart_session, phone_number, valor_total, forma_pagamento) VALUES (:product_id, :product_cover, :product_name, :product_stock, :cart_value, :cart_quantity, :cart_total, :cart_status, :cart_session, :phone_number, :valor_total, :forma_pagamento)");
        $Create->bindValue(":product_id", $product_id);
        $Create->bindValue(":product_cover", $product_cover);
        $Create->bindValue(":product_name", $product_name);
        $Create->bindValue(":product_stock", $stock);
        $Create->bindValue(":cart_value", $product_price);
        $Create->bindValue(":cart_quantity", 1);
        $Create->bindValue(":cart_total", $product_price);
        $Create->bindValue(":cart_status", 1);
        $Create->bindValue(":cart_session", $_SESSION['cart']);
        $Create->bindValue(":phone_number", $_SESSION['cart']);
        $Create->bindValue(":valor_total", 2);
        $Create->bindValue(":forma_pagamento", $_SESSION['cart']);
        $Create->execute();


        //Update on estoque this product.
        $Stock = $pdo->prepare("UPDATE products SET product_stock = :stock WHERE product_id = :pid");
        $Stock->bindParam(":stock", $stock);
        $Stock->bindParam(":pid", $product_id);
        $Stock->execute();

        /*if($Create){
            $message = [
                'message'=> "The product {$product} foi add ao car",
                'status'=> 'success',
                'redirect'=> ''
            ];
        }else{
            $message = [
                'message'=> 'Not foi add ao car',
                'status'=> 'error',
                'redirect'=> ''
            ];
        }*/
    }else{
        $cart_quantity = strip_tags($Sh['cart_quantity'] + 1);
        $cart_id = strip_tags($Sh['cart_id']);
        $value = number_format($product_price * $cart_quantity, 2, ".", "");
        $stock = $product_stock - 1;

        $Update = $pdo->prepare("UPDATE cart_temporary SET cart_quantity = :qtd, product_stock = :stock, cart_value = :val, cart_total = :cart WHERE cart_id = :cart_id AND product_id = :product_id AND cart_session = :ses");
        $Update->bindParam(":qtd", $cart_quantity);
        $Update->bindParam(":stock", $stock);
        $Update->bindParam(":val", $product_price);
        $Update->bindParam(":cart", $value);
        $Update->bindParam(":cart_id", $cart_id);
        $Update->bindParam(":product_id", $product_id);
        $Update->bindParam(":ses", $_SESSION['cart']);
        $Update->execute();

        //Update on estoque this product.
        $Stock = $pdo->prepare("UPDATE products SET product_stock = :stock WHERE product_id = :pid");
        $Stock->bindParam(":stock", $stock);
        $Stock->bindParam(":pid", $product_id);
        $Stock->execute();

        if($Update){
            $message = [
                'message'=> "O produto {$product} foi atualizado ao carrinho",
                'status'=> 'success',
                'redirect'=> ''
            ];
        }else{
            $message = [
                'message'=> 'Não foi atualizado ao carrinho',
                'status'=> 'error',
                'redirect'=> ''
            ];
        }

    }

    echo json_encode($message);
?>