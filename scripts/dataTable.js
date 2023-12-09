function initializeDataTable(tableSelector, searchInputSelector) {
  let dataTable = new DataTable(tableSelector);

  $(document).ready(function () {
    // Initialize DataTable
    $(tableSelector).DataTable();
    $(`${tableSelector}_filter`).hide(); // Hide default search datatables where example is the ID of the table
    $(`${tableSelector}_length`).hide();

    // Handle search input
    $(searchInputSelector).on('keyup', function () {
      dataTable
        .search($(searchInputSelector).val(), false, true)
        .draw();
    });

    // Function to initialize tooltips
    function initializeTooltips() {
      if (tableSelector === '#rewardTable') {
        $('#rewardTable tbody tr').each(function () {
          var nTds = $('td', this);
          var img = "<img src='" + $(nTds[3]).text() + "' class='tooltip-image' />";

          $(this).tooltip({
            "title": img,
            "html": true, // Enable HTML content
            "delay": 0,
            "track": true,
            "fade": 250
          });
        });
      }
    }

    // Initialize tooltips on page load
    initializeTooltips();

    // Event delegation for tooltips on draw event
    $(tableSelector).on('draw.dt', function () {
      initializeTooltips();
    });

    // Handle row click for certain tables
    if (tableSelector === '#newAppTable' || tableSelector === '#approvedAppTable' || tableSelector === '#rejectedAppTable') {
      dataTable.on('click', 'td.dt-control', function (e) {
        let tr = e.target.closest('tr');
        let row = dataTable.row(tr);

        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
        } else {
          // Open this row
          row.child(format($(tr).data('child-name'), $(tr).data('child-email'), $(tr).data('child-phone'), $(tr).data('child-vehicle'))).show();
        }
      });
    }
  });
}


function format(name, email, phoneNo, vehicleNo) {
  return '<div><b>Name</b>: ' + name + ' <br /><b>Email</b>: ' + email + ' <br /><b>Phone Number</b>: ' + phoneNo + ' <br /><b>Car Plate</b>: ' + vehicleNo + '</div>';
}