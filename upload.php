<?php
//echo 'uno';
//var_dump($_FILES);
//echo 'dos';
$arr1 = reset($_FILES);
//echo $arr1['name'];
//echo 'tres';
//echo gettype(reset($_FILES));
//echo 'cuatro';
$correo = key((array)$_FILES);
echo $correo;

$path = $arr1['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);


$target_dir = "files/";

$fileName = $arr1['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$target_file = $target_dir . $correo . '.'. $ext;
$target_name = $correo . '.'. $ext;

$fileType = $arr1['type'];
$fileError = $arr1['error'];
$fileContent = file_get_contents($arr1['tmp_name']);

if($fileError == UPLOAD_ERR_OK){
   if (move_uploaded_file($arr1['tmp_name'], $target_file)) {
        echo "The file ". basename( $arr1["name"]). " has been uploaded.";
                print_r($_FILES);
              echo $mail;
        echo 'this works';
    } else {
      echo "Not uploaded because of error #".$arr1["error"];
        echo "Sorry, there was an error uploading your file.";
    }
}else{
   switch($fileError){
     case UPLOAD_ERR_INI_SIZE:   
          $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
          break;
     case UPLOAD_ERR_FORM_SIZE:  
          $message = 'Error al intentar subir un archivo que excede el tamaño permitido.';
          break;
     case UPLOAD_ERR_PARTIAL:    
          $message = 'Error: no terminó la acción de subir el archivo.';
          break;
     case UPLOAD_ERR_NO_FILE:    
          $message = 'Error: ningún archivo fue subido.';
          break;
     case UPLOAD_ERR_NO_TMP_DIR: 
          $message = 'Error: servidor no configurado para carga de archivos.';
          break;
     case UPLOAD_ERR_CANT_WRITE: 
          $message= 'Error: posible falla al grabar el archivo.';
          break;
     case  UPLOAD_ERR_EXTENSION: 
          $message = 'Error: carga de archivo no completada.';
          break;
     default: $message = 'Error: carga de archivo no completada.';
              break;
    }
      echo json_encode(array(
               'error' => true,
               'message' => $message
            ));
}
?>