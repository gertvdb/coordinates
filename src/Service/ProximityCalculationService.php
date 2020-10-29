<?php

namespace Drupal\coordinates\Service;

/**
 * ProximityCalculationService.
 */
class ProximityCalculationService
{

    /**
     * Calculate latitude sinus.
     *
     * @param float $latitude
     *   The latitude.
     *
     * @return float
     *   The latitude sinus.
     */
    public function calcLatitudeSinus($latitude) {
        return sin(deg2rad(trim($latitude)));
    }

    /**
     * Calculate latitude Cosinus.
     *
     * @param float $latitude
     *   The latitude.
     *
     * @return float
     *   The latitude cosinus.
     */
    public function calcLatitudeCosinus($latitude) {
        return cos(deg2rad(trim($latitude)));
    }

    /**
     * Calculate longitude radius.
     *
     * @param float $latitude
     *
     * @return float
     */
    public function calcLongitudeRadius($latitude) {
        return deg2rad(trim($latitude));
    }

}
