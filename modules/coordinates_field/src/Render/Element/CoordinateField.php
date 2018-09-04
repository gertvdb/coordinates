<?php

namespace Drupal\coordinates\Render\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;
use Drupal\coordinates\Utility\CoordinateValidator;

/**
 * Provides a coordinate form element.
 *
 * Usage example:
 * @code
 *
 * $coordinate = new Coordinate(37.419857, -122.078827);
 *
 * $form['coordinate'] = array(
 *   '#type' => 'coordinate',
 *   '#title' => $this->t('Coodinates'),
 *   '#default_value' => $coordinate->toArray(),
 *   '#required' => TRUE,
 *   '#latitude' => [
 *      '#description' => $this->t('Extra description for latitude'),
 *      '#attributes' => ['class' => ['extra-class']],
 *   ],
 * );
 * @endcode
 *
 * @FormElement("coordinate")
 */
class CoordinateField extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#process' => [
        [$class, 'processCoordinate'],
      ],
      '#element_validate' => [
        [$class, 'validateCoordinate'],
      ],
      '#theme_wrappers' => ['form_element'],
    ];
  }

  /**
   * Form element validation handler for #type 'coordinate'.
   *
   * Note that #maxlength and #required is validated by _
   * form_validate() already.
   *
   * @SuppressWarnings(PHPMD)
   */
  public static function validateCoordinate(&$element, FormStateInterface $formState, &$completeForm) {
    $value = $element['#value'];

    $latValue = isset($value['latitude']) ? $value['latitude'] : NULL;
    $lonValue = isset($value['longitude']) ? $value['longitude'] : NULL;

    if ($latValue && !CoordinateValidator::isValidLatitude($latValue, FALSE)) {
      $formState->setError($element['latitude'], t('The latitude is invalid.'));
    }

    if ($lonValue && !CoordinateValidator::isValidLongitude($lonValue, FALSE)) {
      $formState->setError($element['longitude'], t('The longitude is invalid.'));
    }
  }

  /**
   * Processes a coordinate form element.
   *
   * @SuppressWarnings(PHPMD)
   */
  public static function processCoordinate(&$element, FormStateInterface $formState, &$completeForm) {
    $element['#tree'] = TRUE;

    $element['latitude'] = [
      '#type' => 'latitude',
      '#title' => t('latitude'),
      '#default_value' => isset($element['#default_value']['latitude']) ? $element['#default_value']['latitude'] : NULL,
    ];

    $element['longitude'] = [
      '#type' => 'longitude',
      '#title' => t('longitude'),
      '#default_value' => isset($element['#default_value']['longitude']) ? $element['#default_value']['longitude'] : NULL,
    ];

    // Override child element.
    if (isset($element['#latitude'])) {
      $element['latitude'] = array_merge($element['latitude'], $element['#latitude']);
    }

    // Override child element.
    if (isset($element['#longitude'])) {
      $element['longitude'] = array_merge($element['longitude'], $element['#longitude']);
    }

    return $element;
  }

}
