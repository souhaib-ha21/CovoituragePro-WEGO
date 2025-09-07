<?php
include_once "../Connexion/connexion.php";
include_once "../Model/Trajet.php";
session_start();

if (!isset($_GET['trajet_id'])) {
    die("ID du trajet manquant.");
}

$id = intval($_GET['trajet_id']);
$trajet = Trajet::getTrajetById($id);

// if (!$trajet) {
//     die("Trajet introuvable.");
// }

$city1 = $trajet['depart'];
$city2 = $trajet['arrivee'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route between Cities</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.1/dist/leaflet-routing-machine.css" />
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS -->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.1/dist/leaflet-routing-machine.js"></script>
    
    <script>
        let map = L.map('map').setView([51.505, -0.09], 2); // Default to world view

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let control;

        // Define the cities from PHP variables
        const city1 = "<?php echo $city1; ?>";
        const city2 = "<?php echo $city2; ?>";

        // Geocode city names to coordinates
        fetch(`https://nominatim.openstreetmap.org/search?city=${city1}&format=json`)
            .then(response => response.json())
            .then(data1 => {
                const lat1 = parseFloat(data1[0].lat);
                const lon1 = parseFloat(data1[0].lon);

                fetch(`https://nominatim.openstreetmap.org/search?city=${city2}&format=json`)
                    .then(response => response.json())
                    .then(data2 => {
                        const lat2 = parseFloat(data2[0].lat);
                        const lon2 = parseFloat(data2[0].lon);

                        // If route control exists, remove it
                        if (control) {
                            control.remove();
                        }

                        // Add routing control
                        control = L.Routing.control({
                            waypoints: [
                                L.latLng(lat1, lon1),
                                L.latLng(lat2, lon2)
                            ],
                            routeWhileDragging: true
                        }).addTo(map);

                        map.fitBounds(control.getBounds()); // Adjust the map to show the full route
                    });
            });
    </script>
</body>
</html>
