<?php 
require_once('functions.php');

?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Software Testen Groep 7</title>
		<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<script type="text/javascript" src="/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="/jquery.dropotron-1.0.js"></script>
		<script type="text/javascript" src="/init.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="splash">
				<img src="/images/pic1.jpg" alt="" />
			</div>
			<div id="menu">
				<ul>
					<li><a href="/index.php">Home</a></li>
					<li>
						Opdrachten<span class="arrow"></span>
						<ul>
                                                    <?php 
                                                        $filenames = get_files_in_dir('./opdrachten');
                                                        for($i = 0; $i < count($filenames) && $i <= 0; $i++) : ?>
                                                        <?php $filename = $filenames[$i];
                                                        if($i == 0) : ?>
                                                            <li class="first">
                                                        <?php elseif($i == count($filenames)) : ?>
                                                            <li class="last">
                                                        <?php else : ?>
                                                            <li>
                                                        <?php endif; ?>
                                                            <a href="/index.php?page=opdrachten/<?php echo $filename ?>.php"><?php echo ucfirst(str_replace('_', ' ', $filename)) ?></a>
                                                        </li>
                                                    <?php endfor; ?>
						</ul>
					</li>
					<li><a href="/index.php?page=links.php">Links</a></li>
					<li class="last"><a href="index.php?page=contact.php">Contact</a></li>
				</ul>
				<br class="clearfix" />
			</div>
			<?php 
                            $page = isset($_GET['page']) && file_exists($_GET['page']) ? $_GET['page'] : 'home.php';
                            include($page); 
                        ?>	
		</div>
		<div id="footer">
                    &copy; 2012 <b>G</b>roep 7
		</div>
	</body>
</html>