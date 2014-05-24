<?php if (!defined('THINK_PATH')) exit();?><html>
<head>

    <script type='text/javascript' src='../../public/js/swfobject.js'></script>
</head>
<body>
<div id="slider" class="inner flash">
   <div id="piecemaker"></div>
</div>
<img src="../../public/logo.jpg"/>
<script type="text/javascript">
   var flashvars = {};
   flashvars.cssSource = "../../public/css/piecemaker.css";
   flashvars.xmlSource = "../../public/js/piecemaker/piecemaker.xml";
   
   var flash_params = {};
   flash_params.play = "true";
   flash_params.menu = "false";
   flash_params.scale = "showall";
   flash_params.wmode = "transparent";
   flash_params.allowfullscreen = "true";
   flash_params.allowscriptaccess = "always";
   flash_params.allownetworking = "all";
   
   swfobject.embedSWF('../../public/js/piecemaker/piecemaker.swf', 'piecemaker', '700', '290', '10', null, flashvars, flash_params, null);
   
</script>                      


</body>
</html>