<?

class User extends Datamapper {
	
	var $has_many = array(
										"posts" => array(
											"class" => "post",
											"other_field" => "author")
									);
	
	
	var $name = NULL;
	
	function __construct($id = NULL) {
		parent::__construct($id);
	}
	
	// returns the name of the user
	
	function name()
	{
		if(isset($this->firstname))
		{
			$this->name = $this->firstname;
			$this->name .= isset($this->middlename) ? ' ' . $this->middlename : "";
			$this->name .= isset($this->lastname) ? ' ' . $this->lastname : "";
		}
		else
			$this->name = $this->email;
		
		return $this->name;
	}	
}

?>