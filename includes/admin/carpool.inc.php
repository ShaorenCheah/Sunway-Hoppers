<link rel="stylesheet" href="./styles/dashView.css">
<div class="row">
  <div class="w-75">
    <h2>Carpool Sessions</h2>
  </div>
  <div class="w-25">
    <div class="input-group">
      <input type="text" class="form-control search-input" id="txtSearchCarpools" placeholder="Filter carpools">
      <button class="btn btn-primary search-btn" type="button" id="button-addon2">Search <i class="bi bi-search"></i></button>
    </div>
  </div>
</div>
<div class="row">
  <div class="">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-activeCarpools-tab" data-bs-toggle="pill" data-bs-target="#pills-activeCarpools" type="button" role="tab" aria-controls="pills-activeCarpools" aria-selected="true">Ongoing</button>
      </li>
      <li class="nav-item mx-4" role="presentation">
        <button class="nav-link" id="pills-womenCarpools-tab" data-bs-toggle="pill" data-bs-target="#pills-womenCarpools" type="button" role="tab" aria-controls="pills-womenCarpools" aria-selected="false">Women-Only</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-completedCarpools-tab" data-bs-toggle="pill" data-bs-target="#pills-completedCarpools" type="button" role="tab" aria-controls="pills-completedCarpools" aria-selected="false">Completed</button>
      </li>
    </ul>
  </div>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-activeCarpools" role="tabpanel" aria-labelledby="pills-activeCarpools-tab">
      <?php generateCarpoolTable("activeCarpoolTable"); ?>
    </div>
    <div class="tab-pane fade" id="pills-womenCarpools" role="tabpanel" aria-labelledby="pills-womenCarpools-tab">
      <?php generateCarpoolTable("womenCarpoolTable"); ?>
    </div>
    <div class="tab-pane fade" id="pills-completedCarpools" role="tabpanel" aria-labelledby="pills-completedCarpools-tab">
      <?php generateCarpoolTable("completedCarpoolTable"); ?>
    </div>
  </div>
</div>
<script>
  initializeDataTable('#activeCarpoolTable', '#txtSearchCarpools');
  initializeDataTable('#womenCarpoolTable', '#txtSearchCarpools');
  initializeDataTable('#completedCarpoolTable', '#txtSearchCarpools');
</script>