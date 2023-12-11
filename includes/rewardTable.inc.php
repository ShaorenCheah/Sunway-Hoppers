<?php 
$html .= <<<HTML
<tr>
  <td class="text-center">{$count}</td>
  <td class="text-center">{$redemption['rewardName']}</td>
  <td class="text-center">{$redemption['type']}</td>
  <td class="text-center">- {$redemption['points']} <i class="fa-solid fa-carrot ms-1" style="color:var(--secondary)"></i></td>
  <td class="text-center">{$redemption['redemptionDate']}</td>
  <td class="text-center">{$redemption['expiryDate']}</td>
HTML;

if($redemption['status'] == 'Active'){
  $html .= "<td class='text-center'><span class='badge bg-secondary active mb-0'>{$redemption['status']}</span></td>";
}else if($redemption['status'] == 'Redeemed'){
  $html .= "<td class='text-center'><span class='badge bg-secondary completed mb-0'>{$redemption['status']}</span></td>";
} else if($redemption['status'] == 'Expired'){
  $html .= "<td class='text-center'><span class='badge bg-secondary cancelled  mb-0'>{$redemption['status']}</span></td>";
}

$html .= <<<HTML
  <td class="text-center"><button type="button" data-redemptionIndex='{$count}' data-redemptionID="{$redemption['redemptionID']}" class="btn btn-primary view-reward">View Reward<i class="ms-2 bi bi-gift"></i></button></td>
</tr>
HTML;
?>