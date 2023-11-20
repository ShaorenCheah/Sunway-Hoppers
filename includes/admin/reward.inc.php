<link rel="stylesheet" href="./styles/dash-reward.css">
<div class="row">
    <div class="w-75">
        <h2>Rewards</h2>
    </div>
    <div class="w-25">
        <div class="input-group">
            <input type="text" class="form-control search-input" id="txtSearch" placeholder="Filter rewards">
            <button class="btn btn-primary search-btn" type="button" id="button-addon2">Search <i class="bi bi-search"></i></button>
        </div>
    </div>
</div>
<div class="row">
    <div class="w-75">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-inventory-tab" data-bs-toggle="pill" data-bs-target="#pills-inventory" type="button" role="tab" aria-controls="pills-inventory" aria-selected="true">Inventory</button>
            </li>
            <li class="nav-item mx-4" role="presentation">
                <button class="nav-link" id="pills-claim-tab" data-bs-toggle="pill" data-bs-target="#pills-claim" type="button" role="tab" aria-controls="pills-claim" aria-selected="false">Claim History</button>
            </li>
        </ul>
    </div>
    <div class="w-25 d-flex align-items-center justify-content-end">
        <i class="bi bi-plus-circle" style="font-size: 2.2rem"></i>
    </div>
</div>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-inventory" role="tabpanel" aria-labelledby="pills-inventory-tab">
        <table id="rewardTable" class="" style="width:100%">
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
                require './connection.php';

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
                    echo "<tr>
                      <td>{$rewardName}</td>
                      <td>{$desc}</td>
                      <td>{$points}</td>
                      <td>{$img}</td>
                      <td>{$type}</td>
                      <td>{$quantity}</td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="pills-claim" role="tabpanel" aria-labelledby="pills-claim-tab">
        ...
    </div>
</div>