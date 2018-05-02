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
				<select name="season" id="season">
				<option value="" disabled="disabled" selected="true">Season</option>
				<option value="2018">2018</option>
				<option value="2017">2017</option>
				<option value="2016">2016</option>
				<option value="2015">2015</option>
				<option value="2014">2014</option>
				</select>
				<input type="text" name="search" id="searchstring" placeholder="Enter string for search">
				<button type="submit" class="search-button"></button>
				</input>
				<small>Hints: type team:Dortmund to see matches where Dortmund took place.</small>
				</form>
			</div>
		</div>
		</section>		

		<section id="search_results">
		<hr />
		
		<div id="datatable" style="display: none">
			Results: <hr />

			<table id="resulttable" class="display" width="60%">

			</table>

		</div>
		
		</section>

		
		<section id="upcomming_events">
		<hr />
		<h3>Upcomming Events: <small>(point 1 from the task)</small></h3>
		    <xsl:for-each select="/root/upcomming_events/match">
		    	<div class="event-title"><xsl:value-of select="MatchDateTime"/></div>

		      	<img class="team-icon">
		      	<xsl:attribute name="src">
		      		<xsl:value-of select="Team1URL"/>
		      	</xsl:attribute>
		      	</img>&#160;
		      	<xsl:value-of select="Team1"/>
 - 
		      	<xsl:value-of select="Team2"/>
		      	&#160;<img class="team-icon">
		      	<xsl:attribute name="src">
		      		<xsl:value-of select="Team2URL"/>
		      	</xsl:attribute>
		      	</img>
			<hr />
		    </xsl:for-each>

		</section>
		
		<section id="season_matches">
		<hr />
		<h3>All Season Matches: <small>(point 2 from the task)</small></h3>
		    <xsl:for-each select="/root/season_matches/match">
		    	<div class="event-title"><xsl:value-of select="MatchDateTime"/></div>

		      	<img class="team-icon">
		      	<xsl:attribute name="src">
		      		<xsl:value-of select="Team1URL"/>
		      	</xsl:attribute>
		      	</img>&#160;
		      	<xsl:value-of select="Team1"/>
 - 
		      	<xsl:value-of select="Team2"/>
		      	&#160;<img class="team-icon">
		      	<xsl:attribute name="src">
		      		<xsl:value-of select="Team2URL"/>
		      	</xsl:attribute>
		      	</img>
			<hr />
		    </xsl:for-each>

		</section>
		
		

    </xsl:template>
</xsl:stylesheet>