$( document ).ready(function(){

    $( "#save_form" ).click(function(e) {
        
        e.preventDefault();
        var form = $('#form').serialize();
    
        $.ajax({
            type:"POST",
            url: 'change_password.php',
            data: form,
            success: function(data){
                var data = JSON.parse(data);

                if (data.success) {
                    
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

                    //Clean the form
                    $('#oldPass').val("");
                    $('#newPass').val("");
                    $('#repetePass').val("");

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

