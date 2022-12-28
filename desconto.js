function troco()
{
    
    let $preco = Number(document.querySelector('#ipreco').value);

    let $totalc = $preco / 100 * 5;
    let $valor_com_desconto = ($preco - $totalc);
   
    document.querySelector('#desconto').value = $valor_com_desconto.toLocaleString('pt-BR');
    let $troco = ($totalc - $pago);
    
}