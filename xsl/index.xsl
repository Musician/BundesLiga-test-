<?xml version="1.0" encoding="UTF-8"?>
 <!DOCTYPE xsl:stylesheet [
        <!ENTITY nbsp "<xsl:text disable-output-escaping='yes'>&amp;nbsp;</xsl:text>">
        <!ENTITY middot "<xsl:text disable-output-escaping='yes'>&amp;middot;</xsl:text>">
        <!ENTITY copy "<xsl:text disable-output-escaping='yes'>&amp;copy;</xsl:text>">
 ]>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:exslt="http://exslt.org/common" xmlns="http://www.w3.org/1999/xhtml" version="1.0">
<xsl:include href="default.xsl" />
  <xsl:output method="xml" media-type="text/html" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" cdata-section-elements="script style" indent="yes" encoding="UTF-8"/>
    <xsl:template name="content">

		<section id="header">
		<div class="header">
			<div class="left-half">
				<h2>Bundesliga</h2>
			</div>

			<div class="right-half">		
				<form name="search" method="post" id="searchform">
				<input type="text" name="search" id="searchstring" placeholder="Enter string for search">
				<button type="submit" class="search-button"></button>
				</input>
				<small>Hints: type team:Dortmund to see matches where Dortmund took place.</small>
				</form>
			</div>
		</div>
		</section>		
		
		<section id="current-match">
		<hr />
		<h3>Current Match:</h3>
		<div id="datatable" style="display: none">
			Results: <hr />

			<table id="resulttable" class="display" width="60%">

			</table>

		</div>
		
		</section>

    </xsl:template>
</xsl:stylesheet>