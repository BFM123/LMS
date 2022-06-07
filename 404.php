<?php
	$url = strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));
?>
<html>
<head>
<title>Resource Not Available</title>
<meta name="title" content="Resource Not Available">
<link href="/uniSoft/assets/css/404.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="main">
	<div class="heading"><?php echo $url; ?></div>
	The resource you are trying to access is currently unavailable. If in doubt, contact your Systems Administrator at <a href="mailto:support@idiasmw.com">support@idiasmw.com</a> | +265 211 953 052 | <a href="http://www.idiasmw.com">www.idiasmw.com</a>
	<div class="footer">
		<div class="sw">software development &amp; hosting. </div><div class="dt">data management. </div><div class="it">IT consultancy.</div>
	</div>
</div>
</body>
</html>