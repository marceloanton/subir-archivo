<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Subir archivo con PHP</title>
</head>
<body>
  <?php
    if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'])
    {
      printf('<b>%s</b>', $_SESSION['mensaje']);
      unset($_SESSION['mensaje']);
    }
  ?>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="subirArchivo" />
    </div>

    <input type="submit" name="subirBtn" value="Subir" />
  </form>
</body>
</html>