<?php

/**
 * BasesfGuardUserGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $group_id
 * @property sfGuardUser $sfGuardUser
 * @property sfGuardGroup $sfGuardGroup
 * 
 * @method integer          getUserId()       Returns the current record's "user_id" value
 * @method integer          getGroupId()      Returns the current record's "group_id" value
 * @method sfGuardUser      getSfGuardUser()  Returns the current record's "sfGuardUser" value
 * @method sfGuardGroup     getSfGuardGroup() Returns the current record's "sfGuardGroup" value
 * @method sfGuardUserGroup setUserId()       Sets the current record's "user_id" value
 * @method sfGuardUserGroup setGroupId()      Sets the current record's "group_id" value
 * @method sfGuardUserGroup setSfGuardUser()  Sets the current record's "sfGuardUser" value
 * @method sfGuardUserGroup setSfGuardGroup() Sets the current record's "sfGuardGroup" value
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardUserGroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user_group');
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('group_id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'length' => 4,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardGroup', array(
             'local' => 'group_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}