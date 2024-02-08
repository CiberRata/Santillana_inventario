<?php

/* Se crea código para insertar */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap CSS-->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> Anterior-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <!--  Datatables Responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <title>Nuevo servidor</title>



    
</head>
<body>

    <?php

    include 'configuracion\conexion.php';


    ?>

    <section class="Centrar-tabla">

   
    
        <div class="container">
            <div class="row">
            <form method="post" id="nuevo_cliente_es">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
        
        
                <div class="marginar">
                    <div class="panel-heading">
                    <h1 class="text-center">SERVIDORES DE SANTILLANA Y NORMA 1.0</h1>
                    </div>
                    <div class="panel-body">
                    <div class="row">
                    
                        <!--<div class="col-md-3 col-lg-3 " align="center"> 
                        <div id="load_img">
                            <img class="img-responsive" src=" <*?php echo $row['logo_url'];?>" alt="Logo">
                            
                        </div>
                        <br>				
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class='filestyle' data-buttonText="Logo" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
                                    </div>
                                </div>
                                
                            </div>
                        </div>-->
                        <div class=" col-md-1 col-lg-8 "> 
                        <table class="table table-condensed">
                            <thead>                            
                            <tr>
                                <td class='col-md-1'>IP</td>
                                <td><input type="text" class="form-control input-sm" onkeypress="return validaP(event)"  maxlength="11" name="ip_1" required></td>
                                <td>Discos del servidor</td>
                                <td><input type="text" class="form-control input-sm" onkeypress="return validaP(event)" name="discos_1" required></td>
                                <td>Memoría ram</td>
                                <td><input type="text" class="form-control input-sm" onkeypress="return validaP(event)" name="memoria_1" required></td>
                            </tr>			
                            
                            <tr>
                                <td>Email:</td>
                                <td><input type="email" class="form-control input-sm" name="correo_es" required></td>
                            </tr>
                            <tr>
                                <td>Contacto:</td>
                                <td><input type="text" class="form-control input-sm" name="contacto_es"required></td>
                            </tr>
                            <!--Ya lo demas agregas cualquier text-->
                            </thead>
                        </table>
                        
                        
                        </div>
                        <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
                    </div>
                    </div>
                        <div class="panel-footer text-center">
                            
                            
                                    <button type="submit" class="btn-success"><i class="glyphicon glyphicon-refresh"></i> Ingresar Datos</button>
                            
                            
                        </div>
                    
                </div>
                </div>
                </form>
            </div>
            </div>
    </section>
</body>
</html>


<script>

function validaTC(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9,-,/]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>


<script>

function validaP(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9,.]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<script>
    
function validaN(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

</script>


