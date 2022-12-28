$(document).ready(function() {

    //Update the icon of menu [car] 
    var atualizar = setInterval(function(){
        $('#counter').load("index.php #counter");
    }, 1000); 

    var atualizar = setInterval(function(){
        $('#countermobile').load("index.php #countermobile");
    }, 1000); 

    //Update the page of car
    var atualizar = setInterval(function(){
        $('#cart').load("cart.php #loader");
    }, 1000);

    //Buy Product
    $('body').on('click', '.buy', function(e){
        e.preventDefault();

        var form = $(this).attr('data-value');
        var url = "ajax/cart/buy.php";//Enviar no file buy point php.


        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',

            success: function(data, textStatus, jqXHR)
            {
                if(data['status'] == 'success'){
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-check-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'info'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-info-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'warning'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-exclimation-triangle">'+data['message']+'</span></p></div></div></div>');

                }else{
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-times-circle">'+data['message']+'</span></p></div></div></div>');

                }   

                setTimeout(function(){
                    $('#status-container').hide();

                    if(data['redirect'] != ''){
                        window.location.href = data['redirect']; 
                    }
                }, 1000);
            }
        });
    });


    //Update Qunatity Product Plus
    $('body').on('click', '.plus', function(e){
        e.preventDefault();

        var form = $(this).attr('data-id');
        var val = $('.quantity').change().val();
        var url = "ajax/cart/quantity.php?plus="+val;


        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',

            success: function(data, textStatus, jqXHR){
                if(data['status'] == 'success'){
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-check-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'info'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-info-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'warning'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-exclimation-triangle">'+data['message']+'</span></p></div></div></div>');

                }else{
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-times-circle">'+data['message']+'</span></p></div></div></div>');

                }   

                setTimeout(function(){
                    $('#status-container').hide();

                    if(data['redirect'] != ''){
                        window.location.href = data['redirect']; 
                    }
                }, 1000);
            }
        });
    });


    //Update Qunatity Product Minus
    $('body').on('click', '.minus', function(e){
        e.preventDefault();

        var form = $(this).attr('data-id');
        var val = $('.quantity').change().val();
        var url = "ajax/cart/quantity.php?minus="+val;


        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            dataType: 'JSON',

            success: function(data, textStatus, jqXHR){
                if(data['status'] == 'success'){
                    $('.result').text('');
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-check-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'info'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-info-circle">'+data['message']+'</span></p></div></div></div>');

                }else if(data['status'] == 'warning'){
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-exclimation-triangle">'+data['message']+'</span></p></div></div></div>');

                }else{
                    $('.result').prepend('<div class="status-top-right text-center" id="status-container"><div class="status status-'+data['status']+'"><div class="status-message"><p><span class="fa fa-times-circle">'+data['message']+'</span></p></div></div></div>');

                }   

                setTimeout(function(){
                    $('#status-container').hide();

                    if(data['redirect'] != ''){
                        window.location.href = data['redirect']; 
                    }
                }, 1000);
            }
        });
    });
});