<?php
require_once 'lib/abstractView.php';
class LoginView extends AbstractView {

	public function prepare () {
    include_once 'public/navNotLogIn.php';
		$content='<h1>Sign In</h1>
        <form class="aForm p-4" action="##site##user.php/login" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="username" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>              
            </div>
            <button type="submit"  class="btn btn-primary">Sign in</button> 
        
          </form>';
          include_once 'public/signUp.php';

    $this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('pagename', 'Login');

	}

}

?>