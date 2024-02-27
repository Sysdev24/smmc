<html>
<head>
  <style>
    body{
        font-family: sans-serif;
        text-align: justify;
        line-height: 1.5em;
        font-size: 0.875em;

    }
    @page {
      margin: 180px 40px;
    }
    .div-imagen-fondo {
    background-image: url();
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      background-size: 50rem;
      background-attachment: fixed;
      opacity: 0.5;
    }
    header { position: fixed;
      background-image: url(img/logo_banne_pdf_corpoelec.png);
      background-repeat: no-repeat;
      background-position: center center;
      background-size: 20cm 110%;
      background-attachment: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 80px;
      text-align: center;

    }
    header h3{
      margin: 10px 0;
      font-family: sans-serif;
    }
    div.letra_final{
      margin: 10px 0;
      font-family: sans-serif;
      font-size: 10px;
    }
    header h4{
      font-family: sans-serif;
      margin: 10px 0;
    }
    footer {
      background-image: url(img/cintillo_reporte.png);
      background-repeat: no-repeat;
      background-position: left;
      background-size: 18cm 150%;
      background-attachment: fixed;
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;

    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    footer .izq {
      text-align: left;
    }

    .div-letras-izq{
      text-align: left;
    }
    .div-letras-derecha{
      text-align: right;
    }
    .container .box {
               display : flex;
              flex-direction : row;
               
            }
      
            
            .container .box .box-cell.box1 {
                background:green;
                color:white;
                text-align:justify;
             }
            .container .box .box-cell.box2 {
                background:lightgreen;
                text-align:justify
            }

  </style>

<body>
    <header></header>
    <div class="div-imagen-fondo">
<table   style="width: 100%">
    <tr>
        <td colspan="3"> <center><b><h4>ACTA DE ENTREGA</h4></b></center></td>
    </tr>
  </div>
</table>

<p> En el día de hoy 07 de junio de 2023 el ciudadano <strong><b>ING. {{-- view_firmante.nombre_apellido --}}</b></strong>, 
titular de la Cédula de Identidad Nº <strong><b>{{-- view_firmante.ci --}}</b></strong>, <strong><b>{{-- view_firmante.descripcion --}}</b></strong>. 
Designado mediante el N° <b>{{-- firmante.rosolucion --}}</b> de fecha <b>{{-- firmante.fecha_resolucion --}}</b>, 
Corporación Eléctrica Nacional, S.A. (CORPOELEC), procedió a levantar acta con el objeto 
de dejar constancia de la entrega del siguiente equipo:
</p>
    <p>
       <b>{{-- firmante.rosolucion --}}</b>
    </p>
<div class="container">
    <br>
    <p> Entrega Conforme:, </p>
    <br><br>
    <strong> ING. {{-- view_firmante.nombre --}} </strong>
    <strong> {{-- view_firmante.descripcion --}} </strong>
	<strong> {{-- .resolucion --}} </strong>
    <strong> {{-- firmante.fecha --}} </strong>

    <p>
      Recibe Conforme:{{-- personal.nombre --}}
      <br> NOMBRE:
      <br> C.I.:
      <br> CARGO:
      <br> FIRMA:
    </p>
</div>
<footer>
    <table>
      <tr>
        <td>
            
        </td>
      </tr>
    </table>

  </footer>



</body>
</html>

