<?php
require_once 'lib/abstractView.php';

class IndexView extends AbstractView {

	public function prepare () {
		include_once 'public/homeContent.php';
		include_once 'public/navNotLogIn.php';
		$section = " ";
	  include_once 'public/signInAndUp.php';

	  	$this->setTemplateField('nav', $nav);
		$this->setTemplateField('login', $login);
	  	$this->setTemplateField('content',$content);
		$this->setTemplateField('userProfile', $section);
		$this->setTemplateField('pagename', 'Home');

	}
}
?>