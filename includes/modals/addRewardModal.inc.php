<div class="modal fade" tabindex="-1" id="addRewardModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body w-100 px-4 py-5">
                <div class="container-fluid">
                    <h3 style="font-weight:700;">Add New Reward</h3>
                    <form id="rewardForm" class="pt-3" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="rewardName">Reward Name</label>
                                <input type="text" class="form-control" id="rewardName" name="rewardName" placeholder="Ex: Tealive" required>
                            </div>
                            <div class="col">
                                <label for="type">Reward Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="fnb">Food & Beverage</option>
                                    <option value="petrol">Petrol</option>
                                    <option value="originals">Sunway Originals</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label for="points">Points to Redeem</label>
                                <input type="number" class="form-control" id="points" name="points" placeholder="100 points = RM 1" required>
                            </div>
                            <div class="col">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="image">Attach an Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <div class="mb-4">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id="desc" name="desc" placeholder="Ex: Tealive" required></textarea>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="rewardSubmit" id="rewardSubmit" class="btn btn-primary shadow px-4">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>