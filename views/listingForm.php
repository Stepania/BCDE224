<?php
require_once 'lib/abstractView.php';
class ListingFormView extends AbstractView {

	public function prepare () {
        $model = $this->getModel();
        echo("dfgvdfv");
        $content = '<h1>Listing</h1>
        <form class="aForm p-4" method="post" enctype="multipart/form-data" action="##site##user.php/newListing/'.$model->getID().'">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="productName" required>
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <input type="text" class="form-control" name="productDescription" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="productPicture" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="uploadfile" required>
                </div>
                <div class="mb-3"></div>
                </div>
                <button type="submit" class="btn btnColour">Submit</button> 
            </div>
        </form>';
    include_once 'public/signIn.php';
    include 'public/navLogIn.php';
    $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Sign Up');

	}

}

?>