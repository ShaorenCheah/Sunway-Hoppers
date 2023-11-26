import { DataTable } from 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js';
import { $ } from 'https://code.jquery.com/jquery-3.6.0.js';

function initializeDataTable(tableSelector, searchInputSelector) {
    let dataTable = new DataTable(tableSelector);

    $(document).ready(function() {
        $(tableSelector).DataTable();
        $(`${tableSelector}_filter`).hide(); // Hide default search datatables where example is the ID of table
        $(`${tableSelector}_length`).hide();

        $(searchInputSelector).on('keyup', function() {
            dataTable
                .search($(searchInputSelector).val(), false, true)
                .draw();
        });
    });
}