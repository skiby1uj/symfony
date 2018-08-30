<?php
namespace AppBundle\Controller;


use AppBundle\Validation\DateValidation;
use AppBundle\Validation\FourNumberValidation;
use AppBundle\Validation\Validator\DateValidator;
use AppBundle\Validation\Validator\FourNumberValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PeselController extends Controller
{
	/**
	 * @Route("/getpesel")
	 */
	public function getPeselAction(Request $request)
	{
		$dateErrors = [];
		$fourNumberErrors = [];
		$peselNumber = '';

		$date = $request->request->get('date_born');
		$number = $request->request->get('number');

		$validationDate = new DateValidation( new DateValidator() );
		$isValidationDate = $validationDate->isValid($date);
		if (!$isValidationDate)
		{
			$dateErrors = ($validationDate->getErrors());
		}

		$validationFourNumber = new FourNumberValidation( new FourNumberValidator() );
		$isValidationFourNumber = $validationFourNumber->isValid($number);
		if (!$isValidationFourNumber)
		{
			$fourNumberErrors = $validationFourNumber->getErrors();
		}

		if ( $isValidationDate && $isValidationFourNumber )
		{
			$pattern = $this->getPattern($date, $number);

			$missingNumber = $this->checkPeselNumber($pattern);

			$peselNumber = $this->getPeselNumber($date, $missingNumber, $number);
		}

		return $this->render( "pesel/index.html.twig",[
			'peselNumber' => $peselNumber,
			'dateErrors' => $dateErrors,
			'numberErrors' => $fourNumberErrors
		] );
	}

	private function getPattern($date, $number): int
	{
		$date = strtotime($date);

		$year =  date("y", $date);
		$month = date("m", $date);
		$day =   date("d", $date);

		return ($year[0] + 3*$year[1] + 7*$month[0] + 9*$month[1] + $day[0] +
			3*$day[1] + 9*$number[0]+ $number[1] + 3*$number[2] + $number[3]);
	}

	private function checkPeselNumber( $pattern ): int
	{
		for ( $g = 0; $g <= 9; $g++ )
		{
			$score = $pattern + 7 * $g;

			if ( $score % 10 == 0 )
				return $g;
		}
		return false;
	}

	private function getPeselNumber($date, $missingNumber, $number): string
	{
		if ( !empty($number) )
		{
			$date = strtotime($date);

			$year =  date("y", $date);
			$month = date("m", $date);
			$day =   date("d", $date);

			if ( $missingNumber !== false )
				return $year.$month.$day.$missingNumber.$number;
		}

		return '';
	}
}