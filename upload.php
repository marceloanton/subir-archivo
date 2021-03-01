<?php
session_start();

$message = ''; 
if (isset($_POST['subirBtn']) && $_POST['subirBtn'] == 'Subir')
{
  if (isset($_FILES['SubirArchivo']) && $_FILES['subirArchivos']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file
    $fileTmpPath = $_FILES['subiendoArchivo']['nombreTemporral'];
    $fileName = $_FILES['subiendoArchivo']['nombre'];
    $fileSize = $_FILES['subiendoArchivo']['tamanio'];
    $fileType = $_FILES['subiendoArchivo']['tipo'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './archivos_subidos/';
      $dest_path = $uploadFileDir . $newFileName;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='Los archivos se subieron correctamente.';
      }
      else 
      {
        $message = 'Error al subir los archivos, asegurate de que la carpeta no tiene protección contra escritura.';
      }
    }
    else
    {
      $message = 'El archivo que intentas subir no es de la extensión especificada: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = 'Revisa este error, algo salió mal!.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
$_SESSION['mensaje'] = $message;
header("Location: index.php");