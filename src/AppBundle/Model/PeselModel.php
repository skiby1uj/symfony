<?php
namespace AppBundle\Model;


class PeselModel
{
	private $peselIsCorrect;
	private $year;
	private $month;
	private $day;
	private $endNumber;

	public function __construct(string $date, string $endNumber)
	{
		$date = strtotime($date);

		$this->year 	= date("y", $date);
		$this->month 	= date("m", $date);
		$this->day 		= date("d", $date);

		$this->endNumber[0] = -1;
		for ($i=0; strlen($endNumber) > $i; $i++)
			$this->endNumber[$i+1] = $endNumber[$i];

		$missingNumber = $this->getMissingNumber();

		if ($missingNumber >= -1)
		{
			$this->endNumber[0] = (string)$missingNumber;
			$this->peselIsCorrect = true;
		}
		else
			$this->peselIsCorrect = false;
	}

	public function getPeselNumber(): string
	{
		if ($this->peselIsCorrect)
			return (string)($this->year.$this->month.$this->day.implode("", $this->endNumber));

		return '';
	}

	private function getPattern(): int
	{
		return ($this->year[0] + 3*$this->year[1] + 7*$this->month[0] + 9*$this->month[1] + $this->day[0] +
			3*$this->day[1] + 9*$this->endNumber[1]+ $this->endNumber[2] + 3*$this->endNumber[3] + $this->endNumber[4]);
	}

	private function getMissingNumber(): int
	{
		$pattern = $this->getPattern();

		for ( $g = 0; $g <= 9; $g++ )
		{
			$score = $pattern + 7 * $g;

			if ( $score % 10 == 0 )
				return $g;
		}
		return -1;
	}
}