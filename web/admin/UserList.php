<?
	$Page->Title = 'Usuarios';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');

	SessionPut('UserLink',PageCurrent());

	DbConnect();

	$rs = UserGetListView();

	$titles = array('Id', 'Código', 'Nombre', 'Apellido', 'Correo Electrónico', 'Verificado');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<center>

<p>
<a href="UserForm.php">Nuevo Usuario...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],"UserView.php?Id=".$reg['Id']);
		DatumGenerate($reg['UserName']);
		DatumGenerate($reg['FirstName']);
		DatumGenerate($reg['LastName']);
		DatumGenerate($reg['Email']);
		DatumGenerate($reg['Verified']);
		RowClose();
	}

	TableClose();
?>

</center>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
