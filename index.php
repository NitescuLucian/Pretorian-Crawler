<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script type="text/javascript" src="/js/jquery.min.js"></script>
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
      <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="navbar navbar-default navbar-static-top">
         <div class="container">
            <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="#"><span>Pretorian Crawler by nli</span></a></div>
            <div class="collapse navbar-collapse" id="navbar-ex-collapse">
               <ul class="nav navbar-nav navbar-right">
                  <li class="active"><a href="https://github.com/nliplace/Pretorian-Crawler.git" target="_blank">Download</a></li>
               </ul>
            </div>
         </div>
      </div>
<div class="section">
         <div class="container">
            <div class="row">
            
            		<form action="index.php" method="get">
				Website: <input type="text" name="site" class="form-control"><br>
				<input type="submit" class="form-control">
			</form>
	
		
            	  <div class="col-md-12">
                           <h1>The Tool says that ...</h1>
                 </div> 
                
<?php
error_reporting(0);
ini_set('display_errors', 0);
$i = 1;
$to_crawl = $_GET["site"];
$c = array();

function get_links($url) {
	global $c;
	$input = @file_get_contents($url);
	$regexp ="<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU", $input, $matches);
	$base_url = parse_url($url, PHP_URL_HOST);
	$l = $matches[2];
	foreach($l as $link){
	
		if(strpos($link, "#")) {
			$link = substr($link, 0, strpos($link, "#"));
		}
		if (substr($link, 0, 1) == "."){
			$link = substr($link, 1);
		}
		if (substr($link, 0, 7) == "http://"){
			$link = $link;
		} else if (substr($link, 0, 8) == "https://"){
			$link = $link;
		} else if (substr($link, 0, 2) == "//"){
			$link = substr($link, 2);
		}else if (substr($link, 0, 1) == "#"){
			$link = $url;
		}else if (substr($link, 0, 7) == "mailto:"){
			$link= "[".$link."]";
		}else {
			if (substr($link, 0, 1) == "/"){
			$link= $base_url."/".$link;
			} else {
				$link= $base_url."/".$link;
				
			}
		}
		
		if (substr($link, 0, 7) != "http://" && substr($link, 0, 8) != "https://" && substr($link, 0, 1) != "["){
			if (substr($url, 0, 8) == "https://"){
				//prepend https
				$link = "https://".$link;
			} else {
				//prepend http
				$link = "http://".$link;
			}
	
		}
		$array[$sas] = $link;
		$sas++;
		if (!in_array($link, $c)){
			array_push($c, $link);
		}	
	}
	
}
// we use the functions to crawl
get_links($to_crawl);

foreach ($c as $page) {
	get_links($page);
}

foreach ($c as $page) {
	{
	$array[$sas] = $page;
	$sas++;
	}
}
// we use this values to list things
$lel=array_unique($array);
$twitter="twitter.com";
$face="facebook.com";
$jpg =".jpg";
$jpeg =".jpeg";
$png =".png";
$pdf =".pdf";
$doc =".doc";
$wplogin="wp-login";
$wpadmin="wp-admin";
$nrpoze =1;
$nrdoc=1;
$faci=1;
$twit=1;

// how we give you the intel
for($i = 1; $i <= count($lel); $i++){
	// how we give specific trgets to crawler 
	$posa = strpos($lel[$i],$face);
	$posb = strpos($lel[$i],$jpg);
	$posc = strpos($lel[$i],$png);
	$posd = strpos($lel[$i],$doc);
	$pose = strpos($lel[$i],$pdf);
	$posf = strpos($lel[$i],$wplogin);
	$posg = strpos($lel[$i],$wpadmin);
	$posh = strpos($lel[$i],$jpeg);
	$posi = strpos($lel[$i],$twitter);
	if ($posf == true || $posg == true){
		$masaprima= '<h5>  <div class="alert alert-danger" role="alert"> Wordpress Login Found --- <a target="_blank" href="';
		$masa = ' </a></div></h5>';
		$linkul = $lel[$i].'">';
		$lel[$i] = $masaprima.$linkul.$lel[$i].$masa;
		echo $lel[$i],"</br>";
		
	} else	if (substr($lel[$i], 0, 1) == "["){
		$masaprima= '<h5>  <div class="alert alert-warning" role="alert"> Email Found --- ';
		$masa = ' </div></h5>';
		$lel[$i] = $masaprima.$lel[$i].$masa;
		echo $lel[$i],"</br>";
		
	} else if ($posi == true){
			$twitterl[$twit]=$lel[$i];
			$twit++;
		} 
		else if ($posa == true){
			$faca[$faci]=$lel[$i];
			$faci++;
		}
		else if ($posb == true || $posc == true || $posh == true)  {
			$poze[$nrpoze]=$lel[$i];
			$nrpoze++;
		}else if ($posd == true || $pose == true)  {
			$docu[$nrdoc]=$lel[$i];
			$nrdoc++;
			
		}else {
			?>
			<a target="_blank" href="<?php echo $lel[$i] ?>">
			<?php
				echo $lel[$i],"</br>";
			?>
			</a>
  			<?php
		}
}
?>
<div class="panel panel-default">
  <div class="panel-heading">Facebook links found: <?php echo count($faca);?> </div>
  <div class="panel-body">
  <?php
	for($i = 1; $i <= count($faca); $i++){
   ?>
		<a target="_blank" href="<?php echo $faca[$i] ?>">
			<?php
				echo $faca[$i],"</br>";
			?>
		</a>
  <?php	
	}
   ?>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Twitter links found: <?php echo count($twitterl);?> </div>
  <div class="panel-body">
  <?php
	for($i = 1; $i <= count($twitterl); $i++){
   ?>
		<a target="_blank" href="<?php echo $twitterl[$i] ?>">
			<?php
				echo $twitterl[$i],"</br>";
			?>
		</a>
  <?php	
	}
   ?>
</div>
</div>



<div class="panel panel-default">
  <div class="panel-heading">Photos found: <?php echo count($poze);?> </div>
  <div class="panel-body">
  <?php
	for($i = 1; $i <= count($poze); $i++){
   ?>
		<a target="_blank" href="<?php echo $poze[$i] ?>">
			<?php
				echo $poze[$i],"</br>";
			?>
		</a>
  <?php	
	}
   ?>
</div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">Documents found: <?php echo count($docu);?> </div>
  <div class="panel-body">
  <?php
	for($i = 1; $i <= count($docu); $i++){
   ?>
		<a target="_blank" href="<?php echo $docu[$i] ?>">
			<?php
				echo $docu[$i],"</br>";
			?>
		</a>
  <?php	
	}
   ?>
</div>
</div>


</div> 
</div> 
</div> </div> 
</div>
<footer class="section section-primary">
         <div class="container">
            <div class="row">
               <div class="col-sm-6">
                  <h1>Desclaimer</h1>
                  <p>This PHP application is under Apache License 2.0 </br>
                  Credits to Nitescu Lucian | nliplace.com</p>
                  <p>Developed at hatchatelier.ro</p>
               </div>
            </div>
         </div>
      </footer>
   </body>
   
</html>

