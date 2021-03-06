<?php

/**
 * BaseBild
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $lnr
 * @property string $name
 * @property string $path
 * @property string $caption
 * @property integer $anlage_id
 * @property Anlage $Anlage
 * 
 * @method integer getLnr()       Returns the current record's "lnr" value
 * @method string  getName()      Returns the current record's "name" value
 * @method string  getPath()      Returns the current record's "path" value
 * @method string  getCaption()   Returns the current record's "caption" value
 * @method integer getAnlageId()  Returns the current record's "anlage_id" value
 * @method Anlage  getAnlage()    Returns the current record's "Anlage" value
 * @method Bild    setLnr()       Sets the current record's "lnr" value
 * @method Bild    setName()      Sets the current record's "name" value
 * @method Bild    setPath()      Sets the current record's "path" value
 * @method Bild    setCaption()   Sets the current record's "caption" value
 * @method Bild    setAnlageId()  Sets the current record's "anlage_id" value
 * @method Bild    setAnlage()    Sets the current record's "Anlage" value
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBild extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bild');
        $this->hasColumn('lnr', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('path', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('caption', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('anlage_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));


        $this->index('anlage_lnr', array(
             'fields' => 
             array(
              0 => 'anlage_id',
              1 => 'lnr',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Anlage', array(
             'local' => 'anlage_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}