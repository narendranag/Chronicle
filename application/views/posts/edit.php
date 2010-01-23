<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Chronicle :: Edit Post</title>
	
	<!-- Framework CSS -->
	<link rel="stylesheet" href="/resources/css/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="/resources/css/print.css" type="text/css" media="print">
	<!--[if lt IE 8]><link rel="stylesheet" href="/resources/css/ie.css" type="text/css" media="screen, projection"><![endif]-->
	
	<script src="/resources/scripts/jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/resources/scripts/chronicle.js" type="text/javascript" charset="utf-8"></script>
	
</head>

<body id="list">

<div class="container alt"><form>

	<div class="prepend-1 span-22 append-1 last">
		<label for="title">Title</label>
		<input type="text" name="title" value="" id="title" class="title span-15">
	</div>
	
	<div class="prepend-1 span-22 append-1 last">
		<label for="url">URL</label>
		<input type="text" name="url" value="" id="url" class="span-15">
	</div>
	
	<div class="prepend-1 span-15 border">
		<textarea name="body" id="body" class="span-15"></textarea>
	</div>
	
	<div class="prepend-1 span-6 append-1 last">
		<p>
		<select name="category_id" id="category_id" size="1" class="span-6">
			<option value="0">Choose Category</option>
		</select>
		</p>

		<p>
		<label for="new_category">New Category</label>
		<input type="text" name="new_category" value="" id="new_category" class="span-6">
		</p>
	</div>
	
</form></div>
	
</body>