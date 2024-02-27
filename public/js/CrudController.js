import { refreshRegistros, limpiaForm } from "./Utilitys.js";

/**
 * GUARDAR REGISTROS
 */

$(document).on("submit", "#agregar_registro", function (e) {
    e.preventDefault();

    if (!$(this).data("locked")) {
        let ruta = $(this).attr("action");
        let data = new Object();
        let campos = $(this).serializeArray();

        $(".invalid-feedback", this).remove();

        $(this).data("locked", true);
        $('input[type="submit"]', this).blur();
        $('input[type="submit"]', this).attr("disabled", "disabled");
        $("#foot-notificacion")
            .append(
                `<div class="wait-notification"> <img src="./img/loading.gif" alt="Procesando formulario."
                    style="width: 100px;display: block;">
                  </div>`
            )
            .fadeIn(300);

        campos.forEach(function (val, key) {
            if (val.name === "_token") {
                data[val.name] = val.value;
            } else {
                data[val.name] = val.value.toUpperCase();
            }

            $("#" + val.name).removeClass("is-invalid");
        });

        $.ajax({
            url: ruta,
            type: "POST",
            headers: { "X-CSRF-TOKEN": data["_token"].toLowerCase() },
            dataType: "json",
            data: data,

            beforeSend: function () {
                $("#foot-notificacion").html(
                    '<p class="info-wait text-center w-100"><strong class="text-danger">Procesando formulario...</strong></p>'
                );
                $("#agregar_registro").data("locked", true);
                $('#agregar_registro input[type="submit"]').blur();
                $('#agregar_registro input[type="submit"]').attr(
                    "disabled",
                    "disabled"
                );
            },

            success: function (res) {
                refreshRegistros(table);
                limpiaForm("#agregar_registro");
                $("form#agregar_registro")
                    .before(
                        `<div class="ok-notification notification">Registro exitoso.</div>`
                    )
                    .fadeIn(300);
            },

            error: function (res) {
                if (res.status == 422) {
                    for (let key in res.responseJSON.errors) {
                        if (
                            $(`#agregar_registro #${key}`).hasClass(
                                "chosen-select"
                            )
                        ) {
                            $(
                                `#agregar_registro #${key} ~ .chosen-container`
                            ).after(
                                `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                            );
                            $(
                                `#agregar_registro #${key} ~ .chosen-container`
                            ).addClass("is-invalid");
                        } else if (
                            $(`#agregar_registro #${key}`).hasClass(
                                "datetimepicker"
                            )
                        ) {
                            $(`#agregar_registro #${key}`)
                                .closest("div.input-group")
                                .addClass("is-invalid")
                                .after(
                                    `<span class= "invalid-feedback position-absolute" role = "alert"> <strong>  ${res.responseJSON.errors[key][0]}</strong></span> `
                                );
                        } else {
                            $(`#agregar_registro #${key}`).addClass(
                                "is-invalid"
                            );
                            $(`#agregar_registro #${key}`).after(
                                `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                            );

                            if (key === "ciPasaporte") {
                                $(`#agregar_registro #ci_pasaporte`).addClass(
                                    "is-invalid"
                                );
                                $(`#agregar_registro #ci_pasaporte`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                            }
                        }
                    }
                } else {
                    $("form#agregar_registro").before(
                        `<div class="error-notification notification">${res.status}: Error al procesar su solicitud.</div>`
                    );
                }
            },
            complete: function () {
                $("#agregar_registro").data("locked", false);
                $('#agregar_registro input[type="submit"]').removeAttr(
                    "disabled"
                );
                $(".info-wait").fadeOut(300);
            },
        });

        setTimeout(function () {
            $(".notification").fadeOut(300);
        }, 3000);
    }
});

/**
 * EDITAR REGISTROS
 */

$(document).on("submit", "#editar_registro", function (e) {
    e.preventDefault();

    if (!$(this).data("locked")) {
        let ruta = $(this).attr("action");
        let data = new Object();
        let campos = $(this).serializeArray();

        //-console.log(campos);

        $(".invalid-feedback", this).remove();

        $(this).data("locked", true);
        $('input[type="submit"]', this).blur();
        $('input[type="submit"]', this).attr("disabled", "disabled");
        $("#foot-notificacion")
            .append(
                `<div class="wait-notification"> <img src="./img/loading.gif" alt="Procesando formulario."
                    style="width: 100px;display: block;">
                  </div>`
            )
            .fadeIn(300);

        campos.forEach(function (val, key) {
            if (val.name === "_token") {
                data[val.name] = val.value;
            } else {
                data[val.name] = val.value.toUpperCase();
            }
            $("#" + val.name).removeClass("is-invalid");
        });

        //-console.log(data);

        $.ajax({
            url: `${ruta}/${data["id"]}`,
            type: "PUT",
            headers: { "X-CSRF-TOKEN": data["_token"] },
            dataType: "json",
            data: data,

            beforeSend: function () {
                $("#foot-notificacion").html(
                    '<p class="info-wait text-center w-100"><strong class="text-danger">Procesando formulario...</strong></p>'
                );
                $("#editar_registro").data("locked", true);
                $('#editar_registro input[type="submit"]').blur();
                $('#editar_registro input[type="submit"]').attr(
                    "disabled",
                    "disabled"
                );
            },

            success: function (res) {
                refreshRegistros(table);
                $("form#editar_registro")
                    .before(
                        `<div class="ok-notification notification">Registro exitoso.</div>`
                    )
                    .fadeIn(300);
                $(".modal").modal("hide");
            },

            error: function (res) {
                console.log(res);
                if (res.status == 422) {
                    for (let key in res.responseJSON.errors) {
                        $(`#editar_registro #${key}`).addClass("is-invalid");
                        $(`#editar_registro #${key}`).after(
                            `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                        );

                        if (
                            $(`#editar_registro #${key}`).hasClass(
                                "chosen-select"
                            )
                        ) {
                            $(
                                `#editar_registro #${key} ~ .chosen-container`
                            ).after(
                                `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                            );
                            $(
                                `#editar_registro #${key} ~ .chosen-container`
                            ).addClass("is-invalid");
                        } else if (
                            $(`#editar_registro #${key}`).hasClass(
                                "datetimepicker"
                            )
                        ) {
                            $(`#editar_registro #${key}`)
                                .closest("div.input-group")
                                .addClass("is-invalid")
                                .after(
                                    `<span class= "invalid-feedback position-absolute" role = "alert"> <strong>  ${res.responseJSON.errors[key][0]}</strong></span> `
                                );
                        } else {
                            $(`#editar_registro #${key}`).addClass(
                                "is-invalid"
                            );
                            $(`#editar_registro #${key}`).after(
                                `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                            );
                            if (key === "ciPasaporte") {
                                $(`#editar_registro #ci_pasaporte`).addClass(
                                    "is-invalid"
                                );
                                $(`#editar_registro #ci_pasaporte`).after(
                                    `<span class="invalid-feedback position-absolute" role="alert"><strong>  ${res.responseJSON.errors[key][0]}</strong></span>`
                                );
                            }
                        }
                    }
                } else {
                    $("form#editar_registro").before(
                        `<div class="error-notification notification">${res.status}: Error al procesar su solicitud.</div>`
                    );
                }
            },
            complete: function () {
                $("#editar_registro").data("locked", false);
                $('#editar_registro input[type="submit"]').removeAttr(
                    "disabled"
                );
                $(".info-wait").fadeOut(300);
            },
        });

        setTimeout(function () {
            $(".notification").fadeOut(300);
        }, 3000);
    }
});

/**
 * MODIFICAR EL ESTATUS DE LOS REGISTROS
 */
$(document).on("submit", "#editar_estatus", function (e) {
    e.preventDefault();

    if (!$(this).data("locked")) {
        $(".invalid-feedback").remove();

        var ruta = $("#editar_estatus").attr("action");
        var data = {};
        var campos = $("#editar_estatus").serializeArray();

        $(campos).each(function (i, val) {
            if (val.name === "_token") {
                data[val.name] = val.value;
            } else {
                data[val.name] = val.value.toUpperCase();
            }

            $("#" + val.name).removeClass("is-invalid");
        });

        $.ajax({
            url: `${ruta}/${data["id"]}`,
            type: "DELETE",
            headers: { "X-CSRF-TOKEN": data["_token"] },
            dataType: "json",
            data: data,

            beforeSend: function () {
                $(".modal").animate(
                    {
                        scrollTop: $(
                            "#editar_estatus" + " #foot-notificacion"
                        ).offset().top,
                    },
                    1000
                );

                $("#editar_estatus" + " #foot-notificacion").html(
                    '<p class="info-wait text-center w-100"><strong class="text-danger">Procesando formulario...</strong></p>'
                );
                $("#editar_estatus").data("locked", true);
                $("#editar_estatus" + ' input[type="submit"]').blur();
                $("#editar_estatus" + ' input[type="submit"]').attr(
                    "disabled",
                    "disabled"
                );
            },

            success: function (res) {
                refreshRegistros(table);
                $(".modal").modal("hide");
            },

            error: function (res) {
                $("#foot-notificacion").empty();
                $("#editar_estatus").before(
                    `<div class="error-notification notification">${res.status}: Error al procesar su solicitud.</div>`
                );
            },

            complete: function () {
                $("#editar_registro").data("locked", false);
                $('#editar_registro input[type="submit"]').removeAttr(
                    "disabled"
                );
                $(".info-wait").fadeOut(300);
            },
        });
        setTimeout(function () {
            $(".notification").fadeOut(300);
        }, 3000);
    }
});

/**
 * CONSULTAR USUARIO EN EL SERVIDOR LADAP
 */

$(document).on("click", "#btnBuscarUsuraioLdap", function (e) {
    e.preventDefault();

    var elemento = $(this).attr("id");
    if (!$(this).data("locked")) {
        $("input#ci").removeClass("is-invalid");
        $(".invalid-feedback").empty();
        $("select#usuario").attr("readonly", "readonly");
        $("select#usuario").empty();

        if ($("input#ci").val() == "") {
            $("input#ci").addClass("is-invalid");
            $("input#ci").after(
                '<span class="invalid-feedback position-absolute" role="alert"><strong>Ingrese la cédula</strong></span>'
            );
        } else {
            $("input#ci").attr("readonly", "readonly");
            $("label[for=ci]~small").after(
                "<small> Buscando usuario...</small>"
            );

            $("#" + elemento).data("locked", true);
            $("#" + elemento)
                .removeClass("btn-primary")
                .addClass("btn-disabled");

            const data = {
                cedula: $("input#ci").val(),
            };

            $.ajax({
                url: $(this).attr("href"),
                type: "GET",
                dataType: "json",
                data: data,

                success: function (res) {
                    if (res != null) {
                        if (res == 500) {
                            $("input#ci").addClass("is-invalid");
                            $("input#ci").after(
                                '<span class="invalid-feedback position-absolute" role="alert"><strong>Error inesperado al consultar la cédula, vuelve a intentarlo.</strong></span>'
                            );
                            $("input#ci").removeAttr("readonly").focus();
                        } else {
                            $("select#usuario").append(
                                `<option selected="selected" value="">Seleccione el usuario</option>`
                            );
                            for (const key in res) {
                                $("select#usuario").append(
                                    `<option value="${key}">${res[key]}</option>`
                                );
                            }
                            $("select#usuario").removeAttr("readonly").focus();
                        }
                    } else {
                        $("#usuario").removeAttr("readonly");

                        $("input#ci").addClass("is-invalid");
                        $("input#ci").after(
                            '<span class="invalid-feedback position-absolute" role="alert"><strong>Cédula no encontrada. Por favor verifique.</strong></span>'
                        );
                        $("input#ci").removeAttr("readonly").focus();
                    }
                },
                error: function (jqXHR) {
                    if (jqXHR.status == 422) {
                        for (var key in jqXHR.responseJSON.errors) {
                            $("#" + key).addClass("is-invalid");
                            $("#" + key).after(
                                '<span class="invalid-feedback position-absolute" role="alert"><strong> ' +
                                    jqXHR.responseJSON.errors[key][0] +
                                    " </strong></span>"
                            );
                        }
                    } else {
                        $("input#ci").addClass("is-invalid");
                        $("input#ci").after(
                            '<span class="invalid-feedback position-absolute" role="alert"><strong>Error inesperado al consultar la cédula, vuelve a intentarlo.</strong></span>'
                        );
                        $("input#ci").removeAttr("readonly").focus();
                    }
                    $("input#ci").removeAttr("readonly").focus();
                },

                complete: function () {
                    $("#" + elemento)
                        .removeClass("btn-disabled")
                        .addClass("btn-primary");
                    $("#" + elemento).data("locked", false);
                    $("label[for=ci]~small").next("small").remove();
                },
            });
        }
    }
});

$(document).on("change", "#usuario", function (e) {
    let data = {
        usuario: $(this).val(),
    };

    $("input[name=nombres]").val("");
    $("input[name=apellidos]").val("");
    $("input[name=email]").val("");
    $("label[for=usuario]~small").after("<small> Obteniendo datos...</small>");

    $.ajax({
        url:
            location.protocol +
            "//" +
            location.host +
            "/consultar-datos-usuario-ldap",
        type: "GET",
        dataType: "json",
        data: data,

        success: function (res) {
            $("input[name=nombres]").val(res.nombres);
            $("input[name=apellidos]").val(res.apellidos);
            $("input[name=email]").val(res.email);
        },
        complete: function () {
            $("label[for=usuario]~small").next("small").remove();
        },
    });
});

/**
 * MOSTRAR LA VENTANA DE PARA EDITAR LOS REGISTROS
 */
$(document).on("click", ".openEditWin", function (e) {
    e.preventDefault();

    $("#winEdit .modal-body").html(
        '<div id="mensaje_loading" class="text-center w-100">\
    <img class="img-fluid" src="/img/loading.gif" width="32px">\
    <p><strong>Obteniendo el registro..</strong></p></div>'
    );

    var url_record = $(this).data("registro");

    $.get(url_record, function (res) {
        $("#winEdit .modal-body").html(res);
        $("#winEdit .modal-body").find("form input:visible:first").focus();
    });
});

/**
 * MOSTRAR LA VENTANA DE PARA MODIFICAR EL ESTATUS DE LOS REGISTROS
 */

$(document).on("click", ".openEditStatusWin", function (e) {
    e.preventDefault();
    $("#winEditEstatus .modal-body").html(
        '<div id="mensaje_loading" class="text-center w-100">\
    <img class="img-fluid" src="/img/loading.gif" width="32px" style="">\
    <p><strong>Obteniendo el registro..</strong></p></div>'
    );

    var url_record = $(this).data("registro");

    $.get(url_record, function (res) {
        $("#winEditEstatus .modal-body").html(res);
    });
});
