<?php

declare(strict_types = 1);

namespace Drupal\coordinates_field\Plugin\Field\FieldWidget;

use Drupal\coordinates\CoordinateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\WidgetBase;

/**
 * Default widget for coordinates.
 *
 * @FieldWidget(
 *   id = "coordinate_default",
 *   label = @Translation("Coordinate"),
 *   field_types = {
 *     "coordinate"
 *   }
 * )
 */
class CoordinateFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $formState) {
    /** @var \Drupal\coordinates\Coordinate|null $value */
    $value = isset($items[$delta]->value) && $items[$delta]->value instanceof CoordinateInterface ? $items[$delta]->value : NULL;

    $element += [
      '#title' => $this->t('Coodinates'),
      '#type' => 'coordinate',
      '#default_value' => $value ? $value->toArray() : NULL,
    ];

    return $element;
  }

}
