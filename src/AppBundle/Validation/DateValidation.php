<?php
namespace AppBundle\Validation;

use AppBundle\Validation\Validator\ValidatorInterface;

class DateValidation implements ValidationInterface
{
	/**
	 * @var ValidatorInterface
	 */
	private $dateValidator;
	private $errors;

	public function __construct(ValidatorInterface $dateValidator)
	{
		$this->dateValidator = $dateValidator;
		$this->errors = [];
	}

	public function isValid($date): bool
	{
		$this->errors = $this->dateValidator->validate($date);
		return (count($this->errors) > 0 ) ? false : true;
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}
