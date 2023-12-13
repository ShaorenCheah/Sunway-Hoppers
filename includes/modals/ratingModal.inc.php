<?php
$modal .= <<<HTML
<div class="modal-dialog modal-dialog-centered w-75">
  <div class="modal-content">
    <div class="modal-body w-100 text-center p-4 px-5 d-flex flex-column justify-content-center align-items-center">
      <div class="d-flex flex-column align-items-center justify-content-center">
        <h4 class="mb-2" style="font-weight:600">Rate Your Driver!</h4>
        <p class="text-muted mb-2" style="font-weight:400; font-size:0.929rem">The driver had received your arrival code</p>
        <img class='img-fluid rounded' src="images/rating.png" style="height:15rem; width:20rem" alt='Rating Image'>
        <h5 class="mt-4" style="color:var(--black) !important">How was your ride with<br>
          <span style="color:var(--primary)">{$driverName}</span> on <span style="color:var(--primary)">{$carpoolDate} ({$carpoolTime})</span>
        </h5>
        <div class="ratings-wrapper m-0">
          <div class="ratings">
              <span data-rating="5">★</span>
              <span data-rating="4">★</span>
              <span data-rating="3">★</span>
              <span data-rating="2">★</span>
              <span data-rating="1">★</span>
          </div>
        </div>
        <button type="button" class="btn btn-primary mt-2 px-4" id="rateBtn" disabled>Rate</button>
      </div>
    </div>
  </div>
</div>
HTML;
?>
