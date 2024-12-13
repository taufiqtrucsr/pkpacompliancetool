<?php 

// This helper Created BY vishal parmar 09 09 2020
// this helper use for send notification to admin, sr manager and Rm 

function load_notification() {
    
    // Get a reference to the controller object
    $CI =& get_instance();
    $response = array();
    $response['CI'] = $CI;

    // You may need to load the model if it hasn't been pre-loaded
    return $response;
}


function admin_sent_for_verification($UserDetails,$userStatus){
    $CI =& get_instance();
    // $query_builder['table_name'] = 'global_messages';
    // $query_builder['select'] = array('msg_code','msg');
    // $query_builder['where'] = array('msg_code'=>'admin_sent_for_verification');
    // $GlobalMsgDetails = $CI->gm->get_data_row($query_builder);
    
    // status 3 for registration
    if($userStatus == 3){
        $notification_text = '##USERNAME## has completed KYC. Please assign the profile to ##RMNAME##';
        $notification_data = array(
            '##USERNAME##' => $UserDetails->first_name.' '.$UserDetails->last_name, 
            '##RMNAME##' => 'RM'
        );
        
        foreach($notification_data as $key => $value){
            $notification_text = str_replace($key,$value,$notification_text);
        }
    }else if($userStatus == 2){ // rejected KYC
        $notification_text = $UserDetails->first_name.' '.$UserDetails->last_name. ' has been assigned to you, please proceed with the verification.';
        // $notification_text = $GlobalMsgDetails['msg'];
    }


    return $notification_text;
}

?>