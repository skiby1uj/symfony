<?php
namespace AppBundle\Validation\Validator;


class UserValidator
{
	public function validate($user)
	{
		$errors = [];

		if ( empty ( $user->firstName ) )
			$errors [] = "Podaj pierwsze imie";
		if ( empty( $user->lastName ) )
			$errors [] = "Podaj ostatnie imie";

		return $errors;
	}
}