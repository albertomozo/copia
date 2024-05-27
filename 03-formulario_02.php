<?PHP 
function validarVar($valor)
{
    //$valor =  filter_var($valor, FILTER_SANITIZE_STRING);
    //$valor = addslashes($valor);
    $valor = addslashes(htmlspecialchars($valor));
    return $valor;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario 01</title>
</head>
<body>
    <?PHP
    
    $nombre = $localidad = $anio = $sexo = '';
    $nombreError = $localidadError = $anioError = $conoError = '';
    $conocimientos = []; // comocimiemntos es un array por como esta definido en el formulario name="conocimientos[]"
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        echo '<p>Vienes del formulario</p>';
        print_r ($_POST);
        echo '<hr>';
     
        /* recorremos los campos del formulario */
        foreach ($_POST as $key => $valor){
            if (is_array($valor)){
                echo "eres un array <br>"; 
                foreach ($valor as $key1 => $valor1){
                    echo "  key : $key1 valor : $valor1 | ";
                }
                echo "fin array <br>"; 
            } else {
                echo $_POST[$key]  . "  key : $key valor : $valor <br>";
            }        
        }
        /* recorrer los coniocimiento */
        echo '<hr>';
        
        if (isset( $_POST['conocimientos'])){
            $conocimientos = $_POST['conocimientos'];
        } else {
            $conocimientos = [];
        }
        foreach ($conocimientos as $conocimiento){
            echo $conocimiento .'<br>';
        }


        /* recoger uno a uno */
        echo '<hr>';
        $nombre = $_POST['nombre'];
        $anio = $_POST['ano'];
        $localidad = $_POST['localidad'];
        $sexo = $_POST['sexo'];


        /* validacion */
        echo "nombre = $nombre <br>";
        echo 'vali nombre ' . validarVar($nombre) . '<br>';

        if (empty($nombre)){
            echo '<p>No ha introducido nombre</p>';
            $nombreError = "No ha introducido nombre";
        } else {
            if (strlen($nombre)<4)
            {
                echo '<p>El nombre es muy corto, menos de 4 caracteres</p>';
                $nombreError = 'El nombre es muy corto, menos de 4 caracteres';
            }
        }

    }
    ?>
    <hr><hr>
        <form name="form1" action="" method="POST">
            Nombre <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>"/> *  <?php echo $nombreError; ?>    <br>
            
            Año Nacimiento <input type="text" name="ano" id="ano" value="<?php echo $anio; ?>"/><?php echo $anioError; ?><br>
            Localidad <input type="text" name="localidad" id="localidad" value="<?php echo $localidad; ?>"/><?php echo $localidadError; ?><br>
            <!-- check de conocimientos-->
            Conocimientos:
            <input type="checkbox" name="conocimientos[]" value="HTML" <?php if (in_array('HTML',$conocimientos)) {echo 'checked';}?>>HTML
            <input type="checkbox" name="conocimientos[]" value="CSS" <?php if (in_array('CSS',$conocimientos)) {echo 'checked';}?>>CSS
            <input type="checkbox" name="conocimientos[]" value="JavaScript" <?php if (in_array('JavaScript',$conocimientos)) {echo 'checked';}?>>JavaScript
            <input type="checkbox" name="conocimientos[]" value="PHP" <?php if (in_array('PHP',$conocimientos)) {echo 'checked';}?>>PHP
            <span class="error">* <br><?php echo $conoError;?></span>
            <br>
            <!-- fin check conocimientos--> 
            sexo :  Mujer <input type="radio" name="sexo" value="M" <?php if ($sexo=='M') {echo 'checked';}?> >  Hombre <input type="radio" name="sexo" value="H"  <?php if ($sexo=='H') {echo 'checked';}?> > Otro <input type="radio" name="sexo" value="O"   <?php if ($sexo=='O') {echo 'checked';}?> >
            <br>
            Observaciones: <textarea name="comment" rows="5" cols="40"></textarea>
            <input type="submit" name="submit" value="enviar">
        </form>
    <?PHP 
    ?>
    
</body>
</html>