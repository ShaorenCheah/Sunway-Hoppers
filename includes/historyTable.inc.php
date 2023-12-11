<?php 
$html .= <<<HTML
<tr>
  <td class="text-center">{$count}</td>
  <td class="text-center">{$carpool['carpoolDate']}</td>
  <td class="text-center">{$carpool['carpoolTime']}</td>
  <td class="text-center">{$driver['name']}</td>
  <td class="text-center">{$driver['vehicleType']}, {$driver['vehicleColour']} <span class="badge bg-primary">{$driver['vehicleNo']}</span></td>
  <td class="text-center">{$pickup}</td>
  <td class="text-center">{$destination}</td>
HTML;

if($carpool['status'] == 'Pending'){
  $html .= "<td class='text-center'><span class='badge bg-secondary pending mb-0'>{$carpool['status']}</span></td>";
}else if($carpool['status'] == 'Accepted'){
  $html .= "<td class='text-center'><span class='badge bg-secondary active mb-0'>{$carpool['status']}</span></td>";
}else if($carpool['status'] == 'Completed'){
  $html .= "<td class='text-center'><span class='badge bg-secondary completed mb-0'>{$carpool['status']}</span></td>";
} else if($carpool['status'] == 'Cancelled' || $carpool['status'] == 'Rejected'){
  $html .= "<td class='text-center'><span class='badge bg-secondary cancelled  mb-0'>{$carpool['status']}</span></td>";
}

if($carpool['status'] != 'Accepted'){
  $html .= "<td class='text-center text-muted'>—</td>";
  $html .= "<td class='text-center text-muted'>—</td> </tr>";
}else{
  $html .= "<td class='text-center'>{$carpool['pointsEarned']} pts</td>";
  $html .= "<td class='text-center'>{$carpool['code']}</td> </tr>";
}

?>