<?php

/**
 * Class IrValidator
 */

class IrValidator
{

    /**
     * Validate Iranian National Code
     * @param $code
     * @return bool
     */
	public function nationalCode($code)
    {
        if (empty($code))
            return false;

        $lengthCode = strlen($code);
        if($lengthCode != 10)
            return false;

        $invalidCodes = array(
            0000000000,
            1111111111,
            2222222222,
            3333333333,
            4444444444,
            5555555555,
            6666666666,
            7777777777,
            8888888888,
            9999999999
        );

        if (in_array($code, $invalidCodes)) 
            return false;
        
        $checkNumber = substr($code, 9, 1);
        $sum = 0;
        for ($i = 0; $i < 9; $i++)
            $sum += substr($code, $i, 1) * (10 - $i);

        $remain = $sum % 11;
        if (($remain < 2 && $checkNumber == $remain) || ($remain >= 2 && $checkNumber == (11 - $remain)))
            return true;
        else
            return false;
    }

    /**
     * Validate Iranian National Id (Company Id)
     * @param $id
     * @return bool
     */
	public function nationalId($id)
    {
        if (empty($id))
            return false;

        $lengthId = strlen($id);
        if($lengthId != 11)
            return false;

        $invalidIds = array(
            00000000000,
            11111111111,
            22222222222,
            33333333333,
            44444444444,
            55555555555,
            66666666666,
            77777777777,
            88888888888,
            99999999999
        );

        if (in_array($id, $invalidIds)) 
            return false;
        
        $multiplier = array(29, 27, 23, 19, 17, 29, 27, 23, 19, 17);
        $checkNumber = substr($id, 10, 1);
        $decimalNumber = substr($id, 9, 1);
        $multiplication = $decimalNumber + 2;
        $sum = 0;

        for ($i = 0; $i < 10; $i++)
            $sum += (substr($id, $i, 1) + $multiplication) * $multiplier[$i];

        $remain = $sum % 11;
        if($remain == 10)
            $remain = 0;

        if ($remain == $checkNumber)
            return true;
        else
            return false;
    }

    /**
     * Validate Iranian debit card number
     * @param $cardNumber
     * @return $bool
     */
    public function debitCard($cardNumber)
    {
        $checkDebitCardStatus = $this->checkDebitCard($cardNumber);
        if($checkDebitCardStatus == false)
            return false;

        $checkNumber = substr($cardNumber, 15, 1);
        $sum = 0;
        $multiplier = 0;
        for ($i = 16; $i > 0; $i--) {
            $multiplier = ($i % 2 == 0) ? 2 : 1;
            $multiplication = (int) substr($cardNumber, 16 - $i, 1) * $multiplier;
            $sum += ($multiplication > 9) ? $multiplication - 9 : $multiplication;
        }
        $remain = (($sum % 10) == 0);
        return $remain;
    }

    /**
     * Validate Iranian IBAN (sheba)
     * @param $iban
     * @return bool
     */
    public function iban(string $iban)
    {
        $checkIbanStatus = $this->checkIban($iban);
        if($checkIbanStatus == false)
            return false;
        $convertIban = substr($iban,2).'1827'.substr($iban,0,2);
        $remain = bcmod($convertIban, 97);
        if ($remain == 1)
            return true;
        else
            return false;
    }

    /**
     * Validate Iranian Postal Code
     * this valitator check 5 digits at the beginning
     * @param $code
     * @return bool
     */
    public function postalCode($code)
    {
        $lengthCode = strlen($code);
        if($lengthCode != 10)
            return false;
        $checkNumber = substr($code, 0, 5);
        $status = (bool) preg_match("/^([13456789]{5})$/", $checkNumber);
        return $status;
    }

    /**
     * Validate Iranian debit Card length
     * @param $cardNumber
     * @return bool
     */
    private function checkDebitCard($cardNumber)
    {
        if (empty($cardNumber))
            return false;

        $lengthCardNumber = strlen($cardNumber);
        if($lengthCardNumber != 16)
            return false;
        return true;
    }

    /**
     * Validate Iranian IBAN length
     * @param $iban
     * @return bool
     */
    private function checkIban($iban)
    {
        if (empty($iban))
            return false;

        $lengthIban = strlen($iban);
        if($lengthIban != 24)
            return false;
        return true;
    }
}