<?php
    include_once('../Configuration.inc.php');
    
	$Page->Prefix = '../';
	include($Page->Prefix.'ajfwk/Pages.inc.php');
	include($Page->Prefix.'includes/Users.inc.php');

	include_once($Page->Prefix.'includes/EventoFunctionsEx.inc.php');

	DbConnect();
	EventoWrite('LOUT');
	DbDisconnect();

	UserLogout();

	PageRedirect(PageMain());
?>