<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';
/**
 * TailoredTech CI Rest Controller
 *
 * An extension of Phil Sturgeon's Rest API.
 *
 * @package        	CodeIgniter
 * @subpackage    	YoSell
 * @category    	Libraries
 * @author        	Tailored Tech Dev Team
 * @version 		1.0
 */
abstract class TT_REST_Controller extends REST_Controller
{
	protected $open_methods = array();
	protected $user_details = null;
	 /**
	 * Failed Response
	 *
	 * Returns an object containing a standard success response.
	 * Error Codes:
	 * 1000 - Element not found
	 * 1001 - Insert Failed
	 * 1002 - Malformed Input
	 * 1003 - Authentication Failiure
	 * 1004 - Email verification Failiure
	 * 1020 - Unknown Error
	 * @access	public
	 * @param	Int containing error code
	 * @param	String containing error description
	 */
	function failed_response($code=0, $message='') 
	{
		$data = new stdClass();
		$data->status = "fail";
		$data->error = $code;
		if(strlen($message)>0)
		{
			$data->message = $message;
		}
		else
		{
			switch ($code)
			{
			case 1000:
			  $data->message = "Element not found";
			  break;
			case 1001:
			  $data->message = "API / Database Call Failed";
			  break;
			case 1002:
			  $data->message = "Malformed Input: Maybe you are missing some required fields";
			  break;
			case 1003:
			  $data->message = "Authentication Failure";
			  break;
			case 1004:
			  $data->message = "Email Not Verified";
			  break;			    
			    
			default:
			  $data->message = "Unknown Error";
			}
		}
	    $this->response($data);
	}
	/**
	 * Success Response
	 *
	 * Returns an object containing a standard success response
	 *
	 * @access	public
	 * @param	Object containing response
	 */
	function success_response($response) 
	{
		$data = new stdClass();
		$data->status = "success";
		$data->response = $response;
		if(is_array($response))
		{
			$data->type = "array";
		}
		else if(is_object($response))
		{
			$data->type = "object";
		}
		else
		{
			$data->type = "string";
		}
	    $this->response($data);
	}
	public function _remap($object_called, $arguments)
	{
		$controller_method = $object_called.'_'.$this->request->method;
		if(!in_array($controller_method, $this->open_methods) && $this->request->method!="get")
		{
			$this->_authenticate();
		}
		parent::_remap($object_called, $arguments);
	}
	public function _authenticate()
	{	
		$user_id = $this->post('user_id');
		$auth_token = $this->post('auth_token');
		if($user_id && $auth_token)
		{
			//authenticate & pull the user details from your model here
			$details = new stdClass(); 
			$details->name = "Aakash";
			if($details)
			{
				$this->user_details = $details;
			}
			else
			{
				$this->failed_response(1003);
			}
		}
		else
		{
			$this->failed_response(1002,'Please enter both a user_id and auth token');
		}
	}
}