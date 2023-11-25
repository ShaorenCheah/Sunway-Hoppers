<?php
require_once 'connection.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
  case 'getDistricts':
    echo getDistricts($pdo);
    break;
  case 'getNeighborhoods':
    $selectedDistrict = $_GET['district'];
    echo getNeighborhoods($selectedDistrict, $pdo);
    break;
  default:
    echo "Invalid action";
    break;
}

function getDistricts($pdo)
{
  $stmt = $pdo->prepare("SELECT * FROM selangor_districts");
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select District</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['district_id']}'>{$district['district_name']}</option>";
  }
  return $html;
}

function getNeighborhoods($selectedDistrict, $pdo)
{

  $stmt = $pdo->prepare("SELECT * FROM selangor_neighborhoods WHERE district_id = :district");
  $stmt->bindParam(':district', $selectedDistrict);
  $stmt->execute();
  $districts = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $html = "<option value='' disabled selected>Select Neighborhood</option>";
  foreach ($districts as $district) {
    $html .= "<option value='{$district['neighborhood_id']}'>{$district['neighborhood_name']}</option>";
  }
  return $html;
}

?>