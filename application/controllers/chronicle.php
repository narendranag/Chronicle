<?

/**
 * CLASS Chronicle
 * 
 * @author Narendra Nag
 * @license MIT
 * 
 */


class Chronicle extends Controller {
	
	const $_UNSAVED = 0;
	const $_DRAFT = 1;
	const $_PUBLISHED = 2;
	
	
	/*
		Accessing a url like chronicle/post_title will load the referenced post
		Otherwise if it's just chronicle, redirected to the latest posts
	*/
	
	
	function index($url) {
		
		if(!isset($url))
			redirect("chronicle/latest");
		
		$data = $this->_get($url);
		
		if($data["error"])
			show_404($url);
		else
			$this->load->view("show", $data);
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
			$postObject->where("status", $_PUBLISHED);
		else if($this->input->post("status"))
			$postObject->where("status", $this->input->post("status"));
			
		$postObject->where("url", $url)->get();
		
		if($postObject->exists())
		{
			$data = $postObject->to_array();
			$data["author"] = $postObject->author->name();
			$data["category"] = $postObject->category->name;
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
		
		$postObject->title = $this->input->post("title", TRUE);
		$postObject->body = $this->input->post("body", TRUE);
		
		// Unique SEO Friendly URL
		
		if($id == 0)
		{
			$base_url = url_title($title);
			$url = $base_url;
			$counter = 2;

			do {
				$query = $this->db->where("url", $url)->from("posts")->get();
				if($query->num_rows() > 0)
					$url = $base_url . "_" . $counter++;
			} while($query->num_rows() > 0)

			$postObject->url = $url;
		}
		else
			$postObject->url = url_title($this->input->post("url"));
		
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
		
		if($postObject->status < $_PUBLISHED && $this->input->post("status") == $_PUBLISHED)
			$postObject->published = date("Y-m-d H:i:s", now())
		
		$postObject->status = $this->input->post("status");
		
		// Save
		
		$postObject->save();
		
		// Return the post data
		
		$data = $this->_get($postObject->url);

		echo json_encode($data);

	}
	
	
	function latest($page_number = 0)
	{
		
		$limit = 10;
		$offset = $page_number * $limit;
		
		$postObject = new Post;
		
		$postObject->where("status", $_PUBLISHED)->order_by("published DESC")->limit($offset, $limit)->get();
		
		$data = $postObject->all_to_array();
		
		$this->load->view("list", $data);
	}
	
}
?>