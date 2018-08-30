<?php
namespace AppBundle\Validation;


use AppBundle\Validation\Validator\ValidatorInterface;

class FourNumberValidation implements ValidationInterface
{

	/**
	 * @var ValidatorInterface
	 */
	private $fourNumberValidator;
	private $errors;

	public function __construct(ValidatorInterface $fourNumberValidator)
	{
		$this->fourNumberValidator = $fourNumberValidator;
		$this->errors = [];
	}

	public function isValid($number): bool
	{
		$this->errors = $this->fourNumberValidator->validate($number);
		return (count($this->errors) > 0 ) ? false : true;
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}