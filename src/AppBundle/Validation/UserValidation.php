<?php
namespace AppBundle\Validation;


use AppBundle\Validation\Validator\UserValidator;

class UserValidation
{
	private $userValidator;

	public function __construct( UserValidator $userValidator )
	{
		$this->userValidator = $userValidator;
	}

	public function isValid( $user )
	{
		$errors = $this->userValidator->validate( $user );
		return ( count( $errors ) > 0 ) ? false : true;
	}
}