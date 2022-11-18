<?php
require_once 'lib/abstractView.php';
class allListingsView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        $listings = $model->getListings();
        $role = $model->getRole();
        $content = 
        '<div class="d-flex justify-content-start flex-wrap">
            <div class="d-flex">
                <button type="button" class="btn btnColour rounded-end">
                    <i class="fas fa-search"></i>
                </button>
            </div>';
        if ($role == 'Seller'){
          include_once 'public/newListingButton.php';
        }           
        $content.='</div>
        <div class="mt-2 listingsContainer">';
        if ($listings != null){
          foreach ($listings as $listing) {
            echo("imsending");
            $content.= 
            '<a href="##site##/user.php/singleListing/'.$listing->getID().'">
              <div class="listingCard  rounded-2 border m-1">
                <h2 class="listingName p-2 rounded-top">'.$listing->getProductName().'</h2>
                <div class="m-1 d-flex">
                  <img src="##site##images/'.$listing->getProductPicture().'" class="listImage m-2" alt="'.$listing->getProductName().'">
                  <div class="m-1">
                  <p>Price: '.$listing->getPrice().'</p>
                  <p>Seller: '.$listing->getSellerName().'</p>
          
                  <span class="listingAge">Listed '.$listing->getListingDate().'</span>
                </div>
                </div>
              </div>
            </a>';
        }
      }
        $content.='</div>';
        
        include 'public/defineRole.php';
        include_once 'public/signOut.php';

        $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Home');
    $this->setTemplateField('userProfile', $user);

	}

}

?>