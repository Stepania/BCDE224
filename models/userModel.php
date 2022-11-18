<?php 
include 'lib/abstractModel.php';
include 'models/listingModel.php';
include 'models/businessModel.php';
class UserModel extends AbstractModel {

    private $userName;
    private $userID;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $role;
    private $address;
    private $businessID;
    private $business;
    private $listings;
    private $listing;
    private $changed;
    public $isLogedIn;
    
    //login will create userModel with empty properties and onload will generate, but for sign in will pass all properties to then be saved.
    public function __construct($db, 
    $username=null, $id=null, $email=null, 
    $password=null, $firstName=null, 
    $lastName=null, $role=null, 
    $address=null, 
    $businessID=null) {
		parent::__construct($db);
        $this->setUserName($username);
		$this->setEmail($email);
        $this->hashPassword($password);
		$this->setfirstName($firstName);
		$this->setLastName($lastName);
        // role and id cant change
        $this->userID=$id;
        $this->role=$role;
        $this->setAddress($address);
        $this->setBusinessID($businessID);
		$this->changed=false;
	}
    //Getters
    
	public function getID() {        
		return $this->userID;
	}
    public function getUserName() {
		return $this->userName;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}

    public function getEmail() {
        return $this->email;
    }

	public function getRole() {
        return $this->role;
    }
    public function getAddress() {
        return $this->address;
    }
    
    public function getBusinessID(){
        return $this->businessID;
    }

    public function getBusiness() {
        return $this->business;
    }
    public function getPassword() {
        return $this->password;
    }
	public function hasChanges() {
		return $this->changed;
	}
// setters 
    public function setEmail($value) {
        $this->email = $value;
        $this->changed=true; 
    }

    public function setAddress($value){
        $this->address=$value;
        $this->changed=true;
    }

	public function setLastName($value) {
		$this->lastName=$value;
		$this->changed=true;
	}
    public function setfirstName($value) {
		$this->firstName=$value;
		$this->changed=true;
	}
    public function setPassword($value){
        $this->password = $value;
        $this->changed=true;
    }
    
    public function setUserName($value) {
		$this->userName=$value;
		$this->changed=true;
	}
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    } 

    public function setBusinessID($value){
        $this->businessID = $value;
        $this->changed=true;
    }
    public function setError($value){
        $this->error = $value;
        $this->changed=true;
    }
    public function getError(){
        return $this->error;
    }
    public function checkPasswords(){
        if ($_POST["password"] !== $_POST["confirmPassword"]) {
            throw new Exception("Passwords do not match");
        }
    }

    public function verifyPassword($username, $password){
        $escp = $this->getDB();
        $sql="select userpassword from agorauser WHERE username = '$username'";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("Username $username not found");
        }
        $row=$rows[0];
        $hash=$row['userPassword'];
        $result = false;
        if (password_verify($password, $hash)) {
            $result = true;
        }
        else 
        {
            $result = false;
        }
        return $result;
    }
    function userLogin() {
        session_start();
        $_SESSION['username'] = $this->username;
        return $_SESSION['username'];
      }

    // get user 
	public function getUserByUserName($username) {   
            $this->username = $username;
            $sql="select * from agorauser where username = '$username'";
            $rows=$this->getDB()->query($sql);
            if (count($rows)==0) {
                throw new InvalidDataException("user email $username not found");
            }
            $row=$rows[0];
            $this->firstName=$row['firstName'];
            $this->lastName=$row['lastName'];
            $this->userID=$row['userID'];
            $this->address=$row['address'];
            $this->role=$row['userRole'];
            $this->businessID=$row['businessID'];
            $this->email=$row['email'];
            $this->password=$row['userPassword'];
            $this->changed=false;	
	}
    public function getUserByID($id) {   
        
        $this->userID = $id;
        $sql="select * from agorauser where userID = '$id'";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new InvalidDataException("user id $id not found");
        }
        $row=$rows[0];
        $this->firstName=$row['firstName'];
        $this->lastName=$row['lastName'];
        $this->username=$row['username'];
        $this->address=$row['userAddress'];
        $this->role=$row['userRole'];     

        $this->businessID=$row['businessID'];
        $this->email=$row['email'];
        $this->password=$row['userPassword'];
        $this->changed=false;	
    }
	//needs work on update - Check
	public function save() {        
		$id=$this->userID;
        $username=$this->userName;
		$first=$this->firstName;
		$last=$this->lastName;
        $adres=$this->address;
        $role=$this->role;        
        $email=$this->email;
        $pass=$this->password;
        //im not receiving it for some reason!!!
        $companyID=$this->businessID;
        
		
		if ($this->userID===null) {
			$sql="insert into agorauser(username, email, userPassword, firstName, lastName, 
            userAddress, userRole, businessID) 
            values ("."'$username', '$email', '$pass', '$first', '$last', '$adres', '$role', '$companyID')";
			$this->getDB()->execute($sql);
			$this->userID = $this->getDB()->getInsertID();	
		} else {
			$sql="update agorauser ".
					"set email='$email', ".
			            "userPassword='$pass', ".
                        "firstName='$first', ".
                        "lastName='$last', ".
                        "userAddress='$adres', ".
                        "businessID='$companyID'".
					"where userID= $id";
			$this->getDB()->execute($sql);
		}
		$this->hasChanges=false;
	}
	//needs work
	public function delete ($id) {
        $sql ="delete from listing where sellerID = '$id'";       
		//$rows=$this->getDB()->execute($sql);
        $sql = "delete from agoraUser where userID = '$id'";
        $this->getDB()->execute($sql);
		$this->changed=false;
	}
    
    // Business
    public function editBusiness($db, $id, $businessName, $bnkNum, $NZBN, $adres, $logo){
        //echo("pisos");
        $business = new BusinessModel($db, $id, $businessName, $bnkNum, $NZBN, $adres, $logo);
        $business->save();
        
        return $business;
    }
    public function loadBusiness($db){
        $business = new BusinessModel($db);
        try {
            $business->load($this->businessID);
        }
        catch(Exception $e) {
            $this->setError($e->getMessage());
        }

        $this->business = $business;
    }
    // Listings
    public function loadListings($word){
        switch($this->role){
            case 'admin':
                $sql = "call sp_showProduct(".$this->businessID.")";
                //$sql = "call sp_showAllProducts()";
                echo("need admin");
            break;
            case 'Seller':
                $sql = "call sp_showProduct(".$this->businessID.")";               
                //$sql = "call sp_showAllProducts()";
                echo("need seller");
            break;
            case 'Buyer':
                $sql = "call sp_showProduct(".$this->businessID.")";
                //$sql = "call sp_showAllProducts()";
                //$sql = "select * from agorauser where username='drenders'";
                echo("need Buyer");              
                
                
            break;
        }
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==0) {
        foreach ($rows as $row){
            $productID=$row['productID'];
            $productName=$row['productName'];
            $productDescription=$row['productDescription'];
            $photo=$row['productPicture'];
            $price=$row['price'];
            $listingDate=$row['listingDate'];
            $sellerID=$row['sellerID'];
            $sellerName=$row['sellerName'];
        $listing = new ListingModel($this->getDB(),$productID,$productName,$productDescription,$photo,$price,$listingDate,$sellerID,$sellerName);
            $this->listings[]=$listing;
        }
    }
    }
    public function editListing($db, $id, $productName, $productDescription, $price, $photo){
        $listing = new ListingModel($db, $id, $productName, $productDescription, $photo, 
        $price, null, $this->userID, null, null);
        $listing->save();
        
    }
    public function getListings(){
        return $this->listings;
    }
    // load and get single listing
    public function loadListingByID($db, $id){
        caller();
        $theListing = new ListingModel($db);
        
        $theListing->load($id);

        $this->listing = $theListing;
    }
    public function getSingleListing(){
        return $this->listing;
    }
    public function getlistingPhoto($id) {
        $photo = "1";
        $sql="select productPicture from product where productID = '$id'";
        $rows=$this->getDB()->query($sql);
        if (count($rows)!==0) {
            $row=$rows[0];
            $photo = $row['productPicture'];
        }
        return $photo;
    }

}
?>