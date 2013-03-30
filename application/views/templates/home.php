<?php

echo '<br />';
$i=0;
foreach($language_teams as $team):
    $i++;
    if ($i==1)
      echo '<div class="row">';
    
    echo '<div class="large-3 panel radius centered columns">';
    echo '<h4 style="text-align: center">'.anchor('languages/'.$team->shortname, $team->name);'</h4>';
    echo '</div>';
    
    if ($i==6)
    {
      echo '</div>';  
      $i=0;
    }         
endforeach;

if ($i!=0)
    echo '</div>';  

?>