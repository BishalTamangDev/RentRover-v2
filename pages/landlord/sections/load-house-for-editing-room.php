<?php
$landlordId = isset($_POST['landlordId']) ? $_POST['landlordId'] : 0;
$roomId = isset($_POST['roomId']) ? $_POST['roomId'] : 0;
$initialHouseId = isset($_POST['houseId']) ? $_POST['houseId'] : 0;

echo $initialHouseId ;

if ($landlordId == 0 || $roomId == 0 || $initialHouseId == 0) {
    exit;
}

require_once __DIR__ . '/../../../classes/house.php';

$tempHouse = new House();

$houseList = $tempHouse->fetchHouseByLandlordId($landlordId);
?>

<?php
foreach ($houseList as $house) {
    $tempHouse->address = [
        'district' => $house['district'],
        'ward' => $house['ward'],
        'toleVillage' => $house['tole_village'],
        'municipalityRural' => $house['municipality_rural'],
    ];
    ?>
    <option value="<?= $house['house_id'] ?>" <?php if ($house['house_id'] == $initialHouseId) echo "selected"; ?>> <?= $tempHouse->getAddress() ?>
    </option>
    <?php
}