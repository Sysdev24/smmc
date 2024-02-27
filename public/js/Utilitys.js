/**
 * REFRESCA EL LISTADO DE REGISTROS DESPUES DE UNA OPERACION CRUD.
 * @param url
 */
export const refreshRegistros = (table) => {

    $('.refresh-noticafion').append('<img src="img/loading.gif" style="width:32px"><strong>&nbsp;Actualizando...</strong>').fadeIn(200);

    /* var current_page = parseInt($('.pagination li').find('span.page-link').parent().index()) - 1;
    $.get(url + '?page=' + current_page, function(res) {
        $('#tabla_registros').html(res);

    }); */

    table.ajax.reload(null, false);

    setTimeout(function() {
        $('.refresh-noticafion').children().fadeOut(200).empty();
    }, 1000);

}


/**
 * LIMPIAR FORMULARIOS.
 * @param formulario
 */
export const limpiaForm = (formulario) => {
    $(':input', formulario).each(function() {

        let type = this.type;
        let tag = this.tagName.toLowerCase();

        $(this).removeClass('is-invalid');
        $('.chosen-container').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        if ($(this).attr('data-refresh') != 'no-refresh') {
            if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'email'){
                this.value=''
            }else if (type == 'checkbox' || type == 'radio'){
                this.checked = false;
            }else if (tag == 'select'){

                if ($(this).attr('id')=='tipo_dcumento'){
                    this.value='V'
                }else{
                     this.value = '';
                }
                $(".chosen-select").val('').trigger("chosen:updated");
            }
        }

        if ($(this).attr('tabindex') == 0) {
            $(this).focus();
        }
    });
    $('input#ci').removeAttr('readonly').focus();
    $('select#usuario').attr('readonly', 'readonly').removeAttr('placeholder').empty();
    $('select#correlativo').attr('readonly', 'readonly').removeAttr('placeholder').empty();

    $('.container-pase div .siglas').empty();
    $('.container-pase div .correletivo').empty();
};


/**
 * ACTIVA LA limpiaForm DESDE UN BOTÓN.
 */
$(document).on('click', '#btnLimpiaFormulario', function() {
    var formulario = '#' + $(this).closest('form').attr('id');
    limpiaForm(formulario);
});


/**
 * DEFINE LAS ACCIONES DESPUÉS DE CERRARSE UNA VENTANA MODAL.
 */
$('.modal').on('hidden.bs.modal', function() {
    var formulario = '#' + $(this).find('form').attr('id');
    limpiaForm(formulario);
});
