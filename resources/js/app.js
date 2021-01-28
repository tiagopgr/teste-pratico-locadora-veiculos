require('./bootstrap');

$(function () {
    $(".alert").alert();

    $(".delete-item").click(function () {
        var confirmacao = confirm("Deseja realmente excluir o registro? Essa ação não pode ser desfeita!");

        if (confirmacao === true) {
            var form_delete = $("form").last();

            form_delete.attr("action", $(this).attr("data-delete"));
            form_delete.submit();
        }
    });


    $(".devolver-veiculo").click(function () {
        $("input:hidden[name='reserva_id']").val($(this).attr("data-reserva_id"));
    });


    $("select").select2();
});
