
$(document).ready( function(){ 

    var hasWritten = false;

    $('select[name="rank"]').on('change', function() { //on change for the user rank select we display different inputs
        if($(this).val() == "user") {
            $(user_inputs).each(function() {
                $(this).removeClass('d-none');
            });
        } else {
            $('input[name="hour_price"]').val("");
            $('input[name="hour_total"').val("");
            $('div.is_user').addClass('d-none');
        }
    });


    //password generator
    $('.generate_password').on('click', function() {
         $('input[name="password"]').val(Math.random().toString(36).slice(-8));
         $(this).text("Contraseña generada");
         setTimeout(function() {$('.generate_password').text("Generar Contraseña")}, 3000);
    });


    //Change password visibility depending on "eye" icon state
    $("#show_hide_password a").on('click', function(e) {
        e.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });

    //submit create user / viewer form
    $('#create_new_user').click(function(e) {
        e.preventDefault();
        var form = $('#create_user').serialize();
        save_form(form);
        
       
    });

    //on keyup user name if username field hasn't been modified it copies the content to that input
    $('input[name="name"]').on('keyup', function() {
        if (! hasWritten) {
            $('input[name="username"]').val($(this).val().toLowerCase());
        }
    });

    //in case user has written inside this input, we change the boolean var hasWritten to true
    $('input[name="username"]').on('keyup', function() {
        hasWritten = true;
    });






    $( "#save_notification_form" ).click(function(e) {

        e.preventDefault();
        var form = $('#notifiacation_form').serialize();

        save_form(form);
    
    });

    function save_form(form) {

        $.ajax({
            type:"POST",
            url: 'functions.php',
            data: form,
            success: function(data){
                var data = JSON.parse(data);

                if (data.success) {

                    $('#notificacion_table').load('/admin/notifiaciones.php');

                    //Display success message
                    Swal.fire({
                        icon: 'swal2-icon-show',
                        title: '<i class="material-icons success-icon mr-2">check_circle_outline</i>',
                        text: data.message,
                        timer: 3000,
                        toast: true,
                        position: 'top-end',
                        showCancelButton: false,
                        showConfirmButton: false
                    });

                    $("input.form-control").val("");
                    
                } else {

                    //Display error message
                    Swal.fire({
                        icon: 'swal2-icon-show',
                        title: '<i class="material-icons error-icon mr-2">error_outline</i>Oops...',
                        text: data.message,
                        timer: 3000,
                        toast: true,
                        position: 'top-end',
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                }
                
            }
        });
    }
});