<?php
require_once 'lib/abstractView.php';
class SignView extends AbstractView {

	public function prepare () {
    $model = $this->getModel();
    $value = null;
		$content='<h1>Sign Up</h1>
        <form class="aForm p-4" action="##site##user.php/signUp" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="businessName" class="form-label">Business Name</label>
              <input type="text" class="form-control" id="businessName" name="businessName" required>
            </div>
            <div class="mb-3">
              <label for="NZBN" class="form-label">NZBN</label>
              <input type="text" class="form-control" id="NZBN" name="NZBN" required>
            </div>
            <div class="mb-3">
              <label for="uploadfile" class="form-label">Business Logo</label>
              <input type="file" class="form-control" id="uploadFile" name="uploadfile" required>
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
            <label for="bankNumber" class="form-label">Bank Number</label>
            <input type="text" class="form-control" id="bankNumber" name="bankNumber" required>
          </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="userName" required>
          </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn btnColour">Submit</button> 
            <a class="form-text"href="##site##user.php/login">Already have an account?... Sign in</a>
          </form>';
   
    include_once 'public/signIn.php';
    include_once 'public/navNotLogIn.php';
    $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  $this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Sign Up');

	}

}

?>