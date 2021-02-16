$(document).ready( function(){ 

    $( "#save_form" ).click(function(e) { 

        var form = $('#form').serialize();
        
        $.ajax({
            type:"POST",
            url: 'functions.php',
            data: form,
            success: function(data){
                
                var data = JSON.parse(data);

                if (data.success == 1) {

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
    });
});