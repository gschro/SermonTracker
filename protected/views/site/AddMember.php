<?php 
 //   if(isset($_SESSION['user'])){
     //   include 'protected/views/layouts/HeaderSecure.php';
     // }
     // else{
         include 'protected/views/layouts/Header.php';
     // }
?>
     
     <div class ="container">
     	
               <select name='members' id="members" size="10" multiple>
     	 	<?php 
               
     	 		$members = Member::model()->findAll();
     	 		foreach($members as $member){
     	 			$status = Status::model()->findByPk($member->STATUSID);
     	 			echo '<option value="'.$member->ID.'">'.$member->FIRSTNAME .' ' .$member->LASTNAME . ' ' . $status->STATUS .'</option>';
     	 		}
     	 	?>

           </select>
                          <button id="removeMember">Remove</button>
     	 
     	 <div>
	         <h1>Add Member</h1>
	         
	         	<input type="text" id="firstName" name="firstName" >
	         	<input type="text" name="lastName" id="lastName" >
				<select name="status" id="status">
					<?php 
						$statuses = Status::model()->findAll();

						foreach($statuses as $status){
							echo '<option value="'.$status->ID.'">'.$status->STATUS.'</option>';
						}
					?>
				</select>
				<button id='addMember'>Add</button>
	         
	     </div>
         <a href="<?php echo Yii::app()->createUrl('Site/index')?>">Home</a>
     </div>

<?php include 'protected/views/layouts/Footer.php'; ?>
<script>

     $('#removeMember').click(function(){
              $.ajax({
               
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Site/RemoveMember') ?>",
      data: {   
                "memberId" : $("#members option:selected").val()
            },
      success: function(data){
          //alert(data);
          var dat = JSON.parse(data);
         getMembersNext(dat.members, dat.statuses);
          // $("#members").empty();
          // for(var i = 0; i < dat.members.length; i++){
          //      // alert(dat.questions[i].QUESTION);
          //       //alert(dat.questions);
          //     // alert(dat.cat);
          //      $("#members").append($("<option></option>")
          //       .attr("value",dat.members[i].ID).text(dat.members[i].FIRSTNAME + " " + dat.members[i].LASTNAME + " " + dat.members[i].STATUS));
          //  }
         alert(dat.message);
        // getMembers();
      }
    });  
     })

     $('#addMember').click(function(){
              $.ajax({
               
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Site/AddMember') ?>",
      data: {   
                "firstName" : $("#firstName").val(),
                "lastName" : $("#lastName").val(),
                "status" : $("#status option:selected").val()
            },
      success: function(data){
          //alert(data);
          var dat = JSON.parse(data);
         getMembersNext(dat.members, dat.statuses);
      //     $("#members").empty();
      //     for(var i = 0; i < dat.members.length; i++){
      //          // alert(dat.questions[i].QUESTION);
      //           //alert(dat.questions);
      //         // alert(dat.cat);
      //          $("#members").append($("<option></option>")
      //           .attr("value",dat.members[i].ID).text(dat.members[i].FIRSTNAME + " " + dat.members[i].LASTNAME + " " + dat.members[i].STATUS));
      //      }
      alert(dat.message);
    //   getMembers();
       }
    });  
     });

     function getMembers(){
                 $.ajax({
               
      type: "POST",
      url: "<?php echo Yii::app()->createUrl('Site/GetMembers') ?>",
      success: function(data){          
          var dat = JSON.parse(data);
          
          $("#members").empty();
          for(var i = 0; i < dat.members.length; i++){

               var status = dat.statuses[dat.members[i].STATUSID];
               $("#members").append($("<option></option>")
                .attr("value",dat.members[i].ID).text(dat.members[i].FIRSTNAME + " " + dat.members[i].LASTNAME + " " + status));
           }
      }
    });  
     }

     function getMembersNext(members, statuses){
          $("#members").empty();
          for(var i = 0; i < members.length; i++){

               var status = statuses[members[i].STATUSID];
               $("#members").append($("<option></option>")
                .attr("value",members[i].ID).text(members[i].FIRSTNAME + " " + members[i].LASTNAME + " " + status));
           }
     }
</script>