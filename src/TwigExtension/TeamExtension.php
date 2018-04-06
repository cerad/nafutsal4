<?php

namespace App\TwigExtension;

use App\DataTransformer\PhoneTransformer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TeamExtension extends AbstractExtension
{
    public function getName() { return 'cerad_team'; }

    public function getFilters()
    {
        return [
            new TwigFilter('cerad_phone',[$this, 'phone']),
            new TwigFilter('cerad_date', [$this, 'date']),
            new TwigFilter('cerad_age',  [$this, 'age']),
            new TwigFilter('cerad_email',[$this, 'email']),
        ];
    }

    /* ===================================================
     * Phone transformer
     */
    protected $phoneTransformer;
    
    public function phone($value)
    {
        if (!$this->phoneTransformer) $this->phoneTransformer = new PhoneTransformer();
        
        return $this->phoneTransformer->transform($value);
    }

    public function date(\DateTime $value)
    {
        if (!$value) return null;
        return $value->format('Y-m-d');
    }

    public function age($dob)
    {
        if (!$dob) return null;
        $asOf = new \DateTime();
        $interval = $asOf->diff($dob);
        $years = $interval->format('%y');
        return $years;
    }
    
    public function email($value)
    {
        if (!$value) return null;
        $obfusEmail = str_replace("@","[at]",$value);
        return $obfusEmail;
    }

}

