<?php
namespace AppBundle\Validation;

interface ValidationInterface{
	public function isValid($param);
	public function getErrors();
}