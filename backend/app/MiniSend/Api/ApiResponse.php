<?php 

namespace App\MiniSend\Api;

class ApiResponse
{
	public static function success(String $message, Array $data = [])
	{
		$response = array_merge([
			'code'		=>	ResponseCodes::RESPONSE_CODE_SUCCESS,
			'message'	=>	$message
		], $data);

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_SUCCESS);
	}

	public static function validationError(Array $errors = [], String $message=null)
	{
		$_message = $message == null ? ResponseMessages::MESSAGE_DEFAULT_VALIDATION_ERROR :
			$message;

		$response = array_merge([
			'code'		=>	ResponseCodes::RESPONSE_CODE_VALIDATION_ERROR,
			'message'	=>	$_message
		], $errors);

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_VALIDATION_ERROR);
	}

	public static function validateError(String $message=null)
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_VALIDATION_ERROR;
		$response['message'] = $message;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_VALIDATION_ERROR);
	}


	public static function unauthorized()
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_UNAUTHORIZED;
		$response['message'] = ResponseMessages::MESSAGE_LOGIN_UNAUTHORIZED;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_UNAUTHORIZED);
	}

	public static function forbidden(String $message=null)
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_FORBIDDEN;
		$response['message'] = $message != null ? $message : ResponseMessages::MESSAGE_FORBIDDEN;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_FORBIDDEN);
	}

	public static function generalError(String $message=null)
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_GENERAL_ERROR;
		$response['message'] = $message != null ? $message : 
			ResponseMessages::MESSAGE_GENEAL_ERROR;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_GENERAL_ERROR);
	}

	public static function notFoundError(String $message=null)
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_NOT_FOUND;
		$response['message'] = $message != null ? $message : 
			ResponseMessages::MESSAGE_NOT_FOUND;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_NOT_FOUND);
	}

	public static function serverError()
	{
		$response['code'] = ResponseCodes::RESPONSE_CODE_SERVER_ERROR;
		$response['message'] = ResponseMessages::MESSAGE_SERVER_ERROR;

		return response()
			->json($response, ResponseCodes::RESPONSE_CODE_SERVER_ERROR);
	}
}