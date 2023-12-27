<?php

require_once 'vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=abogados-402022-bb074910159c.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes(['https://www.googleapis.com/auth/drive.file']);

try {
    $service = new Google_Service_Drive($client);
    $file_path = $_FILES['archivos_pdf']['tmp_name'];

    $file = new Google_Service_Drive_DriveFile();
    $file->setName($_FILES['archivos_pdf']['name']);


    $finfo=finfo_open(FILEINFO_MIME_TYPE);
    $mime_type=finfo_file($finfo,$file_path);

    $file->setParents(array("1m3T7v9JMBAsL8TMO7daJ8Kj4pJlwQeoB"));
    $file->setDescription("Archivo cargado desde PHP");
    $file->setMimeType($mime_type);

    $resultado = $service->files->create(
        $file,
        array(
            'data' => file_get_contents($file_path),
            'mimeType' => $mime_type,
            'uploadType' => "media"
        )
    );

    echo '<a href="https://drive.google.com/open?id=' . $resultado->id . '" target="_blank">' . $resultado->name . '</a>';
} catch (Google_Services_Exception $gs) {
    $mensaje = json_decode($gs->getMessage());
    echo $mensaje->error->message();
} catch (Exception $e) {
    echo $e->getMessage();
}
