<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="xml" indent="yes" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"/>
    <xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="hr">

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
					<h2>Pregled klubova</h2>
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
						<xsl:for-each select="klubovi/klub">
							<tr>
								<td><xsl:value-of select="naziv"/></td>
								<td>
									<xsl:value-of select="sport/@stil_karatea"/>&#160;<xsl:value-of select="sport"/>
								</td>
								<td>
									<xsl:choose>
										<xsl:when test="*[contains(@tip, 'Udaracki')]">
											Udarački
										</xsl:when>
										<xsl:otherwise>
											Hrvački
										</xsl:otherwise>
									</xsl:choose>
								</td>
								<td>
									<xsl:for-each select="treneri/trener">
										<xsl:choose>
											<xsl:when test="glavni_trener">
												<strong><xsl:value-of  select="ime"/>&#160;
												<xsl:value-of  select="prezime"/></strong>
												<br/>
											</xsl:when>
											<xsl:otherwise>
												<xsl:value-of  select="ime"/>&#160;
												<xsl:value-of  select="prezime"/>
												<br/>
											</xsl:otherwise>
										</xsl:choose>
									</xsl:for-each>
								</td>
								<td>
									<xsl:for-each select="treneri/trener">
									<xsl:if test="glavni_trener">
									<br/>email:
									<xsl:element name="a">
    									<xsl:attribute name="href">
        									mailto:<xsl:value-of select="ime"/>.<xsl:value-of select="prezime"/>@gmail.com
    									</xsl:attribute>
    										Kontaktiraj nas!
									</xsl:element>
									</xsl:if>
									</xsl:for-each>
									<br/>
									<xsl:for-each select="telefon">
										<br/>tel: <xsl:value-of select="broj/@pozivni_broj"/><xsl:value-of select="broj"/>
									</xsl:for-each>
									<br/>
									<xsl:for-each select="adresa">
										<br/>adresa: <xsl:value-of select="ulica"/>&#160;<xsl:value-of select="kucni_broj"/>
										<br/><xsl:value-of select="mjesto/@post_broj"/>&#160;<xsl:value-of select="mjesto"/>
									</xsl:for-each>
								</td>
								<td><xsl:value-of select="clanarina"/>kn</td>
							</tr>
						</xsl:for-each>
					</table>
				</section>
			</main>
			<footer>
				<p>&#169;Dora Mlinarić - Otvoreno računarstvo 2017/18</p>
			</footer>
		</div>
	</body>
</html>
</xsl:template>
</xsl:stylesheet> 