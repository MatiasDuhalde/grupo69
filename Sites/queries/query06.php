<?php
// get db variable
require("../config/connection.php");

$nombre_ciudad = $_REQUEST["nombre_ciudad"];
$nombre_barco = $_REQUEST["nombre_barco"];

$query_string = "SELECT t.nombre, barcos_atracados
FROM (SELECT puertos.nombre, COUNT(DISTINCT atraca_en.patente) AS barcos_atracados FROM puertos
      INNER JOIN puerto_instalacion
      ON puertos.puerto_id = puerto_instalacion.puerto_id
      INNER JOIN atraca_en
      ON puerto_instalacion.instalacion_id = atraca_en.instalacion_id
      INNER JOIN permisos
      ON atraca_en.permiso_id = permisos.permiso_id
      WHERE DATE_PART('month', permisos.fecha_atraque) = 8 AND
      DATE_PART('year', permisos.fecha_atraque) = 2020
      GROUP BY puertos.nombre) AS t
ORDER BY barcos_atracados DESC
LIMIT 1;";

$pdo_statement = $db->prepare($query_string);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

// HEADERS
echo '<div class="mdc-data-table">
<div class="mdc-data-table__table-container">
<table class="mdc-data-table__table" aria-label="Query Output">
<thead>
<tr class="mdc-data-table__header-row">';
$headers = ["Nombre puerto", "Cantidad barcos atracados"];
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
  echo '<td class="mdc-data-table__cell mdc-data-table__cell--numeric">';
  echo $row[1];
  echo '</td>';

  echo '</tr>';
}
echo '</tbody>
</table>
</div>
</div>';
?>