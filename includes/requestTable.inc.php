<?php
$html .= <<<HTML
<tr>
  <td class="text-center">{$count}</td>
  <td class="text-center">{$carpool['carpoolDate']}</td>
  <td class="text-center">{$carpool['carpoolTime']}</td>
  <td class="text-center">{$carpool['passengerAmt']}</td>
  <td class="text-center">{$pickup}</td>
  <td class="text-center">{$destination}</td>
HTML;

if ($carpool['status'] == 'Active') {
  $html .= "<td class='text-center'><span class='badge bg-secondary active mb-0'>{$carpool['status']}</span></td>";
} else if ($carpool['status'] == 'Completed') {
  $html .= "<td class='text-center'><span class='badge bg-secondary completed mb-0'>{$carpool['status']}</span></td>";
} else if ($carpool['status'] == 'Cancelled') {
  $html .= "<td class='text-center'><span class='badge bg-secondary cancelled  mb-0'>{$carpool['status']}</span></td>";
}

$html .= <<<HTML
  <td class="text-center">{$carpool['pointsEarned']} pts</td>
  <td class="text-center"><button type="button" data-carpoolIndex='{$count}' data-carpoolID="{$carpool['carpoolID']}" class="btn btn-primary position-relative view-request">View Details<i class="ms-2 bi bi-person"></i>
HTML;
if($requestsCount > 0){
  $html .= <<<HTML
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pt-1">
    {$requestsCount}
    <span class="visually-hidden">unread messages</span>
  </span>
  HTML;
}
$html .= <<<HTML
</button></td>
</tr>
HTML;
?>