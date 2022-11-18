<?php 

$business = $model->getBusiness();
$user='<div> <h1>Profile<h1>
<figure class="m-2"><img src="##site##images/'.$business->getcompanyLogo().'" class="img-fluid" alt="Business Logo"/></figure>';
//print_r($user);
$user.='<div class="p-2 mt-2">';
$user.="<p>".$business->getName()."</p>
  <p>".$model->getEmail()."</p>
  <p>".$business->getaddress()."</p>
</div>
</div>";
$user.='<a href=##site##user.php/editAdmin/'.$model->getID().'><button class="btn btn-primary">Edit Profile</button></a>';
?>