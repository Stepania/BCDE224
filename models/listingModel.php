<?php 
class ListingModel extends AbstractModel {

    private $productID;
    private $productName;
    private $productDescription;
    private $photo;
    private $price;
    private $listingDate;
    private $sellerID;
    private $sellerName;
    private $businessLogo;
    private $changed;
    
    public function __construct($db, $id=null, $productName=null, $productDescription=null, $photo=null, $price=null, $listingDate=null, 
    $hashTag=null, $sellerID=null, $sellerContact=null, $sellerName=null) {
		parent::__construct($db);
        $this->productID=$id;
		$this->setproductName($productName);
        $this->setproductDescription($productDescription);
		$this->setProductPicture($photo);
		$this->setPrice($price);
        $this->setListingDate($listingDate);
        $this->setSellerID($sellerID);
        $this->setsellerName($sellerName);
		$this->changed=false;
	}
	//getters
	public function getID() {
		return $this->productID;
        echo("xbxcvbxcb");
	}
	
	public function getproductName() {
		return $this->productName;
	}

    public function getBusinessLogo(){
        return $this->businessLogo;
    }

	public function getproductDescription() {
		return $this->productDescription;
	}
	
    public function getSellerName(){
        return $this->sellerName;
    }

    public function getSellerContact(){
        return $this->sellerContact;
    }
	
    public function getProductPicture() {
        return $this->photo;
    }

    public function getPrice() {
        return $this->price;
    }
    
    public function getSellerID(){
        return $this->sellerID;
    }

    public function getListingDate() {
        return $this->listingDate;
    }
    //setters

    public function setSellerID($value){
        
        $this->sellerID = $value;
        $this->changed = true;
    }
    public function setListingDate($value){
        $this->listingDate=$value;
        $this->changed=true;
    }

    public function setSellerName($value){
        $this->sellerName = $value;
        $this->changed=true;
    }
    public function setproductDescription($value) {
		$this->productDescription=$value;
		$this->changed=true;
	}

    public function setproductName($value) {
		$this->productName=$value;
		$this->changed=true;
	}
    public function hasChanges() {
		return $this->changed;
	}
    public function setProductPicture($value) {
        $this->photo=$value;
    } 
    public function setPrice($value) {
        $this->price = $value;
        $this->changed=true; 
    }

	public function load($id) {  
        
        $this->productID = $id;     
        $sql="CALL sp_showProduct('$id')";
        $rows=$this->getDB()->query($sql);
        if (count($rows)==0) {
            throw new Exception("listing id $id not found");
        }
        $row=$rows[0];
        $this->productName=$row['productName'];
        $this->productDescription=$row['productDescription'];
        $this->photo=$row['productPicture'];
        $this->price=$row['price'];
        $this->listingDate=$row['listingDate'];
        $this->sellerID=$row['sellerID'];
        $this->sellerName=$row['sellerName'];
        $this->businessLogo=$row['companyLogo'];
        $this->changed=false;		
	}
    
	public function save() {
		$id=$this->productID;
		$name=$this->productName;
		$descrip=$this->productDescription;
        $photo=$this->photo;
        $price=$this->price;
        $sellID=$this->sellerID;
        $date = $this->listingDate;

		
		if ($id === null) {
            
			$sql="insert into product(productName, productDescription, productPicture, 
            price, listingDate, sellerID) 
            values ("."'$name', '$descrip', '$photo', '$price', now(), '$sellID');";
			$this->getDB()->execute($sql);
            echo("dsvdd");
			$this->productID=$this->getDB()->getInsertID();	
		} else {

            $sql= 
			 "update product ".
					"set productName = '$name', ".
			            "productDescription='$descrip', ".
                        "productPictutre= '$photo', ".
                        "price= $price, ".
                        "listingDate= now(), ".
                        "sellerID='$sellID'".
					"where productID = '$id'";
			$this->getDB()->execute($sql);
		}
		$this->hasChanges=false;
	}
	
	public function delete ($id) {
	    $sql="delete from product where productID =$id;";
		$rows=$this->getDB()->execute($sql);
		$this->id=null;
		$this->changed=false;
	}





}
?>