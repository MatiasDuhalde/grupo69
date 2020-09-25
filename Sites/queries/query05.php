<?php
// get db variable
require("../config/connection.php");

$query_string = "SELECT puertos.puerto_id, puertos.nombre, AVG(personal.edad) AS promedio_edad FROM personal
INNER JOIN trabaja_en
ON personal.rut = trabaja_en.rut
INNER JOIN puerto_instalacion
ON puerto_instalacion.instalacion_id = trabaja_en.instalacion_id
INNER JOIN puertos
ON puertos.puerto_id = puerto_instalacion.puerto_id
GROUP BY puertos.puerto_id, puertos.nombre;";

$pdo_statement = $db->prepare($query_string);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

// HEADERS
echo '<div class="mdc-data-table">
<div class="mdc-data-table__table-container">
<table class="mdc-data-table__table" aria-label="Query Output">
<thead>
<tr class="mdc-data-table__header-row">';
$headers = ["ID puerto", "Nombre puerto", "Edad promedio"];
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
  echo '<td class="mdc-data-table__cell mdc-data-table__cell--numeric">';
  echo $row[2];
  echo '</td>';

  echo '</tr>';
}
echo '</tbody>
</table>
</div>
</div>';
?>