<?php
namespace AppBundle\Validation;

interface ValidationInterface{
	public function isValid($param): bool;
	public function getErrors(): array;
}