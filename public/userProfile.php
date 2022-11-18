<?php 
$business = $model->getBusiness();
// print_r($model);
$user='<div> <h1>Profile<h1>
<figure class="m-2"><img src="##site##images/'.$business->getcompanyLogo().'" class="img-fluid" alt="Business Logo"/></figure>'; 
$user.='<div class="p-2 mt-2">';
$user.="<p>".$model->getFirstName()." ".$model->getLastName()."</p>
  <p>".$model->getEmail()."</p>
  <p>".$model->getaddress()."</p>
</div>
</div>";
$user.='<a href="##site##user.php/editUser/'.$model->getID().'"><button class="btn btn-primary">Edit Profile</button></a>';
?>

