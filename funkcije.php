<?php

function getElem($node, $elementName){
	return $node->getElementsByTagName($elementName)->item(0)->nodeValue;
}


function getAttr($node, $elementName, $attributeName){
	return $node->getElementsByTagName($elementName)->item(0)->getAttribute($attributeName);
}

function toUpperCase($string) {
	return	"translate(" . $string . ",  'abcdefghijklljmnnjopqrstuvwxyzšđčćž', 'ABCDEFGHIJKLLJMNNJOPQRSTUVWXYZŠĐČĆŽ')";
}

function filter() {
	$query = array();

	if (!empty($_REQUEST['naziv'])) {
		$query[] = 'contains(' . toUpperCase('naziv') . ', "' . mb_strtoupper($_REQUEST['naziv'], "UTF-8") . '")';
	}

	$sportQuery = array();
	if(!empty($_REQUEST['tip'])) {
		$sportQuery[] = '@tip="' . $_REQUEST['tip'] . '"';
	}

	if(!empty($_REQUEST['olimpijski'])) {
		$sportQuery[] = '@olimpijski="' . $_REQUEST['olimpijski'] . '"';
	}

	$karateQuery = array();
	if(!empty($_REQUEST['stil_karatea'])) {
		foreach ($_REQUEST['stil_karatea'] as $stil)
			{
				$karateQuery[] = '@stil_karatea="' . $stil . '"';
			}
		if(!empty($karateQuery)){
			$sportQuery[] = implode(" or ", $karateQuery);
		}
	}

	if(!empty($sportQuery)) {
		$query[] = 'sport[' . implode(' and ', $sportQuery) . ']';
	}

	if (!empty($_REQUEST['sport'])) {
		$query[] = 'contains(' . toUpperCase('sport') . ', "' . mb_strtoupper($_REQUEST['sport'], "UTF-8") . '")';
	}

	if (!empty($_REQUEST['email'])){
		$query[] = 'contains(' . toUpperCase('email') . ', "' . mb_strtoupper($_REQUEST['email'], "UTF-8") . '")';
	}

	if (!empty($_REQUEST['adresa'])){
		$query[] = 'contains(' . toUpperCase('mjesto') . ', "' . mb_strtoupper($_REQUEST['adresa'], "UTF-8") . '")';
	}

	$trenerQuery = array();
	if(!empty($_REQUEST['ime'])) {
		$trenerQuery[] = 'contains(' . toUpperCase('ime') . ', "' . mb_strtoupper($_REQUEST['ime'], "UTF-8") . '")';
	}
	if(!empty($_REQUEST['prezime'])) {
		$trenerQuery[] = 'contains(' . toUpperCase('prezime') . ', "' . mb_strtoupper($_REQUEST['prezime'], "UTF-8") . '")';
	}

	if(!empty($trenerQuery)) {
		$query[] = 'treneri/trener[' . implode(' and ', $trenerQuery) . ']';
	}

	if(!empty($_REQUEST['clanarina'])) {
		if($_REQUEST['clanarina'] == "lt100") {
			$query[] = 'clanarina<100';
		}
		elseif ($_REQUEST['clanarina'] == "gt100lt200") {
			$query[] = 'clanarina>=100 and clanarina<200';
		}
		elseif ($_REQUEST['clanarina'] == "gt200lt300") {
			$query[] = 'clanarina>=200 and clanarina<300';
		}
		elseif ($_REQUEST['clanarina'] == "gt300") {
			$query[] = 'clanarina>=300';
		}
	}


	$xpathQuery = implode(" and ", $query);
	

	if(empty($xpathQuery)){
		return "/klubovi/klub";
	}

	else{
		return "/klubovi/klub[" . $xpathQuery . "]";
	}
}
?>