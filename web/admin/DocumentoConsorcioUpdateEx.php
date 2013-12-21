<?php
    include_once('../Configuration.inc.php');
    
	if (!$Page->Prefix)
		$Page->Prefix = '../';
        
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('DocumentoConsorcioFormEx.php');
		exit;
	}
    
	$Uuid1 = uniqid();
	$Uuid2 = uniqid();
	$Uuid3 = uniqid();
	$Uuid4 = uniqid();
    
    if ($_FILES['Archivo1']['name'])
    {
        $NombreArchivo1 = $_FILES['Archivo1']['name'];
        $ext = pathinfo($NombreArchivo1, PATHINFO_EXTENSION);
        $filename = $Uuid1 . '.' . $ext;
        copy($_FILES['Archivo1']['tmp_name'], '../files/' . $filename);
    }

    if ($_FILES['Archivo2']['name'])
    {
        $NombreArchivo2 = $_FILES['Archivo2']['name'];
        $ext = pathinfo($NombreArchivo2, PATHINFO_EXTENSION);
        $filename = $Uuid2 . '.' . $ext;
        copy($_FILES['Archivo2']['tmp_name'], '../files/' . $filename);
    }

    if ($_FILES['Archivo3']['name'])
    {
        $NombreArchivo3 = $_FILES['Archivo3']['name'];
        $ext = pathinfo($NombreArchivo3, PATHINFO_EXTENSION);
        $filename = $Uuid3 . '.' . $ext;
        copy($_FILES['Archivo3']['tmp_name'], '../files/' . $filename);
    }

    if ($_FILES['Archivo4']['name'])
    {
        $NombreArchivo4 = $_FILES['Archivo4']['name'];
        $ext = pathinfo($NombreArchivo4, PATHINFO_EXTENSION);
        $filename = $Uuid4 . '.' . $ext;
        copy($_FILES['Archivo4']['tmp_name'], '../files/' . $filename);
    }

    if ($_FILES['Archivo1']['name']) {
		$sql = "Insert";

		$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
			Nombre = '$Nombre1' , 
			Descripcion = '$Descripcion1' , 
			NombreArchivo = '$NombreArchivo1' , 
			IdConsorcio = $IdConsorcio1 , 
			Notas = '$Notas1' 		";
			
		$sql .= ", Uuid = '$Uuid1'";

		DbExecuteUpdate($sql);
	}

    if ($_FILES['Archivo2']['name']) {
		$sql = "Insert";

		$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
			Nombre = '$Nombre2' , 
			Descripcion = '$Descripcion2' , 
			NombreArchivo = '$NombreArchivo2' , 
			IdConsorcio = $IdConsorcio2 , 
			Notas = '$Notas2' 		";
			
		$sql .= ", Uuid = '$Uuid2'";

		DbExecuteUpdate($sql);
	}

    if ($_FILES['Archivo3']['name']) {
		$sql = "Insert";

		$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
			Nombre = '$Nombre3' , 
			Descripcion = '$Descripcion3' , 
			NombreArchivo = '$NombreArchivo3' , 
			IdConsorcio = $IdConsorcio3 , 
			Notas = '$Notas3' 		";
			
		$sql .= ", Uuid = '$Uuid3'";

		DbExecuteUpdate($sql);
	}

    if ($_FILES['Archivo4']['name']) {
		$sql = "Insert";

		$sql .= " $Cfg[SqlPrefix]documentosconsorcio set
			Nombre = '$Nombre4' , 
			Descripcion = '$Descripcion4' , 
			NombreArchivo = '$NombreArchivo4' , 
			IdConsorcio = $IdConsorcio4 , 
			Notas = '$Notas4' 		";
			
		$sql .= ", Uuid = '$Uuid4'";

		DbExecuteUpdate($sql);
	}

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("DocumentoConsorcioLink");
	SessionRemove("DocumentoConsorcioLink");

	PageAbsoluteRedirect($Link);
	exit;
?>