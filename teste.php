<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<input type='text' id='email'>
<div id='resposta'></div>

<script language="javascript">
    var email = $("#email");
    email.keyup(function () {
        $.ajax({
            url: 'ajax/teste.php',
            type: 'POST',
            data: {"email": email.val()},
            success: function (data) {
                console.log(data);
                data = $.parseJSON(data);
                $("#resposta").text(data.email);
            }
        });
    });
</script>