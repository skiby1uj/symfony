<?php
namespace AppBundle\Validation\Validator;


class DateValidator implements ValidatorInterface
{
	public function validate($date) :array
	{
		$errors = [];

		if (empty($date))
		{
			$errors[] = "Data jest wymagana";
			return $errors;
		}

		$date = strtotime($date);

		$year =  date("y", $date);
		$month = date("m", $date);
		$day =   date("d", $date);

		if (!checkdate($month, $day, $year))
			$errors[] = 'Data jest niepoprawna';

		return $errors;
	}
}