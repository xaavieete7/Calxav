$(document).ready( function(){ 

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

                    $('#notificacion_table').load('https://cal.xaviete.com/admin/notifiaciones.php');

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

                    $("input[name='title']").val("");
                    $("textarea[name='content']").val("");
                    $("select[name='type']").val("");
                    $("select[name='visibility']").val("");
                    
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