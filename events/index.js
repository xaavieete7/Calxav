$(document).ready( function(){

    $( "#save_form" ).click(function(e) {

        e.preventDefault();
        var form = $('#event_form').serialize();
    
        $.ajax({
            type:"POST",
            url: 'functions.php',
            data: form,
            success: function(data){
                var data = JSON.parse(data);

                if (data.success) {

                    $('#event_table').load('/events/eventos.php');

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
                    $("input[name='start']").val("");
                    $('#select-color').val("starupgrind");
                    $("#color").val("#9771d1");
                    $("textarea[name='description']").val("");

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
                
            },
            error: function(data){
                
            }
        });
    });

    $('#select-color').on('change', function() {

        if (this.value == "starupgrind") {

            $("#color").val("#9771d1");

        } else if (this.value == "aniversari") {

            $("#color").val("#FFA420");

        } else if (this.value == "altres") {

            $("#color").val("#ffdf00");

        }
        
    });
      
});

