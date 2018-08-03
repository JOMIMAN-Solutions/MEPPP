<?php 
	//bloquear el acceso por la url si no existe una sesion
	//require_once '../clases/Bloqueo.php';

	//require_once '../clases/Reporte.php';

	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body{
				text-align: center;
			}
			#encabezado{
				height: 5%;
				color: #dcdcdc;
			}
			#encabezado img{
				float: left;
				width: 50px;
				height: 50px;
			}
			#encabezado p{
				float: right;
			}
			table, th, td{
				border: 2px solid;
				border-collapse: collapse;
				text-align: center;
			}

			table{
				width: 500px;
				margin-left: 120px;
			}

			th{
				background-color: #d3d4d2;
			}
		</style>
	</head>
	<body>
		<div id="encabezado">
			<img src="images/usuarios/jona.png'">
			<p><?php //echo $_SESSION['nombre']; ?></p>
		</div>
		
		<div id="cuerpo">
			<h1>Reporte de <?php //echo $nombreMes.' del '.$año.'. '.$nombre; ?></h1>	
			<table>
				<tr>
					<th colspan="2">SEXO</th>
				</tr>

				<?php //foreach($hombres as $item):?>
				<tr>
					<td>Hombres</td>
					<td><?php //echo $item['hombres']; ?></td>
				</tr>
				<?php 
				//$total= $total + $item['hombres'];
				//endforeach; 
				?>

				<?php //foreach($mujeres as $item):?>
				<tr>
					<td>Mujeres</td>
					<td><?php //echo $item['mujeres']; ?></td>
				</tr>
				<?php 
				//$total= $total + $item['mujeres'];
				//endforeach; 
				?>

				<tr>
					<td>Total</td>
					<td><?php //echo $total; ?></td>
				</tr>
			</table>
				
			<br>
				
			<table>
				<tr>
					<th colspan="2">EDADES</th>
				</tr>

				<?php //foreach($edades as $item):?>
				<tr>
					<td><?php //echo $item['edad']; ?></td>
					<td><?php //echo $item['total']; ?></td>
				</tr>
				<?php //endforeach; ?>
			</table>

			<br>		

			<table>
				<tr>
					<th colspan="2">LUGAR DE PROCEDENCIA</th>
				</tr>

				<?php //foreach($lugares as $item):?>
				<tr>
					<td><?php //echo $item['lugar']; ?></td>
					<td><?php //echo $item['total']; ?></td>
				</tr>
				<?php //endforeach; ?>
			</table>
		</div>

	</body>
</html>

<?php
	// include autoloader
//http://localhost/MEPPP/Aplicacion/Arbol/pdf
	require_once "../../template/backend/assets/plugins/dompdf/autoload.inc.php";

	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	//$dompdf->loadHtml(file_get_contents('reporte.php'));
	$dompdf->load_html(ob_get_clean());

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('letter');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$nombrePDF= 'Reporte';
	$dompdf->stream($nombrePDF);
?>