<?php

namespace App\Entity;

class PlayerWanabe
{
    protected $id;
    protected $project = 'NAFUTSAL_PlayerWanabe'; // For different events

    // Season Desired
    protected $seasonDesired;

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
    
    protected $status = 'Available';  //change to "Joined" when joined a team
    
    // =========================================================
    public function getId()        { return $this->id;         }
    public function getProject()   { return $this->project;    }

    public function getSeasonDesired()  { return $this->seasonDesired;   }
    
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
    
    // ===============================================================
    public function setId     ($value)    { $this->id      = $value; }
    public function setProject($value)    { $this->project = $value; }
    
    public function setSeasonDesired($value)   { $this->seasonDesired = $value; }
    
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
    
    public function setNameFirstParent ($value) { $this->nameFirstParent = $value; }
    public function setNameLastParent ($value)  { $this->nameLastParent  = $value; }
    public function setRelationship ($value)    { $this->relationship = $value; }
        
    public function setMedicalConditions ($value)    { $this->medicalConditions = $value; }
    public function setNameDoctor ($value)           { $this->nameDoctor = $value; }
    public function setNameEmergencyContact ($value) { $this->nameEmergencyContact = $value; }
    
    public function setVolunteerism ($value)    { $this->volunteerism = $value; }
        
    public function setStatus($value)  { $this->status = $value; } 
    
    public function __construct()
    {
        
    }     
}
