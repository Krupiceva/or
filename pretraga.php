<?php
	error_reporting (E_ALL);
	include_once ('funkcije.php');
	
	$dom = new DOMDocument();
  	$dom->load('podaci.xml');

  	$xp = new DOMXPath($dom);

  	$filter = filter();
  	$queryResult = $xp->query($filter);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Klubovi borilačkih sportova u Hrvatskoj</title>
		<link rel="stylesheet" type="text/css" href="dizajn.css" />	
	</head>	
	<body>
		<div class="main_container">
			<header class="zoom_in">
				<a href="index.html">
				<img class="main_img" src="images/main_img_2.jpg" alt="header image" />
				<div id="header_text">Klubovi borilačkih sportova u Hrvatskoj</div>
				</a>
			</header>
			<nav class="zoom_in">
				<img id="logo_img" src="images/muay_thai_logo.png" alt="muay thai logo" />
				<ul>
					 <li><a href="index.html">Početna</a></li>
					 <li><a href="obrazac.html">Pretraživanje</a></li>
					 <li><a href="podaci.xml">Klubovi</a></li>
					 <li><a href="http://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
					 <li><a href="http://www.fer.unizg.hr/" target="_blank">FER</a></li>
					 <li><a href="mailto:dora.mlinaric@fer.hr">Kontakt</a></li>
				</ul>
			</nav>
			<main>
				<section class="zoom_in">
					<h2>Rezultat pretrage</h2>
				</section>
				<section class="zoom_in">
					<table class="main_table">
						<tr>
							<th>Naziv Kluba</th>
							<th>Sport</th>
							<th>Vrsta</th>
							<th>Treneri</th>
							<th>Kontakt</th>
							<th>Članarina</th>
						</tr>
						<?php
							foreach ($queryResult as $element) {
						?>
						<tr>
							<td><?php echo getElem($element, "naziv"); ?></td>
							<td><?php
							 	$sport = getElem($element, "sport"); 
							 	if($sport == "Karate") {
							 		$stil = getAttr($element, "sport", "stil_karatea");
							 		echo $stil . ' ' . $sport;
							 	}
							 	else {
							 		echo $sport;
							 	}
							 ?></td>
							<td><?php
								$tip = getAttr($element, "sport", "tip"); 
								if($tip == "Udaracki") {
									echo "Udarački";
								}
								elseif($tip == "Hrvacki") {
									echo "Hrvački";
								}
							?></td>
							<td><?php
								foreach($element->getElementsByTagName("trener") as $elem) {
									echo $elem->nodeValue; ?><br>
								<?php
									}
								?>
							</td>
							<td><?php 
									foreach($element->getElementsByTagName("email") as $elem) {
									echo $elem->nodeValue; ?><br>
								<?php	
									}
								?>
								<br>
								<?php
									foreach($element->getElementsByTagName("telefon") as $elem) {
									echo ($elem->getElementsByTagName("broj")->item(0)->getAttribute("pozivni_broj") . $elem->nodeValue); ?><br>
								<?php	
									}
								?>
								<br>
								<?php
									foreach($element->getElementsByTagName("adresa") as $elem) {
										$ulica = getElem($elem, "ulica");
										$kucni_broj = getElem($elem, "kucni_broj");
										$mjesto = getElem($elem, "mjesto");
										$post_broj = getAttr($elem, "mjesto", "post_broj");
										echo "$ulica $kucni_broj, $post_broj $mjesto";
									?><br>
								<?php	
									}
								?>
							</td>
							<td><?php echo (getElem($element, "clanarina") . 'kn') ?></td>
						</tr>
        				<?php
							}
						?>	
					</table>
				</section>
			</main>
			<footer>
				<p>&#169;Dora Mlinarić - Otvoreno računarstvo 2017/18</p>
			</footer>
		</div>
	</body>
</html>