<?
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
<?
	if (!$IsNew) {
?>
<a href="UserView.php?Id=<? echo $Id; ?>">Usuario</a>
&nbsp;
&nbsp;
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="UserUpdate.php" method=post>

<?
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("UserName", "Código", $UserName, 30, True);
	
	if ($IsNew) {
		FieldPasswordGenerate("Password", "Contraseña", '', 10, True);
		FieldPasswordGenerate("Password2", "Reingrese Contraseña", '', 10, True);
	}

	FieldTextGenerate("FirstName", "Nombre", $FirstName, 30, True);
	FieldTextGenerate("LastName", "Apellido", $LastName, 30, True);	
	FieldTextGenerate("Email", "Correo Electrónico", $Email, 30, False);
	FieldTextGenerate("Genre", "Género", $Genre, 30, False);
	FieldCheckGenerate("IsAdministrator", "Es Administrador", $IsAdministrator, False);
	FieldCheckGenerate("Verified", "Verificado", $Verified, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
	TableClose();

	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
