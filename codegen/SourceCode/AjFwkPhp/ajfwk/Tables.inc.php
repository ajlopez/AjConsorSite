<?

function TableOpen($titles='',$width='',$class='') {
	if ($width)
		echo "<table class='table-striped table-bordered $class' width='$width'>\n";
	else
		echo "<table class='table-striped table-bordered $class'>\n";	

	if (is_array($titles)) {
		echo "<tr>\n";

		reset($titles);

		while (list($k,$v) = each($titles))
			if ($v)
				echo "<th>$v</th>";
			else
				echo "<th>&nbsp;</th>";

		echo "</tr>\n";
	}
}

function TableClose() {
	  echo "</table>\n";
}

/*function RowOpen() {
	  echo "<tr>\n";
}*/

function RowOpen() {
	  echo "<tr>\n";
}


function RowLinkOpen($link, $mensaje, $clase1, $clase2) {
echo '<tr onclick="'. "mClk(this,'$link');" . '"';
echo ' onmouseout="' . "mOut(this,'$clase1');"; 
echo " window.status=' '; return true;" . '"';  
echo ' onmouseover="'. "mOvr(this,'$clase2');";  
echo " window.status='$mensaje'; return true;"  . '"';
echo ' class="'.$clase1.'"> '; 
echo "\n";
}

function RowClose() {
	  echo "</tr>\n";
}

function DatumGenerate($datum,$align='left',$colspan=1) {
    echo "<td colspan=$colspan valign='top' align=$align>$datum&nbsp;</td>\n";
}

function DatumNumGenerate($datum) {
    echo "<td align='right'>$datum&nbsp;</td>\n";
}

function DatumCurrencyGenerate($datum) {
    echo "<td  align='right'>" . number_format($datum+0,2) . "&nbsp;</td>\n";
}

function DatumLinkGenerate($datum,$link,$align='left',$target='') {
	if (!$datum)
		$datum='&nbsp;';
	echo "<td align='$align' valign='top'><a href='$link'";
	if ($target)
		echo " target='$target'";
	echo ">$datum</a>&nbsp;</td>\n";
}

?>