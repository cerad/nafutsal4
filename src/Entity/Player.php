<?php

namespace App\Entity;

/* ==============================================
 * Each game has a project and a level
 * game.num is unique within project
 */
class Player
{
    protected $id;
    protected $project = 'NAFUTSAL_Player_2018_summer_season'; // For different seasons (events)

    // Play Date
    protected $playDate;

    // Player
    protected $nameFirstPlayer;
    protected $initialPlayer;
    protected $nameLastPlayer;
    protected $gender;
    protected $dob;
    
    // Address
    protected $street;
    protected $city;
    protected $state;
    protected $zipCode;
    
    // Phone numbers
    protected $phonePlayer;
    protected $phoneParent;
    protected $phoneDoctor;
    protected $phoneEmergencyContact;
    
    // Experience
    protected $jerseyNumber;
    protected $indoorExperience;
    protected $outdoorExperience;
    protected $shirtSize;
    
    // Player's email address
    protected $emailAddress;
    
    // Flag indicating, at the time of signing up for the "house" team, whether or not registrant has paid the annual USFF player registration fee
    protected $paidAnnualUSFFplayerFee;
    protected $annualUSFFplayerFee = '20';

    // Parent or Guardian
    protected $nameFirstParent;
    protected $nameLastParent;
    protected $relationship;
    
    // Medical
    protected $medicalConditions;
    protected $nameDoctor;
    protected $nameEmergencyContact;

    // Volunteer
    protected $volunteerism;
    
    protected $status = 'Applied';
    
    protected $fee = '57.00';
    protected $feeStatus;
        
    // =========================================================
    public function getId()        { return $this->id;         }
    public function getProject()   { return $this->project;    }

    public function getPlayDate()  { return $this->playDate;   }
    
    public function getNameFirstPlayer()   { return $this->nameFirstPlayer;   }
    public function getInitialPlayer () { return $this->initialPlayer;  }
    public function getNameLastPlayer()  { return $this->nameLastPlayer;  }
    public function getGender()    { return $this->gender; }
    public function getDob()       { return $this->dob; }
    
    public function getStreet()    { return $this->street;     }
    public function getCity()      { return $this->city;       }
    public function getState()     { return $this->state;      }
    public function getZipCode()   { return $this->zipCode;    }

    // Phone numbers
    public function getPhonePlayer() { return $this->phonePlayer;  }
    public function getPhoneParent() { return $this->phoneParent;  }
    public function getPhoneDoctor() { return $this->phoneDoctor;  }
    public function getPhoneEmergencyContact() { return $this->phoneEmergencyContact;  }
    
    // Experience
    public function getJerseyNumber() { return $this->jerseyNumber;  }
    public function getIndoorExperience ()  { return $this->indoorExperience; }
    public function getOutdoorExperience ()  { return $this->outdoorExperience; }
    public function getShirtSize() { return $this->shirtSize;  }

    public function getEmailAddress()     { return $this->emailAddress;      }
    
    public function getPaidAnnualUSFFplayerFee()     { return $this->paidAnnualUSFFplayerFee;      }
    public function getAnnualUSFFplayerFee()         { return $this->annualUSFFplayerFee; }
    
    // Parent or Guardian
    public function getNameFirstParent() { return $this->nameFirstParent;  }
    public function getNameLastParent () { return $this->nameLastParent;   }
    public function getRelationship ()   { return $this->relationship; }

    // Medical
    public function getMedicalConditions () { return $this->medicalConditions; }
    public function getNameDoctor ()        { return $this->nameDoctor; }
    public function getNameEmergencyContact () { return $this->nameEmergencyContact; }

    public function getVolunteerism ()  { return $this->volunteerism; }

    public function getStatus()    { return $this->status;     }
    
    public function getFee()       { return $this->fee;        }
    public function getFeeStatus() { return $this->feeStatus;  }
    
    // ===============================================================
    public function setId     ($value)    { $this->id      = $value; }
    public function setProject($value)    { $this->project = $value; }
    
    public function setPlayDate($value)   { $this->playDate = $value; }
    
    public function setNameFirstPlayer ($value) { $this->nameFirstPlayer = $value; }
    public function setInitialPlayer ($value)   { $this->initialPlayer = $value; }
    public function setNameLastPlayer ($value)  { $this->nameLastPlayer = $value; }
    public function setGender($value)           { $this->gender = $value; }
    public function setDob ($value)             { $this->dob = $value; }
    
    public function setStreet   ($value)  { $this->street  = $value; }
    public function setCity     ($value)  { $this->city    = $value; }
    public function setState    ($value)  { $this->state   = $value; }
    public function setZipCode  ($value)  { $this->zipCode = $value; }
    
    public function setPhonePlayer ($value)  { $this->phonePlayer = $value; }
    public function setPhoneParent ($value)  { $this->phoneParent = $value; }
    public function setPhoneDoctor ($value)  { $this->phoneDoctor = $value; }
    public function setPhoneEmergencyContact ($value)  { $this->phoneEmergencyContact = $value; }

    public function setJerseyNumber ($value)  { $this->jerseyNumber = $value; }
    public function setIndoorExperience ($value)   { $this->indoorExperience = $value; }
    public function setOutdoorExperience ($value)  { $this->outdoorExperience = $value; }
    public function setShirtSize ($value)  { $this->shirtSize = $value; }
    
    public function setEmailAddress ($value)  { $this->emailAddress = $value; }

    public function setPaidAnnualUSFFplayerFee ($value)
    {
        $this->paidAnnualUSFFplayerFee = $value; // $value is a flag, 1 or 0, Yes or No to "Paid Annual USFF Player Fee?"

        //Also set the AMOUNT of the annual fee
        if ($value == 0) // 0 means player has NOT paid the annual fee
        {
            if ( time() < gmmktime(6,0,0,10,9,2017) ) // Oct 9, 2017 GMT, which is midnight CDT
                $this->setAnnualUSFFplayerFee ('10.00');
            else
                $this->setAnnualUSFFplayerFee ('20.00');
        }
        else // player HAS paid the annual fee and does not need to pay it again
        {
            $this->setAnnualUSFFplayerFee ('20.00');  // 20 regardless, in the fall
        }
    }
    // For PlayerPaymentIndex.html.twig
    public function getOwedUSSFPlayerFee()
    {
        if ($this->getPaidAnnualUSFFplayerFee()) return 0.00;
        return $this->getAnnualUSFFplayerFee();
    }
    public function setAnnualUSFFplayerFee     ($value) { $this->annualUSFFplayerFee = $value; }
    
    public function setNameFirstParent ($value) { $this->nameFirstParent = $value; }
    public function setNameLastParent ($value)  { $this->nameLastParent  = $value; }
    public function setRelationship ($value)    { $this->relationship = $value; }
        
    public function setMedicalConditions ($value)    { $this->medicalConditions = $value; }
    public function setNameDoctor ($value)           { $this->nameDoctor = $value; }
    public function setNameEmergencyContact ($value) { $this->nameEmergencyContact = $value; }
    
    public function setVolunteerism ($value)    { $this->volunteerism = $value; }
        
    public function setStatus($value)  { $this->status = $value; } 
    
    public function setFee      ($value)  { $this->fee       = $value; }
    public function setFeeStatus($value)  { $this->feeStatus = $value; } 
    
    public function __construct()
    {
        
    }
}
