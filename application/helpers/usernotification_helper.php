<?php 

// This helper Created BY vishal parmar 09 09 2020
// this helper use for send notification to User,

function load_usernotification() {
    
    // Get a reference to the controller object
    $CI =& get_instance();
    $response = array();
    $response['CI'] = $CI;

    // You may need to load the model if it hasn't been pre-loaded
    return $response;
}

// with global message
function user_payment_success($Data){
    // instance of $this
    $CI =& get_instance();
    
    // This type_notification work here 
    $notification_type = 14;// 14 -Success payment,

    // get global message
    $query_builder['table_name'] = 'global_messages';
    $query_builder['select'] = array('msg_code','msg');
    $query_builder['where'] = array('msg_code'=>'user_payment_success');
    // retrun always single row .......... Use get_data_list for all data
    $GlobalMsgDetails = $CI->gm->get_data_row($query_builder);
    
    
    // Using For Ngo detail and corporate_details
    $common_query['select'] = array('id','user_id');
    $common_query['where'] = array('user_id'=>$Data['user_id']);
    
    // check condition id org type.  1 => ngo_detail , else corporate detail  
    $details = array();
    if($Data['orgType'] == 1 || $Data['orgType'] == '1'){
        // Ngo detail from here user ID => use for area_id or area id
        $query_builder1['table_name'] = 'ngo_details';
        
    }else{
        // Corporate detail here user ID => use for area_id or area id
        $query_builder1['table_name'] = 'corporate_details';
    }
    // retrun always single row .......... Use get_data_list for all data
    $details_cop_ngo = $CI->gm->get_data_row(array_merge($query_builder1,$common_query)); 

    if($Data['orgType'] == 1 || $Data['orgType'] == '1'){ 
        // For from_user_id
        $query = "select au.* from adminusers as au, ngo_assigned as ca where au.id = ca.assign_to AND ca.ngo_id = ". $details_cop_ngo['id'] ;
    }else{
        // For from_user_id
        $query = "select au.* from adminusers as au, corporate_assigned as ca where au.id = ca.assign_to AND ca.corporate_id = ". $details_cop_ngo['id'] ;
    }
    // For from_user_id
    $assignedDetails = $CI->gm->get_data_row_custom($query); 

    // global message text
    $notification_text = $GlobalMsgDetails['msg'];
    $link = '';
    $remark = '';

    // Notofication for user when payment succeed
    
    $notificationData=array( 
    	'from_user_id'			=> $assignedDetails['id'],
    	'to_user_id'			=> $Data['user_id'],
    	'project_id'			=> '',
    	'area_id'				=> $details_cop_ngo['id'],
    	'notification_text'		=> $notification_text,
    	'link'					=> $link,
    	'type_of_notification'	=> $notification_type, 
    	'remark'				=> $remark,
    	'created_at'			=> strtotime(date('Y-m-d H:i:s')),
    );
    $CI->gm->insert('user_notifications',$notificationData);
}

function projectAndProgramSuccessCreated($data){
    $CI =& get_instance();
    $notificationData=array( 
    	'from_user_id'			=> $data['from_user_id'],
    	'to_user_id'			=> $data['to_user_id'],
    	'project_id'			=> $data['project_id'],
    	'area_id'				=> $data['area_id'],
    	'notification_text'		=> $data['notification_text'],
    	'link'					=> $data['link'],
    	'type_of_notification'	=> $data['type_of_notification'], 
    	'remark'				=> $data['remark'],
    	'created_at'			=> strtotime(date('Y-m-d H:i:s')),
    );
    $CI->gm->insert('user_notifications',$notificationData);

}

?>