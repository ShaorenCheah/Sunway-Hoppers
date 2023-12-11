<?php
$modal .= <<<HTML
<div class="modal-dialog w-75">
  <div class="modal-content">
    <div class="modal-body w-100 text-center p-4 px-5 d-flex flex-column justify-content-center align-items-center">
      <div class="d-flex flex-column align-items-center justify-content-center">
        <h4 class="mb-3" style="font-weight:600">Reward Details #<span style="color:var(--secondary)" id="index">{$data['index']}</span></h4>
        <img class='img-fluid rounded shadow' src="{$redemption['img']}" style="height:14rem; width:14rem" alt='Reward Image'>
        <h4 class="mt-3 mb-0">{$redemption['rewardName']}</h4>
        <p class="text-muted mb-2" style="font-weight:400; font-size:0.929rem">{$redemption['type']}</p>
        <p>{$redemption['description']}</p>
        <h2><span class="badge bg-primary shadow px-4 py-2">{$redemption['code']}</span></h2>
        <p class="text-muted m-0 mt-3" style="font-weight:400; font-size:0.714rem">Redemption Date: {$redemption['redemptionDate']}</p>
        <p class="text-muted" style="font-weight:400; font-size:0.714rem">Expiry Date: {$redemption['expiryDate']}</p>
      </div>
    </div>
  </div>
</div>
HTML;
