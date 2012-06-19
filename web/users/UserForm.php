<?
	$Page->Title = 'Actualiza Mis Datos';
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

	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

	DbConnect();
    
    $Id = UserId();
	
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

	include_once($Page->Prefix.'includes/Header.inc.php');
?>


<?
	ErrorRender();
?>

<form action="UserUpdate.php" method=post>

<?
	TableOpen();

	FieldStaticGenerate("Código",$UserName);
	FieldTextGenerate("FirstName", "Nombre", $FirstName, 30, True);
	FieldTextGenerate("LastName", "Apellido", $LastName, 30, True);
	FieldTextGenerate("Email", "Correo Electrónico", $Email, 30, False);

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
