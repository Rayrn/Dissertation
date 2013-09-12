<?php

// DB Connector Class
// Public New, Get and ToString(Print) Methods.
// Private Set Methods

class DB_INFO
{
	// Attributes
	private $DB_HOST;
	private $DB_NAME;
	private $DB_USER;
	private $DB_PASS;

	// Get Methods
	// Return's value for attribute named
	public function GET_DB_HOSTNAME()
	{
		return $this->DB_HOST;
	}
	public function GET_DB_SERVERNAME()
	{	
		return $this->DB_NAME;
	}
	public function GET_DB_USERNAME()
	{
		return $this->DB_USER;
	}
	public function GET_DB_PASSWORD ()
	{		
		return $this->DB_PASS;
	}
	
	// Set Methods
	// Attempts to set current value to inputted value
	// Returns true if current value is equal to inputted value
	// Returns false if miss-match occurs
	private function SET_DB_HOSTNAME ($NEW_DB_HOSTNAME)
	{	
		$this->DB_HOST = $NEW_DB_HOSTNAME;
		if ($this->GET_DB_HOSTNAME() == $NEW_DB_HOSTNAME)
				return true;
		else return false;
	}
	private function SET_DB_SERVERNAME ($NEW_DB_SERVERNAME)
	{		
		$this->DB_NAME = $NEW_DB_SERVERNAME;
		if ($this->GET_DB_SERVERNAME() == $NEW_DB_SERVERNAME)
			return true;
		else return false;
	}
	private function SET_DB_USERNAME ($New_DB_USERNAME)
	{		
		$this->DB_USER = $New_DB_USERNAME;
		if ($this->GET_DB_USERNAME() == $New_DB_USERNAME)
			return true;
		else return false;
	}
	private function Set_DB_PASSWORD ($New_DB_PASSWORD)
	{	
		$this->DB_PASS = $New_DB_PASSWORD;
		if ($this->GET_DB_PASSWORD() == $New_DB_PASSWORD)
			return true;
		else return false;
	}
	
	// To String (Print-Out)
	public function __toString(){
		return ("DB Host - {$this->GET_DB_HOSTNAME()}  <br>
				 DB Name - {$this->GET_DB_SERVERNAME()} <br>
				 DB User - {$this->GET_DB_USERNAME()} <br>
				 DB Pass - {$this->GET_DB_PASSWORD()} <br>");
	}
	
	// Create a new instance of the server.
	// Returns true if successful (success criteria: all current values are equal to the inputted values)
	// Returns false if any miss-matches occur
	public function NEW_CONNECTION ($HOST, $NAME, $USER, $PASS)
	{
		if ($this->SET_DB_HOSTNAME($HOST) == true)
		{
			if ($this->SET_DB_SERVERNAME($NAME) == true)
			{
				if ($this->SET_DB_USERNAME($USER) == true)
				{
					if($this->SET_DB_PASSWORD($PASS) == true)
						return true;
					else return false;
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}
}

function DB_CONNECTION ($HOST, $NAME, $USER, $PASS)
{
	// Print's error message if un-succsessful (false return from NEW_CONNECTION method)
	$database = new DB_INFO;
	if ($database-> NEW_CONNECTION($HOST, $NAME, $USER, $PASS) != true)
	echo "<BR>ERROR! Database connection not made!<BR>";
	
	// Using PHP Data Object to connecct to database
	return $connector = new PDO('mysql:host=' . $database->GET_DB_HOSTNAME().
						 ';dbname=' .$database->GET_DB_SERVERNAME(),
						 $database->GET_DB_USERNAME(),
						 $database->GET_DB_PASSWORD());
}

// Dissertation DB details, seperated to allow for multiple databases to be stored.
function DTDB_Details()
{
	return DB_CONNECTION('80.68.40.219', 'boeme_DB', 'boeme_db', 'bx12345');
}
?>