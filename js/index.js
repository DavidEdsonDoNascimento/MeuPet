$(function() {
    $("#nome").autocomplete({
        source: "./src/server-nome.php",
        select: function( event, ui ) {
            event.preventDefault();
            $("#nome").val(ui.item.value);
            $("#pessoa_id").val(ui.item.id);
        }
    });
    $("#pet").autocomplete({
        source: "./src/server-pet.php?dono_id="+ $("#pessoa_id")[0].value,
        select: function( event, ui ) {
            event.preventDefault();
            $("#pet").val(ui.item.value);
            $("#pet_id").val(ui.item.id);
        }
    });
    $("#cidade").autocomplete({
        source: "./src/server-cidade.php",
        select: function( event, ui ) {
            event.preventDefault();
            $("#cidade").val(ui.item.value);
            $("#cidade_id").val(ui.item.id);
        }
    });
});
