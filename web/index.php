<?php
    $Page = new StdClass();
	$Page->Title = '';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'includes/Configuration.inc.php');
	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="container">
<!-- Masthead
================================================== -->
<!--
  <header class="jumbotron masthead">
  <div class="inner">
    <h1>Bienvenidos a <?= $Cfg['SiteName'] ?></h1>
	  <p><? echo $Cfg['SiteDescription'] ?></p>
  </div>

</header>

<hr class="soften">
-->
  
<div class="marketing">
  <h1>Nuestros servicios</h1>
  <div class="row">
    <div class="span4">
      <h2>Liquidaciones</h2>
      <p>Liquidaci�n y prorrateo mensual de los gastos previsiones y fondos para hacer frente a las erogaciones mensuales con el acuerdo del Consejo de Administraci�n seg�n el presupuesto aprobado en Asamblea Ordinaria.</p>
    </div>
    <div class="span4">
      <h2>Recaudaci�n de cuotas</h2>
      <p>Recaudaci�n de las cuotas de expensas comunes. Mediante cuenta corriente bancaria del Consorcio donde se depositar�n las cuotas recaudadas.  Ante la falta de pago de las expensas por parte de alg�n copropietario, se env�a  al tercer mes una carta documento (que se cobra al propietario), y si no abona,  se deriva al abogado que designe la asamblea para que inicie la ejecuci�n judicial.</p>
    </div>
    <div class="span4">
      <h2>Pagos</h2>
      <p>Pago de los servicios y proveedores: los pagos se realizar�n mediante la confecci�n de cheque de la cuenta corriente bancaria firmados por el administrador. Los servicios, gastos y abonos regulares, los emitir� directamente la administraci�n, mientras que las erogaciones producidas por reparaciones u obras deber�n contar con la aprobaci�n del  Consejo de Administraci�n.</p>
    </div>
  </div><!--/row-->
  <div class="row">
    <div class="span4">
      <h2>Gestiones</h2>
      <p>Gestiones ante terceros: como representante del Consorcio deber� atender los requerimientos de las autoridades p�blicas y las relaciones con los vecinos. En todos los casos se informa de inmediato al Consejo de Administraci�n.</p>
    </div>
    <div class="span4">
      <h2>Relaciones Internas</h2>
      <p>Se atienden las quejas presentadas por los copropietarios, tanto por desperfectos en las instalaciones como por desavenencias con el encargado o otros copropietarios o terceros. Se verifica en forma inmediata la queja presentada para darle el curso de soluci�n m�s conveniente.</p>
    </div>
    <div class="span4">
      <h2>Presupuestos</h2>
      <p>Confecci�n de un presupuesto de gastos para el ejercicio venidero y el balance anual por el ejercicio cerrado, que se tratar� en la asamblea general ordinaria.</p>
    </div>
  </div><!--/row-->
  
</div>

<?php
	include_once('includes/Footer.inc.php');
?>

