<?php

namespace Drupal\coordinates\Plugin\Field\FieldFormatter;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\coordinates\Formatter\CoordinateFormatter;
use Drupal\coordinates\CoordinateInterface;

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
      if ($item->value && $item->value instanceof CoordinateInterface) {

        /** @var \Drupal\coordinates\CoordinateInterface $coordinate */
        $coordinate = $item->value;
        $coordinateFormatter = new CoordinateFormatter();
        $elements[$delta] = ['#markup' => $coordinateFormatter->format($coordinate, '%lat, %lng')];
      }
    }

    return $elements;
  }

}
