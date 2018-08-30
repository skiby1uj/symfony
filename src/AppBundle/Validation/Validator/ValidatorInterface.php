<?php

namespace AppBundle\Validation\Validator;

interface ValidatorInterface{
	public function validate($param): array;
}