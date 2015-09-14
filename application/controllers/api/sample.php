<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'libraries/TT_REST_Controller.php';

/**
 * Users API Controller
 *
 * API for user functions
 *
 * @package        	CodeIgniter
 * @subpackage    	Sample
 * @category    	Controllers/API
 * @author        	Tailored Tech Dev Team
 * @version 		1.0
 */

class Sample extends TT_REST_Controller 
{
	public function Sample()
	{
		parent::__construct();
		
		$this->open_methods = array('open_post');
	}

	/**
	* This is a sample open POST method no authentication is required for this
	* your login / sign up / forgot passwords will need to be open	
	*/
	public function open_post()
	{
		$var1 = $this->post("sample_input");//getting post values
		$response = new stdClass();
		$response->sample_outpout = $var1;
		$this->success_response($response);
	}
	/**
	* This is a sample locked POST method with authentication 
	* please make sure you pass "user_id" & "auth_token" with this.
	*/
	public function locked_post()
	{
		$var1 = $this->post("sample_input");//getting post values
		$response = new stdClass();
		$response->sample_outpout = $var1;
		$this->success_response($response);
	}
	/**
	* this is a sample get method. All get methods are open.
	*/
	public function list_get()
	{
		$var1 = $this->get("id");//getting get values
		if($var1)
		{
			$response = array("a","b","c","d","f");
			$this->success_response($response);
		}
		else
		{
			$this->failed_response(5000, "Please pass 'id' as a get parameter for this to work. eg. append ?id=12 to the url");
		}
	}
}