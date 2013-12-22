<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Registración';
	$Page->Prefix = '../';
	$FileJs = 'utilities.js';

	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div>
Gracias por registrarse. 
</div>
<div>
<?= $Cfg['UserRegistrationMessage'] ?>
</div>

<?php
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>

