<?php

/**
 * Anhang
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Christoph Herbst
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Anhang extends BaseAnhang
{
	public function save(Doctrine_Connection $conn = null)
	{
		if ( !$this->getPath() ) {
			$this->delete();
		}
		else {
			$ret = parent::save($conn);
			return $ret;
		}
	}  
}
