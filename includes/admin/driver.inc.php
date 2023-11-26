<?php
require_once './backend/connection.php';

function generateTable($tableID, $pdo)
{
    $tableHTML = <<<HTML
    <table id="$tableID" class="" style="width:100%">
        <thead>
            <tr>
                <th>Driver Details</th>
                <th>Driver Name</th>
                <th>Vehicle Type</th>
                <th>Vehicle Colour</th>
                <th>Vehicle Rules</th>
                <th>Driver Bio</th>
                <th>Credentials</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
HTML;
    echo $tableHTML;

    switch ($tableID) {
        case "newAppTable":
            $status = "N";
            break;
        case "approvedAppTable":
            $status = "A";
            break;
        case "rejectedAppTable":
            $status = "R";
            break;
        default:
            $status = "N";
            break;
    }

    $stmt = $pdo->prepare(
        'SELECT application.*, account.email, user.name, user.phoneNo
        FROM application
        JOIN user ON application.accountID = user.accountID
        JOIN account ON user.accountID = account.accountID
        WHERE application.status = :status;'
    );
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $application) {
        $applicationID = $application['applicationID'];
        $vehicleNo = $application['vehicleNo'];
        $vehicleType = $application['vehicleType'];
        $vehicleColour = $application['vehicleColour'];
        $driverCredentials = $application['driverCredentials'];
        $driverBio = $application['driverBio'];
        $vehicleRules = $application['vehicleRules'];
        $email = $application['email'];
        $name = $application['name'];
        $phoneNo = $application['phoneNo'];
        $actionHTML = getActions($status, $applicationID);

        echo <<<HTML
        <tr data-child-name='{$name}' data-child-phone='{$phoneNo}' data-child-email='{$email}' 
        data-child-vehicle='{$vehicleNo}'>
        <td class='dt-control'></td>
        <td>{$name}</td>
        <td>{$vehicleType}</td>
        <td>{$vehicleColour}</td>
        <td>{$vehicleRules}</td>
        <td>{$driverBio}</td>
        <td><a href ='{$driverCredentials}'>Download</a></td>
        <td>{$actionHTML}</td>
    </tr>
    HTML;
    }

    echo <<<HTML
        </tbody>
    </table>
HTML;
}

function getActions($status, $applicationID)
{
    if ($status === "N") {
        return <<<HTML
        <div class="row m-0">
            <div class="col">
                <i class="bi bi-check-square-fill m-0 p-0" style="color: var(--sub); cursor: pointer;" onclick="approveApplication('$applicationID')"></i>
            </div>
            <div class="col">
                <i class="bi bi-x-square-fill" style="color: red; cursor: pointer;" onclick="rejectApplication('$applicationID')"></i>
            </div>
        </div>
        HTML;
    } else if ($status === "A") {
        return <<<HTML
        <i class="bi bi-x-square-fill" style="color: red; cursor: pointer;" onclick="rejectApplication('$applicationID')"></i>
        HTML;
    } else if ($status === "R") {
        return <<<HTML
        <i class="bi bi-check-square-fill m-0 p-0" style="color: var(--sub); cursor: pointer;" onclick="approveApplication('$applicationID')"></i>
        HTML;
    }
}
?>

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
<div class="row m-0">
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
            <?php generateTable("newAppTable", $pdo); ?>
        </div>
        <div class="tab-pane fade" id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
            <?php generateTable("approvedAppTable", $pdo); ?>
        </div>
        <div class="tab-pane fade" id="pills-rejected" role="tabpanel" aria-labelledby="pills-rejected-tab">
            <?php generateTable("rejectedAppTable", $pdo); ?>
        </div>
    </div>
</div>

<script>
    // JavaScript function to handle button click
    function rejectApplication(applicationID) {
        // Make an AJAX request to update the status
        $.ajax({
            type: 'POST',
            url: 'backend/updateAppStatus.php',
            data: {
                applicationID: applicationID,
                status: 'R'
            },
            success: function(response) {
                // Handle the response, if needed
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.error(xhr.responseText);
            }
        });
    }

    function approveApplication(applicationID) {
        // Make an AJAX request to update the status
        $.ajax({
            type: 'POST',
            url: 'backend/updateAppStatus.php',
            data: {
                applicationID: applicationID,
                status: 'A'
            },
            success: function(response) {
                // Handle the response, if needed
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.error(xhr.responseText);
            }
        });
    }
</script>