$(document).ready(function() {

    /* +++ ITERAR +++++ */
    $(document).on('click', '.pagination a.page-link', function(e) {
        e.preventDefault();

        var ruta = $(this).attr('href').split('?')[0];
        var pagina = $(this).attr('href').split('page=')[1];
        var elemento = $(this);
        var page_link = parseInt(elemento.parent().index()) - 1;
        var page_total = $('.pagination li.page-item').length;

        $.ajax({
            url: ruta,
            data: { page: pagina },
            type: 'GET',
            dataType: 'json',

            beforeSend: function() {
                $('#pagination-msg').html('<strong class="text-danger px-3">Espere un momento...</strong>').css('visibility', 'visible');
            },
            success: function(data) {

                $('#tabla_registros').html(data);

                /*  $('.pagination li').find('span.page-link').parent().removeClass('active');
                 $('.pagination li').find('span.page-link').replaceWith('<a class="page-link" href="' + window.location.pathname + '?page=' + $('.pagination li').find('span.page-link').html() + '">' + $('.pagination li').find('span.page-link').html() + '</a>')

                 elemento.parent().addClass('active');
                 elemento.parent().html('<span class="page-link">' + elemento.html() + '</span>'); */

                if (page_link >= page_total) {
                    $('.btn-next').removeClass('btn-primary').addClass('disabled btn-secondary')
                    $('.btn-last').removeClass('btn-primary').addClass('disabled btn-secondary')
                } else {
                    $('.btn-next').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-next').attr('href', window.location + '?page=' + (page_link + 1))

                    $('.btn-last').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-last').attr('href', window.location + '?page=' + (page_total))
                }

                if (page_link <= 1) {
                    $('.btn-prev').removeClass('btn-primary').addClass('disabled btn-secondary')
                    $('.btn-first').removeClass('btn-primary').addClass('disabled btn-secondary')
                } else {
                    $('.btn-prev').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-prev').attr('href', window.location + '?page=' + (page_link - 1))

                    $('.btn-first').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-first').attr('href', window.location + '?page=1')
                }
            },
            complete: function() {
                $('#pagination-msg').css('visibility', 'hidden').empty();
                document.cookie = "current_page=; expires=" + d + "; path=/;";
            }

        })
    });

    /* +++ AVANZAR +++++ */
    $(document).on('click', '.pagination a.btn-next', function(e) {

        e.preventDefault();

        var ruta = $(this).attr('href').split('?')[0];
        var pagina = $(this).attr('href').split('page=')[1];
        var elemento = $(this);
        var current_page = parseInt($('.pagination li').find('span.page-link').parent().index());
        var next_page = current_page;
        var total_page = parseInt($('.pagination li.page-item').length);

        $.ajax({
            url: ruta,
            data: { page: pagina },
            type: 'GET',
            dataType: 'json',

            beforeSend: function() {
                $('#pagination-msg').html('<strong class="text-danger px-3">Espere un momento...</strong>').css('visibility', 'visible');
            },

            success: function(data) {
                $('#tabla_registros').html(data);

                $('.btn-prev').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-prev').attr('href', window.location + '?page=' + (current_page - 1))

                $('.btn-first').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-first').attr('href', window.location + '?page=1')

                $('.pagination li').find('span.page-link').parent().removeClass('active');
                $('.pagination li').find('span.page-link').replaceWith('<a class="page-link" href="' + window.location.pathname + '?page=' + $('.pagination li').find('span.page-link').html() + '">' + $('.pagination li').find('span.page-link').html() + '</a>')

                $('.pagination li.page-item:eq(' + (next_page - 1) + ')').addClass('active');
                $('.pagination li.page-item:eq(' + (next_page - 1) + ')').html('<span class="page-link">' + next_page + '</span>') //replaceWith('<span class="page-link" href="#">*</span>');

                if (next_page >= total_page) {
                    $('.btn-next').removeClass('btn-primary').addClass('disabled btn-secondary')
                    $('.btn-last').removeClass('btn-primary').addClass('disabled btn-secondary')
                } else {
                    $('.btn-next').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-next').attr('href', window.location + '?page=' + (next_page + 1))

                    $('.btn-last').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-last').attr('href', window.location + '?page=' + total_page)
                }
            },
            compvare: function() {
                $('#pagination-msg').css('visibility', 'hidden').empty();
            }

        })

    });

    /* +++ RETROCEDER +++++ */
    $(document).on('click', '.pagination a.btn-prev', function(e) {

        e.preventDefault();

        var ruta = $(this).attr('href').split('?')[0];
        var pagina = $(this).attr('href').split('page=')[1];
        var elemento = $(this);
        var current_page = parseInt($('.pagination li').find('span.page-link').parent().index());
        var prev_page = current_page - 2;
        var total_page = parseInt($('.pagination li.page-item').length);


        $.ajax({
            url: ruta,
            data: { page: pagina },
            type: 'GET',
            dataType: 'json',

            beforeSend: function() {
                $('#pagination-msg').html('<strong class="text-danger px-3">Espere un momento...</strong>').css('visibility', 'visible');
            },

            success: function(data) {
                $('#tabla_registros').html(data);
                $('.btn-next').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-next').attr('href', window.location + '?page=' + (current_page - 1))

                $('.btn-last').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-last').attr('href', window.location + '?page=' + (total_page))


                $('.pagination li').find('span.page-link').parent().removeClass('active');
                $('.pagination li').find('span.page-link').replaceWith('<a class="page-link" href="' + window.location.pathname + '?page=' + $('.pagination li').find('span.page-link').html() + '">' + $('.pagination li').find('span.page-link').html() + '</a>')

                $('.pagination li.page-item:eq(' + (prev_page - 1) + ')').addClass('active');
                $('.pagination li.page-item:eq(' + (prev_page - 1) + ')').html('<span class="page-link">' + prev_page + '</span>') //replaceWith('<span class="page-link" href="#">*</span>');

                if (prev_page <= 1) {
                    $('.btn-prev').removeClass('btn-primary').addClass('disabled btn-secondary')
                    $('.btn-first').removeClass('btn-primary').addClass('disabled btn-secondary')
                } else {
                    $('.btn-prev').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-prev').attr('href', window.location + '?page=' + (prev_page - 1))

                    $('.btn-first').addClass('btn-primary').removeClass('disabled btn-secondary')
                    $('.btn-first').attr('href', window.location + '?page=1')
                }
            },
            complete: function() {
                $('#pagination-msg').css('visibility', 'hidden').empty();
            }

        })


    });



    /* +++ IR AL ÚLTIMO +++++ */
    $(document).on('click', '.pagination a.btn-last', function(e) {

        e.preventDefault();

        var ruta = $(this).attr('href').split('?')[0];
        var pagina = $(this).attr('href').split('page=')[1];
        var total_page = parseInt($('.pagination li.page-item').length);

        $.ajax({
            url: ruta,
            data: { page: pagina },
            type: 'GET',
            dataType: 'json',

            beforeSend: function() {
                $('#pagination-msg').html('<strong class="text-danger px-3">Espere un momento...</strong>').css('visibility', 'visible');
            },

            success: function(data) {
                $('#tabla_registros').html(data);
                $('.btn-prev').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-prev').attr('href', window.location + '?page=' + (total_page - 1))

                $('.btn-first').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-first').attr('href', window.location + '?page=1')

                $('.pagination li').find('span.page-link').parent().removeClass('active');
                $('.pagination li').find('span.page-link').replaceWith('<a class="page-link" href="' + window.location.pathname + '?page=' + $('.pagination li').find('span.page-link').html() + '">' + $('.pagination li').find('span.page-link').html() + '</a>')

                $('.pagination li.page-item:eq(' + (total_page - 1) + ')').addClass('active');
                $('.pagination li.page-item:eq(' + (total_page - 1) + ')').html('<span class="page-link">' + total_page + '</span>')

                $('.btn-next').removeClass('btn-primary').addClass('disabled btn-secondary')
                $('.btn-last').removeClass('btn-primary').addClass('disabled btn-secondary')
            },
            complete: function() {
                $('#pagination-msg').css('visibility', 'hidden').empty();
            }

        })



    });

    /* +++ IR AL PRIMERO +++++ */
    $(document).on('click', '.pagination a.btn-first', function(e) {

        e.preventDefault();

        var ruta = $(this).attr('href').split('?')[0];
        var pagina = $(this).attr('href').split('page=')[1];
        var elemento = $(this);
        var total_page = parseInt($('.pagination li.page-item').length);

        $.ajax({
            url: ruta,
            data: { page: pagina },
            type: 'GET',
            dataType: 'json',

            beforeSend: function() {
                $('#pagination-msg').html('<strong class="text-danger px-3">Espere un momento...</strong>').css('visibility', 'visible');
            },

            success: function(data) {
                $('#tabla_registros').html(data);

                $('.btn-next').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-next').attr('href', window.location + '?page=2')

                $('.btn-last').addClass('btn-primary').removeClass('disabled btn-secondary')
                $('.btn-last').attr('href', window.location + '?page=' + total_page)

                $('.pagination li').find('span.page-link').parent().removeClass('active');
                $('.pagination li').find('span.page-link').replaceWith('<a class="page-link" href="' + window.location.pathname + '?page=' + $('.pagination li').find('span.page-link').html() + '">' + $('.pagination li').find('span.page-link').html() + '</a>')

                $('.pagination li.page-item:eq(0)').addClass('active');
                $('.pagination li.page-item:eq(0)').html('<span class="page-link">1</span>')

                $('.btn-prev').removeClass('btn-primary').addClass('disabled btn-secondary')
                $('.btn-first').removeClass('btn-primary').addClass('disabled btn-secondary')

            },
            complete: function() {
                $('#pagination-msg').css('visibility', 'hidden').empty();
            }
        })
    });
}) /* FIN DEL READY */



/* function limpiaForm(formulario) {
    $(':input', formulario).each(function() {

        var type = this.type;
        var tag = this.tagName.toLowerCase();

        $(this).removeClass('is-invalid');
        $('.invalid-feedback').remove();

        if ($(this).attr('data-refresh') != 'no-refresh') {
            if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'email')
                this.value = '';
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.value = '';
        }
    });

    $('#usuario').removeAttr('readonly');
}




function refreshRegistros(url) {
    $('.update-message').html('<p><strong>Actualizando registros...</strong></p>');

    var current_page = parseInt($('.pagination li').find('span.page-link').parent().index()) - 1;
    $.get(url + '?page=' + current_page, function(res) {
        $('#tabla_registros').html(res);

        $('.update-message').empty();

    });

}


function formatDate(fecha) {


    var fechaFormat = "";

    var anio = fecha.split('/')[2];
    var mes = fecha.split('/')[1];
    var dia = fecha.split('/')[0];

    fechaFormat = anio + "-" + mes + "-" + dia;

    return fechaFormat;
} */