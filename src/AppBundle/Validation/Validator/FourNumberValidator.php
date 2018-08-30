<?php
namespace AppBundle\Validation\Validator;


class FourNumberValidator implements ValidatorInterface
{

	public function validate($number):array
	{
		$errors = [];

		if ( strlen( $number ) != 4 || !is_numeric( $number ) )
			$errors[] = "Wymagane są 4 cyfry";

		return $errors;
	}
}