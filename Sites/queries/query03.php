<?php
// get db variable
require("../config/connection.php");

$query_string = "SELECT DISTINCT puertos.puerto_id, puertos.nombre FROM puertos
INNER JOIN puerto_instalacion
ON puertos.puerto_id = puerto_instalacion.puerto_id
INNER JOIN instalaciones
ON instalaciones.instalacion_id = puerto_instalacion.instalacion_id
WHERE instalaciones.tipo ILIKE '%astillero%';";

$pdo_statement = $db->prepare($query_string);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

// HEADERS
echo '<div class="mdc-data-table">
<div class="mdc-data-table__table-container">
<table class="mdc-data-table__table" aria-label="Query Output">
<thead>
<tr class="mdc-data-table__header-row">';
$headers = ["ID puerto", "Nombre puerto"];
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

  echo '<th class="mdc-data-table__cell mdc-data-table__cell--numeric" scope="row">';
  echo $row[0];
  echo '</th>';
  echo '<td class="mdc-data-table__cell">';
  echo $row[1];
  echo '</td>';

  echo '</tr>';
}
echo '</tbody>
</table>
</div>
</div>';
?>