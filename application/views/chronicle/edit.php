<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="title" content="<?=$title?>">
	
	<title>Narendra Nag's Chronicle - Edit Post</title>
	
	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="/resources/css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/chronicle.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="/resources/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	
	<script src="/resources/scripts/jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready( function(){
			$("#save").click( function() {
				if($("#status").val() < 2)
					$("#status").val(1);
				
				$("form:first").submit();
			});

			$("#publish").click( function() {
				$("#status").val(2);
				$("form:first").submit();
			});
			
		});
	</script>
</head>

<body id="edit">
	


<div class="container white">
	


	<div class="span-24 last chronicle alt">
		Narendra Nag's Chronicle
		<a href="#login" rel="facebox">Sign In</a>
	</div>

	<div id="edit">

		<div class="prepend-top prepend-2 span-21 append-1 last">
			<h3>Edit Post</h3>
		</div>



		<form action="<?=site_url("/chronicle/post")?>" method="post" accept-charset="utf-8">
		<input type="hidden" name="id" value="<?=$id?>" id="id">
		<input type="hidden" name="status" value="<?=$status?>" id="status">
		
		<div class="prepend-2 span-15">

			<p>
			<input type="text" name="title" value="<?=$title?>" id="title" class="title span-15">
			</p>

			<p>
			<textarea name="body" id="body" class="span-15"><?=$body?></textarea>
			</p>

			<p>
			<button type="submit" class="button positive" id="save">
			  <img src="/resources/icons/tick.png" alt=""/> Save
			</button>

			<button type="submit" class="button positive" id="publish">
			  <img src="/resources/icons/external.png" alt=""/> Publish
			</button>

			</p>
		</div>

		<div class="span-5 append-2 last">
			<p>
				<?echo form_dropdown("category_id", $categories, $category_id)?>
			</p>

			<p>
			<label for="new_category">New Category</label><br/>
			<input type="text" name="new_category" value="" id="new_category" class="span-5">
			</p>
		</div>

		<hr class="space" />

		</form>

	</div>
	
</div>

<div class="credits">
	<a href="http://www.github.com/narendranag/Chronicle">Chronicle</a> by <a href="http://www.narendranag.com">Narendra Nag</a> | Built using <a href="http://www.codeigniter.com">CodeIgniter</a> <a href="http://www.jquery.org">jQuery</a> <a href="http://www.blueprintcss.org">Blueprint</a>
</div>

</body>