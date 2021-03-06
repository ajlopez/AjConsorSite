<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Actualiza Usuario';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UserGetById($Id);
		$UserName = $rs['UserName'];
		$FirstName = $rs['FirstName'];
		$LastName = $rs['LastName'];
		$Email = $rs['Email'];
		$Genre = $rs['Genre'];
		$IsAdministrator = $rs['IsAdministrator'];
		$NoReserva = $rs['NoReserva']; 
		$Verified = $rs['Verified'];
		$Notas = $rs['Notas'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Usuario";
		$IsNew = 1;
	}

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="UserList.php">Usuarios</a>
&nbsp;
&nbsp;
<?php
	if (!$IsNew) {
?>
<a href="UserView.php?Id=<?php echo $Id; ?>">Usuario</a>
&nbsp;
&nbsp;
<?php
	}
?>
</div>


<?php
	ErrorRender();
?>

<form action="UserUpdate.php" method=post>

<?php
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("UserName", "C�digo", $UserName, 30, True);
	
	if ($IsNew) {
		FieldPasswordGenerate("Password", "Contrase�a", '', 10, True);
		FieldPasswordGenerate("Password2", "Reingrese Contrase�a", '', 10, True);
	}

	FieldTextGenerate("FirstName", "Nombre", $FirstName, 30, True);
	FieldTextGenerate("LastName", "Apellido", $LastName, 30, True);	
	FieldTextGenerate("Email", "Correo Electr�nico", $Email, 30, False);
	FieldTextGenerate("Genre", "G�nero", $Genre, 30, False);
	FieldCheckGenerate("IsAdministrator", "Es Administrador", $IsAdministrator, False);
	FieldCheckGenerate("Verified", "Verificado", $Verified, False);
	FieldCheckGenerate("NoReserva", "No Puede Reservar SUM", $NoReserva, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
	TableClose();

	if (!$IsNew)
		FieldIdGenerate($Id);
    if ($IdUnidad)
        FieldHiddenGenerate('IdUnidad', $IdUnidad);
    if ($IdConsorcio)
        FieldHiddenGenerate('IdConsorcio', $IdConsorcio);
    if ($Back)
        FieldHiddenGenerate('Back', $Back);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
