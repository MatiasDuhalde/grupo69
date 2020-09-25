<?php
// get db variable
require("../config/connection.php");

$nombre_puerto = $_REQUEST["nombre_puerto"];

$query_string = "SELECT personal.rut, personal.nombre, edad, sexo, jefe_instalacion.instalacion_id FROM personal
INNER JOIN jefe_instalacion
ON personal.rut = jefe_instalacion.rut
INNER JOIN puerto_instalacion
ON jefe_instalacion.instalacion_id = puerto_instalacion.instalacion_id
INNER JOIN puertos
ON puerto_instalacion.puerto_id = puertos.puerto_id
WHERE puertos.nombre ILIKE '%{$nombre_puerto}%';";

$pdo_statement = $db->prepare($query_string);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

// HEADERS
echo '<div class="mdc-data-table">
<div class="mdc-data-table__table-container">
<table class="mdc-data-table__table" aria-label="Query Output">
<thead>
<tr class="mdc-data-table__header-row">';
$headers = ["RUT", "Nombre", "Edad", "Sexo", "ID instalación"];
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
  echo '<td class="mdc-data-table__cell mdc-data-table__cell--numeric">';
  echo $row[2];
  echo '</td>';
  echo '<td class="mdc-data-table__cell">';
  echo $row[3];
  echo '</td>';
  echo '<td class="mdc-data-table__cell mdc-data-table__cell--numeric">';
  echo $row[4];
  echo '</td>';

  echo '</tr>';
}
echo '</tbody>
</table>
</div>
</div>';
?>