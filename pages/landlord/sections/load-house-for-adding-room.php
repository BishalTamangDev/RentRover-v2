<?php
$landlordId = isset($_POST['landlordId']) ? $_POST['landlordId'] : 0;
if ($landlordId == 0) {
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();
$houseList = $tempHouse->fetchHouseByLandlordId($landlordId);
?>

<option value="" selected hidden> Select House </option>

<?php
foreach ($houseList as $house) {
    $tempHouse->address = [
        'district' => $house['district'],
        'ward' => $house['ward'],
        'toleVillage' => $house['tole_village'],
        'municipalityRural' => $house['municipality_rural'],
    ];
    ?>
    <option value="<?= $house['house_id'] ?>"> <?= $tempHouse->getAddress() ?> </option>
    <?php
}