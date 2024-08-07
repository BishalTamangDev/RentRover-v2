<?php
$amenityList = array(
    "Air Conditioning",
    "Balcony",
    "Fireplace",
    "Gardening",
    "Internet",
    "Laundry",
    "Parking",
    "Pets Allowed",
    "Prompt Repair Service",
    "Security",
    "Solar Heating",
    "Swimming Pool",
);

function amenityIcon($amenityName)
{
    if ($amenityName == "Air Conditioning")
        $amenityIconName = "air-conditioner.png";
    elseif ($amenityName == "Balcony")
        $amenityIconName = "balcony.png";
    elseif ($amenityName == "Fireplace")
        $amenityIconName = "fire-place.png";
    elseif ($amenityName == "Gardening")
        $amenityIconName = "gardening.png";
    elseif ($amenityName == "Internet")
        $amenityIconName = "internet.png";
    elseif ($amenityName == "Laundry")
        $amenityIconName = "laundry.png";
    elseif ($amenityName == "Parking")
        $amenityIconName = "parking.png";
    elseif ($amenityName == "Pets Allowed")
        $amenityIconName = "pets-allowed.png";
    elseif ($amenityName == "Prompt Repair Service")
        $amenityIconName = "prompt-repair-service.png";
    elseif ($amenityName == "Security")
        $amenityIconName = "security.png";
    elseif ($amenityName == "Solar Heating")
        $amenityIconName = "solar-heating.png";
    elseif ($amenityName == "Swimming Pool")
        $amenityIconName = "swimming-pool.png";
    else
        $amenityIconName = "NULL";

    return $amenityIconName;
}