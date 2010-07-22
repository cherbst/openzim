<?php

require_once(dirname(__FILE__).'/../../odtphp/library/odf.php');
require_once(dirname(__FILE__).'/../../htmlconverter/library/htmlConverter.php');

/**
 * Anlage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Anlage extends BaseAnlage
{
	public function getBilder()
	{
		return BildTable::getBilderSorted($this->getId());
	}

	public function save(Doctrine_Connection $conn = null)
	{  
		if ( $this->state() != self::STATE_DIRTY && !$this->isNew() )
			return;
		if ( $this->isNew() )
			$this->kuerzel = $this->getStunde()->getZim()->getPtKuerzel();
		$conn = $conn ? $conn : $this->getTable()->getConnection();
  		$conn->beginTransaction();
  		try
  		{
 			$ret = parent::save($conn);
 			$this->updateLuceneIndex();
     			$conn->commit();
 
    			return $ret;
  		}
  		catch (Exception $e)
  		{
    			$conn->rollBack();
    			throw $e;
  		}

	}

	public function delete(Doctrine_Connection $conn = null)
	{
  		$index = AnlageTable::getLuceneIndex();
 
  		foreach ($index->find('pk:'.$this->getId()) as $hit)
  		{
    			$index->delete($hit->id);
  		}
 
  		return parent::delete($conn);
	}

	public function ownedByUser($user){
		if ( !$this->getStunde() )
			return false;
		return $this->getStunde()->getZim()->getSfGuardUser()->getUsername() ==
			$user->getUsername();
	}
 
	public function getLnrStr()
    	{		
       		return sprintf('%02d',$this->getLnr());
    	}

	public function getName()
    	{		
       		return sprintf('%s%s',$this->getKuerzel(),$this->getLnrStr());
    	}

	public function updateLuceneIndex()
	{
  		$index = AnlageTable::getLuceneIndex();
 
  		// remove existing entries
  		foreach ($index->find('pk:'.$this->getId()) as $hit)
  		{
    			$index->delete($hit->id);
  		}
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
		    new Utf8NumSubstringAnalyzer());
  		$doc = new Zend_Search_Lucene_Document();
 
  		// store primary key to identify it in the search results
  		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
 
  		// index anlage fields
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('name', $this->getName(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('longname', $this->getLongname(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('ziel', $this->getZiel(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('kurzinhalt', $this->getKurzinhalt(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('methode', $this->getMethode(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('material', $this->getMaterial(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('tip', $this->getTip(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('rolletm', $this->getRolleTm(), 'utf-8'));
  		$doc->addField(Zend_Search_Lucene_Field::UnStored('inhalt', $this->getInhalt(), 'utf-8'));
 
  		// add anlage to the index
  		$index->addDocument($doc);
  		$index->commit();
	}
	
        public function generateOdf()
	{
		$encode = false;
		
		$htmlConverter = new htmlConverter();
		$convertedInhalt = $htmlConverter->getODF($this->getInhalt());	
		$convertedZiel = $htmlConverter->getODF($this->getZiel());
		$convertedMethode = $htmlConverter->getODF($this->getMethode());
		$convertedMaterial = $htmlConverter->getODF($this->getMaterial());
		$convertedTip = $htmlConverter->getODF($this->getTip());

		$odf = new odf(dirname(__FILE__).'/../../odftmp/Anlage_template.odt');
	   	$odf->setStyleVars('ptKuerzel', $this->getStunde()->getZim()->getPtKuerzel());
	   	$odf->setStyleVars('ptKuerzel1', $this->getStunde()->getZim()->getPtKuerzel());
	   	$odf->setStyleVars('ptJahr', $this->getStunde()->getZim()->getPtJahr());
	   	$odf->setStyleVars('stunde', $this->getStunde()->getLnr());
	   	$odf->setStyleVars('kuerzel', $this->getKuerzel());
	   	$odf->setStyleVars('lnr', $this->getLnrStr());
	   	$odf->setVars('longName', $this->getLongname(), $encode,'UTF-8');
	   	$odf->setVars('zeit', $this->getZeit());
		$odf->setVars('ziel', $convertedZiel, $encode,'UTF-8');
		$odf->setVars('tip', $convertedTip, $encode,'UTF-8');
		$odf->setVars('Inhalt', $convertedInhalt, $encode,'UTF-8');
		$odf->setVars('methode', $convertedMethode, $encode,'UTF-8');
		$odf->setVars('material', $convertedMaterial, $encode,'UTF-8');
 		$bilder = $odf->setSegment('bilder');
                foreach ( $this->getBilder() as $bild ){
                  $convertedCaption = $htmlConverter->getODF($bild->getCaption());
		  $bilder->setVars('titel', $convertedCaption, $encode, 'UTF-8');
    		  $bilder->setImage('bild', sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'bilder'.DIRECTORY_SEPARATOR.$bild->getPath());
		  $bilder->merge();
		}
		$odf->mergeSegment($bilder);
		$odf->exportAsAttachedFile ($this->getFilename().'_.odt');  

        }
	
	private function getFilename()
	{
		return $this->getLnrStr().'_'.$this->getKuerzel().'_Anlage_'.$this->getLongname();
	}

	public function __toString()
	{
		return $this->getName(). ($this->getLongname()?' -- '.$this->getLongname():'');
	}

}
