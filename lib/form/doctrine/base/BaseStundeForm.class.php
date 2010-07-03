<?php

/**
 * Stunde form base class.
 *
 * @method Stunde getObject() Returns the current form's model object
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStundeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'lnr'        => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'zim_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lnr'        => new sfValidatorInteger(),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'zim_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Stunde', 'column' => array('zim_id', 'lnr')))
    );

    $this->widgetSchema->setNameFormat('stunde[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stunde';
  }

}
