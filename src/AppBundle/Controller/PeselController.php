<?php
namespace AppBundle\Controller;


use AppBundle\Model\PeselModel;
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
			$peselModel = new PeselModel($date, $number);
			$peselNumber = $peselModel->getPeselNumber();
		}

		return $this->render( "pesel/index.html.twig",[
			'peselNumber' => $peselNumber,
			'dateErrors' => $dateErrors,
			'numberErrors' => $fourNumberErrors
		] );
	}
}