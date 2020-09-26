<?php
  $bg = array('cannon_galleon.jpg', 'canoe.jpg', 'caravel.jpg', 'demolition_raft.jpg', 
    'demolition_ship.jpg', 'dragon_ship.jpg', 'elite_cannon_galleon.jpg', 'elite_caravel.jpg', 
    'elite_longboat.jpg', 'elite_turtle_ship.jpg', 'fast_fire_ship.jpg', 'fire_galley.jpg',
    'fire_ship.jpg', 'fishing_ship.jpg', 'galleon.jpg', 'galley.jpg', 'heavy_demolition_ship.jpg',
    'junk.jpg', 'longboat.jpg', 'trade_cog.jpg', 'transport_ship.jpg', 'turtle_ship.jpg');


  $cards = ["card-query-1", "card-query-2", "card-query-3", "card-query-4", "card-query-5", "card-query-6", "card-output"];
  $selectedBackgrounds = [];
  foreach ($cards as $card) {
    $i = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBackgrounds[$card] = $bg[$i];
  }
?>

<style type="text/css">
<?php 
foreach ($cards as $cardID) {
    echo "#$cardID {
        background: linear-gradient( rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.60) ), url(images/aoe2_ships/$selectedBackgrounds[$cardID]);
        background-size:     100%;
        background-repeat:   repeat-y;
        background-position: center center;
    }";
}
?>
</style>
