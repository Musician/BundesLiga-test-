<?xml version="1.0" encoding="UTF-8"?>
 <!DOCTYPE xsl:stylesheet [
        <!ENTITY nbsp "<xsl:text disable-output-escaping='yes'>&amp;nbsp;</xsl:text>">
        <!ENTITY middot "<xsl:text disable-output-escaping='yes'>&amp;middot;</xsl:text>">
        <!ENTITY copy "<xsl:text disable-output-escaping='yes'>&amp;copy;</xsl:text>">
 ]>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:exslt="http://exslt.org/common" xmlns="http://www.w3.org/1999/xhtml" version="1.0">
  <xsl:output method="xml" media-type="text/html" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" cdata-section-elements="style" indent="yes" encoding="UTF-8"/>
    <xsl:template match="/">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

	<xsl:call-template name="head" /> 
	<body>
   
	<div class="site-wrapper">
		
		<xsl:call-template name="content" /> 

		<xsl:call-template name="footer" /> 
	</div>
   
	</body>
</html>

</xsl:template>

<!-- ========================================================================================================================================= -->


<!-- ========================================================================================================================================= -->
	<xsl:template name="dummy" >	

	</xsl:template> 
<!-- ========================================================================================================================================= -->

<!-- ===== HTML <head> ======================================================================================================================= -->
	<xsl:template name="head" >	
	<head>
		<!-- Basic Page Needs -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
		<title>
			<xsl:value-of select="/root/lang/title" />
		</title>

		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="revisit-after" content="2 days" />

		<!-- Mobile Specific Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Bootstrap  -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

		<!-- Responsive -->
		<link rel="stylesheet" type="text/css" href="css/responsive.css" />

		<!-- Theme Style -->
		<link rel="stylesheet" type="text/css" href="css/own.css" />

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css" />

	</head>

	</xsl:template> 
<!-- ========================================================================================================================================= -->


<!-- ====== Footer template ================================================================================================================== -->
	<xsl:template name="footer" >	
        <!-- Footer -->


    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/parallax.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js" />
    <script type="text/javascript" src="js/service.js"></script>

	</xsl:template> 
<!-- ========================================================================================================================================= -->

</xsl:stylesheet> 