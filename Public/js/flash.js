//生成动态flash滚动栏
 var flashvars = {};
 flashvars.cssSource = _public+"/css/piecemaker.css";
 flashvars.xmlSource = _public+"/js/piecemaker/piecemaker.xml";
 
 var flash_params = {};
 flash_params.play = "true";
 flash_params.menu = "false";
 flash_params.scale = "showall";
 flash_params.wmode = "transparent";
 flash_params.allowfullscreen = "true";
 flash_params.allowscriptaccess = "always";
 flash_params.allownetworking = "all";
 
 swfobject.embedSWF(_public+'/js/piecemaker/piecemaker.swf', 'piecemaker', '700', '290', '10.0.0', "", flashvars, flash_params, null);
