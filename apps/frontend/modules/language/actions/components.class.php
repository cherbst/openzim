<?php

class languageComponents extends sfComponents
{
  public function executeLanguage(sfWebRequest $request)
  {
    $this->form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'de', 'fr'))
    );
    $this->form->getWidgetSchema()->setLabel('language', __(' '));
    $this->form->getWidgetSchema()->setDefaultFormFormatterName('list');
  }
}

?>
