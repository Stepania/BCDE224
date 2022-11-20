<?php
require_once 'lib/abstractView.php';
class AllListingsView extends AbstractView {

	public function prepare () {
    echo("SDfvsdfvsdvsdfv");
        $model = $this->getModel();
        $products = $model->getListings();
        $role = $model->getRole();
       // print_r($products);
        $content = 
        '';
        if ($role == 'Seller'){
          include_once 'public/newListingButton.php';
        }        
     // zdes   
        $content.='</div>
        <div class="buyer_product_card">';
        if ($products != null){
          foreach ($products as $product) {

            // echo("imsending");
            $content.= 
            '<a href="##site##/user.php/singleproduct/'.$product->getID().'">
            
              <div class="productCard  rounded-2 border m-1">
                <h2 class="productName p-3 rounded-top">'.$product->getProductName().'</h2>
                <div class="m-1 d-flex">
                  <img src="##site##images/'.$product->getProductPicture().'" class="listImage m-2" alt="'.$product->getProductName().'">
                  <div class="m-1">
                  <p>Price: '.$product->getPrice().'</p>
                  <p>Seller: '.$product->getSellerName().'</p>
          
                  <span class="productAge">Listed '.$product->getListingDate().'</span>
                </div>
                </div>
              
            </a>';
        }
       // echo("Fff");
        // print_r($product->getPrice());
        // print_r($product->getSellerName());
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