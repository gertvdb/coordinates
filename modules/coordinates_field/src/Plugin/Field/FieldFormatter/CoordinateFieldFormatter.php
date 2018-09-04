<?php

namespace Drupal\coordinates_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\coordinates\Formatter\CoordinateFormatter;

/**
 * Default formatter for coordinates.
 *
 * @FieldFormatter(
 *   id = "coordinate_default",
 *   label = @Translation("Coordinate"),
 *   field_types = {
 *     "coordinate"
 *   }
 * )
 */
class CoordinateFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      if (!empty($item->value)) {
        /** @var \Drupal\coordinates\CoordinateInterface $coordinate */
        $coordinate = $item->value;
        $coordinateFormatter = new CoordinateFormatter();
        $elements[$delta] = $coordinateFormatter->format($coordinate, '%lat - %lon');
      }
    }

    return $elements;
  }

}
