<?php
require_once 'lib/abstractView.php';
class SingleListingView extends AbstractView {

	public function prepare () {   

        $model = $this->getModel();
        $product = $model->getSingleproduct();
        $business = $model->getBusiness();
        include 'public/defineRole.php';
        
        $content = '
        <figure class=" d-flex justify-content-center">
            <img src="##site##images/'.$product->getBusinessLogo().'" class="img-fluid w-50" alt="Business Logo">
        </figure>
        <h2 class="ps-3">'.$product->getProductName().'</h2> 
        <div class="singleproductContainer p-2">
            <div class="d-flex p-3">
                <figure class="w-25">
                    <img src="##site##images/'.$product->getProductPicture().'" class="img-fluid" alt="'.$product->getProductName().'">
                </figure>
                <div class="flex-grow-1 p-3">
                <h3 class="mb-3">'.$product->getPrice().'</h3>
                <p>Seller: '.$product->getSellerName().'</p>
                <p>Listed: '.$product->getListingDate().'</p>
                
                

            </div>
        </div>
    <p class="mb-0">Description:</p>  
    <p>'.$product->getProductDescription().'</p>';
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