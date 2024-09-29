<?php
namespace model;

require_once 'CalculDistance.php';

class CalculDistanceImpl implements CalculDistance
{
    /**
     * Calcule la distance entre deux coordonnées GPS en utilisant la formule de Haversine.
     * @param float $lat1 Latitude du premier point en degrés.
     * @param float $long1 Longitude du premier point en degrés.
     * @param float $lat2 Latitude du deuxième point en degrés.
     * @param float $long2 Longitude du deuxième point en degrés.
     * @return float Distance entre les deux points en mètres.
     */
    public function calculDistance2PointsGPS(float $lat1, float $long1, float $lat2, float $long2): float
    {
        $R = 6378137; // Rayon de la Terre en mètres

        // Conversion des degrés en radians
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $long1 = deg2rad($long1);
        $long2 = deg2rad($long2);

        // Application de la formule de Haversine
        $d = $R * acos(sin($lat2) * sin($lat1) + cos($lat2) * cos($lat1) * cos($long2 - $long1));

        return $d;
    }

    /**
     * Calcule la distance totale d'un trajet basé sur un tableau de coordonnées GPS.
     * @param array $parcours Liste de tableaux avec des clés 'latitude' et 'longitude' représentant le trajet.
     * @return float Distance totale du trajet en mètres.
     */
    public function calculDistanceTrajet(array $parcours): float
    {
        $totalDistance = 0;

        // Calcul de la distance totale entre chaque paire de points consécutifs
        for ($i = 0; $i < count($parcours) - 1; $i++) {
            $point1 = $parcours[$i];
            $point2 = $parcours[$i + 1];

            $distance = $this->calculDistance2PointsGPS(
                $point1['latitude'],
                $point1['longitude'],
                $point2['latitude'],
                $point2['longitude']
            );

            $totalDistance += $distance;
        }

        return $totalDistance;
    }
}

