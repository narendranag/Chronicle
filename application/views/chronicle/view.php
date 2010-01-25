<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="title" content="<?=$title?>">
	
	<title>Narendra Nag's Chronicle - <?=$title?></title>
	
	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="/resources/css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/chronicle.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="/resources/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	
</head>

<body id="view">
	


<div class="container white">
	


	<div class="span-24 last chronicle alt">
		Narendra Nag's Chronicle
		<a href="<?=site_url("")?>">Home</a>
	</div>

	<div id="post">

		<div class="prepend-1 span-22 append-1">
			<category><?=$category?></category>
			<date><month><?=$month?></month><day><?=$day?></day><year><?=$year?></year></date>

			<h1><?=$title?></h1>



			<author><?=$author?></author>

			<post>
				<?=$body?>
			</post>


		</div>

	</div>
	
</div>

<div class="credits">
	<a href="http://www.github.com/narendranag/Chronicle">Chronicle</a> by <a href="http://www.narendranag.com">Narendra Nag</a> | Built using <a href="http://www.codeigniter.com">CodeIgniter</a> <a href="http://www.jquery.org">jQuery</a> <a href="http://www.blueprintcss.org">Blueprint</a>
</div>

</body>