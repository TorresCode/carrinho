<?php session_start();
    require "../../connection.php";

    $message = null;
    $Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $Plus = filter_input(INPUT_GET, 'plus', FILTER_DEFAULT);
    $Minus = filter_input(INPUT_GET, 'minus', FILTER_DEFAULT);
    $PostFilters = array_map("strip_tags", $Post);

    foreach($PostFilters as $index => $value){}
   
    usleep(500000);

    if(!$_SESSION['cart'] || empty($_SESSION['cart'])){
        $message = [
            "message" => 'Nãp foi possivel atualizar',
            "status" => 'error',
            "redirect" => ''
        ];

        echo json_encode($message);
        return;
    }

    $Cart = $pdo->prepare("SELECT cart_id, cart_session, cart_quantity, cart_status, product_id FROM cart_temporary WHERE cart_session = :sessio AND cart_status = :cart_status AND cart_id = :cartId");
    $Cart->bindValue(":sessio", $_SESSION['cart']);
    $Cart->bindValue(":cart_status", 1);
    $Cart->bindValue(":cartId", $index);
    $Cart->execute();

    $Lines = $Cart->rowCount();

    if($Lines == 0){
        $message = [
            "message" => 'Este produto já foi eliminado',
            "status" => 'info',
            "redirect" => ''
        ];

        echo json_encode($message);
        return;
    }else{

        foreach($Cart as $Sh){}
        $product_id = strip_tags($Sh['product_id']);
        $qtd = strip_tags($Sh['cart_quantity']);

        if(!empty($Plus)){
            $cart_quantity = $qtd + 1;
        }else{
            $cart_quantity = $qtd - 1;
        }

        $Product = $pdo->prepare("SELECT product_id, product_stock, product_price, product_status FROM products WHERE product_id = :product_id AND product_status = :product_status");
        $Product->bindValue(":product_id", $product_id);
        $Product->bindValue(":product_status", 1);
        $Product->execute();

        foreach($Product as $Show){}

        $product_stock = strip_tags($Show['product_stock']);
        $product_price = strip_tags($Show['product_price']);
        $value = $product_price * $cart_quantity;

        if($Plus && !empty($Plus)){
            $stock = $product_stock - 1;
        }else{
            $stock = $product_stock + 1;
        }

        //Qtd on car igual the zero;
        if($cart_quantity == 0){
            $Update = $pdo->prepare("UPDATE products SET product_stock = :stock WHERE product_id = :pid");
            $Update->bindValue(":stock", $stock);
            $Update->bindValue(":pid", $product_id);
            $Update->execute();

            $Delete = $pdo->prepare("DELETE FROM cart_temporary WHERE cart_id  = :cart_id");
            $Delete->bindValue(":cart_id ", $index);
            $Delete->execute();
        

            if($Delete){
                $message = [
                    'message'=> "O produto {$product} foi atualizado ao carrinho",
                    'status'=> 'success',
                    'redirect'=> ''
                ];
            }else{
                $message = [
                    'message'=> 'Não foi eliminado ao carrinho',
                    'status'=> 'error',
                    'redirect'=> ''
                ];
            }
        }

        //Verify if the product have estoque;
        if($product_stock == 0 && empty($Minus)){
            $message = [
                'message'=> "Tem apenas {$qtd} produto",
                'status'=> 'info',
                'redirect'=> ''
            ];
            echo json_encode($message);
            return;
        }else{
            $Update = $pdo->prepare("UPDATE cart_temporary SET cart_quantity = :cart_quantity, product_stock = :product_stock, cart_value = :cart_value, cart_total = :cart_total WHERE cart_id = :cart_id AND product_id = :product_id AND cart_session = :cart_session");
            $Update->bindValue(":cart_quantity", $cart_quantity);
            $Update->bindValue(":product_stock", $product_stock);
            $Update->bindValue(":cart_value", $product_price);
            $Update->bindValue(":cart_total", $value);
            $Update->bindValue(":cart_id", $index);
            $Update->bindValue(":product_id", $product_id);
            $Update->bindValue(":cart_session", $_SESSION['cart']);
            $Update->execute();
        }           

        }
?>