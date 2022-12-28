<?php session_start();
    require_once "base.php";
    
    class crud extends base
    {

        public function qtdcarrinho()
        {
            $status = 1;
            $session = strip_tags($_SESSION['cart']); 
            $Cart = $this->conn->prepare("SELECT cart_session, cart_status FROM cart_temporary WHERE cart_status = :stat AND cart_session = :sessio");
            $Cart->bindParam(":stat", $status);
            $Cart->bindParam(":sessio", $session);
            $Cart->execute();
            return $Cart->rowCount();
        }

        public function selectcalcas() 
        { 
            $vc = "Calcas";
            $keyc = "Ac$!fredy01";
            $status = 1;
            $selcalcas = $this->conn->prepare("SELECT product_id, product_cover, product_name, product_headline, product_stock, product_link, product_price, product_status, modelo FROM products WHERE product_status = ? AND modelo = ?");
            $selcalcas->bindParam(1, $status);
            $selcalcas->bindParam(2, $vc);
            $selcalcas->execute();

            if($selcalcas->rowCount() > 0)
            {
                $resultcalcas = $selcalcas->fetchAll(PDO::FETCH_ASSOC);
                return $resultcalcas;
            }
        }


        public function update($produto, $nome, $preco, $quantidade, $modelo, $id) 
        {
            $update = $this->conn->prepare("UPDATE products SET product_cover = ?, product_name = ?, product_price = ?, product_stock = ?, modelo = ? WHERE product_id = ?");
            $update->bindParam(1, $produto);
            $update->bindParam(2, $nome);
            $update->bindParam(3, $modelo);
            $update->bindParam(4, $quantidade);
            $update->bindParam(5, $preco);
            $update->bindParam(6, $id);
            return $update->execute();
        }

        public function delete($id) 
        {
            $del_tbluser = "DELETE FROM tbluser WHERE id='$id'";
            $query_tbluser = mysqli_query($conn, $del_tbluser);          

            $delete = $this->conn->prepare("DELETE FROM products WHERE product_id = ?");
            $delete->bindParam(1, $id);
            return $delete->execute();
        }
    }
?>