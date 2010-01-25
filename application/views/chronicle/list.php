<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="title" content="Narendra Nag's Chronicle">
	
	<title>Narendra Nag's Chronicle</title>
	
	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="/resources/css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/chronicle.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="/resources/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	
</head>

<body id="list">
	


<div class="container white">
	


	<div class="span-24 last chronicle alt">
		Narendra Nag's Chronicle
		<a href="#login" rel="facebox">Sign In</a>
	</div>

	<div id="list">


		<div class="prepend-1 span-22 append-1">
			<? 
			if(isset($posts))
				foreach($posts as $post)
				{ 
			?>
			<category><?=$post["category"]?></category>
			<date><month><?=date("M", strtotime($post["published"]))?></month><day><?=date("d", strtotime($post["published"]))?></day><year><?=date("Y", strtotime($post["published"]))?></year></date>

			<h2><a href="<?=site_url('chronicle/view/' . $post['url'])?>"><?=$post["title"]?></a></h2>

			<author><?=$post["author"]?></author>

			<extract>
				<?=$post["body"]?>
			</extract>
			
		
				<?}?>
		</div>
		
		
	</div>
	
</div>

<div class="credits">
	<a href="http://www.github.com/narendranag/Chronicle">Chronicle</a> by <a href="http://www.narendranag.com">Narendra Nag</a> | Built using <a href="http://www.codeigniter.com">CodeIgniter</a> <a href="http://www.jquery.org">jQuery</a> <a href="http://www.blueprintcss.org">Blueprint</a>
</div>

</body>