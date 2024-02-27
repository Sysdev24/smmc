/* -------------------------------------------------
 *  CONFIGURAR EL PLUGING CHOOSEN QUERY
 *--------------------------------------------------*/
$(".chosen-select").chosen({
    no_results_text: 'No hay resultados.',
});
/* -------------------------------------------------
 *  CONFIGURAR EL PLUGING ZEBRA TOOL TIPS
 *--------------------------------------------------*/

new $.Zebra_Tooltips($('.zebra_tooltips'), {
    vertical_alignment: 'below'
});

/* -------------------------------------------------
 *  CONFIGURAR EL PLUGING ZEBRA TOOL TIPS
 *  PARA LAS CELDAS DE UNA TABLA HTML
 *--------------------------------------------------*/

new $.Zebra_Tooltips($('.zebra_tooltips_td'), {
    position: 'right'
});


/* -------------------------------------------------
 *  CONFIGURAR EL PLUGING DATE-TIME-PICKER-BOOSTRAP4
 *
 * Fuente:https://www.jqueryscript.net/time-clock/Date-Time-Picker-Bootstrap-4.html
 *--------------------------------------------------*/

/* $(function() {
    $('#fecha_hora_evento').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY hh:mm a',
        locale: 'es',
        icons: {
            time: 'icofont-clock-time',
            date: 'icofont-calendar',
            up: 'icofont-circled-up',
            down: 'icofont-circled-down',
            previous: 'icofont-arrow-left',
            next: 'icofont-arrow-right',
            today: 'icofont-focus',
            clear: 'icofont-trash',
            close: 'icofont-close-circled'
        },

    })/* .data("DateTimePicker").maxDate(new Date); */

/* $('#fecha_hora_evento').data("DateTimePicker").maxDate(new Date);

}); */

$(function () {
    $('#visita_desde').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY hh:mm a',
        locale: 'es',
        useCurrent: false,
        icons: {
            time: 'icofont-clock-time',
            date: 'icofont-calendar',
            up: 'icofont-circled-up',
            down: 'icofont-circled-down',
            previous: 'icofont-arrow-left',
            next: 'icofont-arrow-right',
            today: 'icofont-focus',
            clear: 'icofont-trash',
            close: 'icofont-close-circled'
        },
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });

    $('#visita_hasta').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY hh:mm a',
        locale: 'es',
        useCurrent: false,
        icons: {
            time: 'icofont-clock-time',
            date: 'icofont-calendar',
            up: 'icofont-circled-up',
            down: 'icofont-circled-down',
            previous: 'icofont-arrow-left',
            next: 'icofont-arrow-right',
            today: 'icofont-focus',
            clear: 'icofont-trash',
            close: 'icofont-close-circled'
        },
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });

    $("#visita_desde").on("dp.change", function (e) {
        $('#visita_hasta').data("DateTimePicker").minDate(e.date);
    });
    $("#visita_hasta").on("dp.change", function (e) {
        $('#visita_desde').data("DateTimePicker").maxDate(e.date);
    });
});



$(function () {
    $('#fecha_desde').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY hh:mm a',
        locale: 'es',
        useCurrent: false,
        icons: {
            time: 'icofont-clock-time',
            date: 'icofont-calendar',
            up: 'icofont-circled-up',
            down: 'icofont-circled-down',
            previous: 'icofont-arrow-left',
            next: 'icofont-arrow-right',
            today: 'icofont-focus',
            clear: 'icofont-trash',
            close: 'icofont-close-circled'
        },
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });

    $('#fecha_hasta').datetimepicker({
        ignoreReadonly: true,
        format: 'DD/MM/YYYY hh:mm a',
        locale: 'es',
        useCurrent: false,
        icons: {
            time: 'icofont-clock-time',
            date: 'icofont-calendar',
            up: 'icofont-circled-up',
            down: 'icofont-circled-down',
            previous: 'icofont-arrow-left',
            next: 'icofont-arrow-right',
            today: 'icofont-focus',
            clear: 'icofont-trash',
            close: 'icofont-close-circled'
        },
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        },
    });

    $("#fecha_desde").on("dp.change", function (e) {
        $('#fecha_hasta').data("DateTimePicker").enable();
        $('#fecha_hasta').val('');
        $('#fecha_hasta').data("DateTimePicker").minDate(e.date);

    });
    $("#fecha_hasta").on("dp.change", function (e) {
        $('#fecha_desde').data("DateTimePicker").maxDate(e.date);

    });
});



/* -------------------------------------------------
 *  CONFIGURAR LA LIBRERÍA SELECT2
 *
 *   web:https://select2.org/
 *--------------------------------------------------*/
$('select#estados,select#centro_trabajo,select#municipios,select#operador,select#carnet,select#tipos_visitante,select#motivo_visita').select2({
    theme: "bootstrap-5",
    closeOnSelect: false,
    placeholder: 'Todo'
});

/* * -------------------------------------------------- */

