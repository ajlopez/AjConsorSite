<?
	$Page->Title = 'Reservas';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ReservaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');
	include_once($Page->Prefix . 'includes/Users.inc.php');

	SessionPut('ReservaLink',PageCurrent());

	DbConnect();
    
    $rs = UsoMultipleGetListByUser(UserId());

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="actions">
<a href="ReservaForm.php">Nueva Reserva...</a>
</div>

<?		
	while ($reg=DbNextRow($rs)) {
?>
<h3><?= $reg['Nombre'] ?></h3>
<?        
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
