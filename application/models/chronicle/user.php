<?

class User extends Datamapper {
	
	var $has_many = array(
										"posts" => array(
											"class" => "post",
											"other_field" => "author")
									);
	
	
	function __construct($id = NULL) {
		parent::__construct($id);
	}
	
}

?>