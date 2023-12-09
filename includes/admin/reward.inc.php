<?php include './includes/modals/addRewardModal.inc.php'; ?>
<link rel="stylesheet" href="./styles/dashView.css">
<div class="row">
  <div class="w-75">
    <h2>Rewards</h2>
  </div>
  <div class="w-25">
    <div class="input-group">
      <input type="text" class="form-control search-input" id="txtSearchRewards" placeholder="Filter rewards">
      <button class="btn btn-primary search-btn" type="button" id="button-addon2">Search <i class="bi bi-search"></i></button>
    </div>
  </div>
</div>
<div class="row">
  <div class="w-75">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-inventory-tab" data-bs-toggle="pill" data-bs-target="#pills-inventory" type="button" role="tab" aria-controls="pills-inventory" aria-selected="true">Inventory</button>
      </li>
      <li class="nav-item mx-4" role="presentation">
        <button class="nav-link" id="pills-claim-tab" data-bs-toggle="pill" data-bs-target="#pills-claim" type="button" role="tab" aria-controls="pills-claim" aria-selected="false">Claim History</button>
      </li>
    </ul>
  </div>
  <div class="w-25 d-flex align-items-center justify-content-end" id="addRewardBtn">
    <i class="bi bi-plus-circle add-btn" data-bs-toggle="modal" data-bs-target="#addRewardModal" id="addRewardIcon"></i>
  </div>
</div>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-inventory" role="tabpanel" aria-labelledby="pills-inventory-tab">
    <div class="table-container">
      <table id="rewardTable" class="dashboardTable" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Points</th>
            <th>Image</th>
            <th>Type</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require './backend/connection.php';

          $stmt = $pdo->prepare('SELECT * FROM reward');
          $stmt->execute();

          // Fetch the result
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($result as $reward) {
            $rewardName = $reward['rewardName'];
            $desc = $reward['description'];
            $points = $reward['points'];
            $img = $reward['img'];
            $type = $reward['type'];
            $quantity = $reward['quantity'];
            echo <<<HTML
                    <tr>
                      <td>$rewardName</td>
                      <td>$desc</td>
                      <td>$points</td>
                      <td>$img</td>
                      <td>$type</td>
                      <td>$quantity</td>
                    </tr>
                  HTML;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="tab-pane fade" id="pills-claim" role="tabpanel" aria-labelledby="pills-claim-tab">
    <div class="table-container">
      <table id="claimTable" class="dashboardTable" style="width:100%">
        <thead>
          <tr>
            <th>Reward Claimed</th>
            <th>Points</th>
            <th>Type</th>
            <th>Email</th>
            <th>Code</th>
            <th>Expiry Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require './backend/connection.php';

          $stmt = $pdo->prepare('SELECT
          reward.rewardName AS "Reward Name",
          reward.points AS "Points",
          reward.type AS "Type",
          account.email AS "Email",
          redemption.code AS "Code",
          redemption.expiryDate AS "Expiry Date",
          redemption.status AS "Status"
      FROM
          redemption
      JOIN account ON redemption.accountID = account.accountID
      JOIN reward ON redemption.rewardID = reward.rewardID;');
          $stmt->execute();

          // Fetch the result
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($result as $claim) {
            $rewardName = $claim['Reward Name'];
            $points = $claim['Points'];
            $type = $claim['Type'];
            $email = $claim['Email'];
            $code = $claim['Code'];
            $expiryDate = $claim['Expiry Date'];
            $status = $claim['Status'];
            echo <<<HTML
                    <tr>
                      <td>$rewardName</td>
                      <td>$points</td>
                      <td>$type</td>
                      <td>$email</td>
                      <td>$code</td>
                      <td>$expiryDate</td>
                      <td>$status</td>
                    </tr>
                  HTML;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  initializeDataTable('#rewardTable', '#txtSearchRewards');
  initializeDataTable('#claimTable', '#txtSearchRewards');

  //display add reward icon when inventory tab is clicked
  $(document).ready(function() {
    $('#pills-inventory-tab').click(function() {
      document.getElementById('addRewardIcon').style.display = 'block';
    });
    $('#pills-claim-tab').click(function() {
      document.getElementById('addRewardIcon').style.display = 'none';
    });
  });
</script>