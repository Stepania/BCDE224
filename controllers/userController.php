<?php
include 'lib/abstractController.php';
include 'models/userModel.php';

class UserController extends AbstractController {

	public function __construct($context) {
		parent::__construct($context);
	}
	protected function getView($isPostback) {
        
        $db=$this->getDB();
		$uri=$this->getURI();
		$action=$uri->getPart();
        $model = new UserModel($db);        
        $view = null;        
        //print((string)$view);
        //print $action;
		switch ($action) {
            case 'login':
                //echo "made it here userControllersign"; 
                include_once 'views/login.php';
                $view = new LoginView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $model->verifyPassword($username, $password);

                    //need some work here!!!! - Create Session
                    $model->getUserByUserName($username);
                    $this->redirect_to('user/'. $model->getID().'');
                }
                break;
            case 'signUp':
                
                include_once 'views/signUp.php';
                $view = new SignView();
                $view->setTemplate('html/form.html');
                // echo("signUp");
                if($_SERVER['REQUEST_METHOD'] == 'POST') { 
                    $logo = $this->addImgFile();                          
                    $business = $model->editBusiness($db, null,
                    $_POST["businessName"], 
                    $_POST["bankNumber"],
                    $_POST["NZBN"],  
                    $_POST["address"], 
                    $logo); 
                    
                    $model= new UserModel($db, $_POST["userName"], null, $_POST["email"], $_POST["password"],
                    null, null, "admin", null, $business->getBusinessID());                                       
                    $model->hashPassword();                                       
                    $model->save();                     
                    $this->redirect_to('login');

                    $id=$this->userID;
                    $username=$this->userName;
                    $first=$this->firstName;
                    $last=$this->lastName;
                    $adres=$this->address;                               
                    $role=$this->role;
                    $companyID=$this->businessID;
                    $email=$this->email;
                    $pass=$this->password;
                    $companyID=$this->businessID;    
                    // print_r($this->businessID);

            }
            break;
            case 'addUser':             
                include_once 'views/addUser.php';
                include_once 'lib/initModel.php';
                //include_once 'public/adminAuth.php';
                // echo("addUser");
                $view = new AddUserView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        $model->checkPasswords();
                    }
                    catch(Exception $e){
                        $model->setError($e->getMessage());
                        break;
                    }
                    $user = new UserModel(
                    $db, $_POST["userName"], null, $_POST["email"], 
                    $_POST["password"], $_POST["firstName"], 
                    $_POST["lastName"], $_POST["role"], 
                    $_POST["userAddress"],                   
                    $model->getBusinessID());
                    $user->hashPassword();  
                    $user->save();
                    $this->redirect_to('/agora/user.php/admin'); 
                }
            break;
            case 'user':       
                include_once 'lib/initModel.php';
                include_once 'views/userIndex.php';
                $view = new UserIndexView();
                $view->setTemplate('html/masterPage.html');
            break;
            case 'signOut':
                include_once 'lib/initModel.php';
                include_once 'views/index.php';
                $view = new IndexView();
                $view->setTemplate('html/masterPage.html');
                $model->getUserByID($id);
            break;
            // TEST buyer and seller listings
            case 'allListings':
                // caller();
                include_once 'lib/initModel.php';
                // 
                include_once 'views/allListings.php';
              
                $view = new AllListingsView();
                
                $view->setTemplate('html/masterPage.html');
             
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    
                    $model->loadListings($_POST['searchListing']);
                    }
                else{
                    $model->loadListings('');
                }
            break;
            case 'newListing':                
                
                include_once 'lib/initModel.php';
                include_once 'views/listingForm.php';
                // echo($companyID);
                $view = new ListingFormView();
                $view->setTemplate('html/form.html');
                
               
                if($_SERVER['REQUEST_METHOD'] == 'POST') {  
                    $photo = $this->addImgFile();                    
                    $model->editListing($db, null,
                    $_POST["productName"], 
                    $_POST["productDescription"],
                    $_POST["price"],
                    $photo); 

                    
                 $this->redirect_to('/agora/user.php/allListings/' . $model->getID().'');          
            }
            break;
            case 'admin':
                
                include_once 'lib/initModel.php';
                include_once 'views/adminUsers.php';
                $view = new AdminUsersView();
                $view->setTemplate('html/masterPage.html');
            break;
            case 'editAdmin':  
                // echo("editAdmin");
                include_once 'lib/initModel.php';
                include_once 'views/editAdmin.php';
                $view = new EditAdminView();
                $view->setTemplate('html/masterPage.html');
                $business = $model->getBusiness();
                $password = $model->getPassword(); 
                if($_SERVER['REQUEST_METHOD'] == 'POST') {  
                    try {
                        $model->checkPasswords();
                    }
                    catch(Exception $e){
                        $model->setError($e->getMessage());
                        break;
                    }

                    if ($_FILES["uploadfile"]["name"] == ""){
                        $logo = $business->getLogo();
                    } 
                    else {    
                        $logo = $this->addImgFile(); 
                    }  
                    
                    //print_r($business);
                    $business = $model->editBusiness($db, $model->getBusinessID(),
                    $_POST["businessName"], 
                    $_POST["bankNumber"],
                    $_POST["registrationID"],  
                    $_POST["Address"], 
                     $logo);
                    
                     
                    if ($_POST["password"] !== ""){
                        $password = $_POST["password"];
                    }
                    
                    $updateModel= new UserModel($db, $model->getUserName(), $model->getID(), $_POST["email"], $password,
                    null, null, "admin", null, null, $model->getBusinessID());
                    if ($_POST["password"] !== ""){
                        $updateModel->hashPassword();
                    }
                    
                    //print_r($updateModel);
                    $updateModel->save();
                 $this->redirect_to('/agora/user.php/user');          
            }
            break;
            case 'editUser':                
                include_once 'views/editUser.php';
                include_once 'lib/initModel.php';
                $view = new EditUserView();
                $view->setTemplate('html/form.html');
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user = new UserModel(
                    $db, $model->getUserName(), $id, $_POST["email"], 
                    $_POST["password"], $_POST["firstName"], 
                    $_POST["lastName"], $model->getRole(), 
                    $_POST["address"],                   
                    $model->getBusinessID());
                    
                    $user->save();
                    $this->redirect_to('/agora/user.php/user/' . $model->getID().''); 
                }
            break;
            case 'singleListing':
                // print_r($view);
                include_once 'lib/initModel.php';      
                include_once 'views/singleListing.php'; 
                
                echo("im in usercomtroller220");      
                
                // not getting any ID for some reason, go to uri
                $listingID = $uri->getID();                   
                $view = new SingleListingView();
                $view->setTemplate('html/masterPage.html');
                $model->loadListingByID($db, $listingID);               
            break;

			 default:
            //  caller();
            
			 	throw new InvalidRequestException ("Invalid action in URI");
		}
        $view->setModel($model);
		return $view;
	}
    private function addImgFile(){
        
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo( $_FILES["uploadfile"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension;    
        $source = $_FILES["uploadfile"]["tmp_name"];
        $destination  = "./images/{$basename}";       

        move_uploaded_file( $source, $destination );
        return $basename;
}
}