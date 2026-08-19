<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Comision Reguladora de Telecomunicaiones">
    
    <meta name="description" content="En este espacio encontrarás información de los Concesionarios que participan en los mercados de telecomunicaciones y radiodifusión." />
	<meta name="keywords" content="Comparador tarifas, Visor tarifas, tarifas, tarifas CRT, tarifas telecomunicaciones, tarifas radiodifusion, concesiones, concesiones telecomunicaciones, concesiones radiodifusion, estructuras accionarias, convenios, puntos interconexion, permisos, autorizaciones, telecom, informes, sanciones, supervision" />
	<meta name="abstract" content="En este espacio encontrarás información de los Concesionarios que participan en los mercados de telecomunicaciones y radiodifusión." />
    
    
    <title>Registro Público de Concesiones</title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="<?php echo URLAPP;?>/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo URLASSETS?>img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo URLASSETS?>img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo URLASSETS?>img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo URLASSETS?>img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="<?php echo URLASSETS;?>css/base.css?version=26" rel="stylesheet">
    <link href="<?php echo URLASSETS?>css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo URLASSETS?>css/tabs_home.css" rel="stylesheet">
    <link href="<?php echo URLASSETS?>css/blog.css?version=17" rel="stylesheet">
    
    <link href="<?php echo URLASSETS?>css/bootstrap-accessibility_1.0.3.css" rel="stylesheet">
    
    <!-- SPECIFIC CSS -->
    <link href="<?php echo URLASSETS?>css/skins/square/grey.css" rel="stylesheet">
    <link href="<?php echo URLASSETS?>css/date_time_picker.css" rel="stylesheet">
    
    <!-- Range slider -->
    <link href="<?php echo URLASSETS?>css/ion.rangeSlider.css" rel="stylesheet" >
    <link href="<?php echo URLASSETS?>css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
	
    <!-- Google web fonts -->
   <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

 <!-- Common scripts -->
<script src="<?php echo URLASSETS?>js/jquery-1.11.2.min.js"></script>

<script src="<?php echo URLASSETS?>js/common_scripts_min.js"></script>
<!--<script src="<?php echo URLASSETS?>js/jquery.magnific-popup.js"></script>-->
<!--<link href="<?php echo URLASSETS?>css/magnific-popup.css" rel="stylesheet">-->

<script src="<?php echo URLASSETS?>js/bootstrap.js?2"></script>
<script src="<?php echo URLASSETS?>js/bootstrap-accessibility_1.0.3.js"></script>

<script src="<?php echo URLASSETS?>js/functions.js?13"></script>

   
   <!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo URLASSETS?>css/jquery.fancybox.css?v=2.1.5_1" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo URLASSETS?>js/jquery.fancybox.js?v=2.1.5"></script>


<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="<?php echo URLASSETS?>css/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo URLASSETS?>js/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo URLASSETS?>js/jquery.fancybox-media.js?v=1.0.6"></script>
   
   
   <!-- local JS -->
   <script src="<?php echo URLASSETS?>js/rpc_js.js?84"></script>
        
    <!--[if lt IE 9]>
      <script src="<?php echo URLASSETS?>js/html5shiv.min.js"></script>
      <script src="<?php echo URLASSETS?>js/respond.min.js"></script>
    <![endif]-->
 
 
 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43968735-19', 'auto');
  ga('send', 'pageview');

</script>
 
 
        
</head>
