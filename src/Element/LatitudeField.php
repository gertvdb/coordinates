<?php

namespace Drupal\coordinates\Element;

use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Form\FormStateInterface;
use Drupal\coordinates\Utility\CoordinateValidator;
use Drupal\Core\Render\Element;

/**
 * Provides a text field form element for latitude.
 *
 * Usage example:
 * @code
 *
 * $coordinate = new Coordinate(37.419857, -122.078827);
 * $form['latitude'] = array(
 *   '#type' => 'latitude',
 *   '#title' => $this->t('Latitude'),
 *   '#default_value' => $coordinate->getLatitude(),
 *   '#required' => TRUE,
 * );
 * @endcode
 *
 * @FormElement("latitude")
 */
class LatitudeField extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $class = get_class($this);
    return [
      '#input' => TRUE,
      '#size' => 60,
      '#maxlength' => 128,
      '#process' => [
        [$class, 'processAjaxForm'],
        [$class, 'processPattern'],
        [$class, 'processGroup'],
      ],
      '#pre_render' => [
        [$class, 'preRenderLatitudeField'],
        [$class, 'preRenderGroup'],
      ],
      '#theme' => 'latitude',
      '#theme_wrappers' => ['form_element'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function valueCallback(&$element, $input, FormStateInterface $formState) {
    if ($input !== FALSE && $input !== NULL) {
      if (CoordinateValidator::isValidLatitude($input)) {
        return (float) $input;
      }
    }

    return NULL;
  }

  /**
   * Prepares a #type 'latitude' render element for latitude.html.twig.
   *
   * @param array $element
   *   An associative array containing the properties of the element.
   *   Properties used: #title, #value, #description,
   *   #placeholder, #required, #attributes.
   *
   * @return array
   *   The $element with prepared variables ready for latitude.html.twig.
   */
  public static function preRenderLatitudeField(array $element) {
    $element['#attributes']['type'] = 'text';
    Element::setAttributes($element, [
      'id',
      'name',
      'value',
      'size',
      'maxlength',
      'placeholder',
    ]);
    static::setAttributes($element, ['form-text']);

    return $element;
  }

}
