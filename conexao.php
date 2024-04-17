<?php
$ip  = "localhost";
$username = "root";
$senha = "";
$db = "trp";

$conn = new mysqli($ip, $username, $senha, $db);

function formatNumber($number) {
    $formattedNumber = number_format($number, 0, ',', '.');
    return $formattedNumber;
}

$vehicleNames = array(
    "Landstalker", "Bravura", "Buffalo", "Linerunner", "Perrenial",
    "Sentinel", "Dumper", "Firetruck", "Trashmaster", "Stretch",
    "Manana", "Infernus", "Voodoo", "Pony", "Mule", "Cheetah",
    "Ambulance", "Leviathan", "Moonbeam", "Esperanto", "Taxi",
    "Washington", "Bobcat", "Mr Whoopee", "BF Injection", "Hunter",
    "Premier", "Enforcer", "Securicar", "Banshee", "Predator",
    "Bus", "Rhino", "Barracks", "Hotknife", "Trailer 1", "Previon",
    "Coach", "Cabbie", "Stallion", "Rumpo", "RC Bandit", "Romero",
    "Packer", "Monster", "Admiral", "Squalo", "Seasparrow",
    "Pizzaboy", "Tram", "Trailer 2", "Turismo", "Speeder", "Reefer",
    "Tropic", "Flatbed", "Yankee", "Caddy", "Solair",
    "Berkley's RC Van", "Skimmer", "PCJ-600", "Faggio", "Freeway",
    "RC Baron", "RC Raider", "Glendale", "Oceanic", "Sanchez",
    "Sparrow", "Patriot", "Quad", "Coastguard", "Dinghy",
    "Hermes", "Sabre", "Rustler", "ZR-350", "Walton",
    "Regina", "Comet", "BMX", "Burrito", "Camper",
    "Marquis", "Baggage", "Dozer", "Maverick", "News Chopper",
    "Rancher", "FBI Rancher", "Virgo", "Greenwood", "Jetmax",
    "Hotring", "Sandking", "Blista Compact", "Police Maverick",
    "Boxville", "Benson", "Mesa", "RC Goblin", "Hotring Racer A",
    "Hotring Racer B", "Bloodring Banger", "Rancher", "Super GT",
    "Elegant", "Journey", "Bike", "Mountain Bike", "Beagle",
    "Cropdust", "Stunt", "Tanker", "Roadtrain", "Nebula",
    "Majestic", "Buccaneer", "Shamal", "Hydra", "FCR-900",
    "NRG-500", "HPV1000", "Cement Truck", "Tow Truck", "Fortune",
    "Cadrona", "FBI Truck", "Willard", "Forklift", "Tractor",
    "Combine", "Feltzer", "Remington", "Slamvan", "Blade",
    "Freight", "Streak", "Vortex", "Vincent", "Bullet",
    "Clover", "Sadler", "Firetruck LA", "Hustler", "Intruder",
    "Primo", "Cargobob", "Tampa", "Sunrise", "Merit",
    "Utility", "Nevada", "Yosemite", "Windsor", "Monster A",
    "Monster B", "Uranus", "Jester", "Sultan", "Stratum",
    "Elegy", "Raindance", "RC Tiger", "Flash", "Tahoma",
    "Savanna", "Bandito", "Freight Flat", "Streak Carriage", "Kart",
    "Mower", "Duneride", "Sweeper", "Broadway", "Tornado",
    "AT-400", "DFT-30", "Huntley", "Stafford", "BF-400",
    "Newsvan", "Tug", "Trailer 3", "Emperor", "Wayfarer",
    "Euros", "Hotdog", "Club", "Freight Carriage", "Trailer 3",
    "Andromada", "Dodo", "RC Cam", "Launch", "Police Car (LSPD)",
    "Police Car (SFPD)", "Police Car (LVPD)", "Police Ranger", "Picador",
    "S.W.A.T. Van", "Alpha", "Phoenix", "Glendale", "Sadler",
    "Luggage Trailer A", "Luggage Trailer B", "Stair Trailer", "Boxville",
    "Farm Plow", "Utility Trailer");

function getVehicleName($veh) {
    global $vehicleNames;
    return $vehicleNames[$veh - 400];
}

function getVehCat($veh) {
    $motos = array(521, 522, 581, 586, 448, 461, 462, 463, 468, 471);
    $helicopteros = array(417, 425, 447, 469, 487, 488, 497, 548, 563);
    $avioes = array(460, 476, 511, 512, 513, 519, 520, 553, 577, 592, 593);
    $caminhoes = array(407, 408, 524, 525, 528, 544, 413, 414, 440, 443, 444, 455, 456, 459, 478, 482, 498, 499, 514, 515, 524, 531, 578, 609);
    $barcos = array(430, 446, 452, 453, 454, 472, 473, 484, 493, 595);
    if(in_array($veh, $motos)) return 1;
    else if(in_array($veh, $helicopteros)) return 2;
    else if(in_array($veh, $avioes)) return 3;
    else if(in_array($veh, $caminhoes)) return 4;
    else if(in_array($veh, $barcos)) return 5;
    else return 0;
}

$vehicleColors = array(
    // The existing colours from San Andreas
    "000000", "F5F5F5", "2A77A1", "840410", "263739", "86446E", "D78E10", "4C75B7", "BDBEC6", "5E7072",
    "46597A", "656A79", "5D7E8D", "58595A", "D6DAD6", "9CA1A3", "335F3F", "730E1A", "7B0A2A", "9F9D94",
    "3B4E78","732E3E","691E3B","96918C","515459","3F3E45","A5A9A7","635C5A","3D4A68","979592",
    "421F21","5F272B","8494AB","767B7C","646464","5A5752","252527","2D3A35","93A396","6D7A88",
    "221918","6F675F","7C1C2A","5F0A15","193826","5D1B20","9D9872","7A7560","989586", "ADB0B0",
    "848988", "304F45", "4D6268", "162248", "272F4B", "7D6256", "9EA4AB", "9C8D71", "6D1822", "4E6881",
    "9C9C98", "917347", "661C26", "949D9F", "A4A7A5", "8E8C46", "341A1E", "6A7A8C", "AAAD8E", "AB988F",
    "851F2E", "6F8297", "585853", "9AA790", "601A23", "20202C", "A4A096", "AA9D84", "78222B", "0E316D",
    "722A3F", "7B715E", "741D28", "1E2E32", "4D322F", "7C1B44", "2E5B20", "395A83", "6D2837", "A7A28F",
    "AFB1B1", "364155", "6D6C6E", "0F6A89", "204B6B", "2B3E57", "9B9F9D", "6C8495", "4D8495", "AE9B7F",
    "406C8F", "1F253B", "AB9276", "134573", "96816C", "64686A", "105082", "A19983", "385694", "525661",
    "7F6956", "8C929A", "596E87", "473532", "44624F", "730A27", "223457", "640D1B", "A3ADC6", "695853",
    "9B8B80", "620B1C", "5B5D5E", "624428", "731827", "1B376D", "EC6AAE", "000000",
    // SA-MP extended colours (0.3x)
    "177517", "210606", "125478", "452A0D", "571E1E", "010701", "25225A", "2C89AA", "8A4DBD", "35963A",
    "B7B7B7", "464C8D", "84888C", "817867", "817A26", "6A506F", "583E6F", "8CB972", "824F78", "6D276A",
    "1E1D13", "1E1306", "1F2518", "2C4531", "1E4C99", "2E5F43", "1E9948", "1E9999", "999976", "7C8499",
    "992E1E", "2C1E08", "142407", "993E4D", "1E4C99", "198181", "1A292A", "16616F", "1B6687", "6C3F99",
    "481A0E", "7A7399", "746D99", "53387E", "222407", "3E190C", "46210E", "991E1E", "8D4C8D", "805B80",
    "7B3E7E", "3C1737", "733517", "781818", "83341A", "8E2F1C", "7E3E53", "7C6D7C", "020C02", "072407",
    "163012", "16301B", "642B4F", "368452", "999590", "818D96", "99991E", "7F994C", "839292", "788222",
    "2B3C99", "3A3A0B", "8A794E", "0E1F49", "15371C", "15273A", "375775", "060820", "071326", "20394B",
    "2C5089", "15426C", "103250", "241663", "692015", "8C8D94", "516013", "090F02", "8C573A", "52888E",
    "995C52", "99581E", "993A63", "998F4E", "99311E", "0D1842", "521E1E", "42420D", "4C991E", "082A1D",
    "96821D", "197F19", "3B141F", "745217", "893F8D", "7E1A6C", "0B370B", "27450D", "071F24", "784573",
    "8A653A", "732617", "319490", "56941D", "59163D", "1B8A2F", "38160B", "041804", "355D8E", "2E3F5B",
    "561A28", "4E0E27", "706C67", "3B3E42", "2E2D33", "7B7E7D", "4A4442", "28344E"
);

function converterSegundos($segundos) {
    $horas = floor($segundos / 3600);
    $segundos %= 3600;
    $minutos = floor($segundos / 60);
    $segundos %= 60;
    
    return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
}

?>