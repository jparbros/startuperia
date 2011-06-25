<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); 
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header ("Cache-Control: no-cache, must-revalidate"); 
header ("Pragma: no-cache"); 
?> 

<?php echo $resp; ?>