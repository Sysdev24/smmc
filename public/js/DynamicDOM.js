$(document).ready(function () {

   /**  
   * | Esto impide que el formulario se envíe cuando el usuario presiona la tecla Intro. 
   */
    $('form').keypress(function(e){
        if(e == 13){
          return false;
        }
      });

      $('input').keypress(function(e){
        if(e.which == 13){
          return false;
        }
      });
    /* -------------------------------------------------
     * GESTIONAR MENÚ PRINCIPAL
     *--------------------------------------------------*/

    $(".title-parent").click(function () {
        let grupoMenu = $(this).siblings(".group-menu");

        if (!$(this).hasClass("actived")) {
            $(".menu-principal .parent-menu .group-menu").each(function () {
                $(this).slideUp(200);
                $(this).siblings(".title-parent").removeClass("actived");
                $(this)
                    .siblings(".title-parent")
                    .children("span.icofont-thin-down")
                    .removeClass("actived");
            });

            $("span.icofont-thin-down", this).addClass("actived");
            $(this).addClass("actived");
            grupoMenu.slideDown(200);
        } else {
            grupoMenu.slideUp(200);
            $(this).removeClass("actived");
            $("span.icofont-thin-down", this).removeClass("actived");
        }
    });

    /**---------------------------------------------------
     * ASIGNA EL FOCO AL PRIMER ELEMENTO DEL FORMULARIOS
     *-----------------------------------------------------*/

    $("#openAddWin").click(function () {
        $("#winAgregarRegistro").modal({
            show: true,
        });
    });
    //$('#winAgregarRegistro').on('shown.bs.modal', function() {
    //$(this).find('form').children('div:first').children('div:first').children('input').focus();
    //$(':input:enabled:visible:first').focus();
    // $('#winAgregarRegistro').trigger('focus')

    //$('#carnet').trigger('focus');
    //console.log($(this).find('form').children('div:first').children('div:first').children('input').attr('name'));
    // })

    $(function () {
        $("#winAgregarRegistro").on("shown.bs.modal", function (e) {
            $(this)
                .find("form")
                .children("div:first")
                .children("div:first")
                .children("input")
                .trigger("focus");
        });
    });

    //find('form input:visible:first').focus();

    /**
     * CARGA EL CORRELATIVO EN EL EMULADOR DE CARNET
     */
    $(document).on("change", "#correlativo", function (e) {
        $(".container-pase div .correletivo").empty();
        $(".container-pase div .correletivo").append(
            $(this).find("option:selected").text()
        );
    });

    /**
     * ACTIVA/DESACTIVA LA CÁMARA PARA TOMAR UNA FOTO CON LA WEBCAM
     */

    $(document).on("click", "#activarCamara", function (e) {
        $(this).addClass("btn-disabled").prop("disabled", true);
        $("#capturarCamara")
            .removeClass("btn-disabled")
            .prop("disabled", false);

        obtenerDispositivos().then((dispositivos) => {
            const dispositivosDeVideo = [];

            dispositivos.forEach(function (dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            if (dispositivosDeVideo.length > 0) {
                mostrarStream(
                    dispositivosDeVideo[0].deviceId,
                    dispositivosDeVideo
                );

            }
        });
    });


    $(document).on("click", "#capturarCamara", function (e) {
        $(this).addClass("btn-disabled").prop("disabled", true);
        $("#activarCamara").removeClass("btn-disabled").prop("disabled", false);


        const $wrapImagen = document.getElementById("wrap-image");
        const $canva = document.createElement("canvas");
        const $img = document.createElement("img");
        const $fragment = document.createDocumentFragment();
        const $webCam = document.getElementById("webCam");



        $canva.getContext('2d').drawImage($webCam, 12, 0,250,200);
        let imgData = $canva.toDataURL('image/png');

        $img.setAttribute('src',imgData)
        $img.style.padding="1rem"
        $fragment.appendChild($img);
        $wrapImagen.appendChild($fragment);

        $("input[name=img-base64]").val(imgData)
        $("#wrap-image :first-child").remove();


    });
}); /* FIN DEL READY */

mostrarStream = (idDeDispositivo) => {
    const $wrapImagen = document.getElementById("wrap-image");
    const $screamCam = document.createElement("video");
    const $fragment = document.createDocumentFragment();

    navigator.mediaDevices
        .getUserMedia({ audio: false, video: { deviceId: idDeDispositivo } })
        .then((stream) => {
            $("#wrap-image :first-child").remove();

            $screamCam.width = 250;
            $screamCam.id = "webCam";
            $screamCam.style.padding="1rem"
            $screamCam.srcObject = stream;
            $screamCam.play();

            $fragment.appendChild($screamCam);
            $wrapImagen.appendChild($fragment);
        })
        .catch(function (error) {
            console.error(error.name);

            $(
                "#msgCamera"
            ).html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            El dispositivo no tiene privilegios insuficientes o no está configurada correctamente.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`);

            $("#capturarCamara")
                .addClass("btn-disabled")
                .prop("disabled", true);

            $("#activarCamara")
                .removeClass("btn-disabled")
                .prop("disabled", false);
        });
};

obtenerDispositivos = () => navigator.mediaDevices.enumerateDevices();
