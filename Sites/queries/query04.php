<?php
// get db variable
require("../config/connection.php");

$nombre_ciudad = $_REQUEST["nombre_ciudad"];
$nombre_barco = $_REQUEST["nombre_barco"];

$query_string = "SELECT permisos.permiso_id, atraca_en.instalacion_id, instalaciones.tipo, permisos.fecha_atraque FROM permisos
INNER JOIN atraca_en
ON atraca_en.permiso_id = permisos.permiso_id
INNER JOIN barcos
ON barcos.patente = atraca_en.patente
INNER JOIN instalaciones
ON instalaciones.instalacion_id = atraca_en.instalacion_id
INNER JOIN puerto_instalacion
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puertos.puerto_id = puerto_instalacion.puerto_id
INNER JOIN ciudad_puerto
ON puertos.puerto_id = ciudad_puerto.puerto_id
INNER JOIN ciudades
ON ciudad_puerto.ciudad_id = ciudades.ciudad_id
WHERE barcos.nombre ILIKE '%{$nombre_barco}%' AND ciudades.nombre ILIKE '%{$nombre_ciudad}%';";

$pdo_statement = $db->prepare($query_string);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

// HEADERS
echo '<div class="mdc-data-table">
<div class="mdc-data-table__table-container">
<table class="mdc-data-table__table" aria-label="Query Output">
<thead>
<tr class="mdc-data-table__header-row">';
$headers = ["ID permiso", "ID instalación", "tipo", "Fecha de atraque"];
foreach($headers as $header) {
  echo '<th class="mdc-data-table__header-cell" role="columnheader" scope="col">';
  echo $header;
  echo '</th>';
}
echo '</tr>
</thead>';

// ROWS
echo '<tbody class="mdc-data-table__content">';
// FIRST COL

foreach($result as $row) {  
  echo '<tr class="mdc-data-table__row">';

  echo '<th class="mdc-data-table__cell" scope="row">';
  echo $row[0];
  echo '</th>';
  echo '<td class="mdc-data-table__cell">';
  echo $row[1];
  echo '</td>';
  echo '<td class="mdc-data-table__cell">';
  echo $row[2];
  echo '</td>';
  echo '<td class="mdc-data-table__cell">';
  echo $row[3];
  echo '</td>';

  echo '</tr>';
}
echo '</tbody>
</table>
</div>
</div>';
?>