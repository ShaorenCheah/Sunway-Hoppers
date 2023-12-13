<link rel="stylesheet" href="./styles/dashView.css">
<h2>Dashboard</h2>
<div class="row">
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Users</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo totalUser() ?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="bi bi-person-fill"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Drivers</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo totalDriver() ?></p>
        </span>
        <span class="w-50 summary-icon-green">
          <i class="bi bi-person-badge-fill"></i></span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Total Carpools</h5>
      <div class="row">
        <span class="w-50">
          <p class="summary-text"><?php echo totalCarpool() ?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="fa-solid fa-car"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">Rewards Left</h5>
      <div class="row ">
        <span class="w-50">
          <p class="summary-text"><?php echo totalReward() ?></p>
        </span>
        <span class="w-50 summary-icon-green">
          <i class="bi bi-gift-fill"></i>
        </span>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="summary shadow">
      <h5 class="text-muted mb-0">New Applicants</h5>
      <div class="row ">
        <span class="w-50">
          <p class="summary-text"><?php echo totalApplication() ?></p>
        </span>
        <span class="w-50 summary-icon-orange">
          <i class="bi bi-file-earmark-text-fill"></i>
        </span>
      </div>
    </div>
  </div>
</div>
<hr style="margin-top: 2.5rem;">
<div class="row">
  <h2 class="w-50">Carpools Today</h2>
  <span class="w-50 d-flex justify-content-end align-items-start">
    <button class="btn btn-primary shadow px-4 date ">
      <?php date_default_timezone_set("Asia/Kuala_Lumpur");
      echo date('d/m/Y');
      ?></button>
  </span>
  <div class="table-container">
    <table id="todayCarpoolTable" class="dashboardTable" style="width:100%">
      <thead>
        <tr>
          <th>Driver Details</th>
          <th>Car Number</th>
          <th>Carpool Time</th>
          <th>Destination</th>
          <th>Pick-Up Location</th>
          <th>No. of Passengers</th>
          <th>Status</th>
      </thead>
      <tbody>
        <?php
        require './backend/connection.php';
        $stmt = $pdo->prepare(
          'SELECT 
            application.*, 
            account.email, 
            user.name, user.phoneNo, 
            carpool.*,
              (
                SELECT COUNT(*)
                FROM carpool_passenger
                WHERE carpool_passenger.carpoolID = carpool.carpoolID
                AND carpool_passenger.isApproved = 1
              ) as "numOfPassengers"
                FROM carpool
                JOIN user ON carpool.accountID = user.accountID
                JOIN account ON carpool.accountID = account.accountID
                JOIN application ON user.accountID = application.accountID
                WHERE carpool.carpoolDate = :today;'
        );
        $stmt->bindValue(':today', date('Y-m-d'));
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $carpool) {
          $vehicleNo = $carpool['vehicleNo'];
          $vehicleColour = $carpool['vehicleColour'];
          $vehicleType = $carpool['vehicleType'];
          $email = $carpool['email'];
          $name = $carpool['name'];
          $phoneNo = $carpool['phoneNo'];
          $time = $carpool['carpoolTime'];
          $passenger = $carpool['numOfPassengers'];
          $destination = $carpool['location'];
          $district = $carpool['district'];
          $neighborhood = $carpool['neighborhood'];
          $status = $carpool['status'];

          echo <<<HTML
            <tr data-child-name='{$name}' data-child-phone='{$phoneNo}' data-child-email='{$email}' 
            data-child-vehicle='{$vehicleColour} {$vehicleType}'>
              <td class='dt-control'></td>
              <td>{$vehicleNo}</td>
              <td>{$time}</td>
              <td>{$destination}</td>
              <td>{$district}, {$neighborhood}</td>
              <td>{$passenger}</td>
              <td>{$status}</td>
            </tr>
    HTML;
        }
        echo <<<HTML
      </tbody>
    </table>
  </div>
HTML;
        ?>
  </div>
  <script>
    initializeDataTable('#todayCarpoolTable', '#txtSearchCarpools');
  </script>