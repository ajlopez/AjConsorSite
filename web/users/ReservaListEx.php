<?
	$Page->Title = 'Mis Reservas';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Dates.inc.php');
	include_once($Page->Prefix . 'ajfwk/Forms.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ReservaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UsoMultipleFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/ReservaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/Users.inc.php');

	SessionPut('ReservaLink',PageCurrent());
	
	if (!$FechaDesde)
		$FechaDesde = DateToMonday(DateToday());
	else
		$FechaDesde = DateToMonday($FechaDesde);
	if (!$FechaHasta)
		$FechaHasta = DateAddDays($FechaDesde, 6);
        		
	$SemanaAnterior = DateAddDays($FechaDesde, -7);
	$SemanaSiguiente = DateAddDays($FechaDesde, 7);
	$MesAnterior = DateAddMonths($FechaDesde, -1);
	$MesSiguiente = DateAddMonths($FechaDesde, 1);

	DbConnect();
    
	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<style>
.hours th {
	width: 100px;
}

.hours td{
	width: 100px;
	height: 20px;
	cursor: pointer;
}

.reservapropia {
	position: relative;
	top: 0px;
	left: 0px;
	border: 1px;
	border-style: solid;
	border-color: darkgreen;
	background-color: #a0FFa0;
	z-index: 1;
	width: 100px;
	height: 20px;
	overflow: ellipsis;
}

.reserva {
	position: relative;
	top: 0px;
	left: 0px;
	border: 1px;
	border-style: solid;
	border-color: darkred;
	background-color: #ffa0a0;
	z-index: 1;
	width: 100px;
	height: 20px;
	overflow: ellipsis;
	cursor: default;
}
</style>

<?
	if (UserHasManyMultiple()) {
?>
<h3>Reservas de:</h3>
<div>
<?
		$nsum=0;
		$rs = UsoMultipleGetListByUser(UserId());
		while ($reg=DbNextRow($rs)) {
			$nsum++;
?>
<a href="#num<?= $nsum ?>"><?= $reg['Nombre'] ?></a>
<br/>
<?		
		}
?>
</div>
<?		
	}
	
	function comparareservas($res1, $res2)
	{
		if ($res1['DesdeHora'] < $res2['DesdeHora'])
			return -1;
		if ($res1['DesdeHora'] > $res2['DesdeHora'])
			return 1;
		if ($res1['DesdeFecha'] < $res2['DesdeFecha'])
			return -1;
		if ($res1['DesdeFecha'] > $res2['DesdeFecha'])
			return 1;
		return 0;
	}

    $nsum = 0;
    $rs = UsoMultipleGetListByUser(UserId());
	
	while ($reg=DbNextRow($rs)) {
		$nsum++;
		$iduso = $reg['Id'];
		$rsReservas = ReservaGetList("IdUsoMultiple = $iduso and (DesdeFecha >= '$FechaDesde' or HastaFecha >= '$FechaDesde') and (DesdeFecha <= '$FechaHasta' or HastaFecha <= '$FechaHasta')", "DesdeHora, DesdeFecha");
		unset($reservas);		
		$reserva = DbNextRow($rsReservas);
		
		while ($reserva) {
			if ($reserva['DesdeFecha'] != $reserva['HastaFecha'])
			{
				$reserva1 = $reserva;
				$reserva1['HastaHora'] = '24:00';
				$reserva1['HastaFecha'] = $reserva1['DesdeFecha'];
				$reservas[] = $reserva1;
				$reserva2 = $reserva;
				$reserva2['DesdeHora'] = '00:00';
				$reserva2['DesdeFecha'] = $reserva2['HastaFecha'];
				$reservas[] = $reserva2;
			}
			else 
				$reservas[] = $reserva;
				
			$reserva = DbNextRow($rsReservas);
		}
		
		if ($reservas)
			usort($reservas, "comparareservas");
		
		unset($reserva);
		DbFreeResult($rsReservas);
?>


<br />

<a name='num<?= $nsum ?>'>

<div class="actions">
<a href="ReservaListEx.php?FechaDesde=<?= $MesAnterior ?>#num<?= $nsum ?>">Mes Anterior</a>&nbsp;&nbsp;
<a href="ReservaListEx.php?FechaDesde=<?= $SemanaAnterior ?>#num<?= $nsum ?>">Semana Anterior</a>&nbsp;&nbsp;
<a href="ReservaListEx.php?FechaDesde=<?= $SemanaSiguiente ?>#num<?= $nsum ?>">Semana Siguiente</a>&nbsp;&nbsp;
<a href="ReservaListEx.php?FechaDesde=<?= $MesSiguiente ?>#num<?= $nsum ?>">Mes Siguiente</a>&nbsp;&nbsp;
<a href="ReservaListEx.php#num<?= $nsum ?>">Hoy</a>&nbsp;&nbsp;
<a href="ReservaListEx.php?FechaDesde=<?= $FechaDesde ?>">Tope de Página</a>
</div>

<h3><?= $reg['Nombre'] ?></h3>
<table class="table-striped table-bordered hours">
<tr>
<th></th>
<?
	$nreserva = 0;
	
	if ($nreserva < count($reservas))
		$reserva = $reservas[$nreserva++];

	for ($k = 0; $k < 7; $k++) {
		$fecha = DateAddDays($FechaDesde, $k);
?>
<th>
<?= $fecha ?>
<br/>
<?= DateToWeekDaySpanishName($fecha) ?>
</th>
<?		
	}
?>
<?
	foreach ($Hours as $nh => $hour)
	{
		echo "<tr>\n";
		if ($hour == "24:00")
			continue;
		if (substr($hour, -2) == "00")
			echo "<td rowspan=2 style='padding: 0px; height: 24px'>$hour</td>";
			
		for ($k = 0; $k < 7; $k++) {
			$fecha = DateAddDays($FechaDesde, $k);
			if ($reserva && $reserva['DesdeFecha'] == $fecha && $reserva['DesdeHora'] == $hour)
			{
				$desdehora = $reserva['DesdeHora'];
				$hastahora = $reserva['HastaHora'];
				
				$nhours = (substr($hastahora, 0, 2) - substr($desdehora, 0, 2)) * 2;
				if (substr($hastahora, -2) != substr($desdehora, -2))
					if (substr($hastahora, -2) == "00")
						$nhours--;
					else
						$nhours++;
				if ($nh + $nhours > count($Hours))
					$nhours -= count($Hours) - $nh;
				$divheight = $nhours * 20;
				if ($nhours > 1)
					$divheight += ($nhours - 1) * 2;
				if ($reserva['IdUser'] == UserId())
					$klass = 'reservapropia';
				else
					$klass = 'reserva';
				$fullname = UserTranslateFullName($reserva['IdUser']);
				$idreserva = $reserva['Id'];
				if ($klass == 'reserva')
					echo "<td rowspan=$nhours><div class='$klass' style='height:${divheight}px'>$fullname</div></td>";
				else
					echo "<td rowspan=$nhours onclick='viewreserva($idreserva)'><div class='$klass' style='height:${divheight}px'>$fullname</div></td>";

				if ($nreserva < count($reservas))
					$reserva = $reservas[$nreserva++];
				else
					unset($reserva);					
					
				$skips[$k] = $nhours-1;
			}
			else if ($skips[$k])
				$skips[$k]--;
			else {
				$hour2 = $Hours[$nh+1];
				echo "<td onclick='doreserva(\"$fecha\",\"$hour\",\"$fecha\",\"$hour2\",$iduso)'></td>";
			}
		}
		echo "</tr>\n";
	}
?>
</table>
<?        
	}
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
<script language="javascript">
function doreserva(desdefecha, desdehora, hastafecha, hastahora, idum)
{
	window.location = 'ReservaForm.php?DesdeFecha=' + desdefecha + "&DesdeHora=" + desdehora + "&HastaFecha=" + hastafecha + "&HastaHora=" + hastahora + "&IdUsoMultiple=" + idum;
}

function viewreserva(idreserva)
{
	window.location = 'ReservaView.php?Id=' + idreserva;
}

</script>