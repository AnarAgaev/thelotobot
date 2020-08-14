<?
	// This script get the current url of the user located page

  $CLIENT__URL = '';
  $default_port = 80; // default port

  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    $CLIENT__URL .= 'https://'; // if in protected, add protocol
    $default_port = 443; // and reassign the default port value
  } else {
    $CLIENT__URL .= 'http://';  // normal connection, normal protocol
  }
  $CLIENT__URL .= $_SERVER['SERVER_NAME'];  // server name, e.g. site.com or www.site.com

  if ($_SERVER['SERVER_PORT'] != $default_port) { // if the default port
    $CLIENT__URL .= ':'.$_SERVER['SERVER_PORT']; // if the port is not the default, add the port to the URL
  }

  $CLIENT__URL .= $_SERVER['REQUEST_URI']; // last part of the request (path and GET parameters)
?>