<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageAdminEditForm extends AnlageForm
{
  public function configure()
  {
    parent::configure();
    $this->useFields(array('kuerzel', 'lnr'));
  }
}
