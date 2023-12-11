<script src="./scripts/addReward.js"></script>
<div class="modal fade" tabindex="-1" id="addRewardModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body w-100 px-4 py-5">
        <div class="container-fluid">
          <h3 style="font-weight:700;">Add New Reward</h3>
          <form id="rewardForm" class="pt-3" action="./backend/addReward.php" method="post" enctype="multipart/form-data">
            <div class="row mb-4">
              <div class="col">
                <label for="rewardName">Reward Name</label>
                <input type="text" class="form-control" id="rewardName" name="rewardName" placeholder="A short name">
                <small id="rewardNameHelp" class="form-small-text" style="color: red"></small>
              </div>
              <div class="col">
                <label for="type">Reward Type</label>
                <select class="form-select" id="type" name="type" style="border-color: green">
                  <option value="fnb">Food & Beverage</option>
                  <option value="petrol">Petrol</option>
                  <option value="originals">Sunway Originals</option>
                </select>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col">
                <label for="rewardPts">Points to Redeem</label>
                <input type="number" class="form-control" id="rewardPts" name="rewardPts" placeholder="100 points = RM 1">
                <small id="rewardPtsHelp" class="form-small-text" style="color: red"></small>
              </div>
              <div class="col">
                <label for="rewardQty">Quantity</label>
                <input type="number" class="form-control" id="rewardQty" name="rewardQty" placeholder="">
                <small id="rewardQtyHelp" class="form-small-text" style="color: red"></small>
              </div>
            </div>
            <div class="mb-4">
              <label for="rewardImage">Attach an Image</label>
              <input type="file" class="form-control" id="rewardImage" name="rewardImage" accept=".jpg, .jpeg, .png">
              <small class="form-small-text">*Only JPG, JPEG and PNG files are allowed.</small>
            </div>
            <div class="mb-4">
              <label for="rewardDesc">Description</label>
              <textarea class="form-control" id="rewardDesc" name="rewardDesc" rows="3" placeholder="Explain what the voucher is, its value, and T&C.&#10;Max 160 characters."></textarea>
              <small id="rewardDescHelp" class="form-small-text" style="color: red"></small>
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" name="addRewardBtn" id="addRewardBtn" class="btn btn-primary shadow px-4" disabled>Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>