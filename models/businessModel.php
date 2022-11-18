<?php 
class BusinessModel extends AbstractModel {

    private $businessID;
    private $name;
    private $address;
    private $NZBN;
    private $bankAccount;
    private $companyLogo;
    private $users;
    private $changed;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, $id=null, $name=null, $bankAccount=null, $NZBN=null, 
    $address=null, $companyLogo=null) {
		parent::__construct($db);
        // id cant change
        $this->businessID=$id;
        $this->setcompanyName($name);
        $this->setNZBN($NZBN);
		$this->setbankAccount($bankAccount);
		$this->setcompanyLogo($companyLogo);
        $this->setaddress($address);
		$this->changed=false;
	}
    //Getters
	public function getBusinessID() {
		return $this->businessID;
	}
    public function getName() {
		return $this->name;
	}
	public function getNZBN() {
		return $this->NZBN;
	}
		
	public function getbankAccount() {
		return $this->bankAccount;
	}

	public function getcompanyLogo() {
        return $this->companyLogo;
    }
    public function getaddress() {
        return $this->address;
    }

	public function hasChanges() {
		return $this->changed;
	}

    public function setaddress($value){
        $this->address=$value;
        $this->changed=true;
    }

	public function setcompanyName($value) {
		$this->name=$value;
		$this->changed=true;
	}
    public function setNZBN($value) {
		$this->NZBN=$value;
		$this->changed=true;
	}
    public function setbankAccount($value) {
		$this->bankAccount=$value;
		$this->changed=true;
	}
    public function setcompanyLogo($value) {
        $this->companyLogo = $value;
        $this->changed=true; 
    }
    public function getLogo() {
        return $this->companyLogo;
    }


    
	public function load($id) {   
            $this->businessID = $id;
            $sql="select * from business where businessID = '$id';";
            $rows=$this->getDB()->query($sql);
            if (count($rows)==0) {
                throw new InvalidDataException("user slkdjfkls username not found");
            }
            $row=$rows[0];
            $this->name=$row['companyName'];
            $this->NZBN=$row['NZBN'];
            $this->bankAccount=$row['bankAccount'];
            $this->companyLogo=$row['companyLogo'];
            $this->address=$row['address'];
            $this->changed=false;
        
		
	}
	
	public function save() {
        
		$id=$this->businessID;        
		$name=$this->name;
        $adres=$this->address;
        $bnknum=$this->bankAccount;
        $NZBN=$this->NZBN;
        $companyLogo=$this->companyLogo;
		
		if ($id === null) {            
			$sql="insert into business(companyName, NZBN, bankAccount, companyLogo, 
            address) 
            values ("."'$name', '$NZBN', '$bnknum', '$companyLogo', '$adres')";
			$this->getDB()->execute($sql);
			$this->businessID=$this->getDB()->getInsertID();	
		} else {
            
			$sql="update business ".
					"set companyName='$name', ".
			            "NZBN='$NZBN', ".
                        "bankAccount='$bnknum', ".
                        "companyLogo='$companyLogo', ".
                        "address='$adres' ".
                        "where businessID = $id;";
			$this->getDB()->execute($sql);
            
		}
		$this->hasChanges=false;
        
        
	}
	
	public function delete () {
	    // $sql="delete from business where businessID = $id;";
		// $rows=$this->getDB()->execute($sql);
		// $this->id=$null;
		// $this->changed=false;
	}
    // users
    public function getUsers(){
        
        $sql = "select * from agorauser where businessID =" .$this->businessID. ";";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("users not found");
        }
        foreach ($rows as $row){
            $id = $row['userID'];
            $firstName=$row['firstName'];
            $lastName=$row['lastName'];
            $username=$row['username'];
            $address=$row['address'];
            $role=$row['userRole'];
            $businessID=$row['businessID'];
            $email=$row['email'];
            $password=$row['userPassword'];
            $user = new UserModel($this->getDB(), $username, $id, $email, $password, $firstName, $lastName, $role, 
            $address, $businessID);
            $this->users[]=$user;
    }
    return $this->users;
    }
}
?>