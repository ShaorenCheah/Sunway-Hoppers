<?php
$modal .= <<<HTML
<div class="modal-dialog modal-lg w-75">
  <div class="modal-content">
    <div class="modal-body w-100 text-center p-4 px-5 d-flex flex-column justify-content-center align-items-center">
      <h4 class="mb-3" style="font-weight:600">Carpool Details #<span style="color:var(--secondary)" id="index">{$data['index']}</span></h4>
      
      <div class="m-0  d-flex w-100 justify-content-center align-items-center">
        <div class="col d-flex  flex-column justify-content-center align-items-center">
          <h5 class="mb-3">Pickup Area <i class="ms-2 bi bi-geo"></i></h5>
          <div class="d-flex" id="pickup">
            {$data['pickup']}
          </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mx-4">
          <i class="bi bi-arrow-right-circle-fill" style="font-size: 1.563rem;"></i>
        </div>
        <div class="col d-flex  flex-column justify-content-center align-items-center">
          <h5 class="mb-3">Destination <i class="ms-2 bi bi-flag"></i></i></h5>
          <div class="d-flex" id="destination">
            {$data['destination']}
          </div>
        </div>
      </div>

      <hr class="my-4 w-100">
      <div class="w-100 d-flex flex-column align-items-start justify-content-start">
        <h5 class="mb-1 fw-b">Pending Requests <i class="ms-2 bi bi-person"></i></h5>
        {$pendingHTML}
      </div>

      <hr class="my-2 mb-3 w-100">
      <div class="w-100 d-flex flex-column align-items-start justify-content-start">
        <h5 class="mb-1 fw-b">Passengers <i class="ms-2 bi bi-person-check"></i></h5>
        {$passengerHTML}
      </div>
    </div>
  </div>
</div>
HTML;
