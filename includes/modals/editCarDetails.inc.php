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
                <label for="editCarNo" class="form-label ">Car Plate Number <i class="bi bi-123"></i></label>
                <input type="text" class="form-control" id="editCarNo" name="carNo" value="<?php echo $carNo ?>" disabled>
              </div>
              <div class="col">
                <label for="editCarType" class="form-label">Car Type <i class="bi bi-car-front-fill"></i></label>
                <input type="text" class="form-control" id="editCarType" name="carType" value="<?php echo $carType ?>" disabled>
              </div>
              <div class="col">
                <label for="editCarColour" class="form-label">Car Colour <i class="bi bi-palette"></i></label>
                <select name="carColour" id="editCarColour" class="form-select">
                  <option <?php echo ($carColour === "red") ? 'selected' : ''; ?> value="red">Red</option>
                  <option <?php echo ($carColour === "blue") ? 'selected' : ''; ?> value="blue">Blue</option>
                  <option <?php echo ($carColour === "green") ? 'selected' : ''; ?> value="green">Green</option>
                  <option <?php echo ($carColour === "white") ? 'selected' : ''; ?> value="white">White</option>
                  <option <?php echo ($carColour === "black") ? 'selected' : ''; ?> value="black">Black</option>
                  <option <?php echo ($carColour === "silver") ? 'selected' : ''; ?> value="silver">Silver</option>
                  <option <?php echo ($carColour === "gray") ? 'selected' : ''; ?> value="gray">Gray</option>
                  <option <?php echo ($carColour === "yellow") ? 'selected' : ''; ?> value="yellow">Yellow</option>
                  <option <?php echo ($carColour === "orange") ? 'selected' : ''; ?> value="orange">Orange</option>
                  <option <?php echo ($carColour === "purple") ? 'selected' : ''; ?> value="purple">Purple</option>
                  <option <?php echo ($carColour === "brown") ? 'selected' : ''; ?> value="brown">Brown</option>
                  <option <?php echo ($carColour === "pink") ? 'selected' : ''; ?> value="pink">Pink</option>
                </select>
              </div>
            </div>
            <div class="mb-4">
              <label for="editCarRules" class="form-label">Car Rules <i class="bi bi-list-ol"></i></label>
              <textarea class="form-control" id="editCarRules" name="carRules" style="height: 8rem" placeholder="Ex: No food in my car!" required><?php echo $carRules ?></textarea>
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