<?php

namespace App\Entity;

/* ==============================================
 * Each game has a project and a level
 * game.num is unique within project
 */
class Team
{
    protected $id;
    protected $project = 'NAFUTSAL_Summer2017'; // For different events
    
    protected $teamName;
    protected $teamLevel;
    protected $teamColor;
    
    protected $teamAge;
    protected $teamGender;
    
    // POC
    protected $nameFirst;
    protected $nameLast;
    protected $dob;
    protected $gender;
    
    protected $email;
    
    protected $phoneHome;
    protected $phoneCell;
    protected $phoneWork;
    
    protected $street;
    protected $city;
    protected $state;
    protected $zipCode;
    
    protected $learn;
    
    protected $status = 'Applied';
    
    protected $fee;
    protected $feeStatus;
        
    // =========================================================
    public function getId()        { return $this->id;         }
    public function getProject()   { return $this->project;    }
    
    public function getTeamName()   { return $this->teamName;   }
    public function getTeamLevel()  { return $this->teamLevel;  }
    public function getTeamColor()  { return $this->teamColor;  }
    public function getTeamAge()    { return $this->teamAge;    }
    public function getTeamGender() { return $this->teamGender; }
    
    // POC
    public function getNameFirst() { return $this->nameFirst;  }
    public function getNameLast () { return $this->nameLast;   }
    
    public function getDob()       { return $this->dob;        }
    public function getGender()    { return $this->gender;     }
    
    public function getEmail()     { return $this->email;      }
    public function getPhoneHome() { return $this->phoneHome;  }
    public function getPhoneCell() { return $this->phoneCell;  }
    public function getPhoneWork() { return $this->phoneWork;  }
    
    public function getStreet()    { return $this->street;     }
    public function getCity()      { return $this->city;       }
    public function getState()     { return $this->state;      }
    public function getZipCode()   { return $this->zipCode;    }
    
    public function getStatus()    { return $this->status;     }
    public function getLearn ()    { return $this->learn;      }
    
    public function getFee()       { return $this->fee;        }
    public function getFeeStatus() { return $this->feeStatus;  }
    
    // ===============================================================
    public function setId     ($value)    { $this->id      = $value; }
    public function setProject($value)    { $this->project = $value; }
    
    public function setTeamName  ($value) { $this->teamName   = $value; }
    public function setTeamLevel ($value) { $this->teamLevel  = $value; }
    public function setTeamColor ($value) { $this->teamColor  = $value; }
    public function setTeamGender($value) { $this->teamGender = $value; }
    
    public function setNameFirst($value)  { $this->nameFirst = $value; }
    public function setNameLast ($value)  { $this->nameLast  = $value; }
    public function setDob      ($value)  { $this->dob       = $value; }
    public function setGender   ($value)  { $this->gender    = $value; }
        
    public function setEmail    ($value)  { $this->email     = $value; }
    public function setPhoneHome($value)  { $this->phoneHome = $value; }
    public function setPhoneCell($value)  { $this->phoneCell = $value; }
    public function setPhoneWork($value)  { $this->phoneWork = $value; }
    
    public function setStreet   ($value)  { $this->street  = $value; }
    public function setCity     ($value)  { $this->city    = $value; }
    public function setState    ($value)  { $this->state   = $value; }
    public function setZipCode  ($value)  { $this->zipCode = $value; }
    
    public function setFee      ($value)  { $this->fee       = $value; }
    public function setFeeStatus($value)  { $this->feeStatus = $value; }
    
    public function setLearn    ($value)  { $this->learn  = $value; }
    public function setStatus   ($value)  { $this->status = $value; }
    
    public function __construct()
    {
        
    }
    
    public function setTeamAge($age) 
    { 
        $this->teamAge = $age;
        
        switch($age)
        {
            case 'U09': case 'U10': case 'U11': case 'U12':
                $fee = '185.00';    //Season Deposit = $185, exactly= ($320 + $50) / 2    //Full Price was 350, but now 395 or 400
                break;              //All Tourney Fee = $250, Early Bird = $200
            
            case 'U13': case 'U14': case 'U15': case 'U16': case 'U13-15 (MS)':
                $fee = '240.00';    //Season Deposit = $240, approx.= ($400 + $75) / 2    //Full Price was 450, but now 495 or 500
                break;              //All Tourney Fee = $300, Early Bird = $250
            
            case 'U17': case 'U18': case 'U19': case 'U16-19 (HS)':
                $fee = '290.00';    //Season Deposit = $290, exactly= ($480 + $100) / 2   //Full Price was 550, but now 595 or 600
                break;              //All Tourney Fee = $350, Early Bird = $300
                 
            case 'Adult':           // 10-GAME Session: Season Deposit = $365, exactly= ($630 + $100) / 2  //Full Price was 688, but now 744 or 750
                $fee = '290.00';    //  8-GAME Session: Season Deposit = $290, approx.= ($480 + $100) / 2  //Full Price was 550, but now 595 or 600
                break;              //All Tourney Fee = $350, Early Bird = 300
             
            default: $fee = null;
        }
        $this->setFee($fee);
    }
     
    public function getTeamDivision()
    {
        $age    = $this->teamAge;
        $gender = $this->teamGender;
        
        if ($age == 'Adult')
        {
            switch($gender)
            {
                case 'M': return $age . ' Men';
                case 'F': return $age . ' Women';
                default: return null;
            }
        }
        switch($gender)
        {
            case 'M': return $age . ' Boys';
            case 'F': return $age . ' Girls';
        }
        return null;
    }
}
