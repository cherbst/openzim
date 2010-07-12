<?php

require_once(dirname(__FILE__).'/../../odtphp/library/odf.php');
require_once(dirname(__FILE__).'/../../htmlconverter/library/htmlConverter.php');

/**
 * Zim
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    openZIM
 * @subpackage model
 * @author     Christoph Herbst
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Zim extends BaseZim
{
	public function getStunden()
	{
		return StundeTable::getStundenSorted($this->getId());
	}

        public function generateOdf()
	{
		$odf = new odf(dirname(__FILE__).'/../../odftmp/Zim_template.odt');
		$htmlConverter = new htmlConverter(true);
		$odf->setVars('nameZim',$this->getName(),true,'UTF-8');
		$odf->setVars('zieleZim',$htmlConverter->getODF($this->getZiele()),false,'UTF-8');
		$odf->setVars('zielGruppe',$htmlConverter->getODF($this->getZielGruppe()),false,'UTF-8');
		$odf->setVars('roterFaden',$htmlConverter->getODF($this->getRoterFaden()),false,'UTF-8');
		$koffer = $odf->setSegment('koffer');
		foreach($this->getStunden() AS $stunde) {
			foreach($stunde->getAnlagen() AS $anlage) {
			    $koffer->kuerzel($anlage->getKuerzel());
			    $koffer->lnr($anlage->getLnrStr());
			    $koffer->setVars('kofferInhalt',$htmlConverter->getODF($anlage->getKofferInfo()),false,'UTF-8');
			    $koffer->merge();
			}
		}
		$odf->mergeSegment($koffer);
		$stunden = $odf->setSegment('stunden');
		foreach($this->getStunden() AS $stunde) {
			$stunden->setVars('lnrStunde',$stunde->getLnr());
			$stunden->setVars('nameStunde',$stunde->getName(),true,'UTF-8');
			foreach($stunde->getAnlagen() AS $anlage) {
			    $stunden->anlagen->name($anlage->getName());
			    $stunden->anlagen->zeit($anlage->getZeit());
			    $stunden->anlagen->setVars('ziel',
				$htmlConverter->getODF($anlage->getZiel()), false,'UTF-8');
			    $stunden->anlagen->setVars('kurzinhalt',
				$htmlConverter->getODF($anlage->getKurzinhalt()), false,'UTF-8');
			    $stunden->anlagen->setVars('methode',
				$htmlConverter->getODF($anlage->getMethode()), false,'UTF-8');
			    $stunden->anlagen->setVars('rolletm',
				$htmlConverter->getODF($anlage->getRolleTm()), false,'UTF-8');
			    $stunden->anlagen->name2($anlage->getName());
			    $stunden->anlagen->setVars('material',
				$htmlConverter->getODF($anlage->getMaterial()), false,'UTF-8');
			    $stunden->anlagen->merge();
			}
			$stunden->merge();
		}
		$odf->mergeSegment($stunden);
		$odf->exportAsAttachedFile ('neuesZim.odt');  
        }
}
