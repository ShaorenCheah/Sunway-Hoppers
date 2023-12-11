<?php 
$html .= <<<HTML
<tr>
  <td class="text-center">{$count}</td>
  <td class="text-center">{$carpool['carpoolDate']}</td>
  <td class="text-center">{$carpool['carpoolTime']}</td>
  <td class="text-center">{$carpool['passengerAmt']}</td>
  <td class="text-center">{$pickup}</td>
  <td class="text-center">{$destination}</td>
  <td class="text-center">{$carpool['status']}</td>
  <td class="text-center">{$carpool['pointsEarned']} pts</td>
  <td class="text-center"><button type="button" data-carpoolIndex='{$count}' data-carpoolID="{$carpool['carpoolID']}" class="btn btn-primary view-request">View Details<i class="ms-2 bi bi-person"></i></button><td>
</tr>
HTML;
?>