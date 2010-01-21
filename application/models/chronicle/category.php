<?

class Category extends Datamapper {
	
	var $model = "category";
	var $table = "categories";
	
	var $has_many = array(
										"posts" => array(
											"class" => "post",
											"other_field" => "category"),
									);
	
	
	function __construct($id = NULL) {
		parent::__construct($id);
	}
	
}

?>