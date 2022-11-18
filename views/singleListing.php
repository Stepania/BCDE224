<?php
require_once 'lib/abstractView.php';
class SingleListingView extends AbstractView {

	public function prepare () {   
        caller();            
        caller();            
        $model = $this->getModel();
        $listing = $model->getSingleListing();
        $business = $model->getBusiness();
        include 'public/defineRole.php';
        $content = '
        <figure class=" d-flex justify-content-center">
            <img src="##site##images/'.$listing->getBusinessLogo().'" class="img-fluid w-50" alt="Business Logo">
        </figure>
        <h2 class="ps-3">'.$listing->getProductName().'</h2> 
        <div class="singleListingContainer p-2">
            <div class="d-flex p-3">
                <figure class="w-25">
                    <img src="##site##images/'.$listing->getProductPicture().'" class="img-fluid" alt="'.$listing->getProductName().'">
                </figure>
                <div class="flex-grow-1 p-3">
                <h3 class="mb-3">'.$listing->getPrice().'</h3>
                <p>Seller: '.$listing->getSellerName().'</p>
                <p>Listed: '.$listing->getListingDate().'</p>

            </div>
        </div>
    <p class="mb-0">Description:</p>  
    <p>'.$listing->getProductDescription().'</p>';
    $content.='</div> ';
    include_once 'public/signOut.php';


    $this->setTemplateField('nav', $nav);
    $this->setTemplateField('login', $login);
      $this->setTemplateField('content',$content);
    $this->setTemplateField('pagename', 'Home');
    $this->setTemplateField('userProfile', $user);

    }
}
?>