jQuery(document).on('submit', '#form-login', function (event) {

    event.preventDefault();

    jQuery.ajax({
        url: 'validar.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {
            $('.btn-get-started').val('Validando...');
        }
    })
    .done(function (respuesta) {
            console.log(respuesta);
            if (!respuesta.error) {
                location.href = 'general.php';
            } else {
                $('.error').slideDown('slow');
                setTimeout(function(){
                    $('.error').slideUp('slow');
                },3000);
                $('.btn-get-started').val('Ingresar');
            }
        })
});