function addImages() { 
  
  var total_images_recieved=$('#total_images_added').val();
  if(total_images_recieved=='')
  {
    total_images_recieved=1;
    $('#total_images_added').val(total_images_recieved);
  }
  
  var i = 1;
  for(i;i<=total_images_recieved;i++){
    // goalName = $("#goalName_"+i).val();
    // goalDescription = $("#goalDescription_"+i).val();
    // goalImg = $("#goal_"+i).val();
    
    // if(goalName == '' || goalDescription == ''){
    // $.toast({
    //   heading: '',
    //   text: 'Cannot be blank',
    //   showHideTransition: 'slide',
    //   icon: 'error'
    //   }); 
    //   return false; 
    // }
  }
  
  new_total_images_recieved=parseInt(total_images_recieved) + parseInt(1);
  $('#total_images_added').val(new_total_images_recieved);
      
  $.ajax({
    type: 'POST', 
    url: BASE_URL+"motivator/addImages",
    data: {
      counter:new_total_images_recieved,
      campaign_id:$('#campaign_id').val()
    },
    success: function(data) {
      $('#image-add-block').append(data);
    }
  });

}