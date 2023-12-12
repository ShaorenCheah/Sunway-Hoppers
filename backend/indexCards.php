<?php
function getSteps($type){
  $passCards = [
    'Select Carpool Ride' => "Browse through available carpool invitations and request for a ride.",
    'Hop On Your Ride' => "Arrive at the pick-up location on time and onboard your ride.",
    'Say The Secret Code' => "Let the driver know the code to complete your ride and earn carrots (our points)!",
    'Redeem Vouchers' => "Exchange your carrots for vouchers! A token of appreciation from us to you.",
  ];
  
  $driverCards = [
    'Create Carpool Session' => "Create a carpool invitation and wait for passengers to request for a ride.",
    'Pick Up Your Passengers' => "Pick up your passengers at the agreed location and drive to your destination.",
    'Enter The Secret Code' => "Get a code from your passengers and enter it on the platform to earn carrots (our points)!",
    'Redeem Vouchers' => "Exchange your carrots for vouchers! A token of appreciation from us to you.",
  ];

  if ($type == "passenger") {
    getCards("pass", $passCards);
  } else if($type == "driver") {
    getCards("driver", $driverCards);
  }

}

function getCards($type, $cards) {
  foreach ($cards as $key => $value) {
    $stepNumber = array_search($key, array_keys($cards)) + 1;
    $imageSource = "./images/$type-step-$stepNumber.png";
  
    echo <<<HTML
    <div class='col'>
      <div class='card shadow' style='width: 16rem; height: 23rem'>
        <div class='card-body'>
          <h5 class='number m-0' style="text-align: left">$stepNumber.</h5>
          <div style="height: 12rem">
            <img class='card-img' style="object-fit: cover" src='$imageSource'>
          </div>
          <h5 class='card-title'>$key</h5>
          <p style="text-align: justify">$value</p>
        </div>
      </div>
    </div>
HTML;
  }
}
?>
