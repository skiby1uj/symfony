<?php
/**
 * Created by PhpStorm.
 * User: grzegorz
 * Date: 13.08.18
 * Time: 22:28
 */

namespace AppBundle\Helper;


class Checker
{
	private $isValid = false;

	public function isValid($val = 'B')
	{
		if($val == 'A')
			$this->isValid = true;

		return $this->isValid;
	}
}