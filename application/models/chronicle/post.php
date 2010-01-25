<?

class Post extends Datamapper {
	
	var $has_one = array(
										"author" => array(
											"class" => "user",
											"other_field" => "posts"),
											
										"category" => array(
											"class" => "category",
											"other_field" => "posts")
									);
	
	
	function __construct($id = NULL) {
		parent::__construct($id);
	}
	
}

?>