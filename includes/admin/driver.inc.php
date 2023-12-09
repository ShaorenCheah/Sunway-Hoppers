<link rel="stylesheet" href="./styles/dashView.css">
<div class="row">
  <div class="w-75">
    <h2>Driver Applications</h2>
  </div>
  <div class="w-25">
    <div class="input-group">
      <input type="text" class="form-control search-input" id="txtSearchApplications" placeholder="Filter applications">
      <button class="btn btn-primary search-btn" type="button" id="button-addon2">Search <i class="bi bi-search"></i></button>
    </div>
  </div>
</div>
<div class="row">
  <div class="">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-new-tab" data-bs-toggle="pill" data-bs-target="#pills-new" type="button" role="tab" aria-controls="pills-new" aria-selected="true">New</button>
      </li>
      <li class="nav-item mx-4" role="presentation">
        <button class="nav-link" id="pills-approved-tab" data-bs-toggle="pill" data-bs-target="#pills-approved" type="button" role="tab" aria-controls="pills-approved" aria-selected="false">Approved</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-rejected-tab" data-bs-toggle="pill" data-bs-target="#pills-rejected" type="button" role="tab" aria-controls="pills-rejected" aria-selected="false">Rejected</button>
      </li>
    </ul>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
      <?php generateAppTable("newAppTable"); ?>
    </div>
    <div class="tab-pane fade" id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
      <?php generateAppTable("approvedAppTable"); ?>
    </div>
    <div class="tab-pane fade" id="pills-rejected" role="tabpanel" aria-labelledby="pills-rejected-tab">
      <?php generateAppTable("rejectedAppTable"); ?>
    </div>
  </div>
</div>
<script>
  initializeDataTable('#newAppTable', '#txtSearchApplications');
  initializeDataTable('#approvedAppTable', '#txtSearchApplications');
  initializeDataTable('#rejectedAppTable', '#txtSearchApplications');
</script>
<script src="./scripts/manageApplications.js"></script>