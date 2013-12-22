<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Actualiza Contraseña';
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

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<?php
	ErrorRender();
?>

<form action="UserPasswordUpdate.php" method=post>

<?php
	TableOpen();

	FieldPasswordGenerate("Password", "Contraseña Actual", '', 10, True);
	FieldPasswordGenerate("NewPassword", "Nueva Contraseña", '', 10, True);
	FieldPasswordGenerate("NewPassword2", "Reingrese Nueva Contraseña", '', 10, True);

	FieldOkGenerate();
	TableClose();

	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
