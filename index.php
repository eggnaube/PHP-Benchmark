<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>PHP Benchmark</title>
		<meta name="description" content="Test how fast your webserver really is!">
		<meta name="author" content="Philipp Schroer">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link type="text/css" rel="stylesheet" href="css/syntaxhighlighter/shCore.css"/>
		<link type="text/css" rel="stylesheet" href="css/syntaxhighlighter/shCoreDefault.css"/>
		<link rel="stylesheet" href="css/css3buttons.css" media="screen">
		<link type="text/css" href="css/south-street/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/style.css?v=2">

		<script src="js/libs/modernizr-1.7.min.js"></script>
		
	</head>
	<body>

		<div id="container">

			<header>
				<h1>PHP Benchmark</h1>
				<h2>test how fast your webserver <span style="font-style:italic;">really</span> is!</h2>
			</header>
			
			<div id="main" role="main">
				
				<section id="controls">
						<p id="controls-run">
							<a href="#" class="primary button left big" id="button-start"><span class="icon rightarrow"></span>Start</a><a href="#" class="right big negative button" id="button-stop">Stop</a>
						</p>
						<p id="controls-etc">	
							<a href="#" class="button left negative cross big" id="button-clear"><span class="cross icon"></span>Clear table</a><a class="big right button" id="button-settings" href="#"><span class="cog icon"></span>Settings</a>
						</p>
						<p id="controls-clear-verify" style="display:none;">
							<a href="#" class="button big negative left" id="controls-clear-verify-yes"><span class="cross icon"></span>Yes</a><a href="#" class="primary button big right" id="controls-clear-verify-no">No</a>
						</p>
						<p id="status">Start the tests by clicking on the start button</p>
						<div id="progressbar"></div>
				</section>
				
				<section>
					<table id="results">
		                <thead>
		                    <tr>
		                        <th></th>
		                        <th scope="col">Strings</th>
		                        <th scope="col">Encryptions</th>
		                        <th scope="col">Dates</th>
		                        <th scope="col">Images</th>
		                        <th scope="col">Arrays</th>
		                        <th scope="col">Filesystem</th>
		                        <th scope="col">Objects</th>
								<th scope="col" class="total">Total</th>
		                    </tr>
		                </thead>
		                <tfoot>
							<tr id="averages"> 
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
		                </tfoot>
		                <tbody id="results-content">
		                    
		                </tbody>
            		</table>
				</section>
				
				<section id="serverinfo">
					<h2>Server information</h2>
					<ul>
						<li><span style="font-weight:bold;">Hostname</span>: <?php echo php_uname('n'); ?></li>
						<li><span style="font-weight:bold;">Operating system</span>: <?php echo php_uname('s'); ?></li>
						<li><span style="font-weight:bold;">PHP version</span>: <?php echo phpversion(); ?></li>
						<li><span style="font-weight:bold;">PHP API type</span>: <?php echo php_sapi_name(); ?></li>
						<li><span style="font-weight:bold;">Zend version</span>: <?php echo zend_version(); ?></li>
					</ul>
				</section>
				
				<section>
					<h2>Sourcecode</h2>
					<div id="sourcecode">
						<ul>
							<li><a href="#sourcecode-1">Strings</a></li>
							<li><a href="#sourcecode-2">Encryptions</a></li>
							<li><a href="#sourcecode-3">Dates</a></li>
							<li><a href="#sourcecode-4">Images</a></li>
							<li><a href="#sourcecode-5">Arrays</a></li>
							<li><a href="#sourcecode-6">Filesystem</a></li>
							<li><a href="#sourcecode-7">Objects</a></li>
						</ul>
						<div id="sourcecode-1">
							<h3>Strings and calculating</h3>
							<p>This test uses several string functions an a string and calculates a little bit.</p>
<pre class="brush: php">			
$string1= 'abcdefghij';
for($i = 1; $i <= 30000; $i++) {
	$x=$i * 5;
	$x=$x + $x;
	$x=$x/10;
	$string3 = $string1 . strrev($string1);
	$string2 = substr($string1, 9, 1) . substr($string1, 0, 9);
	$string1 = strtoupper($string2);
}				
</pre>
						</div>
						<div id="sourcecode-2">
							<h3>Encryption and hashing</h3>
							<p>This test uses several encryptions and hashes on a string.</p>
<pre class="brush: php">			
$string = "This is a test string to see how fast your web server can process PHP functions";
for($i=0; $i < 150; $i++) {
	$md5 = md5($string);
	$sha1 = sha1($md5);
	$crc32 = crc32($sha1);
	$cryptDate = crypt($crc32);
}				
</pre>						
						</div>
						<div id="sourcecode-3">
							<h3>Date functions</h3>
							<p>This tests handles with date functions and date calculations.</p>
<pre class="brush: php">			
for($i=0; $i < 1000; $i++) {
	$string3 = date("D M d Y"). ', News Years Day : ' .date("M-d-Y", mktime(0, 0, 0, 1, 1, 1998));
	$secNextWeek = time() + (7 * 24 * 60 * 60);
	date('Y-m-d', $secNextWeek);
}				
</pre>								
						</div>
						<div id="sourcecode-4">
							<h3>Image manipulation</h3>
							<p>This tests manipulates images to measure the speed of GD.</p>
<pre class="brush: php">			
for($i=0; $i < 1000; $i++) {
	$im = @imagecreatetruecolor(200, 200) or die("Cannot Initialize new GD image stream");
	$text_color = imagecolorallocate($im, 233, 14, 91);
	magestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
	imagedestroy($im);
	unset($im);
}				
</pre>								
						</div>
						<div id="sourcecode-5">
							<h3>Array managment</h3>
							<p>This test gets system variables in $_SERVER and uses shuffle() and arsort() on them 1000 times.</p>
<pre class="brush: php">			
for($i=0; $i < 1700; $i++) {
	$array = $_SERVER;
    shuffle($array);
	arsort($array);
}				
</pre>								
						</div>
						<div id="sourcecode-6">
							<h3>File system</h3>
							<p></p>
<pre class="brush: php">			
for($i=0; $i < 200; $i++) {
	        		
	// Subtest 6.1 - reading files
	$dataFile = fopen( __FILE__, "r" ) ;
	if($dataFile) {
		while (!feof($dataFile)) {
	    	$buffer = fgets($dataFile, 4096);
	    }
	    fclose($dataFile);
	} else {
		die( "fopen failed for ".__FILE__) ;
	}
	
	// Subtest 6.2 - read file metadata
	$filesize = @filesize(__FILE__);
	$isreadable = @is_readable(__FILE__);
	$iswritable = @is_writable(__FILE__);
	$df = @disk_free_space("/");
	
	 // Subtest 6.3 - copying and deleting files
	 if($i < 7) {
	 	$file2 = "benchmark2.php";
	    $copy = @copy(__FILE__, $file2);
	    if(!$copy) {
	    	echo "failed to copy __FILE__...\n";
	    } else {
			unlink($file2);
	    }
	 }
}				
</pre>								
						</div>
						<div id="sourcecode-7">
							<h3>Objects</h3>
							<p>This test creates an instance of the PHP_Benchmark_Foo class and starts these functions 1000 times in a loop.</p>
<pre class="brush: php">			
for($i=0; $i < 20000; $i++) {
	$bar = new PHP_Benchmark_Foo("Hello world!");
	$_1 = $bar->do_foo();
	$_2 = $bar->multiply(72, 12);
}				
</pre>							
						</div>
					</div>
				</section>
			
			</div>
			
			<footer>
				<p>
					<a xmlns:xh="http://www.w3.org/1999/xhtml/vocab#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" rel="xh:license xh:license license" href="http://creativecommons.org/licenses/by-sa/3.0/">
						<img alt="Creative Commons License" src="https://d3nwyuy0nl342s.cloudfront.net/img/9df00526e958635bcd1988a037413bdce001b493/687474703a2f2f692e6372656174697665636f6d6d6f6e732e6f72672f6c2f62792d73612f332e302f38387833312e706e67">
					</a>
				</p>
				<p>
					<a href="https://github.com/Philipp15b/PHP-Benchmark">PHP Benchmark</a> by Philipp Schroer is licensed under a <a xmlns:xh="http://www.w3.org/1999/xhtml/vocab#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" rel="xh:license xh:license license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.
				</p>
			</footer>
		
		</div>
		
		<div id="settings" title="Settings">
			<form action="javascript:void();">
				<ul>
					<li>Do <input id="settings-TestsOnStart" name="TestsOnStart" type="text" size="2" maxlength="4" value="5"> tests after clicking on the start button.</li>
				</ul>
			</form>
		</div>
		
		
		<script src="js/libs/jquery-1.6.1.min.js"></script>
		
		<!-- SyntaxHighlighter -->
		<script type="text/javascript" src="js/libs/syntaxhighlighter/shCore.js"></script>
		<script type="text/javascript" src="js/libs/syntaxhighlighter/shBrushPhp.js"></script>
		<script type="text/javascript">SyntaxHighlighter.all();</script>
		<!-- SyntaxHighlighter END -->
		
		<script type="text/javascript" src="js/libs/jquery-ui-1.8.13.custom.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>

		<!--[if lt IE 7 ]>
		<script src="js/libs/dd_belatedpng.js"></script>
		<script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
		<![endif]-->
	</body>
</html>