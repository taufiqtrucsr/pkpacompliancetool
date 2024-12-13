<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('fatch_consent')) {
    function fatch_consent($meta){

        $CI = &get_instance();
		$CI->load->model('CommonModel');
        
		$consent = $CI->CommonModel->TblRecords('cms_pages',1,array('version','DESC'),array('identifier' => $meta,'status' => 1),'','');
		return $consent;
	}
}
if (!function_exists('save_consent')) {
    function save_consent($info){

        $CI = &get_instance();
		$CI->load->model('CommonModel');
        if($info)
			$CI->CommonModel->insertData('terms_and_condition',$info);
		return true;
	}
}
if (!function_exists('GUID')) {
	function GUID()
	{
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}

		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}
if (!function_exists('AccessLayerProtector')) {
    function AccessLayerProtector($module,$subModule){

        $CI = &get_instance();
		$CI->load->model('CommonModel');
        
		$id = $_SESSION['UserId'];
		$user = $CI->CommonModel->TblRecords('users',1,'',array('id' => $id),'','');

		if($user && !empty($user->access_type)){
			$access_group = $CI->CommonModel->TblRecords('access_group',1,'',array('id' => $user->access_type),'','');
			if($access_group && !empty($access_group->id)){
				$key = array(
								'm_id' => $module,
								'access_group_id' => $user->access_type
							);
				if($subModule)
					$key += array(
						'sm_id' => $subModule
					);
				$access = $CI->CommonModel->TblRecords('access_type_master',1,'',$key,'','');
				if($access){
					return $access;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
?>