<?php
include './backend/connection.php';

$sql = "SELECT * FROM application WHERE accountID = :accountID";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':accountID', $_SESSION['user']['accountID']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$carNo = $result['vehicleNo'];
$carType = $result['vehicleType'];
$carColour = $result['vehicleColour'];
$carRules = $result['vehicleRules'];
?>

<div class="modal fade" tabindex="-1" id="editCarModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body w-100 px-4 py-5">
        <div class="container-fluid">
          <h3 style="font-weight:700;">Edit Car Details</h3>
          <form id="editCarForm" class="pt-3" method="post">
            <div class="row mb-4">
              <div class="col ">
                <label for="carNo" class="form-label ">Car Plate Number <i class="bi bi-123"></i></label>
                <input type="text" class="form-control" id="carNo" name="carNo" value="<?php echo $carNo ?>" disabled>
              </div>
              <div class="col">
                <label for="carType" class="form-label">Car Type <i class="bi bi-car-front-fill"></i></label>
                <input type="text" class="form-control" id="carType" name="carType" value="<?php echo $carType ?>" disabled>
              </div>
              <div class="col">
                <label for="carColour" class="form-label">Car Colour <i class="bi bi-palette"></i></label>
                <select name="carColour" id="carColour" class="form-select">
                  <option <?php echo ($carColour === "Red") ? 'selected' : ''; ?> value="Red">Red</option>
                  <option <?php echo ($carColour === "Blue") ? 'selected' : ''; ?> value="Blue">Blue</option>
                  <option <?php echo ($carColour === "Green") ? 'selected' : ''; ?> value="Green">Green</option>
                  <option <?php echo ($carColour === "White") ? 'selected' : ''; ?> value="White">White</option>
                  <option <?php echo ($carColour === "Black") ? 'selected' : ''; ?> value="Black">Black</option>
                  <option <?php echo ($carColour === "Silver") ? 'selected' : ''; ?> value="Silver">Silver</option>
                  <option <?php echo ($carColour === "Gray") ? 'selected' : ''; ?> value="Gray">Gray</option>
                  <option <?php echo ($carColour === "Yellow") ? 'selected' : ''; ?> value="Yellow">Yellow</option>
                  <option <?php echo ($carColour === "Orange") ? 'selected' : ''; ?> value="Orange">Orange</option>
                  <option <?php echo ($carColour === "Purple") ? 'selected' : ''; ?> value="Purple">Purple</option>
                  <option <?php echo ($carColour === "Brown") ? 'selected' : ''; ?> value="Brown">Brown</option>
                  <option <?php echo ($carColour === "Pink") ? 'selected' : ''; ?> value="Pink">Pink</option>
                </select>
              </div>
            </div>
            <div class="mb-4">
              <label for="carRules" class="form-label">Car Rules <i class="bi bi-list-ol"></i></label>
              <textarea class="form-control" id="carRules" name="carRules" style="height: 8rem" placeholder="Ex: No food in my car!" required><?php echo $carRules ?></textarea>
            </div>
            <p class="text-muted text-center">Contact SunwayHoppers Admins If You Wish To Change Car Plate Number Or Car Type </p>
            <div class="d-flex justify-content-center">
              <button type="submit" name="submitCarBtn" id="submitCarBtn" class="btn btn-primary shadow px-4">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>