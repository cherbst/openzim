<?php
class htmlConverter {

	private $isZimInput;

	public function __construct($input=false) {
		$this->isZimInput = $input;
	}

	public function getIsZimInput() {
		return $this->isZimInput;
	}	

	public function convertFromArray($array,$text) {
		return str_replace(array_keys($array), array_values($array), $text);
        }

	public function getODF($text) {
        
		$styles['anlage']['bold'] = "T5";
		$styles['anlage']['italic'] = "T1";
		$styles['anlage']['underline'] = "T13";
		$styles['zim']['bold'] = "T10";
		$styles['zim']['italic'] = "T12";
		$styles['zim']['underline'] = "T11";
	
		if( $this->getIsZimInput()) 
			$styles = $styles['zim'];
		else
			$styles = $styles['anlage'];

		$styleArray = array(
			  '<strong>'  => '<text:span text:style-name="'.$styles['bold'].'">',
                          '</strong>' => '</text:span>',
                          '<em>'      => '<text:span text:style-name="'.$styles['italic'].'">',
                          '</em>'     => '</text:span>',
		);
		$pregArray = array(
			  '#<span style="text-decoration: underline;">(.*)</span>#U' => 
			  '<text:span text:style-name="'.$styles['underline'].'">$1</text:span>'
		);

		// 1. convert styles special to template
                $result = $this->convertFromArray($styleArray,$text);	
		// 2. convert regular expressions
		$result = preg_replace(array_keys($pregArray), array_values($pregArray), $result);
		// 3. remove all but the odf tags
		$result = strip_tags($result, '<text:span>');
		return $result;
	}

}
?>
