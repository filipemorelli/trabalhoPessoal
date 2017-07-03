<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <?= $this->Html->css('/template/assets/css/bootstrap.min.css') ?>
    <?= $this->Html->css('/template/assets/css/material-kit.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="login-page">

	<div class="page-header header-filter" style="background-image: url('<?= $this->Url->build('/template/assets/img/bg10.jpg') ?>'); background-size: cover; background-position: top center;">
		<?= $this->Flash->render() ?>
        <div class="container">
			<?= $this->fetch('content') ?>
		</div>
		<footer class="footer">
	        <div class="container">
	            <nav class="pull-left">
					<ul>
						<li>
							<a href="http://morellibrasil.com.br">
								Filipe Morelli
							</a>
						</li>
						<li>
							<a href="https://bhtecnologia.com">
							   BH Tecnologia
							</a>
						</li>
					</ul>
	            </nav>
	            <div class="copyright pull-right">
	                &copy; <?= date('Y') ?>, feito com <i class="fa fa-heart heart"></i> por <a href="http://bhtecnologia.com" target="_blank">BH Tecnologia</a>
	            </div>
	        </div>
	    </footer>

	</div>
    <!--   Core JS Files   -->
    <script src="..\assets\js\jquery.min.js" type="text/javascript"></script>
    <script src="..\assets\js\bootstrap.min.js" type="text/javascript"></script>
    <script src="..\assets\js\material.min.js"></script>

    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="..\assets\js\nouislider.min.js" type="text/javascript"></script>

    <!--	Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="..\assets\js\bootstrap-datepicker.js" type="text/javascript"></script>

    <!--	Plugin for Select Form control, full documentation here: https://github.com/FezVrasta/dropdown.js -->
    <script src="..\assets\js\jquery.dropdown.js" type="text/javascript"></script>

    <!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/  -->
    <script src="..\assets\js\jquery.tagsinput.js"></script>

    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="..\assets\js\jasny-bootstrap.min.js"></script>

    <!-- Plugin For Google Maps -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="..\assets\js\material-kit.js" type="text/javascript"></script>
</body>
</html>
