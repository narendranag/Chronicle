<?

/**
 * CLASS Chronicle
 * 
 * @author Narendra Nag
 * @license MIT
 * 
 */


class Chronicle extends Controller {
	
	var $_UNSAVED = 0;
	var $_DRAFT = 1;
	var $_PUBLISHED = 2;
	
	
	/*
		Accessing a url like chronicle/post_title will load the referenced post
		Otherwise if it's just chronicle, redirected to the latest posts
	*/
	
	
	function index() {
		$this->latest();
	}
	
	function view($url = NULL) {
		
		if(! isset($url))
			redirect("chronicle/latest");
		
		$data = $this->_get($url);
		
		if($data["error"])
			show_404($url);
		else
			$this->load->view("chronicle/view", $data);
	}
	
	
	function edit($id)
	{
		$this->load->helper('form');
		
		if(! $this->dx_auth->is_logged_in())
		{
			redirect("auth/login");
		}
		
		if(isset($id))
		{
			$postObject = new Post($id);
			$data = $postObject->to_array();
		}
		else
		{
			$data["id"] = 0;
			$data["status"] = $this->_UNSAVED;
			$data["title"] = "";
			$data["body"] = "";
			$data["category_id"] = 0;
			$data["error"] = FALSE;
		}
		
		$categoryObject = new Category;
		$categoryObject->order_by("name")->get();
		$data["categories"][0] = "New Category";
		foreach($categoryObject->all as $cat)
			$data["categories"][$cat->id] = $cat->name;
		
		$this->load->view("chronicle/edit", $data);
		
	}
	
	
	/*
		This will be used get ajaxed calls for a particular entry, allowing us to load pages a lot quicker 
		than waiting for all elements to load
	*/
	
	function get($url) {
		$data = $this->_get($url);
		echo json_encode($data);
	}


	/*
		Private method to load post data
	*/

	function _get($url) {

		$postObject = new Post;
		
		if(! $this->dx_auth->is_logged_in() )
			$postObject->where("status", $this->_PUBLISHED);
		else if($this->input->post("status"))
			$postObject->where("status", $this->input->post("status"));
			
		$postObject->where("url", $url)->get();
		
		if($postObject->exists())
		{
			$data = $postObject->to_array();
			
			if($postObject->status == $this->_PUBLISHED)
				$date = $postObject->published;
			else
				$date = $postObject->updated;
			
			$data["day"] = date("d", strtotime($date));
			$data["month"] = date("M", strtotime($date));
			$data["year"] = date("Y", strtotime($date));
			
			$data["author"] = $postObject->author->name();
			$data["category"] = ($postObject->category_id > 0) ? $postObject->category->name : "";
			$data["error"] = FALSE;
		}
		else
			$data["error"] = TRUE;
		
		return $data;
	
	}
	
	
	/*
		Used to save a post
	*/
	
	function post() {
		
		if(! $this->dx_auth->is_logged_in())
			$this->dx_auth->deny("login");
			
		$id = $this->input->post("id");
		
		$postObject = new Post;
		
		if($id > 0)
			$postObject->get_by_id($id);
		
		// Author
		
		$postObject->author_id = $this->dx_auth->get_user_id();
		
		// Title & Text
		
		$postObject->title = trim($this->input->post("title", TRUE));
		$postObject->body = $this->input->post("body", TRUE);
		
		// Unique SEO Friendly URL
		
		if(($postObject->status < $this->_PUBLISHED && $this->input->post("status") == $this->_PUBLISHED) OR strlen($postObject->url) == 0)
		{
			$base_url = url_title(strtolower($postObject->title));
			$url = $base_url;
			$counter = 2;

			do {
				$query = $this->db->where("url", $url)->from("posts")->get();
				if($query->num_rows() > 0)
					$url = $base_url . "_" . $counter++;
			} while($query->num_rows() > 0);

			$postObject->url = $url;
		}
		
		// Category
		
		if($this->input->post("category_id") > 0)
			$postObject->category_id = $this->input->post("category_id");
		else if ($this->input->post("category") != FALSE)
		{
			$new_category = ucwords(trim($this->input->post("category_id", TRUE)));
			$categoryObject = new Category;
			$categoryObject->get_by_name($new_category);
			if(! exists($categoryObject))
			{
				$categoryObject->name = $new_category;
				$categoryObject->save();
			}
			
			$postObject->category_id = $categoryObject->id;
		}	
		
		
		// Status & Publishing Date
		
		if($postObject->status < $this->_PUBLISHED && $this->input->post("status") == $this->_PUBLISHED)
			$postObject->published = date("Y-m-d H:i:s", time());
		
		$postObject->status = $this->input->post("status");
		
		// Save
		
		$postObject->save();
		
		// Return the post data
		
		redirect("chronicle/view/$postObject->url");

	}
	
	
	function latest($page_number = 0)
	{
		
		
		$limit = 10;
		$offset = $page_number * $limit;
		
		$postObject = new Post;
		
		$postObject->where("status", $this->_PUBLISHED)->order_by("published DESC")->limit($limit, $offset)->get();
		
		foreach($postObject->all as $post)
		{
			$data["posts"][$post->id]["category"] = ($post->category_id > 0) ? $post->category->name : "";
			$data["posts"][$post->id]["title"] = $post->title;
			$data["posts"][$post->id]["published"] = $post->published;
			$data["posts"][$post->id]["author"] = $post->author->name();
			$data["posts"][$post->id]["body"] = $post->body;
			$data["posts"][$post->id]["url"] = $post->url;
		}
		
		$this->load->view("chronicle/list", $data);
	}
	
}
?>