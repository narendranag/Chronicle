// Change this when we drop the index.php from our CI install

const POST_URL = "/index.php/chronicle/post";
const GET_URL = "/index.php/chronicle/get";

// Prototype for each individual post

function Post() {
	
	// For Each Instance
	
	this.id						= 0;
	this.status				= 0;
	this.author_id 		= 0;
	this.author				= "";
	this.category_id 	= 0;
	this.category			= "";
	this.title				= "";
	this.url					= "";
	this.body					= "";
	this.created			= "";
	this.published		= "";
} 

Post.prototype = {
	
	constructor		: Post,

	// Assigns values from a json object

	from_json			: function(data) {
		this.id = data.id;
		this.status = data.status;
		this.author_id = data.author_id;
		this.author = data.author;
		this.category_id = data.category_id;
		this.category = data.category;
		this.title = data.title;
		this.url = data.url;
		this.body = data.url;
		this.created = data.created;
		this.published = data.published;
	},
	
	// Picks up values from the form
	
	from_form			: function(data) {
		this.title = $("#title").val();
		this.category_id = $("#category_id").val();
		this.category = $("#new_category").val();
		this.url = $("#url").val();
		this.body = $("#body").val();
	},
	
	// Saves the current post
	
	save					: function() {
		
		$.post( POST_URL, 
						{ "id" : this.id, "status" : this.status, "category_id" : this.category_id, "category" : this.category, "title" : this.title, "url" : this.url, "body" : this.body },
						function(data) {
							if(! data.error)
								this.from_json(data);
							else
								alert("Error");
						}, "json"
			);
		
	},
	
	// Gets the post for a particular url
	
	get 					: function() {
		var final_get_url = GET_URL + "/" + this.url;
		
		$.post( final_get_url,
						{},
						function(data) {
							if(! data.error)
								this.from_json(data);
							else
								alert("Error");
								
						}, "json"
			);
	},
	
	// Fills up a form 
	
	edit					: function() {
		
		$("#title").val(this.title);
		$("#category_id").val(this.category_id);
		$("#url").val(this.url);
		$("#body").val(this.body);
		
	},
	
	// Shows
	
	display				: function() {
		
		$("#title").text(this.title);
		$("#author").text(this.html);
		$("#published").text(this.published)
		$("#category").text(this.category);
		$("#body").html(this.body);
		
	}
	
}

// End Post Object


