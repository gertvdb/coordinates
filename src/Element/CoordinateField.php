<?php

namespace Drupal\coordinates\Element;

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

  const PRESERVED_KEYS = [
    '#type'
  ];

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
      '#theme' => 'coordinate',
      '#theme_wrappers' => ['form_element'],
    ];
  }

  /**
   * Form element validation handler for #type 'coordinate'.
   *
   * Note that #maxlength and #required is validated by _
   * form_validate() already.
   *
   * @param $element
   *   The element
   * @param \Drupal\Core\Form\FormStateInterface $formState
   *   The form state
   * @param $completeForm
   *   The form
   *
   * @SuppressWarnings(PHPMD)
   */
  public static function validateCoordinate(&$element, FormStateInterface $formState, &$completeForm) {
    $value = $element['#value'];

    $latValue = isset($value['latitude']) ? $value['latitude'] : NULL;
    $lonValue = isset($value['longitude']) ? $value['longitude'] : NULL;

    if ($latValue && !$lonValue) {
      $formState->setError($element['longitude'], t('When latitude value is provided, you also need to provide a longitude value.'));
    }

    if ($lonValue && !$latValue) {
      $formState->setError($element['latitude'], t('When longitude value is provided, you also need to provide a latitude value.'));
    }

    if ($latValue && !CoordinateValidator::isValidLatitude($latValue)) {
      $formState->setError($element['latitude'], t('The latitude is invalid.'));
    }

    if ($lonValue && !CoordinateValidator::isValidLongitude($lonValue)) {
      $formState->setError($element['longitude'], t('The longitude is invalid.'));
    }
  }

  /**
   * Processes a coordinate form element.
   *
   * @param $element
   *   The element
   * @param \Drupal\Core\Form\FormStateInterface $formState
   *   The form state
   * @param $completeForm
   *   The form
   *
   * @return array
   *   The processed element
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

    // Define keys we don't want the user to be able to override.
    $preservedKeys = self::PRESERVED_KEYS;

    // Override child element.
    if (isset($element['#latitude'])) {

      // Remove preserved keys from override to prevent errors.
      $element['#latitude'] = array_filter($element['#latitude'], function($key) use ($preservedKeys){
        return !in_array($key, $preservedKeys);
      }, ARRAY_FILTER_USE_KEY);

      // Set the new latitude element.
      $element['latitude'] = array_merge($element['latitude'], $element['#latitude']);
    }

    // Override child element.
    if (isset($element['#longitude'])) {

      // Remove preserved keys from override to prevent errors.
      $element['#longitude'] = array_filter($element['#longitude'], function($key) use ($preservedKeys){
        return !in_array($key, $preservedKeys);
      }, ARRAY_FILTER_USE_KEY);

      // Set the new longitude element.
      $element['longitude'] = array_merge($element['longitude'], $element['#longitude']);
    }

    return $element;
  }

}
