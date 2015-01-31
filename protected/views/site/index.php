<?php 
 //   if(isset($_SESSION['user'])){
      //  include 'protected/views/layouts/HeaderSecure.php';
     // }
     // else{
         include 'protected/views/layouts/Header.php';
     // }http://media-cache-ak0.pinimg.com/736x/c6/cb/9d/c6cb9d373ef77afffed01ce74e814b0f.jpg
?>



  
sermon tracker
<form action="<?php echo Yii::app()->createUrl('Site/GetMembers');?>">
<a href="<?php echo Yii::app()->createUrl('Site/GetMembers');?>">test</a>
<a href="<?php echo Yii::app()->createUrl('Site/ViewAddMember');?>">Add Member</a>
</form>


<?php include 'protected/views/layouts/Footer.php'; ?>