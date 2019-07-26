<form id="dataForm">
    <label for="name">Nome: </label>
    <input type="text" name="name" id="name"/>
    <br>
    <br>
    <label for="file">Arquivos: </label>
    <input type="file" name="files[]" id="file" multiple="multiple"/>
    <br>
    <br>
    <button type="submit" id="sendForm">Enviar</button>
</form>
<script>

    $(function () {
        $("#dataForm").on('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var button = $("#sendForm");
            var data = new FormData(this);
            
            console.log(data);
            $.ajax({
                beforeSend: function () {
                    button.attr('disabled', true);
                    button.html("Going...");
                },
                url: "ajax/ajax_bandeira_cartao.php",
                type: 'POST',
                data: data,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    button.attr('disabled', false);
                    button.html("Enviar");
                }
            });
        });
    });
</script>