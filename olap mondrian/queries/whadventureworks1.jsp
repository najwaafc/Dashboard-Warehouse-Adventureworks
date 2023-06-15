<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

            <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
            jdbcUrl="jdbc:mysql://localhost/whadventureworks?user=root&password=" 
            catalogUri="/WEB-INF/queries/whadventureworks1.xml">

                select {[Measures].[Order Qty],[Measures].[ship rate],[Measures].[Unit Price],[Measures].[Line Total]} ON COLUMNS, 
                {([Time].[All Times],[Vendor],[Product],[Ship Method])} ON ROWS 
                from [fakta pembelian]

            </jp:mondrianQuery>

            <c:set var="title01" scope="session">Query WH Adventure Works Fakta Pembelian using Mondrian OLAP</c:set>
