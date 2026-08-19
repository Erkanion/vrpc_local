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
     <!-- Header================================================== -->
    <header id="colored">

        
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div id="logo">
                        <a href="" data-toggle="modal"><img src="<?php echo URLASSETS?>img/rpc_logo.png" height="85" alt="Registro Público de Concesiones" data-retina="true" class="logo_normal"></a>
                        <a href=""><img src="<?php echo URLASSETS?>img/rpc_logo_blanco.png" height="85" alt="Registro Público de Concesiones" data-retina="true" class="logo_sticky"></a>
                    </div>
                </div>
                <nav class="col-md-9 col-sm-9 col-xs-9">
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="<?php echo URLASSETS?>img/logotipo-ift-2-mobile.png" width="72" height="40" alt="CRT" data-retina="true">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                        <ul>
                        	<li><a href="<?php echo URLAPP;?>" data-toggle="modal"><i class="icon-home-1"></i>Inicio</a></li>
                        	<li><a href="<?php echo URLAPP;?>" data-toggle="modal"><i class="icon-eye"></i>Nueva búsqueda</a></li>
                        	<li class="submenu">
                                <a href="javascript:void(0);" class="show-submenu"><i class="icon-list-alt"></i>Sitios de interés<i class="icon-down-open-mini"></i></a><ul>
                                	<!--<li><a href="http://rpc.ift.org.mx/rpc/index_rpc_old.html" target="_blank">Versión anterior del RPC</a></li>-->                                    
                                    <li><a href="<?php echo URLAPPVISORSERT;?>" target="_blank">Buscador de tarifas</a></li>
                                    <li><a href="http://apps.ift.org.mx/cumplimientoStp/secured/adminficum.faces" target="_blank">Buscador de resoluciones del Pleno</a></li>
                                    <li><a href="http://www.ift.org.mx/" target="_blank">Portal del CRT</a></li>
                                </ul>
                            </li>
                        	<li><a href="mailto:atencion.ciudadana@crt.gob.mx"><i class="icon-mail-6"></i>Contacto</a></li>
                        </ul>
                    </div><!-- End main-menu -->
                    <ul id="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i>Últimas consultas (0) </a> -->
                                <ul class="dropdown-menu" id="cart_items">
                                    <li>
                                        <div class="image"><img src="<?php echo URLASSETS?>img/thumb_cart_1.jpg" alt=""></div>
                                        <strong>
										<a href="#">Louvre museum</a>1x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo URLASSETS?>img/thumb_cart_2.jpg" alt=""></div>
                                        <strong>
										<a href="#">Versailles tour</a>2x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div class="image"><img src="<?php echo URLASSETS?>img/thumb_cart_3.jpg" alt=""></div>
                                        <strong>
										<a href="#">Versailles tour</a>1x $36.00 </strong>
                                        <a href="#" class="action"><i class="icon-trash"></i></a>
                                    </li>
                                    <li>
                                        <div>Total: <span>$120.00</span></div>
                                        <a href="cart.html" class="button_drop">Go to cart</a>
                                        <a href="payment.html" class="button_drop outline">Check out</a>
                                    </li>
                                </ul>
                            </div><!-- End dropdown-cart-->
                        </li>
                    </ul>
                </nav>
                
            </div>
        </div><!-- container -->
    </header><!-- End Header -->
