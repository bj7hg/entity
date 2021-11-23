<?php

namespace Drupal\rgb\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * @ContentEntityType(
 *   id = "rgb",
 *   label = @Translation("Rgb"),
 *   base_table = "rgb",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *   "canonical" = "/rgb/{rgb}",
 *   "delete" = "/rgb/{rgb}/delete",
 *   "edit" = "/rgb/{rgb}/edit",
 *   },
 *   handlers = {
 *    "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\rgb\Controller\EntityController",
 *     "views_data" = "Drupal\Core\Views\EntityViewsData",
 *   "form" = {
 *       "default" = "Drupal\rgb\Form\EntityForm",
 *       "delete" = "Drupal\rgb\Form\EntityDeleteForm",
 *     },
 *   "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 * )
 */
class RgbEntity extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */

  /**
   * Make fields for my entity.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of ContentEntityExample entity.'));
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('id'))
      ->setDescription(t('id'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('uuid'))
      ->setReadOnly(TRUE);
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setSetting('max_length', 100)
      ->setRequired(TRUE)
      ->setDefaultValue(NULL)
      ->setPropertyConstraints('value', [
        'Length' => [
          'min' => 2,
          'minMessage' => 'You name must be longer than 2 symbols',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 10,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 10,
        'settings' => [
          'placeholder' => 'Only latin',
        ],
      ]);
    $fields['email'] = BaseFieldDefinition::create('email')
      ->setLabel(t('Email'))
      ->setSetting('max_length', 100)
      ->setDefaultValue(NULL)
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 10,
      ])
      ->setDisplayOptions('form', [
        'weight' => 10,
        'settings' => [
          'placeholder' => 'example@gmail.com',
        ],
      ]);
    $fields['phone'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Phone number'))
      ->setSetting('max_length', 12)
      ->setRequired(TRUE)
      ->setPropertyConstraints('value', [
        'Regex' => [
          'pattern' => '/^[0-9]{12}$/',
          'message' => t('Format:380123456789'),
        ],
      ]
      )
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 10,
      ])
      ->setDisplayOptions('form', [
        'weight' => 10,
        'settings' => [
          'placeholder' => '380731234567',
        ],
      ]);
    $fields['review'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Review'))
      ->setRequired(TRUE)
      ->setDefaultValue(NULL)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'weight' => 10,
      ])
      ->setDisplayOptions('form', [
        'weight' => 10,
        'settings' => [
          'placeholder' => 'Message',
        ],
      ]);
    $fields['avatar'] = BaseFieldDefinition::create('image')
      ->setLabel(t('User photo'))
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'public://images/',
        'max_filesize' => 2097152,
        'alt_field' => FALSE,
      ])
      ->setDefaultValue(NULL)
      ->setDisplayOptions('form', [
        'type' => 'image',
        'label' => 'hidden',
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'image',
      ]);
    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Review photo'))
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'file_directory' => 'public://images/',
        'max_filesize' => 5242880,
        'alt_field' => FALSE,
      ])
      ->setDisplayOptions('form', [
        'label' => 'hidden',
        'type' => 'image',
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'image',
      ]);
    $fields['date'] = BaseFieldDefinition::create('created')
      ->setLabel('Date')
      ->setSetting('data_format', 'm/j/Y H:i:s')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'datetime_custom',
        'settings' => [
          'data_format' => 'drupal_get_user_timezone()',
        ],
        'weight' => 70,
      ])
      ->setDisplayConfigurable('view', TRUE);
    return $fields;
  }

}
