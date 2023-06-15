<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
<%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>

            <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver" 
            jdbcUrl="jdbc:mysql://localhost/whadventureworks?user=root&password=" 
            catalogUri="/WEB-INF/queries/whadventureworks2.xml">

             select {[Measures].[Order Qty], [Measures].[Unit Price],[Measures].[Unit Price Discount],[Measures].[Line Total]} ON COLUMNS, 
            {([Time].[All Times],[Customer],[Product],[Ship Method])} ON ROWS 
            from [fakta penjualan]

            </jp:mondrianQuery>

            <c:set var="title01" scope="session">Query WH Adventure Fakta Penjualan using Mondrian OLAP</c:set>
