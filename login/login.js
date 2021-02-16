$(document).ready( function(){ 

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    if (urlParams.get('r')) {

        var reason = urlParams.get('r');
        if (reason == "expired") {
            if ($('#session-expired').hasClass('display-none')) {
                $('#session-expired').removeClass('display-none');
            }
        }

    }

    if (urlParams.get('url')) {

        var url = urlParams.get('url');

        if (url == "dashboard")      {   var url = "/dashboard";    }
        if (url == "calendari")      {   var url = "/calendari";    }
        if (url == "eventos")        {   var url = "/eventos";      }
        if (url == "perfil")         {   var url = "/perfil";       }
        if (url == "equip")          {   var url = "/equip";        }
        if (url == "configuracio")   {   var url = "/configuracio"; }
        if (url == "seguretat")      {   var url = "/seguretat";    }
        if (url == "administracio")  {   var url = "/admin";        }

    } else {
        var url = "/dashboard";
    }

    $( "#login_button" ).click(function(e) {

        e.preventDefault();
        var form = $('#login_form').serialize();
        
        $.ajax({
            type:"POST",
            url: 'login.php',
            data: form,
            success:function(data){
                var data = JSON.parse(data);

                if (data.message == "login") {
                    window.location = url;
                    if (!$('#session-error').hasClass('display-none')) {
                        $('#session-error').addClass('display-none');
                    }
                    if (!$('#session-expired').hasClass('display-none')) {
                        $('#session-expired').addClass('display-none');
                    }
                }

                if (data.message == "error") {
                    if ($('#session-error').hasClass('display-none')) {
                        $('#session-error').removeClass('display-none');
                    }
                }
            }
        });
    });
});