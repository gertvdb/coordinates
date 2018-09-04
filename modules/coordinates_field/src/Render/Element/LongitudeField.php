<?php

namespace Drupal\coordinates\Render\Element;

use Drupal\Core\Render\Element\Textfield;

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
 * @see \Drupal\Core\Render\Element\Textfield
 *
 * @FormElement("latitude")
 */
class LongitudeField extends Textfield {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $info = parent::getInfo();
    $info['#theme'] = 'input__longitude';
  }

}
