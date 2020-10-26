<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"

xmlns:xsl="">


<xsl:template match="/">
  <html>
  <body>
  <h2>BUYER DETAILS</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th>Title</th>
      <th>Artist</th>
	  <th>Company</th>
	  <th>Country </th>
	  <th>Price </th>
	  <th>Year</th>
    </tr>
    <xsl:for-each select="CATALOG/CD">
    <tr>
      <td><xsl:value-of select="TITLE"/></td> 
      <td><xsl:value-of select="ARTIST"/></td>
	  <td><xsl:value-of select="COMPANY"/></td>
	  <td><xsl:value-of select="COUNTRY"/></td>
	  <td><xsl:value-of select="PRICE"/></td>
	  <td><xsl:value-of select="YEAR"/></td>
    </tr>
    </xsl:for-each>
  </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>