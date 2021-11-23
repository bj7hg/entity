<?php

namespace Drupal\rgb\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a rgb entity.
 *
 * @ingroup rgb
 */
class EntityDeleteForm extends ContentEntityConfirmFormBase {

  /**
   * Returns the question to ask the user.
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete review?');
  }

  /**
   * Returns the route to go to if user cancels the action.
   */
  public function getCancelUrl() {
    return new Url('rgb');
  }

  /**
   * Text confirm.
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * We delete our review when confirming the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $entity->delete();
    $form_state->setRedirect('rgb');
  }

}
