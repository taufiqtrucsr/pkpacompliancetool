<?php
defined('BASEPATH') OR exit('No direct script access allowed');
###+------------------------------------------------------------------------------------------------
###| BCOD WEB SOLUTIONS PVT. LTD., MUMBAI [ www.bcod.co.in ]
###+------------------------------------------------------------------------------------------------
###| Code By - Mangal Jaiswar (mangal.jaiswar@bcod.co.in)
###+------------------------------------------------------------------------------------------------
###| Date - July 2021
###+------------------------------------------------------------------------------------------------

class Reports extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		$this->load->model('UserModel');
        $this->load->model('NgoModel');
        $this->load->model('CommonModel');
		$this->load->model('ContractModel');
		$this->load->model('ProjectModel');
		$this->load->model('ReportModel');
		$this->load->model('SearchModel');
		$this->load->model('CompanyModel');
		$this->load->model('FundModel');
		$this->load->model('DonorModel');
		
		$userId = isset($_SESSION['UserId'])?$_SESSION['UserId']:'';
		if($userId == ''){
			redirect(base_url('signin'));
		}else{
			$data['UserDetails']=$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			$data['orgType']= $orgType= $UserDetails->type;
			$data['orgStatus']= $UserDetails->status;
			$data['State']= $this->CommonModel->get_state();
			$data['SectorMaster']= $this->CommonModel->get_sector_master();
			$data['BeneficiaryMaster']= $this->CommonModel->getBeneficiaryMaster();
			$data['GoalMaster']= $this->CommonModel->getGoalMaster();
			$this->load->vars($data);
			
			$_SESSION['countdown'] = 40;
			$_SESSION['time_started'] = date("Y-m-d H:i:s");
			
			$_SESSION['last_active_time'] = time();
			$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION['countdown'].'minutes', strtotime($_SESSION['time_started']))) ;
			$_SESSION['end_time'] = $end_time;
		}
    }
	
	public function projectDropdown(){
		$project_id = $this->input->post('projectDropdown');
		$user_id = $_SESSION['UserId'];
		$data['getUserProjectById'] = $getUserProjectById = $this->ProjectModel->getUserProjectById($user_id,$project_id);
        $data['current_date'] = $current_date = time();
        $data['checkProjectReport'] = $checkProjectReport = $this->ReportModel->checkProjectReport($project_id);
        /*Due Reports*/
		$data['DueReports'] = $DueReports = $this->ReportModel->getAllProjectReports($project_id,'Due');
		$data['dueReportsCount'] = $dueReportsCount = count($DueReports);
		$dueReportHtml="";
        if($dueReportsCount > 0){
			$dueReportHtml.='<div class="create-report-sec-inner">';
				$dueReportHtml.='<table cellpadding="0" cellspacing="0" align="center">'; 
					$dueReportHtml.='<tbody>';
						$dueReportHtml.='<tr>';
							$dueReportHtml.='<th>Sr No.</th>';
							$dueReportHtml.='<th>REPORT TYPE</th>';
							$dueReportHtml.='<th>DUE DATE</th>';
							$dueReportHtml.='<th>DATE SUBMITTED </th>';
							$dueReportHtml.='<th>STATUS</th>';
							$dueReportHtml.='<th></th>';
						$dueReportHtml.='</tr>';
						if(isset($DueReports) && count($DueReports) > 0){
							$i = 1;
							foreach ($DueReports as $due_report) {
								$dueReportHtml.='<tr>';
									$dueReportHtml.='<td>'.$i.'</td>';
									$dueReportHtml.='<td>'.$due_report->report_type_name.'</td>';
									$dueReportHtml.='<td>'.date('d-m-Y', $due_report->due_date).'</td>';
									if($due_report->submit_date == 0){
									    $dueReportHtml.='<td>--</td>';
								    }else{
									    $dueReportHtml.='<td>'.date('d-m-Y', $due_report->submit_date).'</td>';
									}	
									if(empty($due_report->submit_date)) {
										$overdue = $this->CommonModel->get_days_interval($current_date,$due_report->due_date);
										if($current_date > $due_report->due_date && $overdue['D'] > 7){
											$dueReportHtml.='<td class="red-text">Overdue report <br>submission by '.$overdue['YM'].'</td>';
											$dueReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$due_report->id.'">CREATE REPORT</a></td>';
										}elseif($current_date < $due_report->due_date && $overdue['D'] <= 3){
											$dueReportHtml.='<td class="blue-text">Upcoming report <br>submission by '.$overdue['YM'].'</td>';
											$dueReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$due_report->id.'">CREATE REPORT</a></td>';
										}else{
											$dueReportHtml.='<td class="">--</td>';
											if($current_date < $due_report->due_date){
											$dueReportHtml.='<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a></td>';
											}else{
											$dueReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$due_report->id.'">CREATE REPORT</a></td>';
										    }
									    } 
								    } else {
										$dueReportHtml.='<td class="">--</td>';
										$dueReportHtml.='<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a></td>';
								    }
							    $dueReportHtml.='</tr>';
							    $i++; 
						    } 
						}
					$dueReportHtml.='</tbody>';
				$dueReportHtml.='</table>';
			$dueReportHtml.='</div>';
		}else{
			$dueReportHtml.='<p class="not-found">No Data found.</p>';
		}	
		$data['dueReportHtml'] = $dueReportHtml;

		/*Draft Reports*/
		$data['DraftReports']=$DraftReports=$this->ReportModel->getAllProjectReports($project_id,'Draft');
		$data['draftReportsCount'] = $draftReportsCount = count($DraftReports);
		$draftReportHtml="";
        if($draftReportsCount > 0){
			$draftReportHtml.='<div class="create-report-sec-inner">';
				$draftReportHtml.='<table cellpadding="0" cellspacing="0" align="center">'; 
					$draftReportHtml.='<tbody>';
						$draftReportHtml.='<tr>';
							$draftReportHtml.='<th>Sr No.</th>';
							$draftReportHtml.='<th>REPORT TYPE</th>';
							$draftReportHtml.='<th>DUE DATE</th>';
							$draftReportHtml.='<th>DATE SUBMITTED </th>';
							$draftReportHtml.='<th>STATUS</th>';
							$draftReportHtml.='<th></th>';
						$draftReportHtml.='</tr>';
						if(isset($DraftReports) && count($DraftReports) > 0){
							$i = 1;
							foreach ($DraftReports as $draft_report) {
								$draftReportHtml.='<tr>';
									$draftReportHtml.='<td>'.$i.'</td>';
									$draftReportHtml.='<td>'.$draft_report->report_type_name.'</td>';
									$draftReportHtml.='<td>'.date('d-m-Y', $draft_report->due_date).'</td>';
									if($draft_report->submit_date == 0){
									    $draftReportHtml.='<td>--</td>';
								    }else{
									    $draftReportHtml.='<td>'.date('d-m-Y', $draft_report->submit_date).'</td>';
									}	
									if(empty($draft_report->submit_date)) {
										$overdue = $this->CommonModel->get_days_interval($current_date,$draft_report->due_date);
										if($current_date > $draft_report->due_date && $overdue['D'] > 7){
											$draftReportHtml.='<td class="red-text">Overdue report <br>submission by '.$overdue['YM'].'</td>';
											$draftReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$draft_report->id.'">CREATE REPORT</a></td>';
										}elseif($current_date < $draft_report->due_date && $overdue['D'] <= 3){
											$draftReportHtml.='<td class="blue-text">Upcoming report <br>submission by '.$overdue['YM'].'</td>';
											$draftReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$draft_report->id.'">CREATE REPORT</a></td>';
										}else{
											$draftReportHtml.='<td class="">--</td>';
											if($current_date < $draft_report->due_date){
											$draftReportHtml.='<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a></td>';
											}else{
											$draftReportHtml.='<td><a class="upload-contract campaign-blue-btn" href="'.BASE_URL.'progress-report/'.$draft_report->id.'">CREATE REPORT</a></td>';
										    }
									    } 
								    } else {
										$draftReportHtml.='<td class="">--</td>';
										$draftReportHtml.='<td><a class="upload-contract campaign-blue-btn inactive-create" href="javascript:void(0)">CREATE REPORT</a></td>';
								    }
							    $draftReportHtml.='</tr>';
							    $i++; 
						    } 
						}
					$draftReportHtml.='</tbody>';
				$draftReportHtml.='</table>';
			$draftReportHtml.='</div>';
		}else{
			$draftReportHtml.='<p class="not-found">No Data found.</p>';
		}	
		$data['draftReportHtml'] = $draftReportHtml;
		
		/*Submitted Reports*/
		$data['SubmittedReports'] = $SubmittedReports = $this->ReportModel->getAllProjectReports($project_id,'Submitted');
		$data['submittedReportsCount'] = $submittedReportsCount= count($SubmittedReports);
		$submittedReportHtml="";
        if($submittedReportsCount > 0){
			$submittedReportHtml.='<div class="create-report-sec-inner">';
				$submittedReportHtml.='<table cellpadding="0" cellspacing="0" align="center">'; 
					$submittedReportHtml.='<tbody>';
						$submittedReportHtml.='<tr>';
							$submittedReportHtml.='<th>Sr No.</th>';
							$submittedReportHtml.='<th>REPORT TYPE</th>';
							$submittedReportHtml.='<th>DUE DATE</th>';
							$submittedReportHtml.='<th>DATE SUBMITTED </th>';
							$submittedReportHtml.='<th>STATUS</th>';
							$submittedReportHtml.='<th></th>';
						$submittedReportHtml.='</tr>';
						if(isset($SubmittedReports) && count($SubmittedReports) > 0){
							$i = 1;
							foreach ($SubmittedReports as $sub_report) {
								$submittedReportHtml.='<tr>';
									$submittedReportHtml.='<td>'.$i.'</td>';
									$submittedReportHtml.='<td>'.$sub_report->report_type_name.'</td>';
									$submittedReportHtml.='<td>--</td>';
									$submittedReportHtml.='<td>'.date('d-m-Y', $sub_report->submit_date).'</td>';
									$submittedReportHtml.='<td class="">--</td>';
						            $submittedReportHtml.='<td><a class="upload-contract campaign-blue-btn inactive-create" href="'.BASE_URL.'preview-report/'.$sub_report->id.'">PREVIEW REPORT</a></td>';
							    $submittedReportHtml.='</tr>';
							    $i++; 
						    } 
						}
					$submittedReportHtml.='</tbody>';
				$submittedReportHtml.='</table>';
			$submittedReportHtml.='</div>';
		}else{
			$submittedReportHtml.='<p class="not-found">No Data found.</p>';
		}	
		$data['submittedReportHtml'] = $submittedReportHtml;

		//echo "<pre>";print_r($data);echo "</pre>";
		echo json_encode($data);
	}

 	public function reportListings(){
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Dashboard Project Detail';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 2;
		$identifier = $_POST['identifier'];
		if(empty($identifier )){
			redirect(base_url('dashboard/projects'));
		}
		$projectData = $this->ProjectModel->getProjectByIdentifier($identifier,$userId,$orgType);
		if(count($projectData) > 0){
			$projectReport = $this->ReportModel->getProjectReportByProjectId($projectData->id);
			if(empty($projectReport) && count($projectReport) <= 0){
				$from = date('Y-m-d', $projectData->project_date_from);
				$to = date('Y-m-d', $projectData->project_date_to);
				$reporting_frequency = explode(',', $projectData->reporting_frequency);
				foreach($reporting_frequency as $frequency) 
				{
					$dt_arr = array();
					$mpr = array();
					$dataForDb = array();
					if($frequency == 1)
					{
						$start = new DateTime($from);
						$start->modify('first day of next month');
						$end = new DateTime($to);
						$end->modify('first day of this month');
						$interval = DateInterval::createFromDateString('1 month');
						
						$period = new DatePeriod($start, $interval, $end);
						$dt_arr[]['due_date'] = $projectData->project_date_from;
						foreach ($period as $dt) {
							$dt_frmt = strtotime($dt->format("Y-m-d"));
							$dt_arr[]['due_date'] = $dt_frmt;
						}
						$dt_arr[]['due_date'] = $projectData->project_date_to;

						$intervals = $this->CommonModel->get_interval_in_month($projectData->project_date_from,$projectData->project_date_to);
						for($i=1; $i<=$intervals+1; $i++){
							$mpr[]['MPR'] = 'MPR-'.$i;
						}

						if(isset($dt_arr) && count($dt_arr) > 0){
							foreach ($dt_arr as $key => $value) {
								$main_arr[] = array_merge((array)$mpr[$key], (array)$value);
							}
					    }

						if(isset($main_arr) && count($main_arr) > 0){
							foreach ($main_arr as $val) {
								$dataForDb[] = array('project_id'=>$projectData->id,'report_type_name'=>$val['MPR'],'due_date'=>$val['due_date'],'report_type'=>'Due');
							}
							$this->db->insert_batch('project_reports', $dataForDb);
					    }
					     
					}else if($frequency == 2){
						$start_dt = strtotime($from);
						
						$start = new DateTime($from);
						$end = new DateTime($to);
						$interval = DateInterval::createFromDateString('90 days');
						$period = new DatePeriod($start, $interval, $end);
						$i=1;
						foreach ($period as $dt) {
							$dt_frmt = strtotime($dt->format("Y-m-d"));
							if($dt_frmt!=$start_dt){
								$arr['due_date'] = $dt_frmt;
								$arr['QPR'] = 'QPR-'.$i;
								$dt_arr[] = $arr;
								$i++;
							}
						}
						if(isset($dt_arr) && count($dt_arr) > 0){
							foreach ($dt_arr as $value) {
								$dataForDb[] = array('project_id'=>$projectData->id,'report_type_name'=>$value['QPR'],'due_date'=>$value['due_date'],'report_type'=>'Due');
							}
							
							$this->db->insert_batch('project_reports', $dataForDb);
						}

					}else if($frequency == 3){
						$start_dt = strtotime($from);
						$start = new DateTime($from);
						$end = new DateTime($to);
						$interval = DateInterval::createFromDateString('180 days');
						$period = new DatePeriod($start, $interval, $end);
						$i=1;
						foreach ($period as $dt) {
							$dt_frmt = strtotime($dt->format("Y-m-d"));
							if($dt_frmt!=$start_dt){
								$hpr['due_date'] = $dt_frmt;
								$hpr['HPR'] = 'HPR-'.$i;
								$dt_arr[] = $hpr;
								$i++;
							}
						}
						if(isset($dt_arr) && count($dt_arr) > 0){
							foreach ($dt_arr as $value) {
								$dataForDb[] = array('project_id'=>$projectData->id,'report_type_name'=>$value['HPR'],'due_date'=>$value['due_date'],'report_type'=>'Due');
							}
							
							$this->db->insert_batch('project_reports', $dataForDb);
					    }

					}else if($frequency == 4){

						$start_dt = strtotime($from);
						$start = new DateTime($from);
						$end = new DateTime($to);
						$interval = DateInterval::createFromDateString('1 year');
						$period = new DatePeriod($start, $interval, $end);
						$i=1;
						foreach ($period as $dt) {
							$dt_frmt = strtotime($dt->format("Y-m-d"));
							if($dt_frmt!=$start_dt){
								$apr['due_date'] = $dt_frmt;
								$apr['APR'] = 'APR-'.$i;
								$dt_arr[] = $apr;
								$i++;
							}
						}
						if(isset($dt_arr) && count($dt_arr) > 0){
							foreach ($dt_arr as $value) {
								$dataForDb[] = array('project_id'=>$projectData->id,'report_type_name'=>$value['APR'],'due_date'=>$value['due_date'],'report_type'=>'Due');
							}
							
							$this->db->insert_batch('project_reports', $dataForDb);
					    }
					}
				}
			}

			$data['DueReports'] = $DueReports = $this->ReportModel->getAllProjectReports($projectData->id,'Due');
			$data['dueReportsCount'] = count($DueReports);
			$data['projectData'] = $projectData;
			
			$this->load->view('report/due_report_tab', $data); 
		}else{
			redirect(base_url('dashboard/projects'));
		}
    }

 //    function SeeMoreReports()
	// {
	// 	if(isset($_POST))
	// 	{
	// 		$search_param = array();
	// 		$order_by ='';
			
	// 		$offset = $_POST['offset'];
	// 		$limit = 6;
	// 		$data['loadmoreFlag'] = 1;
	// 		$data['AllProjects']=$this->SearchModel->AllProjects($search_param,$order_by,$offset,$limit);
	// 		$data['ProjectListCount']=count($this->SearchModel->AllProjects($search_param,$order_by,$offset,''));
	// 		$this->load->view('donation/discover_projects_list', $data);
	// 	}else {
	// 		exit;
	// 	}
	// }

	public function create_progress_report(){
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Create Report';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 6;
		$data['report_id'] =$report_id = $this->uri->segment(2);
		if(empty($report_id )){
			redirect(base_url('dashboard/projects'));
		}

		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetails($report_id);

		$data['gettotaldonation']=$gettotaldonation = $this->CommonModel->get_total_donation($progressDetails->project_id); //code for get total donation and donors count by project_id use $progressDetails->project_id //for getting date we can add project id 25
		$data['proReportImageData']=$proReportImageData=$this->ReportModel->getDraftReportImageData($report_id);	
		$data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($progressDetails->project_id);
		$data['contributorsList'] = $contributorsList=$this->ReportModel->getContributorsOfProject($progressDetails->project_id);
		// print_r("<pre>");
		// print_r($contributorsList);
		// Get External Contributor 
		$data['ExternalcontributorsList'] = $ExternalcontributorsList=$this->ReportModel->getExternalContributor($progressDetails->project_id);
		$data['get_current_tot_beneficiaries'] = $get_current_tot_beneficiaries = $this->ReportModel->get_current_tot_beneficiaries($report_id,$progressDetails->project_id);
		// $data['ContractcontributorsList'] = $contractcontributorsList=$this->ReportModel->getcontractContributorsOfProject($userId,$progressDetails->project_id); //code added here
		// $data['contracted_contributor_list'] = $contracted_contributor_list=$this->ReportModel->getProjectcontributor($progressDetails->project_id); //code wirtten for get only contributor list name 
		

        if(isset($progressDetails->contributor_id) && $progressDetails->contributor_id!=""){
           $contributorArr=explode(",", $progressDetails->contributor_id);
           $selectContributor=$this->ReportModel->projectContributorFundsDetails($progressDetails->contributor_id,$progressDetails->project_id);
		}else{
		   $contributorArr=array();
		   $selectContributor=array();
		}
		$data['selectedContributorArr'] = $selectContributor;					
		
		$unselectContributorArr=array();
		for ($i=0; $i <count($contributorsList) ; $i++) {
		    if(!in_array($contributorsList[$i]->id, $contributorArr)) 
            $unselectContributorArr[]=$contributorsList[$i]->id;
		}
		$contributerIds=implode(",", $unselectContributorArr);
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetails($contributerIds,$progressDetails->project_id);
		$unselectContributor=$this->ReportModel->projectContributorFundsDetailss($contributerIds,$progressDetails->project_id);
		$data['unselectContributor'] = $unselectContributor;

		// code start here 
		// code ends here
		// print_r("<pre>");
		// print_r($unselectContributor);
		// exit;
		$data['report_frequency'] = substr($progressDetails->report_type_name, 0, -2);
		$data['proMilestoneData'] = $proMilestoneData=$this->ProjectModel->getProjectsFundsMilestonesData($progressDetails->project_id);
        $data['reportCaseStudyData']=$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($report_id);	
		// $date['reportCoverImage'] = $reportCoverImage = $this->ReportModel->getDraftCoverImage($report_id);
		$data['get_report_cover_details']= $get_report_cover_details = $this->db->get_where('project_reports',array('id'=>$report_id))->row();
		//echo "<pre>";print_r($data['selectedContributorArr']);echo "</pre>";
		$this->load->view('report/creating_report', $data); 
	}

	public function add_image(){
		if(isset($_POST) && count($_POST) > 0){
			//echo "<pre>";print_r($_POST);echo "</pre>";
			//echo "<pre>";print_r($_FILES);echo "</pre>";
			if(empty($_POST['image_description'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Image description is empty."));
				exit;
		    }elseif(isset($_FILES['image_path']['name']) && !empty($_FILES['image_path']['name'])){
		    	$allowed = array('gif','jpg','jpeg','png');
				$documentFile = $_FILES['image_path']['name'];
				$filesize = MAX_FILESIZE_BYTE;
				$size = MAX_FILESIZE_MB;
				$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
				if(!empty($documentFile) && !in_array($ext, $allowed)) {
					echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
		            exit;
				}elseif($_FILES['image_path']['size'] > $filesize){
					echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds geater than 3mb"));
					exit;
				}else{
					$config['upload_path'] = REP_IMG_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] =$documentFile;
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					//echo "<pre>";print_r($this->upload);echo "</pre>";
					//echo "<pre>";print_r($this->upload->do_upload('image_path'));echo "</pre>";
					if($this->upload->do_upload('image_path')){
					    $uploadData = $this->upload->data();
					    //echo "<pre>";print_r($uploadData);echo "</pre>";
					    $document = $uploadData['file_name'];
					    $insertData=array(  
					    	'project_report_id'	=> $_POST['project_report_id'],
							'image_path'		=> $document,
							'image_description'	=> $_POST['image_description'],
							'created_at'		=> strtotime(date('Y-m-d H:i:s')),
						);
						//echo "<pre>";print_r($insertData);echo "</pre>";
                        $this->db->insert('project_report_images', $insertData);
						$proReportImageData=$this->ReportModel->getDraftReportImageData($_POST['project_report_id']);
                        $imageHtml="";
						if(isset($proReportImageData) && count($proReportImageData)>0){
							foreach($proReportImageData as $value){
								$imageHtml.='<div class="col-sm-12 create-report-img-sec">';
									$imageHtml.='<div class="col-sm-2 image-s">';
										$imageHtml.='<label class="control-label">IMAGE</label>';
										$imageHtml.='<div class="add-image">';
											$imageHtml.='<img  class="imageThumb" src="'.REP_IMG_URL.$value->image_path.'" width="100" height="100">';
										$imageHtml.='</div>';
									$imageHtml.='</div>';

									$imageHtml.='<div class="col-sm-10 descp-s">';
										$imageHtml.='<label class="control-label">DESCRIPTION <span>*</span><span class="remove-link" onclick="remove_image($value->id)">Remove</span></label>';
										$imageHtml.='<textarea class="form-control" disabled>'.$value->image_description.'</textarea>';
									$imageHtml.='</div>';
								$imageHtml.='</div>';
							}
						}
						echo json_encode(array('flag'=>1, 'msg'=>"Image added successfully.", 'imageHtml'=> $imageHtml));
						exit;
					}else{
				    	echo json_encode(array('flag'=>0, 'msg'=>"File upload had some problem"));
		                exit;
				    }
				}		  
		    }else{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields.Please upload Files"));
		        exit;
			}
		}else{
             echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			  exit;
		}
	}

	public function remove_image(){
        //echo "<pre>";print_r($_POST);echo "</pre>";
		if(isset($_POST) && count($_POST) > 0){
			$this->db->where('id', $_POST['id']);
			$this->db->delete('project_report_images');
			$proReportImageData=$this->ReportModel->getDraftReportImageData($_POST['project_report_id']);
            $imageHtml="";
			if(isset($proReportImageData) && count($proReportImageData)>0){
				foreach($proReportImageData as $value){
					$imageHtml.='<div class="col-sm-12 create-report-img-sec">';
						$imageHtml.='<div class="col-sm-2 image-s">';
							$imageHtml.='<label class="control-label">IMAGE</label>';
							$imageHtml.='<div class="add-image">';
								$imageHtml.='<img  class="imageThumb" src="'.REP_IMG_URL.$value->image_path.'" width="100" height="100">';
							$imageHtml.='</div>';
						$imageHtml.='</div>';

						$imageHtml.='<div class="col-sm-10 descp-s">';
							$imageHtml.='<label class="control-label">DESCRIPTION <span>*</span><span class="remove-link" onclick="remove_image('.$value->id.')">Remove</span></label>';
							$imageHtml.='<textarea class="form-control" disabled>'.$value->image_description.'</textarea>';
						$imageHtml.='</div>';
					$imageHtml.='</div>';
				}
			}
			echo json_encode(array('flag'=>1, 'msg'=>"Image deleted successfully.", 'imageHtml'=> $imageHtml));
			exit;
		}else{
             echo json_encode(array('flag'=>0, 'msg'=>"Image id is invalid"));
			  exit;
		}
	}
    
    public function contributername() {
		if(isset($_SESSION['UserId'])) {
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			if($UserDetails->type != 1){
				redirect(base_url());
			} 
			$projectId = $this->input->post('projectId');
			$contributorsList = $this->ReportModel->getContributorsOfProject($projectId);
			
			// echo "<pre>";print_r($contributorsList);echo "</pre>";
			$selectedContributorArr=isset($_POST['projectContributorFundsId'])?$_POST['projectContributorFundsId']:array();
			// echo "<pre>";print_r($selectedContributorArr);echo "</pre>";
			$unselectContributorArr=array();
			for ($i=0; $i <count($contributorsList) ; $i++) { 
				if(!in_array($contributorsList[$i]->id, $selectedContributorArr)){
                   $unselectContributorArr[]=$contributorsList[$i]->id;
				}
			}
			//echo "<pre>";print_r($unselectContributorArr);echo "</pre>";

			$fundHtml='';
            $totalOtherCommitAmt=0;
            $totalOtherReceiveAmt=0;
            $totalOtherBalanceAmt=0;
            $totalCommitAmt=0;
			$totalReceiveAmt=0;
			$totalBalanceAmt=0;
			
			if(isset($selectedContributorArr) && count($selectedContributorArr)>0){
				$fundHtml.='<div class="form-group  funded-table fund-received-table">';
					$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM CONTRIBUTORS NAME</p>';
					$fundHtml.='<div class="team-members overflow-table  white-box">';
						$fundHtml.='<table cellpadding="0" cellspacing="0" align="center">';
							$fundHtml.='<thead>';
								$fundHtml.='<tr>';
									$fundHtml.='<th>FUNDED BY</th>';
									// $fundHtml.='<th>DATE RECEIVED</th>';
									$fundHtml.='<th>SOURCE</th>';
									$fundHtml.='<th>COMMITTED</th>';
									$fundHtml.='<th>RECEIVED</th>';
									$fundHtml.='<th>BALANCE</th>';
								$fundHtml.='</tr>';
							$fundHtml.='</thead>';
							$fundHtml.='<tbody id="appendTable">';
							foreach($selectedContributorArr as $key => $projectContributorFundsId){
								$value = $this->ReportModel->projectContributorFundsByID($projectContributorFundsId,$projectId);
								$created= date('d-m-Y',$value->created_at);
								$fundHtml.='<tr id="'.$value->id.'">';
								    $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'" disabled="disabled"></td>';
								    // $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td><td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
									$fundHtml.='<td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="committed_amount" id="committed_amount_'.$value->id.'" value="'.number_format($value->committed_amount, 0, '', ',').'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="received_amount" id="received_amount_'.$value->id.'" value="'.number_format($value->received_amount, 0, '', ',').'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="balance_amount" id="balance_amount_'.$value->id.'" value="'.number_format($value->balance_amount, 0, '', ',').'" disabled="disabled"></td>';
								$fundHtml.='</tr>';
                                $totalCommitAmt=$totalCommitAmt + $value->committed_amount;
								$totalReceiveAmt=$totalReceiveAmt + $value->received_amount;
								$totalBalanceAmt=$totalBalanceAmt + $value->balance_amount;
							}
							$fundHtml.='</tbody>';
						$fundHtml.='</table>';
					$fundHtml.='</div>';
					$fundHtml.='<div class="add-another-fund-box">';
					    $fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="totalCommit" value="₹ '.number_format($totalCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="received_amount" value="₹ '.number_format($totalReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="balance_amount" value="₹ '.number_format($totalBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
					$fundHtml.='</div>';
			    $fundHtml.='</div>';
			}

			if(isset($unselectContributorArr) && count($unselectContributorArr)>0){
			    $fundHtml.='<div class="form-group  funded-table fund-received-table">';
					$fundHtml.='<p class="second-heading">FUNDS	RECEIVED FROM OTHER  CONTRIBUTORS  <!--span class="remove-link"><a href="">Remove</a></span--></p>';
					$fundHtml.='<div class="team-members overflow-table  white-box">';
						$fundHtml.='<table cellpadding="0" cellspacing="0" align="center">';
							$fundHtml.='<thead>';
								$fundHtml.='<tr>';
									$fundHtml.='<th>FUNDED BY</th>';
									// $fundHtml.='<th>DATE RECEIVED</th>';
									$fundHtml.='<th>SOURCE</th>';
									$fundHtml.='<th>COMMITTED</th>';
									$fundHtml.='<th>RECEIVED</th>';
									$fundHtml.='<th>BALANCE</th>';
								$fundHtml.='</tr>';
							$fundHtml.='</thead>';
							$fundHtml.='<tbody id="OtherContributerTable">';
							$contributerIds=implode(",",$selectedContributorArr);
							$unselectContributor=$this->ReportModel->projectContributorFundsNotByID($contributerIds,$projectId);
							foreach($unselectContributor as $key => $value){
								$created= date('d-m-Y',$value->created_at);
								$fundHtml.='<tr id="'.$value->id.'">';
								    $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'" disabled="disabled"></td>';
								    // $fundHtml.='<td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'" disabled="disabled"></td>';
								    $fundHtml.='<td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="committed_amount" id="committed_amount_'.$value->id.'" value="'.number_format($value->committed_amount, 0, '', ',').'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="received_amount" id="received_amount_'.$value->id.'" value="'.number_format($value->received_amount, 0, '', ',').'" disabled="disabled"></td>';
								    $fundHtml.='<td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="balance_amount" id="balance_amount_'.$value->id.'" value="'.number_format($value->balance_amount, 0, '', ',').'" disabled="disabled"></td>';
								$fundHtml.='</tr>';
                                $totalOtherCommitAmt=$totalOtherCommitAmt + $value->committed_amount;
								$totalOtherReceiveAmt=$totalOtherReceiveAmt + $value->received_amount;
								$totalOtherBalanceAmt=$totalOtherBalanceAmt + $value->balance_amount;
							}
							$fundHtml.='</tbody>';
						$fundHtml.='</table>';
					$fundHtml.='</div>';
				
					$fundHtml.='<div class="add-another-fund-box total-sub">';
						$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>COMMITTED</span> <input class="form-control" type="text" id="OthertotalCommit" value="₹ '.number_format($totalOtherCommitAmt, 0, '', ',').'" placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> AMOUNT <br>RECEIVED</span> <input class="form-control" type="text" id="Otherreceived_amount" value="₹ '.number_format($totalOtherReceiveAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
						$fundHtml.='<div class="col-sm-4"><span> BALANCE <br>AMOUNT </span> <input class="form-control" type="text" id="Otherbalance_amount" value="₹ '.number_format($totalOtherBalanceAmt, 0, '', ',').'"  placeholder="--" disabled="disabled"></div>';
					$fundHtml.='</div>';
			    $fundHtml.='</div>';
            }
			
			$recAmt	= $totalOtherReceiveAmt+$totalReceiveAmt;
			$balAmt	= $totalOtherBalanceAmt+$totalBalanceAmt;
			
			$fundHtml.='<div class="funds-summary total-sm">';
				$fundHtml.='<div class="form-group col-sm-6">';
					$fundHtml.='<label class="control-label grey-txt">TOTAL AMOUNT RECEIVED </label>';
					$fundHtml.='<input class="form-control" id="totalRecivedAmt" type="text" value="₹ '.number_format($recAmt, 0, '', ',').'" placeholder="--" disabled="disabled">';
				$fundHtml.='</div>';
				$fundHtml.='<div class="form-group col-sm-6">';
					$fundHtml.='<label class="control-label grey-txt">TOTAL BALANCE AMOUNT</label>';
					$fundHtml.='<input class="form-control" id="totalBalanceAmt" type="text" value="₹ '.number_format($balAmt, 0, '', ',').'" placeholder="--" disabled="disabled">';
				$fundHtml.='</div>';
			$fundHtml.='</div>';

			//echo $fundHtml;die;
            $data['fundHtml']=$fundHtml;
            echo json_encode($data);
		}else{
			redirect('signin','refresh');
		}
	}

	public function add_fundutilized(){
		// echo "<pre>";print_r($_POST);echo "</pre>";	
		// echo "<pre>";print_r($_FILES);echo "</pre>";
		$_POST['amount']=str_replace( ',', '', $_POST['amount']);
		$_POST['recAmt']=str_replace( ',', '', $_POST['recAmt']);	
		
		// code for file type
		$allowed = array('pdf');
		$documentFile = isset($_FILES['documentFile']['name'])?$_FILES['documentFile']['name']:'';
		$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
		//code for file type ends here

		if(empty($_POST['project_id'])) {
			echo json_encode(array('flag'=>0, 'msg'=>"Project id is empty."));
			exit;
	    }elseif(empty($_POST['project_contributor_fund_id'])) {
			echo json_encode(array('flag'=>0, 'msg'=>"Project contributor fund id is empty."));
			exit;
	    }elseif(empty($_POST['amount_description'])) {
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter amount description."));
			exit;
	    }elseif(empty($_POST['amount'])) {
			echo json_encode(array('flag'=>0, 'msg'=>"Please enter amount."));
			exit;
	    }elseif(empty($_POST['recAmt']) && intval($_POST['recAmt']) < intval($_POST['amount'])) {
			echo json_encode(array('flag'=>0, 'msg'=>"Utilized amount must be less than receive amount."));
			exit;
	    }elseif(!empty($documentFile) && !in_array($ext, $allowed)) { //code added on 24-dec-2022
			echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type")); 
			exit;
		}else{
		// elseif(isset($_FILES['documentFile']['name']) && !empty($_FILES['documentFile']['name'])) {
	    	// $projectContributorUnsentAmount=$this->FundModel->get_contributor_unsent_amount($_POST['project_contributor_fund_id']);
	    	//echo "<pre>";print_r($projectContributorUnsentAmount);echo "</pre>";echo intval($_POST['amount']);die;
	        // if($projectContributorUnsentAmount['unsentAmount'] < intval($_POST['amount'])) {
            //     echo json_encode(array('flag'=>0, 'msg'=>"Utilized amount must be less than ".$projectContributorUnsentAmount['funded_by']."'s receive amount."));
			// 	exit;
		    // }else{
				$insertdata = array( 
					'amount'     => intval($_POST['amount']),
					'type' => "utilized",
					'project_id' => $_POST['project_id'],
					'project_contributor_fund_id' => $_POST['project_contributor_fund_id'], 
					'created_at' => strtotime(date('Y-m-d H:i:s')),
				);
				//print_r($insertdata);
				$this->db->insert('project_contributor_fund_details', $insertdata);
				$project_fund_detail_id = $this->db->insert_id();


				//$project_fund_detail_id = 1;
				$insertdata = array( 
					'project_fund_detail_id' => $project_fund_detail_id,
					'amount_description' => $_POST['amount_description'],
					// 'document' => $document, 
					'created_at' => strtotime(date('Y-m-d H:i:s')),
				);
				//print_r($insertdata);
				$this->db->insert('project_contributor_fund_utilized', $insertdata);
				$project_contributor_fund_utilized_id = $this->db->insert_id();


				$allowed = array('pdf');
				$documentFile = isset($_FILES['documentFile']['name'])?$_FILES['documentFile']['name']:'';
				$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
				if(!empty($documentFile) && !in_array($ext, $allowed)) {
					echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
		            exit;
				}else{
					$config['upload_path'] = FUND_UTILIZED_IMG_PATH;
					$config['allowed_types'] = 'pdf';
					$config['file_name'] =$documentFile;

					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					//echo "<pre>";print_r($this->upload);echo "</pre>";
					//echo "<pre>";print_r($this->upload->do_upload('documentFile'));echo "</pre>";
					if($this->upload->do_upload('documentFile')){
					    $uploadData = $this->upload->data();
					    $document = $uploadData['file_name'];
					   
                        //$project_fund_detail_id = 1;
						$insertdata = array( 
							// 'project_fund_detail_id' => $project_fund_detail_id,
							// 'amount_description' => $_POST['amount_description'],
							'document' => $document, 
							// 'created_at' => strtotime(date('Y-m-d H:i:s')),
						);
						//print_r($insertdata);
						$this->db->where('id',$project_contributor_fund_utilized_id);
						$this->db->update('project_contributor_fund_utilized', $insertdata);
				    // }else{
				    // 	echo json_encode(array('flag'=>0, 'msg'=>"File upload had some problem"));
		            //     exit;
				    }
						$contributorsList=$this->ReportModel->getContributorsOfProject($_POST['project_id']);
                        $proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($_POST['project_id']);
						// echo "<pre>";print_r($proFundUtilized);echo "</pre>";
						$fundUtilizedHtml="";
						$fundUtilizedHtml.='<tr>';
							$fundUtilizedHtml.='<th>SR.NO</th>';
							$fundUtilizedHtml.='<th>DESCRIPTION</th>';
							$fundUtilizedHtml.='<th>FUNDED BY</th>';
							$fundUtilizedHtml.='<th>AMOUNT SPENT</th>';
							$fundUtilizedHtml.='<th>DOCUMENT</th>';
						$fundUtilizedHtml.='</tr>'; 
						$totalSpentAmt=0;
						if(isset($proFundUtilized) && count($proFundUtilized)>0){
							$i=1;
							foreach($proFundUtilized as $value){
							    $totalSpentAmt=$totalSpentAmt+$value->amount;
								$fundUtilizedHtml.='<tr>';
									$fundUtilizedHtml.='<td class="grey-td"><span>'.$i.'</span></td>';
									$fundUtilizedHtml.='<td class="big-td">';
										$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$value->amount_description.'" placeholder="Enter amount description here" disabled="disabled">';
									$fundUtilizedHtml.='</td>';
									$fundUtilizedHtml.='<td class="big-td">';
												foreach($contributorsList as $contributorFund) { 
													if($contributorFund->id==$value->project_contributor_fund_id){
														$funded_by=$contributorFund->funded_by;
													}
												}
												$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$funded_by.'" placeholder="" disabled="disabled">';
									$fundUtilizedHtml.='</td>';
									$fundUtilizedHtml.='<td class="medium-td rupee-box">';
										$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" value="'.$value->amount.'" disabled="disabled">';
									$fundUtilizedHtml.='</td>';
									$ext = pathinfo(FUND_UTILIZED_IMG_PATH.$value->document, PATHINFO_EXTENSION);
									if($ext == 'pdf'){
										$imageSrc=SKIN_URL.'images/pdf-icon.png';
										$imagePdf='<img class="imageThumb" src="'.$imageSrc.'" width="50" height="50">';
									}else{
										$imagePdf='-';
									}
									$fundUtilizedHtml.='<td>';
											$fundUtilizedHtml.='<span class="remove-link" onclick="remove_fundutilized('.$value->id.')">Remove</span>';
											$fundUtilizedHtml.='<span>'.$imagePdf.'</span>';
									$fundUtilizedHtml.='</td>';
								$fundUtilizedHtml.='</tr>';
							    $i++;
							} 
						}
		                
		                
						$fundUtilizedHtml.='<tr>';
							$fundUtilizedHtml.='<td class="grey-td">';
								$fundUtilizedHtml.='<span>'.$i.'</span>';
							$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='<td class="big-td">';
								$fundUtilizedHtml.='<input type="text" class="form-control" id="amount_description" name="amount_description" placeholder="Enter amount description here">';
							$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='<td class="big-td">';
								$fundUtilizedHtml.='<div class="select-box">';
									$fundUtilizedHtml.='<select id="project_contributor_fund_id" name="project_contributor_fund_id" class="form-control">';
									    foreach($contributorsList as $contributorfunding) {
									        $fundUtilizedHtml.='<option value="'.$contributorfunding->id.'">'.$contributorfunding->funded_by.'</option>';
									    }
									$fundUtilizedHtml.='</select>'; 
								$fundUtilizedHtml.='</div>';
							$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='<td class="medium-td rupee-box">';
								$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" name="amount" id="fund_utilized_amount">';
							$fundUtilizedHtml.='</td>';
							$fundUtilizedHtml.='<td>';
								$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept"></div>';
								$fundUtilizedHtml.='<div class="reciept-upload" style="display:block">';
									$fundUtilizedHtml.='<input class="upload-receipt" type="file" name="documentFile" id="fund_utilized_document">';
								$fundUtilizedHtml.='</div>';	
							$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='</tr>';
						$totalUnSpentAmt=$_POST['recAmt'] - $totalSpentAmt;
				        echo json_encode(array('flag'=>1, 'msg'=>"Fund utilized added successfully.",'fundUtilizedHtml'=> $fundUtilizedHtml,'totalSpentAmt'=> number_format($totalSpentAmt),'totalUnSpentAmt'=> number_format($totalUnSpentAmt)));
						exit;
				}
		    // }
		
		// 	echo json_encode(array('flag'=>0, 'msg'=>"Please upload Files"));
	    //     exit;
		}
	}

	public function remove_fundutilized(){
        //echo "<pre>";print_r($_POST);echo "</pre>";
		if(isset($_POST) && count($_POST) > 0){
			$_POST['recAmt']=str_replace( ',', '', $_POST['recAmt']);
		
			$this->db->where('id', $_POST['id']);
			$this->db->delete('project_contributor_fund_details');
			$this->db->where('project_fund_detail_id', $_POST['id']);
			$this->db->delete('project_contributor_fund_utilized');
			
			$contributorsList=$this->ReportModel->getContributorsOfProject($_POST['project_id']);        
			$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($_POST['project_id']);
            $fundUtilizedHtml="";
			$fundUtilizedHtml.='<tr>';
				$fundUtilizedHtml.='<th>SR.NO</th>';
				$fundUtilizedHtml.='<th>DESCRIPTION</th>';
				$fundUtilizedHtml.='<th>FUNDED BY</th>';
				$fundUtilizedHtml.='<th>AMOUNT SPENT</th>';
				$fundUtilizedHtml.='<th>DOCUMENT</th>';
			$fundUtilizedHtml.='</tr>'; 
			$totalSpentAmt=0;
			$i=1;
			if(isset($proFundUtilized) && count($proFundUtilized)>0){
				$i=1;
				foreach($proFundUtilized as $value){
				    $totalSpentAmt=$totalSpentAmt+$value->amount;
					$fundUtilizedHtml.='<tr>';
						$fundUtilizedHtml.='<td class="grey-td"><span>'.$i.'</span></td>';
						$fundUtilizedHtml.='<td class="big-td">';
							$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$value->amount_description.'" placeholder="Enter amount description here" disabled="disabled">';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td class="big-td">';
									foreach($contributorsList as $contributorFund) { 
										if($contributorFund->id==$value->project_contributor_fund_id){
											$funded_by=$contributorFund->funded_by;
										}
									}
									$fundUtilizedHtml.='<input class="form-control" type="text" value="'.$funded_by.'" placeholder="" disabled="disabled">';
						$fundUtilizedHtml.='</td>';
						$fundUtilizedHtml.='<td class="medium-td rupee-box">';
							$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" value="'.$value->amount.'" disabled="disabled">';
						$fundUtilizedHtml.='</td>';
						$ext = pathinfo(FUND_UTILIZED_IMG_PATH.$value->document, PATHINFO_EXTENSION);
						if($ext == 'pdf'){
							$imageSrc=SKIN_URL.'images/pdf-icon.png';
						}else{
							$imageSrc=FUND_UTILIZED_IMG_URL.$value->document;
						}
						$fundUtilizedHtml.='<td>';
								$fundUtilizedHtml.='<span class="remove-link" onclick="remove_fundutilized('.$value->id.')">Remove</span>';
								$fundUtilizedHtml.='<span><img class="imageThumb" src="'.$imageSrc.'" width="50" height="50"></span>';
						$fundUtilizedHtml.='</td>';
					$fundUtilizedHtml.='</tr>';
				    $i++;
				} 
			}
            
            
			$fundUtilizedHtml.='<tr>';
				$fundUtilizedHtml.='<td class="grey-td">';
					$fundUtilizedHtml.='<span>'.$i.'</span>';
				$fundUtilizedHtml.='</td>';
				$fundUtilizedHtml.='<td class="big-td">';
					$fundUtilizedHtml.='<input type="text" class="form-control" id="amount_description" name="amount_description" placeholder="Enter amount description here">';
				$fundUtilizedHtml.='</td>';
				$fundUtilizedHtml.='<td class="big-td">';
					$fundUtilizedHtml.='<div class="select-box">';
						$fundUtilizedHtml.='<select id="project_contributor_fund_id" name="project_contributor_fund_id" class="form-control">';
						    foreach($contributorsList as $contributorfunding) {
						        $fundUtilizedHtml.='<option value="'.$contributorfunding->id.'">'.$contributorfunding->funded_by.'</option>';
						    }
						$fundUtilizedHtml.='</select>'; 
					$fundUtilizedHtml.='</div>';
				$fundUtilizedHtml.='</td>';
				$fundUtilizedHtml.='<td class="medium-td rupee-box">';
					$fundUtilizedHtml.='<input type="text" class="form-control amount-number validate-number" name="amount" id="fund_utilized_amount">';
				$fundUtilizedHtml.='</td>';
				$fundUtilizedHtml.='<td>';
					$fundUtilizedHtml.='<div class="incp-sec" id="upload_img_reciept"></div>';
					$fundUtilizedHtml.='<div class="reciept-upload" style="display:block">';
						$fundUtilizedHtml.='<input class="upload-receipt" type="file" name="documentFile" id="fund_utilized_document">';
					$fundUtilizedHtml.='</div>';	
				$fundUtilizedHtml.='</td>';
			$fundUtilizedHtml.='</tr>';
			$totalUnSpentAmt=$_POST['recAmt'] - $totalSpentAmt;
	        echo json_encode(array('flag'=>1, 'msg'=>"Fund utilized deleted successfully",'fundUtilizedHtml'=> $fundUtilizedHtml,'totalSpentAmt'=> number_format($totalSpentAmt),'totalUnSpentAmt'=> number_format($totalUnSpentAmt)));
			exit;

		}else{
            echo json_encode(array('flag'=>0, 'msg'=>"Fund utilized id is invalid"));
			exit;
		}
	}
    
    public function add_casestudy(){
    	if(isset($_POST) && count($_POST) > 0){
			//echo "<pre>";print_r($_POST);echo "</pre>";
			//echo "<pre>";print_r($_FILES);echo "</pre>";
			if(empty($_POST['case_study_title'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Case study title is empty."));
				exit;
		    }elseif(empty($_POST['case_study'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Case study content is empty."));
				exit;
		    }elseif(strlen($_POST['case_study']) < 50){
				echo json_encode(array('flag'=>0, 'msg'=>"Case study content must be minimum 50 character"));
				exit;
			}elseif(strlen($_POST['case_study']) > 500){
				echo json_encode(array('flag'=>0, 'msg'=>"Case study content exceeded"));
				exit;
			}elseif(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
		    	$allowed = array('gif','jpg','jpeg','png');
				$documentFile = $_FILES['case_study_image']['name'];
				$filesize = MAX_FILESIZE_BYTE;
				$size = MAX_FILESIZE_MB;
				$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
				if(!empty($documentFile) && !in_array($ext, $allowed)) {
					echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
		            exit;
				}elseif($_FILES['case_study_image']['size'] > $filesize){
					echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3mb"));
					exit;
				}else{
					// $updateData = array( 
					// 	'case_study_title'			=> $_POST['case_study_title'],
					// 	'case_study'		        => $_POST['case_study'],
					// 	'update_at'	   			=> strtotime(date('Y-m-d H:i:s')),
					// );

					// $this->db->where('id', $_POST['project_report_id']);
					// $this->db->update('project_reports', $updateData);

					$config['upload_path'] = REP_CASE_STUDY_PATH;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size'] = MAX_FILESIZE_BYTE;
					$config['file_name'] =$documentFile;
					//Load upload library and initialize configuration
					$this->load->library('upload',$config);
					$this->upload->initialize($config);
					//echo "<pre>";print_r($this->upload);echo "</pre>";
					//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
					if($this->upload->do_upload('case_study_image')){
					    $uploadData = $this->upload->data();
					    //echo "<pre>";print_r($uploadData);echo "</pre>";
					    $document = $uploadData['file_name'];
					    $insertData=array(  
					    	'project_report_id'	=> $_POST['project_report_id'],
							'case_study_image'		=> $document,
							'case_study_title'			=> $_POST['case_study_title'],
							'case_study'		        => $_POST['case_study'],
							'created_at'		=> strtotime(date('Y-m-d H:i:s')),
						);
						//echo "<pre>";print_r($insertData);echo "</pre>";
                        $this->db->insert('project_report_case_studies', $insertData);
						$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($_POST['project_report_id']);
                        $caseStudyImageHtml="";
						if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
	                        foreach($reportCaseStudyData as $value){
						        // $caseStudyImageHtml.= '<div class="gallery-image">';
							    //     $caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
							    //     $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
						        // $caseStudyImageHtml.= '</div>';
								$caseStudyImageHtml.= '<div class="case-study-add-block" >';
									$caseStudyImageHtml.= '<div class="case-study-label form-group">';
										$caseStudyImageHtml.= '<p class="second-heading"><span class="remove-link" onclick="remove_casestudy_image('.$value->id.')">Remove</span></p>';
										$caseStudyImageHtml.= '<label class="control-label">TITLE OF THE CASE STUDY </label>';
										$caseStudyImageHtml.= '<input type="text" class="form-control" value="'.$value->case_study_title.'" readonly>';
									$caseStudyImageHtml.= '</div><!-- case-study-label -->';
									$caseStudyImageHtml.= '<div class="upload-img form-group">	';
										$caseStudyImageHtml.= '<label class="control-label">IMAGES</label>';
										$caseStudyImageHtml.= '<div class="upload-img-section">';
											$caseStudyImageHtml.= '<div class="gallery_box">';								
												$caseStudyImageHtml.= '<div class="gallery-image">';
													$caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
													// $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
												$caseStudyImageHtml.= '</div>';
											$caseStudyImageHtml.= '</div>';
										$caseStudyImageHtml.= '</div><!-- upload-img-section-->';
									$caseStudyImageHtml.= '</div><!-- upload-img -->';
									$caseStudyImageHtml.= '<div class="add-descp-block form-group">';
										$caseStudyImageHtml.= '<label class="control-label">WRITE CASE STUDY HERE <span class="normal-font">(50 characters min & 500 characters max) *</span></label>';
										$caseStudyImageHtml.= '<textarea class="form-control write-case-textares"  maxlength="500" minlength="50" readonly>'.$value->case_study.'</textarea>';
									$caseStudyImageHtml.= '</div><!-- add-descp-block -->';
								$caseStudyImageHtml.= '</div>';
						    }
						}

						$progressDetails = $this->ReportModel->getProgressReportDetails($_POST['project_report_id']);
						echo json_encode(array('flag'=>1, 'msg'=>"Case study added successfully.", 'caseStudyImageHtml'=> $caseStudyImageHtml, 'case_study_title'=> $progressDetails->case_study_title, 'case_study'=> $progressDetails->case_study));
						exit;
					}else{
				    	echo json_encode(array('flag'=>0, 'msg'=>"File upload had some problem"));
		                exit;
				    }
				}		  
		    }else{
				echo json_encode(array('flag'=>0, 'msg'=>"Please upload Files"));
		        exit;
			}
		}else{
             echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			  exit;
		}

    }

    public function remove_casestudy_image(){
        //echo "<pre>";print_r($_POST);echo "</pre>";
		if(isset($_POST) && count($_POST) > 0){
			$this->db->where('id', $_POST['id']);
			$this->db->delete('project_report_case_studies');
			$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($_POST['project_report_id']);
            $caseStudyImageHtml="";
			if(isset($reportCaseStudyData) && count($reportCaseStudyData)>0){
                foreach($reportCaseStudyData as $value){
			        // $caseStudyImageHtml.= '<div class="gallery-image">';
				    //     $caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
				    //     $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
			        // $caseStudyImageHtml.= '</div>';
					$caseStudyImageHtml.= '<div class="case-study-add-block" >';
						$caseStudyImageHtml.= '<div class="case-study-label form-group">';
							$caseStudyImageHtml.= '<p class="second-heading"><span class="remove-link" onclick="remove_casestudy_image('.$value->id.')">Remove</span></p>';
							$caseStudyImageHtml.= '<label class="control-label">TITLE OF THE CASE STUDY </label>';
							$caseStudyImageHtml.= '<input type="text" class="form-control" value="'.$value->case_study_title.'" readonly>';
						$caseStudyImageHtml.= '</div><!-- case-study-label -->';
						$caseStudyImageHtml.= '<div class="upload-img form-group">	';
							$caseStudyImageHtml.= '<label class="control-label">IMAGES</label>';
							$caseStudyImageHtml.= '<div class="upload-img-section">';
								$caseStudyImageHtml.= '<div class="gallery_box">';								
									$caseStudyImageHtml.= '<div class="gallery-image">';
										$caseStudyImageHtml.= '<img src="'.REP_CASE_STUDY_URL.$value->case_study_image.'" height="100" width="100" class="thumbnail" title="">';
										// $caseStudyImageHtml.= '<span onclick="remove_casestudy_image('.$value->id.')" class="remove-cross">X</span>';
									$caseStudyImageHtml.= '</div>';
								$caseStudyImageHtml.= '</div>';
							$caseStudyImageHtml.= '</div><!-- upload-img-section-->';
						$caseStudyImageHtml.= '</div><!-- upload-img -->';
						$caseStudyImageHtml.= '<div class="add-descp-block form-group">';
							$caseStudyImageHtml.= '<label class="control-label">WRITE CASE STUDY HERE <span class="normal-font">(50 characters min & 500 characters max) *</span></label>';
							$caseStudyImageHtml.= '<textarea class="form-control write-case-textares"  maxlength="500" minlength="50" readonly>'.$value->case_study.'</textarea>';
						$caseStudyImageHtml.= '</div><!-- add-descp-block -->';
					$caseStudyImageHtml.= '</div>';
			    }
			}
			echo json_encode(array('flag'=>1, 'msg'=>"Case study deleted successfully.", 'caseStudyImageHtml'=> $caseStudyImageHtml));
			exit;
		}else{
            echo json_encode(array('flag'=>0, 'msg'=>"Case study id is invalid"));
			exit;
		}
	}
    

    public function add_milestone_spent(){
    	if(isset($_POST) && count($_POST) > 0){
    		//echo "<pre>";print_r($_POST);echo "</pre>";
    		$_POST['milstoneAmt']=str_replace( ',', '', $_POST['milstoneAmt']);
		    $_POST['actual_amount_spent']=str_replace( ',', '', $_POST['actual_amount_spent']);
			if(empty($_POST['actual_start_date'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Actual start date is empty."));
				exit;
		    }elseif(empty($_POST['actual_end_date'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Actual end date is empty."));
				exit;
		    }elseif(empty($_POST['actual_amount_spent'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Actual amount spent is empty."));
				exit;
		    }elseif(intval($_POST['actual_amount_spent']) > intval($_POST['milstoneAmt'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Actual amount spent cannot be greater than amount alloted."));
				exit;
		    }elseif(empty($_POST['actual_amount_spent'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"actual_start_date is empty."));
				exit;
		    }elseif(empty($_POST['milestone_description'])) {
				echo json_encode(array('flag'=>0, 'msg'=>"Description is empty."));
				exit;
		    }else{
    		    $insertData=array(  
			    	'project_report_id'	=> $_POST['project_report_id'],
			    	'projects_funds_milestone_id'	=> $_POST['projects_funds_milestone_id'],
			    	'actual_start_date'	=> strtotime($_POST['actual_start_date']),
			    	'actual_end_date'	=> strtotime($_POST['actual_end_date']),
			    	'actual_amount_spent'	=> str_replace( ',', '', $_POST['actual_amount_spent']),
			    	'milestone_description'	=> $_POST['milestone_description'],
					'created_at'		=> strtotime(date('Y-m-d H:i:s')),
				);
				//echo "<pre>";print_r($insertData);echo "</pre>";exit;
                $this->db->insert('project_report_milestone', $insertData);
				$proReportMilestoneData = $this->ReportModel->getReportMilestoneData($_POST['projects_funds_milestone_id']);
                $milestoneSummaryHtml="";
                $milestoneSummaryHtml.='<table cellpadding="0" cellspacing="0" align="center">';
	            $milestoneSummaryHtml.='<tbody>';
				if(isset($proReportMilestoneData) && count($proReportMilestoneData) > 0){
			        foreach ($proReportMilestoneData as $val) {
			        	$amountSpentPercent=($val->actual_amount_spent/$_POST['milstoneAmt'])*100;
			        	$milestoneSummaryHtml.='<tr>';
							$milestoneSummaryHtml.='<td></td>';
							$milestoneSummaryHtml.='<td class="big-td">';
								    $milestoneSummaryHtml.='<input type="text" class="form-control actual_start_date" value="'.date('d-m-Y', $val->actual_start_date).'" disabled>';
						    $milestoneSummaryHtml.='</td>';
							$milestoneSummaryHtml.='<td class="big-td">';
								    $milestoneSummaryHtml.='<input type="text" class="form-control actual_end_date" value="'.date('d-m-Y', $val->actual_end_date).'" disabled>';
							$milestoneSummaryHtml.='</td>';
							$milestoneSummaryHtml.='<td class="big-td rupee-box">';
							        $milestoneSummaryHtml.='<input type="text" class="form-control amount-number"  value="'.$val->actual_amount_spent.'" disabled>';
							$milestoneSummaryHtml.='</td>';
							$milestoneSummaryHtml.='<td class="big-td"  align="center" valign="top"><span class="remove-link" onclick="remove_milestone_spent('.$val->id.','.$_POST['projects_funds_milestone_id'].')">Remove</span></td>';
						$milestoneSummaryHtml.='</tr>';
						$milestoneSummaryHtml.='<tr>';
							$milestoneSummaryHtml.='<td></td>';
							$milestoneSummaryHtml.='<td colspan="3" class="big-td">';
									$milestoneSummaryHtml.='<label class="control-label">ADD DESCRIPTION </label>';
									$milestoneSummaryHtml.='<textarea class="form-control" disabled>'.$val->milestone_description.'</textarea>';
							$milestoneSummaryHtml.='</td>';
							$milestoneSummaryHtml.='<td></td>';
						$milestoneSummaryHtml.='</tr>';
			        }
			    }
			    $milestoneSummaryHtml.='</tbody>';
                $milestoneSummaryHtml.='</table>';
		        //echo die;
				echo json_encode(array('flag'=>1, 'msg'=>"Milestone spent amount entry added successfully.", 'milestoneSummaryHtml'=> $milestoneSummaryHtml,'projects_funds_milestone_id' => $_POST['projects_funds_milestone_id']));
			    exit;
		    }
		}else{
             echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));
			  exit;
		}

    }

    public function remove_milestone_spent(){
    	if(isset($_POST) && count($_POST) > 0){
    		//echo "<pre>";print_r($_POST);echo "</pre>";
    		$_POST['milstoneAmt']=str_replace( ',', '', $_POST['milstoneAmt']);
		    
    		$this->db->where('id', $_POST['id']);
			$this->db->delete('project_report_milestone');
			$proReportMilestoneData = $this->ReportModel->getReportMilestoneData($_POST['projects_funds_milestone_id']);
            $milestoneSummaryHtml="";
            $milestoneSummaryHtml.='<table cellpadding="0" cellspacing="0" align="center">';
            $milestoneSummaryHtml.='<tbody>';
			if(isset($proReportMilestoneData) && count($proReportMilestoneData) > 0){
		        foreach ($proReportMilestoneData as $val) {
		        	$amountSpentPercent=($val->actual_amount_spent/$_POST['milstoneAmt'])*100;
		        	$milestoneSummaryHtml.='<tr>';
						$milestoneSummaryHtml.='<td></td>';
						$milestoneSummaryHtml.='<td class="big-td">';
							    $milestoneSummaryHtml.='<input type="text" class="form-control actual_start_date" value="'.date('d-m-Y', $val->actual_start_date).'" disabled>';
					    $milestoneSummaryHtml.='</td>';
						$milestoneSummaryHtml.='<td class="big-td">';
							    $milestoneSummaryHtml.='<input type="text" class="form-control actual_end_date" value="'.date('d-m-Y', $val->actual_end_date).'" disabled>';
						$milestoneSummaryHtml.='</td>';
						$milestoneSummaryHtml.='<td class="big-td rupee-box">';
						        $milestoneSummaryHtml.='<input type="text" class="form-control amount-number"  value="'.$val->actual_amount_spent.'" disabled>';
						$milestoneSummaryHtml.='</td>';
						$milestoneSummaryHtml.='<td class="big-td"  align="center" valign="top"><span class="remove-link" onclick="remove_milestone_spent('.$val->id.','.$_POST['projects_funds_milestone_id'].')">Remove</span></td>';
					$milestoneSummaryHtml.='</tr>';
					$milestoneSummaryHtml.='<tr>';
						$milestoneSummaryHtml.='<td></td>';
						$milestoneSummaryHtml.='<td colspan="3" class="big-td">';
								$milestoneSummaryHtml.='<label class="control-label">ADD DESCRIPTION </label>';
								$milestoneSummaryHtml.='<textarea class="form-control" disabled>'.$val->milestone_description.'</textarea>';
						$milestoneSummaryHtml.='</td>';
						$milestoneSummaryHtml.='<td></td>';
					$milestoneSummaryHtml.='</tr>';
		        }
		    }
		    $milestoneSummaryHtml.='</tbody>';
            $milestoneSummaryHtml.='</table>';
	        //echo die;
			echo json_encode(array('flag'=>1, 'msg'=>"Milestone spent amount entry deleted successfully.", 'milestoneSummaryHtml'=> $milestoneSummaryHtml,'projects_funds_milestone_id' => $_POST['projects_funds_milestone_id']));
		    exit;
		}else{
            echo json_encode(array('flag'=>0, 'msg'=>"Milestone spent amount id is invalid"));
			exit;
		}

    }
    

    public function save_draft_report(){
		// print_r("<pre>");
		// print_r($_FILES);
		// exit;
		if(isset($_SESSION['UserId'])){
			if(isset($_POST) && $_POST != ''){
				//echo "<pre>";print_r($_POST);echo "</pre>";
				$start_period = isset($_POST['start_period'])?$_POST['start_period']:'';
				if(isset($_POST['start_period'])){
					$updateData['start_date'] = strtotime($start_period);
				}

				$end_period = isset($_POST['end_period'])?$_POST['end_period']:'';
				if(isset($_POST['end_period'])){
					$updateData['end_date'] = strtotime($start_period);
				}

				if(isset($_POST['contributors']) && count($_POST['contributors']) > 0){
					$updateData['contributor_id'] = implode(",", $_POST['contributors']);
				}

				if(isset($_POST['work_description']) && $_POST['work_description']!=""){
					$updateData['work_description'] = $_POST['work_description'];
				}

				if(isset($_POST['no_of_beneficiaries']) && $_POST['no_of_beneficiaries']!=""){
					$updateData['no_of_beneficiaries'] = $_POST['no_of_beneficiaries'];
				}

				if(isset($_POST['work_activity_status']) && $_POST['work_activity_status']!=""){
					$updateData['work_activity_status'] = $_POST['work_activity_status'];
				}

				if(isset($_POST['report_type']) && $_POST['report_type']!=""){
					$updateData['report_type'] = $_POST['report_type'];
				}

				if(isset($_POST['case_study_title']) && $_POST['case_study_title']!=""){
					$updateData['case_study_title'] = $_POST['case_study_title'];
				}

				if(isset($_POST['case_study']) && $_POST['case_study']!=""){
					$updateData['case_study'] = $_POST['case_study'];
				}


				// code added for condition start here
				$contributors_arr = isset($_POST['contributors'])?$_POST['contributors']:array();
				// if(count($contributors_arr) == 0){
				// 	echo json_encode(array('flag'=>0, 'msg'=>"Please select at least one contributor."));exit;
				// }
				// added code ends here

				// code start here for 
				$contributor =$_POST['contributors'];
				if(in_array('240',$contributor) && Count($_POST['contributors'])>1){
					$updateData['source_type'] = 'Both';
					// echo "This is both";
				}else if(in_array('240',$contributor) && Count($_POST['contributors'])==1){
					$updateData['source_type'] = 'Crowdfunded';
					// echo "Thi is Inmplementor";
				}else if(!in_array('240',$contributor) && Count($_POST['contributors'])>0){
					$updateData['source_type'] = 'Contributor';
					// echo "This is contributor";
				}
				// code ends here

				$this->db->where('id', $_POST['report_id']);
				$this->db->update('project_reports', $updateData);

				// code for update cover iamge start here
				// if(empty($_FILES['case_study_images']['name'])){
				// 	echo json_encode(array('flag'=>0, 'msg'=>"Please upload cover image"));exit; //original code
				// }else
				if(isset($_FILES['case_study_images']['name']) && !empty($_FILES['case_study_images']['name'])){
						$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['case_study_images']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['case_study_images']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}else{
							$config['upload_path'] = REP_COVER_IMG_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('image_path'));echo "</pre>";
							if($this->upload->do_upload('case_study_images')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array( 

							    	// 'report_id'	=> $_POST['report_id'],
									// 'image_path'		=> $document,
									// 'image_description'	=> $_POST['image_description'],
									// 'created_at'		=> strtotime(date('Y-m-d H:i:s')),
									'cover_image' => $document
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
								$this->db->where('id', $_POST['report_id']);
		                        $this->db->update('project_reports', $insertData);
		                        // $this->db->insert('project_report_images', $insertData);
		                    }
		                }

				}
				// code for update cover image ends here

				// code start here
				$project_id =$_POST['report_id'];
				$project_report_case_studies_details = $this->db->get_where('project_report_case_studies',array('project_report_id'=>$project_id))->row();
				if($project_report_case_studies_details==""){
					if(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
				    	$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['case_study_image']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['case_study_image']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB "));
							exit;
						}else{
							$config['upload_path'] = REP_CASE_STUDY_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
							if($this->upload->do_upload('case_study_image')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array(  
							    	'project_report_id'	=> $_POST['report_id'],
									'case_study_image'	=> $document,
									'case_study_title'	=> $_POST['case_study_title'],
									'case_study'		=> $_POST['case_study'],
									'created_at'		=> strtotime(date('Y-m-d H:i:s')),
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
		                        $this->db->insert('project_report_case_studies', $insertData);
		                    }
		                }
		            }
				}else{
					//this section works when user add image while editing 
					if(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
				    	$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['case_study_image']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['case_study_image']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB "));
							exit;
						}else{
							$config['upload_path'] = REP_CASE_STUDY_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
							if($this->upload->do_upload('case_study_image')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array(  
							    	// 'project_report_id'	=> $_POST['report_id'],
									'case_study_image'	=> $document,
									'case_study_title'	=> $_POST['case_study_title'],
									'case_study'		=> $_POST['case_study'],
									'updated_at'		=> strtotime(date('Y-m-d H:i:s')),
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
								$this->db->where('project_report_id', $_POST['report_id']);
		                        $this->db->update('project_report_case_studies', $insertData);
		                    }
		                }
		            }	
				}
				// code ends here
				
				$redirect=base_url().'progress-report/'.$_POST['report_id']; //code commented

				// $redirect = base_url().'dashboard/reports';

				echo json_encode(array('flag'=>1, 'msg'=>"success", 'redirect'=>$redirect));
				exit;
			}else{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
			}
		}else{
			redirect('signin','refresh');
		}
	}

	public function submit_report(){
		if(isset($_SESSION['UserId'])){
			//added code start here
			$userId = $_SESSION['UserId']; 
			$projectId = $_POST['project_id'];
			$data['projectData'] = $projectData = $this->ProjectModel->getProjectById($projectId);
			$data['projectFundsData'] = $this->ProjectModel->getProjectsFundsData($projectData->id);
			$ngoUserId = $projectData->user_id;
			$NgoUserDetails = $this->UserModel->GetUserById($ngoUserId);
			$ngoDetails = $this->NgoModel->GetUserNgoInfo($ngoUserId);
			//added code ends here

			if(isset($_POST) && $_POST != ''){
				$contributors_arr = isset($_POST['contributors'])?$_POST['contributors']:array();
				$start_period = isset($_POST['start_period'])?$_POST['start_period']:'';
				$end_period = isset($_POST['end_period'])?$_POST['end_period']:'';
				$workDescription = isset($_POST['work_description'])?$_POST['work_description']:'';
				$no_of_beneficiaries = isset($_POST['no_of_beneficiaries'])?$_POST['no_of_beneficiaries']:'';
				$work_activity_status = isset($_POST['work_activity_status'])?$_POST['work_activity_status']:'';
				$case_study_title = isset($_POST['case_study_title'])?$_POST['case_study_title']:'';
				$case_study = isset($_POST['case_study'])?$_POST['case_study']:'';
				$proReportImageData=$this->ReportModel->getDraftReportImageData($_POST['report_id']);
				$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($_POST['report_id']);

				// code start here for 
				$contributor =$_POST['contributors'];
				if(in_array('240',$contributor) && Count($_POST['contributors'])>1){
					$source_type = 'Both';
					// echo "This is both";
				}else if(in_array('240',$contributor) && Count($_POST['contributors'])==1){
					$source_type = 'Crowdfunded';
					// echo "Thi is Inmplementor";
				}else if(!in_array('240',$contributor) && Count($_POST['contributors'])>0){
					$source_type = 'Contributor';
					// echo "This is contributor";
				}
				// code ends here
   
				//Code add here
				$project_id =$_POST['report_id'];
				$project_report_case_studies_details = $this->db->get_where('project_report_case_studies',array('project_report_id'=>$project_id))->row();
				//Code ends here

				if(count($contributors_arr) == 0){
					echo json_encode(array('flag'=>0, 'msg'=>"Please select at least one contributor."));exit;
				// }elseif(empty($no_of_beneficiaries) || empty(strip_tags($workDescription)) || empty($_POST['work_activity_status']) || empty(strip_tags($case_study)) || empty($_POST['case_study_title'])){ //previous code 
				}elseif(empty($no_of_beneficiaries) || empty(strip_tags($workDescription)) || empty($_POST['work_activity_status']) || empty(count($contributors_arr))){
					echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields..."));exit;
				}elseif(empty($_POST['image_description']) || empty($_FILES['image_path']['name'])){
					echo json_encode(array('flag'=>0, 'msg'=>"Image and description is empty."));exit;
				}elseif(empty($_FILES['image_path']['name'])){
					echo json_encode(array('flag'=>0, 'msg'=>"Please upload image"));exit;
				}
				// code for cover study_image start here
				// elseif(empty($_FILES['case_study_images']['name'])){
				// 	echo json_encode(array('flag'=>0, 'msg'=>"Please upload cover image"));exit; //original code
				// }
				// elseif(isset($_FILES['case_study_images']['name']) && !empty($_FILES['case_study_images']['name'])){
				// 		$allowed = array('gif','jpg','jpeg','png');
				// 		$documentFile = $_FILES['case_study_images']['name'];
				// 		$filesize = MAX_FILESIZE_BYTE;
				// 		$size = MAX_FILESIZE_MB;
				// 		$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
				// 		if(!empty($documentFile) && !in_array($ext, $allowed)) {
				// 			echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				//             exit;
				// 		}elseif($_FILES['case_study_images']['size'] > $filesize){
				// 			echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$file["name"]));
				// 			exit;
				// 		}else{
				// 			$config['upload_path'] = REP_COVER_IMG_PATH;
				// 			$config['allowed_types'] = 'jpg|jpeg|png|gif';
				// 			$config['max_size'] = MAX_FILESIZE_BYTE;
				// 			$config['file_name'] =$documentFile;
				// 			//Load upload library and initialize configuration
				// 			$this->load->library('upload',$config);
				// 			$this->upload->initialize($config);
				// 			//echo "<pre>";print_r($this->upload);echo "</pre>";
				// 			//echo "<pre>";print_r($this->upload->do_upload('image_path'));echo "</pre>";
				// 			if($this->upload->do_upload('case_study_images')){
				// 			    $uploadData = $this->upload->data();
				// 			    //echo "<pre>";print_r($uploadData);echo "</pre>";
				// 			    $document = $uploadData['file_name'];
				// 			    $insertData=array( 

				// 			    	// 'report_id'	=> $_POST['report_id'],
				// 					// 'image_path'		=> $document,
				// 					// 'image_description'	=> $_POST['image_description'],
				// 					// 'created_at'		=> strtotime(date('Y-m-d H:i:s')),
				// 					'cover_image' => $document
				// 				);
				// 				//echo "<pre>";print_r($insertData);echo "</pre>";
				// 				$this->db->where('id', $_POST['report_id']);
		        //                 $this->db->update('project_reports', $insertData);
		        //                 // $this->db->insert('project_report_images', $insertData);
		        //             }
		        //         }

				// }
				// code ends for cover study image ends here
				// elseif(empty($_FILES['case_study_image']['name'])){
				// 	if($project_report_case_studies_details==""){ //code added here
				// 		echo json_encode(array('flag'=>0, 'msg'=>"Please upload case study image"));exit; //original code
				// 	}//added code ends here
				// } //else if code commented here
				else{
					if(isset($_FILES['image_path']['name']) && !empty($_FILES['image_path']['name'])){
				    	$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['image_path']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['image_path']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}else{
							$config['upload_path'] = REP_IMG_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('image_path'));echo "</pre>";
							if($this->upload->do_upload('image_path')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array(  
							    	'project_report_id'	=> $_POST['report_id'],
									'image_path'		=> $document,
									'image_description'	=> $_POST['image_description'],
									'created_at'		=> strtotime(date('Y-m-d H:i:s')),
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
		                        $this->db->insert('project_report_images', $insertData);
		                    }
		                }
		            }


					// code for cover image start here
			// code for update cover iamge start here
			$get_report_details = $this->db->get_where('project_reports',array('id'=>$_POST['report_id']))->row();
				if(empty($_FILES['case_study_images']['name']) && $get_report_details->cover_image!==""){
					// echo json_encode(array('flag'=>0, 'msg'=>"Please upload cover image"));exit; //original code
					// }else{
					// if(isset($_FILES['case_study_images']['name']) && !empty($_FILES['case_study_images']['name'])){
					$allowed = array('gif','jpg','jpeg','png');
					$documentFile = $_FILES['case_study_images']['name'];
					$filesize = MAX_FILESIZE_BYTE;
					$size = MAX_FILESIZE_MB;
					$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
					if(!empty($documentFile) && !in_array($ext, $allowed)) {
						echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
						exit;
					}elseif($_FILES['case_study_images']['size'] > $filesize){
						echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
						exit;
					}else{
						$config['upload_path'] = REP_COVER_IMG_PATH;
						$config['allowed_types'] = 'jpg|jpeg|png|gif';
						$config['max_size'] = MAX_FILESIZE_BYTE;
						$config['file_name'] =$documentFile;
						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						//echo "<pre>";print_r($this->upload);echo "</pre>";
						//echo "<pre>";print_r($this->upload->do_upload('image_path'));echo "</pre>";
						if($this->upload->do_upload('case_study_images')){
							$uploadData = $this->upload->data();
							//echo "<pre>";print_r($uploadData);echo "</pre>";
							$document = $uploadData['file_name'];
							$insertData=array( 

								// 'report_id'	=> $_POST['report_id'],
								// 'image_path'		=> $document,
								// 'image_description'	=> $_POST['image_description'],
								// 'created_at'		=> strtotime(date('Y-m-d H:i:s')),
								'cover_image' => $document
							);
							//echo "<pre>";print_r($insertData);echo "</pre>";
							$this->db->where('id', $_POST['report_id']);
							$this->db->update('project_reports', $insertData);
							// $this->db->insert('project_report_images', $insertData);
						}
					}
					

			}
			// code for update cover image ends here
					// code for cover image ends here
						
					// code commenete start here

					// if(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
				    // 	$allowed = array('gif','jpg','jpeg','png');
					// 	$documentFile = $_FILES['case_study_image']['name'];
					// 	$filesize = MAX_FILESIZE_BYTE;
					// 	$size = MAX_FILESIZE_MB;
					// 	$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
					// 	if(!empty($documentFile) && !in_array($ext, $allowed)) {
					// 		echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				    //         exit;
					// 	}elseif($_FILES['case_study_image']['size'] > $filesize){
					// 		echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above $size for ".$file["name"]));
					// 		exit;
					// 	}else{
					// 		$config['upload_path'] = REP_CASE_STUDY_PATH;
					// 		$config['allowed_types'] = 'jpg|jpeg|png|gif';
					// 		$config['max_size'] = MAX_FILESIZE_BYTE;
					// 		$config['file_name'] =$documentFile;
					// 		//Load upload library and initialize configuration
					// 		$this->load->library('upload',$config);
					// 		$this->upload->initialize($config);
					// 		//echo "<pre>";print_r($this->upload);echo "</pre>";
					// 		//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
					// 		if($this->upload->do_upload('case_study_image')){
					// 		    $uploadData = $this->upload->data();
					// 		    //echo "<pre>";print_r($uploadData);echo "</pre>";
					// 		    $document = $uploadData['file_name'];
					// 		    $insertData=array(  
					// 		    	'project_report_id'	=> $_POST['report_id'],
					// 				'case_study_image'	=> $document,
					// 				'case_study_title'	=> $_POST['case_study_title'],
					// 				'case_study'		=> $_POST['case_study'],
					// 				'created_at'		=> strtotime(date('Y-m-d H:i:s')),
					// 			);
					// 			//echo "<pre>";print_r($insertData);echo "</pre>";
		            //             $this->db->insert('project_report_case_studies', $insertData);
		            //         }
		            //     }
		            // }
					// original code commented ends here

					// code start here
				$project_id =$_POST['report_id'];
				$project_report_case_studies_details = $this->db->get_where('project_report_case_studies',array('project_report_id'=>$project_id))->row();
				if($project_report_case_studies_details==""){
					if(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
				    	$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['case_study_image']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['case_study_image']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}else{
							$config['upload_path'] = REP_CASE_STUDY_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
							if($this->upload->do_upload('case_study_image')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array(  
							    	'project_report_id'	=> $_POST['report_id'],
									'case_study_image'	=> $document,
									'case_study_title'	=> $_POST['case_study_title'],
									'case_study'		=> $_POST['case_study'],
									'created_at'		=> strtotime(date('Y-m-d H:i:s')),
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
		                        $this->db->insert('project_report_case_studies', $insertData);
		                    }
		                }
		            }
				}else{
					//this section works when user add image while editing 
					if(isset($_FILES['case_study_image']['name']) && !empty($_FILES['case_study_image']['name'])){
				    	$allowed = array('gif','jpg','jpeg','png');
						$documentFile = $_FILES['case_study_image']['name'];
						$filesize = MAX_FILESIZE_BYTE;
						$size = MAX_FILESIZE_MB;
						$ext = strtolower(pathinfo($documentFile, PATHINFO_EXTENSION));
						if(!empty($documentFile) && !in_array($ext, $allowed)) {
							echo json_encode(array('flag'=>0, 'msg'=>"Invalid file type"));
				            exit;
						}elseif($_FILES['case_study_image']['size'] > $filesize){
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}else{
							$config['upload_path'] = REP_CASE_STUDY_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|gif';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							$config['file_name'] =$documentFile;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							//echo "<pre>";print_r($this->upload);echo "</pre>";
							//echo "<pre>";print_r($this->upload->do_upload('case_study_image'));echo "</pre>";
							if($this->upload->do_upload('case_study_image')){
							    $uploadData = $this->upload->data();
							    //echo "<pre>";print_r($uploadData);echo "</pre>";
							    $document = $uploadData['file_name'];
							    $insertData=array(  
							    	// 'project_report_id'	=> $_POST['report_id'],
									'case_study_image'	=> $document,
									'case_study_title'	=> $_POST['case_study_title'],
									'case_study'		=> $_POST['case_study'],
									'updated_at'		=> strtotime(date('Y-m-d H:i:s')),
								);
								//echo "<pre>";print_r($insertData);echo "</pre>";
								$this->db->where('project_report_id', $_POST['report_id']);
		                        $this->db->update('project_report_case_studies', $insertData);
		                    }
		                }
		            }	
				}
				// code ends here
					


					// $userId = $_SESSION['UserId']; 
					// $projectId = $_POST['project_id'];
					// $data['projectData'] = $projectData = $this->ProjectModel->getProjectById($projectId);
					// // $data['projectFundsData'] = $this->ProjectModel->getProjectsFundsData($projectData->id);
					// $ngoUserId = $projectData->user_id;
					// $NgoUserDetails = $this->UserModel->GetUserById($ngoUserId);
					// $ngoDetails = $this->NgoModel->GetUserNgoInfo($ngoUserId);
					// code for notification to contributor
					
					$report_details =$this->db->get_where('project_reports',array('id'=>$_POST['report_id']))->row();
					$report_month =date("M Y", strtotime("-1 months",$report_details->due_date));
					$ngo_name  = $ngoDetails->org_name;
					$project_name = $projectData->project_name;
					foreach($contributors_arr as $contributor_id){
						$get_contributor_id = $this->db->get_where('project_contributor_funds',array('id'=>$contributor_id))->row();
						$cont_id = $get_contributor_id->contributor_id;

						$notificationText = $ngo_name.' has submitted monthly progress report of ' .$project_name. ' for the month of '.$report_month;
						// $link='<a href="/dashboard/reports">View and Download the report</a>'; //code commented on 23-12-2022
						$link='<a href="/dashboard/reports/0">View and Download the report</a>';
						$notificationDataArray=array( 
									'from_user_id'			=> $userId,
									'to_user_id'			=> $cont_id,
									'project_id'			=> $projectId,
									'area_id'				=> '0',
									// 'area_id'				=> $LastInsertID,
									'notification_text'		=> $notificationText,
									'link'					=> $link,
									'type_of_notification'	=> 14,
									'created_at'			=> strtotime(date('Y-m-d H:i:s')),
									);
									
						$this->db->insert('user_notifications', $notificationDataArray);
					}

					$rowData=$this->ContractModel->getProjectAssignedByProjectID($projectId);
					if(isset($rowData) && count($rowData)>0){
						// $GlobalMsgDetails = $this->CommonModel->getGlobalMsgByCode('admin_sent_for_verification');
						// $GlobalMsg = $GlobalMsgDetails->msg;
							
						//$notification_text = $GlobalMsg;
						// $notification_text = 'Report has been created';
						$notification_text = $ngo_name.' has submitted monthly progress report of ' .$project_name. ' for the month of '.$report_month;
						$link = '<a href="/admin.php/reports/manage/">View the reports</a>';
						
					
						$insertdata = array(
						'from_user_id' 	=> $userId, 
						'to_user_id'		=> $rowData->assign_from,
						'type'			=> 0,
						'area_id' 		=> '',
						'notification_text'=> $notification_text,
						'link' 			=> $link, 
						'type_of_notification' => '',
						'created_at'   	=> strtotime(date('Y-m-d H:i:s')),
						);
						
						$this->db->insert('adminuser_notifications', $insertdata);

						$insertdata = array(
							'from_user_id' 	=> $userId, 
							'to_user_id'		=> $rowData->assign_to,
							'type'			=> 0,
							'area_id' 		=> '',
							'notification_text'=> $notification_text,
							'link' 			=> $link, 
							'type_of_notification' => '',
							'created_at'   	=> strtotime(date('Y-m-d H:i:s')),
						);
							
						$this->db->insert('adminuser_notifications', $insertdata);
						

					}

					// code ends for notification here


				
					$updateData = array( 
						'submit_date' 				=> strtotime(date('Y-m-d H:i:s')), 
						'contributor_id' 			=> implode(",", $_POST['contributors']),
						'report_type'				=> $_POST['report_type'],
						'start_date'				=> strtotime($start_period),
						'end_date'					=> strtotime($end_period),
						'work_description'			=> $_POST['work_description'],
						'no_of_beneficiaries'		=> $_POST['no_of_beneficiaries'],
						'work_activity_status'		=> $_POST['work_activity_status'],
						// 'case_study_title'		    => $_POST['case_study_title'],
						// 'case_study'		        => $_POST['case_study'],
						'source_type'				=>$source_type,//code added here
						'created_at'	   			=> strtotime(date('Y-m-d H:i:s')),
					);
	                //echo "<pre>";print_r($updateData);echo "</pre>";die;
					$this->db->where('id', $_POST['report_id']);
					$this->db->update('project_reports', $updateData);
					$redirect=base_url().'preview-report/'.$_POST['report_id'];
					echo json_encode(array('flag'=>1, 'msg'=>"success", 'redirect'=>$redirect));
					exit;
			    }
			}else{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
			}
		}else{
			redirect('signin','refresh');
		}
	}


    public function preview_report(){
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Create Report';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 6;
		$data['report_id'] =$report_id = $this->uri->segment(2);
		if(empty($report_id )){
			redirect(base_url('dashboard/projects'));
		}

		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetails($report_id);
		$data['proReportImageData']=$proReportImageData=$this->ReportModel->getDraftReportImageData($report_id);	
		$data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($progressDetails->project_id);
		$data['proFundUtilizedgraph']=$proFundUtilizedgraph=$this->ReportModel->getProjectReportUtilizedSumAmount($progressDetails->project_id);
		$data['contributorsList'] = $contributorsList=$this->ReportModel->getContributorsOfProject($progressDetails->project_id);
		$data['get_report_cover_details']= $get_report_cover_details = $this->db->get_where('project_reports',array('id'=>$report_id))->row(); //code added to get cover details
		$data['gettotaldonation']=$gettotaldonation = $this->CommonModel->get_total_donation($progressDetails->project_id); //code for get total donation and donors count by project_id use $progressDetails->project_id //for getting date we can add project id 25
		
		// code added here
		$data['get_current_tot_beneficiaries'] = $get_current_tot_beneficiaries = $this->ReportModel->get_current_tot_beneficiaries($report_id,$progressDetails->project_id);
		// code added here
        if(isset($progressDetails->contributor_id) && $progressDetails->contributor_id!=""){
           $contributorArr=explode(",", $progressDetails->contributor_id);
           $selectContributor=$this->ReportModel->projectContributorFundsDetails($progressDetails->contributor_id,$progressDetails->project_id);
		}else{
		   $contributorArr=array();
		   $selectContributor=array();
		}
		$data['selectedContributorArr'] = $selectContributor;		

		$unselectContributorArr=array();
		for ($i=0; $i <count($contributorsList) ; $i++) {
		    if(!in_array($contributorsList[$i]->id, $contributorArr)) 
            $unselectContributorArr[]=$contributorsList[$i]->id;
		}
		$contributerIds=implode(",", $unselectContributorArr);
		// code start here
		// $get_project_contributor = $this->ReportModel->projectContributorids($progressDetails->project_id);
		// $get_project_contributort = $this->ReportModel->projectContributoridst($progressDetails->project_id);
		// for($i=0;$i<$get_project_contributort;$i++){
		// 	$abc = $get_project_contributor[$i]['id'];
		// 	$unselectContributor=$this->ReportModel->projectContributorFundsDetailss($abc,$progressDetails->project_id);
		// }
		
		// code ends here
		$unselectContributor=$this->ReportModel->projectContributorFundsDetailss($contributerIds,$progressDetails->project_id);
		$data['unselectContributor'] = $unselectContributor;

		$data['report_frequency'] = substr($progressDetails->report_type_name, 0, -2);
		$data['proMilestoneData'] = $proMilestoneData=$this->ProjectModel->getProjectsFundsMilestonesData($progressDetails->project_id);
        $data['reportCaseStudyData']=$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($report_id);	
		//echo "<pre>";print_r($data['selectedContributorArr']);echo "</pre>";
		$this->load->view('report/preview_report', $data); 
	}

	public function download_report(){
		// print_r($_POST);
		// exit;
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Create Report';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 6;
		$data['report_id'] =$report_id = $_POST['report_id'];
		// $data['report_id'] =$report_id = $this->uri->segment(2);
		if(empty($report_id )){
			redirect(base_url('dashboard/projects'));
		}

		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetails($report_id);
		$data['get_project_goals'] = $get_project_goals = $this->db->get_where('projects_goals',array('project_id'=>$progressDetails->project_id))->row(); //new line added to get project goals
		// code added here
		$project_details = $this->db->get_where('projects',array('id'=>$progressDetails->project_id))->row();
		$data['user_details']=$users_details = $this->db->get_where('users',array('id'=>$project_details->user_id))->row();
		$data['ngo_details'] =$ngo_details = $this->db->get_where('ngo_details',array('user_id'=>$users_details->id))->row();
		// code ends here
		$data['proReportImageData']=$proReportImageData=$this->ReportModel->getDraftReportImageData($report_id);	
		$data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($progressDetails->project_id);
		$data['proFundUtilizedgraph']=$proFundUtilizedgraph=$this->ReportModel->getProjectReportUtilizedSumAmount($progressDetails->project_id);
		$data['contributorsList'] = $contributorsList=$this->ReportModel->getContributorsOfProject($progressDetails->project_id);
		$data['selectCurrentContributor']= $selectCurrentContributor=$this->ReportModel->projectCurrentContributor($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		$data['selectCurrentCollaborator']= $selectCurrentCollaborator=$this->ReportModel->projectCurrentCollaborator($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		$data['get_report_cover_details']= $get_report_cover_details = $this->db->get_where('project_reports',array('id'=>$report_id))->row(); //code added to get cover details
		$data['gettotaldonation']=$gettotaldonation = $this->CommonModel->get_total_donation($progressDetails->project_id); //code for get total donation and donors count by project_id use $progressDetails->project_id //for getting date we can add project id 25

        if(isset($progressDetails->contributor_id) && $progressDetails->contributor_id!=""){
           $contributorArr=explode(",", $progressDetails->contributor_id);
           $selectContributor=$this->ReportModel->projectContributorFundsDetails($progressDetails->contributor_id,$progressDetails->project_id);
		}else{
		   $contributorArr=array();
		   $selectContributor=array();
		}
		$data['selectedContributorArr'] = $selectContributor;		

		$unselectContributorArr=array();
		for ($i=0; $i <count($contributorsList) ; $i++) {
		    if(!in_array($contributorsList[$i]->id, $contributorArr)) 
            $unselectContributorArr[]=$contributorsList[$i]->id;
		}
		$contributerIds=implode(",", $unselectContributorArr);
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetails($contributerIds,$progressDetails->project_id); //code commented
		$unselectContributor=$this->ReportModel->projectContributorFundsDetailss($contributerIds,$progressDetails->project_id);
		$data['unselectContributor'] = $unselectContributor;

		$data['report_frequency'] = substr($progressDetails->report_type_name, 0, -2);
		$data['proMilestoneData'] = $proMilestoneData=$this->ProjectModel->getProjectsFundsMilestonesData($progressDetails->project_id);
        $data['reportCaseStudyData']=$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($report_id);	
		//echo "<pre>";print_r($data['selectedContributorArr']);echo "</pre>";
		// $html = $this->load->view('report/preview_report', $data); 
		$html = $this->load->view('report/download_report', $data,true);
		// print_r($html);
		// exit; 
		$this->load->library('pdf');
		// $this->pdf->setPaper('A4', 'landscape');
		$this->pdf->download($html, "Project Report");
		// redirect(base_url('dashboard/report'));
		
	}

	public function check_report(){
		$project_id = $_POST['search_project_id'];
		$start_date = strtotime($_POST['report_start_date']);
		$end_date = strtotime($_POST['report_end_date']. " +1 days");

		$sdate =$_POST['report_start_date'];
		$edate =$_POST['report_end_date'];

		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetailsn($project_id,$start_date,$end_date);  //DONE
		

		if($progressDetails!=""){
			$redirect= site_url('view_report').'?project_id='.$project_id.'&start_date='.$sdate.'&end_date='.$edate;
			echo json_encode(array('flag'=>1, 'msg'=> "Wait, Report is generating", 'project_id'=>"$project_id",'start_date'=>"$start_date",'end_date'=>"$end_date",'redirect'=>$redirect));
			exit;
		}else{
			echo json_encode(array('flag'=>0, 'msg'=> "No report were submitted during this period"));
			exit;
		}

	}


	// new report view start here
	public function view_report(){
		// print_r($_GET);
		// exit;
		// print_r($_GET);
		// $project_id = $_POST['search_project_id'];
		// $start_date = strtotime($_POST['report_start_date']);
		// $end_date = strtotime($_POST['report_end_date']. " +1 days");

		$sdate = $_GET['start_date'];
		$edate = $_GET['end_date'];

		$project_id = $_GET['project_id'];
		$start_date = strtotime($sdate);
		$end_date = strtotime($edate. " +1 days");
		// $start_date = $_GET['start_date'];
		// $end_date = $_GET['end_date'];
		// $start_date = strtotime($_GET['start_date']);
		// $end_date = strtotime($_GET['end_date']. " +1 days");
		
		
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Create Report';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 6;
		// $data['report_id'] =$report_id = $_POST['report_id']; //code commented here
		$data['report_id'] =$report_id = $_GET['project_id'];
	
		// $data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetails($report_id); //code commented here
		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetailsn($project_id,$start_date,$end_date);  //DONE
		

		// if($progressDetails!=""){
		// 	echo json_encode(array('flag'=>1, 'msg'=> "Successfully created report", 'project_id'=>"$project_id",'start_date'=>"$start_date",'end_date'=>"$end_date"));
		// 	exit;
		// }else{
		// 	echo json_encode(array('flag'=>0, 'msg'=> "No report were submitted during this period"));
		// 	exit;
		// }
		
		
		$data['case_study_details'] = $case_study_details = $this->db->get_where('project_report_case_studies',array('project_report_id'=>$progressDetails->id))->row();
		
		if($progressDetails->contributor_id ==""){
			// $this->load->view('report/error_report');
			// redirect(base_url('dashboard/reports'));				
		}
		$data['get_project_goals'] = $get_project_goals = $this->db->get_where('projects_goals',array('project_id'=>$project_id))->row(); //new line added to get project goals //DONE
		
		// code added here
		$project_details = $this->db->get_where('projects',array('id'=>$project_id))->row(); //DONE

		$data['user_details']=$users_details = $this->db->get_where('users',array('id'=>$project_details->user_id))->row(); //DONE
		$data['ngo_details'] =$ngo_details = $this->db->get_where('ngo_details',array('user_id'=>$users_details->id))->row(); //DONE
		// code ends here
		// $data['proReportImageData']=$proReportImageData=$this->ReportModel->getDraftReportImageData($report_id);  //AS OF NOW WE ARE  NOT USING	
		// $data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($project_id); //DONE
		$data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData_new($project_id,$start_date,$end_date); //DONE
		$data['proFundUtilizedgraph']=$proFundUtilizedgraph=$this->ReportModel->getProjectReportUtilizedSumAmount($project_id); //DONE
		$data['contributorsList'] = $contributorsList=$this->ReportModel->getContributorsOfProject($project_id); //DONE
		$data['selectCurrentContributor']= $selectCurrentContributor=$this->ReportModel->projectCurrentContributorn($project_id,$userId); //DONE
		// $data['selectCurrentContributor']= $selectCurrentContributor=$this->ReportModel->projectCurrentContributor($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		$data['selectCurrentCollaborator']= $selectCurrentCollaborator=$this->ReportModel->projectCurrentCollaboratorn($project_id,$selectCurrentContributor[0]->contributor_id); //DONE
		// $data['selectCurrentCollaborator']= $selectCurrentCollaborator=$this->ReportModel->projectCurrentCollaborator($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		// $data['get_report_cover_details']= $get_report_cover_details = $this->db->get_where('project_reports',array('id'=>$report_id))->row(); //code added to get cover details
		$data['get_report_cover_details']= $get_report_cover_details = $this->ReportModel->getprojectcoverimage($project_id); //code added to get cover details
		$data['gettotaldonation']=$gettotaldonation = $this->CommonModel->get_total_donation($project_id); //code for get total donation and donors count by project_id use $progressDetails->project_id //for getting date we can add project id 25  //DONE

        if(isset($progressDetails->contributor_id) && $progressDetails->contributor_id!=""){
           $contributorArr=explode(",", $progressDetails->contributor_id);
        //    $selectContributor=$this->ReportModel->projectContributorFundsDetails($progressDetails->contributor_id,$progressDetails->project_id);
		//    $selectContributor=$this->ReportModel->projectContributorFundsDetails_new($progressDetails->project_id,$start_date,$end_date);
		   $selectContributor=$this->ReportModel->projectContributorFundsDetails_new($progressDetails->project_id,$progressDetails->contributor_id);
		   
		}else{
		   $contributorArr=array();
		   $selectContributor=array();
		}
		$data['selectedContributorArr'] = $selectContributor;		

		$unselectContributorArr=array();
		for ($i=0; $i <count($contributorsList) ; $i++) {
		    if(!in_array($contributorsList[$i]->id, $contributorArr)) 
            $unselectContributorArr[]=$contributorsList[$i]->id;
		}
		$contributerIds=implode(",", $unselectContributorArr);
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetails($contributerIds,$progressDetails->project_id); //code commented
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetailss($contributerIds,$progressDetails->project_id); //code commented on 24-11-22
		$unselectContributor=$this->ReportModel->projectContributorFundsDetailss_new($project_id,$start_date,$end_date);
		$data['unselectContributor'] = $unselectContributor;

		$data['report_frequency'] = substr($progressDetails->report_type_name, 0, -2);
		$data['proMilestoneData'] = $proMilestoneData=$this->ProjectModel->getProjectsFundsMilestonesData($project_id); //DONE
        $data['reportCaseStudyData']=$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($report_id);	
		//echo "<pre>";print_r($data['selectedContributorArr']);echo "</pre>";
		// $html = $this->load->view('report/preview_report', $data); 
		$this->load->view('report/view_report', $data);
		// print_r($html);
		// exit; 
		// $this->load->library('pdf');
		// $this->pdf->setPaper('A4', 'landscape');
		// $this->pdf->download($html, "Project Report");
		// redirect(base_url('dashboard/report'));
		
	}
	// new report view ends here

	// new download report code start here
	public function download_reportn(){

		$project_id = $_POST['search_project_id'];
		$start_date = strtotime($_POST['report_start_date']);
		$end_date = strtotime($_POST['report_end_date']. " +1 days");
		// $end_date = strtotime($_POST['report_end_date']);
		// if(empty($start_date)  || empty($end_date)){
		// 	redirect(base_url('dashboard/reports')); 
			
		// }
		
		$userId = $_SESSION['UserId'];
		$data['PageTitle'] = SITE_NAME.' - Create Report';	
		$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
		$orgType= $UserDetails->type;
		$data['current_date'] = time();
        //$limit = 6;
		// $data['report_id'] =$report_id = $_POST['report_id']; //code commented here
		$data['report_id'] =$report_id = $_POST['search_project_id'];
		// $data['report_id'] =$report_id = $this->uri->segment(2);
		// if(empty($report_id )){
		// 	redirect(base_url('dashboard/projects'));
		// }

		// $data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetails($report_id); //code commented here
		$data['progress_details'] = $progressDetails = $this->ReportModel->getProgressReportDetailsn($project_id,$start_date,$end_date);  //DONE

		$data['case_study_details'] = $case_study_details = $this->db->get_where('project_report_case_studies',array('project_report_id'=>$progressDetails->id))->row(); //code for get study details

		if($progressDetails->contributor_id ==""){
			redirect(base_url('dashboard/reports'));				
		}
		$data['get_project_goals'] = $get_project_goals = $this->db->get_where('projects_goals',array('project_id'=>$project_id))->row(); //new line added to get project goals //DONE
		
		// code added here
		$project_details = $this->db->get_where('projects',array('id'=>$project_id))->row(); //DONE

		$data['user_details']=$users_details = $this->db->get_where('users',array('id'=>$project_details->user_id))->row(); //DONE
		$data['ngo_details'] =$ngo_details = $this->db->get_where('ngo_details',array('user_id'=>$users_details->id))->row(); //DONE
		// code ends here
		// $data['proReportImageData']=$proReportImageData=$this->ReportModel->getDraftReportImageData($report_id);  //AS OF NOW WE ARE  NOT USING	
		// $data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData($project_id); //DONE
		$data['proFundUtilized']=$proFundUtilized=$this->ReportModel->getProjectReportUtilizedData_new($project_id,$start_date,$end_date); //DONE
		$data['proFundUtilizedgraph']=$proFundUtilizedgraph=$this->ReportModel->getProjectReportUtilizedSumAmount($project_id); //DONE
		$data['contributorsList'] = $contributorsList=$this->ReportModel->getContributorsOfProject($project_id); //DONE
		$data['selectCurrentContributor']= $selectCurrentContributor=$this->ReportModel->projectCurrentContributorn($project_id,$userId); //DONE
		// $data['selectCurrentContributor']= $selectCurrentContributor=$this->ReportModel->projectCurrentContributor($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		$data['selectCurrentCollaborator']= $selectCurrentCollaborator=$this->ReportModel->projectCurrentCollaboratorn($project_id,$selectCurrentContributor[0]->contributor_id); //DONE
		// $data['selectCurrentCollaborator']= $selectCurrentCollaborator=$this->ReportModel->projectCurrentCollaborator($progressDetails->contributor_id,$progressDetails->project_id,$userId);
		// $data['get_report_cover_details']= $get_report_cover_details = $this->db->get_where('project_reports',array('id'=>$report_id))->row(); //code added to get cover details
		$data['get_report_cover_details']= $get_report_cover_details = $this->ReportModel->getprojectcoverimage($project_id); //code added to get cover details
		$data['gettotaldonation']=$gettotaldonation = $this->CommonModel->get_total_donation($project_id); //code for get total donation and donors count by project_id use $progressDetails->project_id //for getting date we can add project id 25  //DONE

        if(isset($progressDetails->contributor_id) && $progressDetails->contributor_id!=""){
           $contributorArr=explode(",", $progressDetails->contributor_id);
        //    $selectContributor=$this->ReportModel->projectContributorFundsDetails($progressDetails->contributor_id,$progressDetails->project_id);
			// $selectContributor=$this->ReportModel->projectContributorFundsDetails_new($progressDetails->project_id);
			$selectContributor=$this->ReportModel->projectContributorFundsDetails_new($progressDetails->project_id,$progressDetails->contributor_id);
		}else{
		   $contributorArr=array();
		   $selectContributor=array();
		}
		$data['selectedContributorArr'] = $selectContributor;		

		$unselectContributorArr=array();
		for ($i=0; $i <count($contributorsList) ; $i++) {
		    if(!in_array($contributorsList[$i]->id, $contributorArr)) 
            $unselectContributorArr[]=$contributorsList[$i]->id;
		}
		$contributerIds=implode(",", $unselectContributorArr);
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetails($contributerIds,$progressDetails->project_id); //code commented
		// $unselectContributor=$this->ReportModel->projectContributorFundsDetailss($contributerIds,$progressDetails->project_id);//code commented on 24-11-2022
		$unselectContributor=$this->ReportModel->projectContributorFundsDetailss_new($project_id,$start_date,$end_date);
		$data['unselectContributor'] = $unselectContributor;

		$data['report_frequency'] = substr($progressDetails->report_type_name, 0, -2);
		$data['proMilestoneData'] = $proMilestoneData=$this->ProjectModel->getProjectsFundsMilestonesData($project_id); //DONE
        $data['reportCaseStudyData']=$reportCaseStudyData=$this->ReportModel->getDraftReportCaseStudyData($report_id);	
		//echo "<pre>";print_r($data['selectedContributorArr']);echo "</pre>";
		// $html = $this->load->view('report/preview_report', $data); 
		$html = $this->load->view('report/download_report', $data,true);
		// print_r($html);
		// exit; 
		$this->load->library('pdf');
		// $this->pdf->setPaper('A4', 'landscape');
		$this->pdf->download($html, "Project Report");
		// redirect(base_url('dashboard/report'));
		
	}
	// new download report code ends here

	public function addImageEntry(){
		if(isset($_SESSION['UserId'])) {
			//print_r($_POST);exit;
			$random_id=generateUniqueID(10,'Numeric');
			$data['random_id']=$random_id;
			$data['number']=$random_id;
			$data['image_recieved_counter']=$_POST['counter'];
			$this->load->view('report/add_image_form', $data);
		}else{
			redirect('signin','refresh');
		}
	}

	public function addFundUtilizedEntry(){
		if(isset($_SESSION['UserId'])) {
			$random_id=generateUniqueID(10,'Numeric');
			$data['random_id']=$random_id;
			$data['number']=$random_id;
			$data['fund_utilized_counter']=$_POST['counter'];
			$data['contributorsList'] = $this->ReportModel->getContributorsOfProject();
			$this->load->view('report/fund_utilized_form', $data);
		}else{
			redirect('signin','refresh');
		}
	}

	public function addCaseStudyEntry(){
		if(isset($_SESSION['UserId'])) {
			//print_r($_POST);exit;
			$random_id=generateUniqueID(10,'Numeric');
			$data['random_id']=$random_id;
			$data['number']=$random_id;
			$data['case_study_counter']=$_POST['counter'];
			$this->load->view('report/add_case_study_form', $data);
			
		}else{
			redirect('signin','refresh');
		}
	}

	public function reportPostForm(){
		if(isset($_SESSION['UserId'])){
			if(isset($_POST) && $_POST != ''){
				$contributors_arr = isset($_POST['contributors'])?$_POST['contributors']:array();
				//$proSector_arr = array_values(array_filter($proSector));
				$start_period = isset($_POST['start_period'])?$_POST['start_period']:'';
				$end_period = isset($_POST['end_period'])?$_POST['end_period']:'';
				$workDescription = isset($_POST['work_description'])?$_POST['work_description']:'';
				$no_of_beneficiaries = isset($_POST['no_of_beneficiaries'])?$_POST['no_of_beneficiaries']:'';
				$work_activity_status = isset($_POST['work_activity_status'])?$_POST['work_activity_status']:'';
				
				if(isset($_POST['proReportFormbtn']) &&  $_POST['proReportFormbtn'] == 'CREATE REPORT'){
					if(empty($no_of_beneficiaries) || empty(strip_tags($workDescription))|| empty($_POST['work_activity_status'])){
						echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields..."));exit;
					}elseif(count($contributors_arr)<=0){
						echo json_encode(array('flag'=>0, 'msg'=>"Please select at least one contributor."));exit;
					}
					$submit_date = strtotime(date('Y-m-d H:i:s'));
					$redirect = base_url() . "dashboard/projects";
				}else{
					$submit_date = 0;
					$saved_as_draft = 1;
					$redirect = base_url() . "dashboard/projects";
				}
				
				$updateData = array( 
					'submit_date' 				=> $submit_date, 
					'report_type'				=> $_POST['report_type'],
					'start_date'				=> strtotime($start_period),
					'end_date'					=> strtotime($end_period),
					'work_description'			=> $_POST['work_description'],
					'no_of_beneficiaries'		=> $_POST['no_of_beneficiaries'],
					'work_activity_status'		=> $_POST['work_activity_status'],
					'created_at'	   			=> strtotime(date('Y-m-d H:i:s')),
				);

				$this->db->where('id', $_POST['reportID']);
				$this->db->update('project_reports', $updateData);
				$this->imageDescriptionFunction($_POST);
				$this->fundUtilizedFunction($_POST);
				$this->caseStudyFunction($_POST);
				echo json_encode(array('flag'=>1, 'msg'=>"success", 'redirect'=>$redirect));exit;
			}else{
				echo json_encode(array('flag'=>0, 'msg'=>"Please enter all mandatory / compulsory fields."));exit;
			}
		}else{
			redirect('signin','refresh');
		}
	}

	public function imageDescriptionFunction($POST){
		if(isset($_SESSION['UserId'])){
			if(isset($POST) && $POST != ''){
				$ImageDescription=isset($POST['ImageDescription'])?$POST['ImageDescription']:array();
				$ImageDescription_arr=array_values(array_filter($ImageDescription));
				foreach($ImageDescription as $desc){				
					if(empty(strip_tags($desc))){
						echo json_encode(array('flag'=>0, 'msg'=> "Image description can not be blank"));
						exit;
					}
				}
				$rep_img=isset($_FILES['rep_img'])?$_FILES['rep_img']:array();
				$rep_img_arr=array_values(array_filter($rep_img));
				$hiddenRepImage=isset($POST['hiddenRepImage'])?$POST['hiddenRepImage']:array();
				$filesize = MAX_FILESIZE_BYTE;
				$size = MAX_FILESIZE_MB;
				if(isset($POST['proReportFormbtn']) && $POST['proReportFormbtn'] == 'CREATE REPORT'){
					$errors = false;
					$file_ary = $this->reArrayFiles($_FILES['rep_img']);
					foreach($file_ary as $key => $file){
						// Check size, if exceed allowed size tell's you wich one have the problem
						if($file['error'] != 4){
							if($file['size'] > $filesize){
								$errors = true;
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB "));
								exit;
							}
						}
					}
					if(count($ImageDescription_arr)<=0){
						echo json_encode(array('flag'=>0, 'msg'=>"Please add image description."));exit;
					}
				}

				if(isset($ImageDescription_arr) && count($ImageDescription_arr)>0){
					foreach($ImageDescription_arr as $key=>$value){
						$hiddenRepImageVal = $hiddenRepImage[$key];
						$hiddenImageIdVal = $POST['hiddenImageId'][$key];
						$imageNameVal = $rep_img['name'][$key];
						$filename1 = ($hiddenRepImageVal != '')?$hiddenRepImageVal:'';
						if($imageNameVal != ''){
							$_FILES['reportImg']['name']= $file_name = $rep_img['name'][$key];
							$_FILES['reportImg']['type']= $rep_img['type'][$key];
							$_FILES['reportImg']['tmp_name']= $rep_img['tmp_name'][$key];
							$_FILES['reportImg']['error']= $rep_img['error'][$key];
							$_FILES['reportImg']['size']= $rep_img['size'][$key];
							
							if($_FILES["reportImg"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
								exit;
							}
							
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = 'IMG_'.$POST['reportID'].'_'.date('Ymd_His').'.'.$ext;
							$config['upload_path'] = REP_IMG_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = 'IMG_'.$POST['reportID'].'_'.date('Ymd_His');
							
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('reportImg')){
								//$error = array('error' => $this->upload->display_errors());
								$uploadData = $this->upload->data();
								$filename1=$uploadData['file_name'];
							}
						}
						
						if($hiddenImageIdVal == ''){
							$insertData=array(  'project_report_id'	=> $POST['reportID'],
												'image_path'		=> $filename1,
												'image_description'	=> $value,
												'created_at'		=> strtotime(date('Y-m-d H:i:s')),
												);
							$this->db->insert('project_report_images', $insertData);	
						}
					}
				}
			}
		}
	}

	public function fundUtilizedFunction($POST){
		if(isset($_SESSION['UserId'])){
			if(isset($POST) && $POST != ''){
				$fund_description=isset($POST['fund_description'])?$POST['fund_description']:array();
				$utilize_description_arr=array_values(array_filter($fund_description));
				foreach($fund_description as $fdesc){				
					if(empty(strip_tags($fdesc))){
						echo json_encode(array('flag'=>0, 'msg'=> "Fund description can not be blank"));
						exit;
					}
				}

				$category=isset($POST['category'])?$POST['category']:array();
				$category_arr=array_values(array_filter($category));

				$amount_spent=isset($POST['amount_spent'])?$POST['amount_spent']:array();
				$amount_spent_arr=array_values(array_filter($amount_spent));

				$reciept=isset($_FILES['reciept'])?$_FILES['reciept']:array();
				$reciept_arr=array_values(array_filter($reciept));
				
				$filesize = MAX_FILESIZE_BYTE;
				$size = MAX_FILESIZE_MB;

				$errors = false;
				$file_ary = $this->reArrayFiles($_FILES['reciept']);
				foreach($file_ary as $key => $file){
					if($file['error'] != 4){
						if($file['size'] > $filesize){
							$errors = true;
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}
					}
				}
				if(count($amount_spent_arr)<=0){
					echo json_encode(array('flag'=>0, 'msg'=>"Please add amount spent."));exit;
				}

				if(isset($utilize_description_arr) && count($utilize_description_arr)>0){
					foreach($utilize_description_arr as $key=>$value){
						$amountSpentVal = $amount_spent_arr[$key];
						$categoryVal = $category_arr[$key];
						$recieptImgNameVal = $reciept['name'][$key];
						$filename1 = '';
						if($recieptImgNameVal != ''){
							$_FILES['file']['name']= $file_name = $reciept['name'][$key];
							$_FILES['file']['type']= $reciept['type'][$key];
							$_FILES['file']['tmp_name']= $reciept['tmp_name'][$key];
							$_FILES['file']['error']= $reciept['error'][$key];
							$_FILES['file']['size']= $reciept['size'][$key];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
								exit;
							}
						
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = 'FUND_IMG_'.$POST['reportID'].'_'.date('Ymd_His').'.'.$ext;
							$config['upload_path'] = FUND_UTILIZED_IMG_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = 'FUND_IMG_'.$POST['reportID'].'_'.date('Ymd_His');

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
								$uploadData = $this->upload->data();
								$filename1=$uploadData['file_name'];
							}
						}
					
						$insertData=array(  'project_report_id'		=> $POST['reportID'],
											'utilize_description'	=> $value,
											'funded_by'				=> $categoryVal,
											'amount_spent'			=> $amountSpentVal,
											'utilize_document'		=> $filename1,
											'created_at'			=> strtotime(date('Y-m-d H:i:s')),
											);
						$this->db->insert('project_report_fund_utilized', $insertData);	
					}
				}
			}
		}
	}

	public function caseStudyFunction($POST){
		if(isset($_SESSION['UserId'])){
			if(isset($POST) && $POST != ''){
				$caseStudyTitle=isset($POST['caseStudyTitle'])?$POST['caseStudyTitle']:array();
				$caseStudyTitle_arr=array_values(array_filter($caseStudyTitle));

				$caseStudyDescription=isset($POST['caseStudyDescription'])?$POST['caseStudyDescription']:array();
				$caseStudyDescription_arr=array_values(array_filter($caseStudyDescription));

				$caseStudyImg=isset($_FILES['case_study_img'])?$_FILES['case_study_img']:array();
				$caseStudyImg_arr=array_values(array_filter($caseStudyImg));
				
				$filesize = MAX_FILESIZE_BYTE;
				$size = MAX_FILESIZE_MB;

				$errors = false;
				$file_ary = $this->reArrayFiles($_FILES['case_study_img']);
				foreach($file_ary as $key => $file){
					if($file['error'] != 4){
						if($file['size'] > $filesize){
							$errors = true;
							echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
							exit;
						}
					}
				}
				
				if(isset($caseStudyTitle_arr) && count($caseStudyTitle_arr)>0){
					foreach($caseStudyTitle_arr as $key=>$value){
						$caseStudyDescriptionVal = $caseStudyDescription_arr[$key];
						$caseStudyImgVal = $caseStudyImg['name'][$key];
						$filename1 = '';
						if($caseStudyImgVal != ''){
							$_FILES['file']['name']= $file_name = $caseStudyImg['name'][$key];
							$_FILES['file']['type']= $caseStudyImg['type'][$key];
							$_FILES['file']['tmp_name']= $caseStudyImg['tmp_name'][$key];
							$_FILES['file']['error']= $caseStudyImg['error'][$key];
							$_FILES['file']['size']= $caseStudyImg['size'][$key];
							
							if($_FILES["file"]["size"] > $filesize){
								echo json_encode(array('flag'=>0, 'msg'=> "Limit exceeds above 3MB"));
								exit;
							}
						
							$ext = pathinfo($file_name, PATHINFO_EXTENSION);
							$filename = 'CASE_STUDY_IMG_'.$POST['reportID'].'_'.date('Ymd_His').'.'.$ext;
							$config['upload_path'] = REP_CASE_STUDY_PATH;
							$config['allowed_types'] = 'jpg|jpeg|png|pdf';
							$config['max_size'] = MAX_FILESIZE_BYTE;
							
							$config['file_name'] = 'CASE_STUDY_IMG_'.$POST['reportID'].'_'.date('Ymd_His');

							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);

							if($this->upload->do_upload('file')){
								$uploadData = $this->upload->data();
								$filename1=$uploadData['file_name'];
							}
						}
					
						$insertData=array(  'project_report_id'	=> $POST['reportID'],
											'case_study_title'	=> $value,
											'case_study_image'	=> $filename1,
											'case_study'		=> $caseStudyDescriptionVal,
											'created_at'		=> strtotime(date('Y-m-d H:i:s')),
											);
						$this->db->insert('project_report_case_studies', $insertData);	
					}
				}
			}
		}
	}

	public function reArrayFiles(&$file_post) {
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}

	public function OtherContributerName() {
		if(isset($_SESSION['UserId'])) {
			$UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
			if($UserDetails->type != 1){
				redirect(base_url());
			} 
			$project_id = $this->input->post('project_id');
			$projectContributorFundsID_arr = isset($_POST['projectContributorFundsID'])?$_POST['projectContributorFundsID']:array();
			if(isset($projectContributorFundsID_arr) && count($projectContributorFundsID_arr)>0){
				// $result[] = '';
				$data ['result'] = $result = '';
				
				$totalreceivedamount ='';
				$projectContributorFundsByID = $this->ReportModel->projectContributorFundsNotByID($projectContributorFundsID_arr,$project_id);
				// print_r($projectContributorFundsByID); //die();
				$data ['totalCommit'] = $totalCommit=0;
				$data ['received_amount'] = $received_amount=0;
				$data ['balance_amount'] = $balance_amount=0;
				foreach($projectContributorFundsByID as $key=>$value){
					// $value = $this->ReportModel->projectContributorFundsByID($projectContributorFundsByID,$project_id);
					$created= date('d-m-Y',$value->created_at);
					// echo $created; echo " date";
					$data['result'] =$result.= '<tr id="'.$value->id.'"><td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="funded_by[]" value="'.$value->funded_by.'" placeholder="'.$value->funded_by.'"></td><td><input type="text" class="form-control " id="funded_by_'.$value->id.'" name="created_at[]" value="'.$created.'" placeholder="'.$created.'"></td><td><input type="text" class="form-control " id="source_'.$value->id.'" name="source[]" value="'.$value->source.'" placeholder="'.$value->source.'"></td><td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="committed_amount" id="committed_amount_'.$value->id.'" value="'.number_format($value->committed_amount, 0, '', ',').'"></td><td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="received_amount" id="received_amount_'.$value->id.'" value="'.number_format($value->received_amount, 0, '', ',').'"></td><td class="medium-td rupee-box"><input type="text" class="form-control amount-number " name="balance_amount" id="balance_amount_'.$value->id.'" value="'.number_format($value->balance_amount, 0, '', ',').'"></td></tr>';

					
					$data ['totalCommit'] = $totalCommit=number_format($totalCommit + $value->committed_amount, 0, '', ',');
					$data ['received_amount'] = $received_amount=number_format($received_amount + $value->received_amount, 0, '', ',');
					$data ['balance_amount'] = $balance_amount=number_format($balance_amount + $value->balance_amount, 0, '', ',');
				}
				
				// echo $totalreceivedamount ;
				echo json_encode($data);
			}
		}else{
			redirect('signin','refresh');
		}
	}


	//function created for getting report into pdf and excel

	public function consolidateDonationReport(){
		// if(!empty($_POST)){
		if(!empty($_POST['start_date'] && $_POST['end_date'])){
			$ngo_id = $_POST['ngo_id'];
			$start_date = $_POST['start_date'];
		    $end_date = $_POST['end_date'];
			$donation_type = $_POST['donation_type'];
			// if($donation_type =='all_transaction'){
			// 	$donationDetails = $this->ReportModel->get_donationDetails($ngo_id,$start_date,$end_date);
			// }else if($donation_type =='all_offline_transaction'){
			// 	$donationDetails = $this->ReportModel->get_offline_donationDetails($ngo_id,$start_date,$end_date);
			// }
		    // $donationDetails = $this->ReportsModel->get_donationDetails($ngo_id,$start_date,$end_date);
			$donationDetails = $this->ReportModel->get_donationDetails($ngo_id,$start_date,$end_date);
		    $ngoData = $this->db->get_where('ngo_details',array('id'=>$ngo_id))->row();
		    $ngo = $ngoData->org_name;
			$ngoADD1 = $ngoData->org_address_line1;
			$ngoADD2 = $ngoData->org_address_line2;
			$ngocity = $ngoData->city;
			$ngostate = $ngoData->state;
			$ngopincode = $ngoData->pincode;
			
		    $data['ngo'] = $ngo;
		    $data['address'] = "$ngoADD1, $ngocity, $ngostate - $ngopincode";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			$donationRaised=0;
			$donationDeducted =0;
			$donationSettled=0;
			$projectArr=array();
			$trucsr_platform_fee_percent=TRUCSR_PLATFORM_FEE_PERCENTAGE;
			for ($i=0; $i <count($donationDetails) ; $i++) {
			    $donationRaised=$donationRaised+$donationDetails[$i]->donation_amount;
			    if(!isset($donationDetails[$i]->totalPlatFormFee)){
			    	$donationDetails[$i]->totalPlatFormFee=0;
			    }

			    if(!isset($donationDetails[$i]->gstPlatFormFee)){
			    	$donationDetails[$i]->gstPlatFormFee=0;
			    }

			    if($donationDetails[$i]->trasnfer_status==1){
			    	$totalPlatFormFee=round(($donationDetails[$i]->donation_amount*$trucsr_platform_fee_percent)/100,2);
			    	$deduct=$donationDetails[$i]->donation_amount-$donationDetails[$i]->transfer_amount;
			    	$gstPlatFormFee=$deduct-$totalPlatFormFee;
			    	$donationDeducted=$donationDeducted+$deduct;
			    	$donationSettled=$donationSettled+$donationDetails[$i]->transfer_amount;
			    	$donationDetails[$i]->totalPlatFormFee=$totalPlatFormFee;
			    	$donationDetails[$i]->gstPlatFormFee=$gstPlatFormFee;
			    }			    
                
                $projectArr[$donationDetails[$i]->project_id]['project_id']=$donationDetails[$i]->project_id;
			    $projectArr[$donationDetails[$i]->project_id]['project']=$donationDetails[$i]->project;
			    $projectArr[$donationDetails[$i]->project_id]['transaction'][]=$donationDetails[$i];
			    
			    if(!isset($projectArr[$donationDetails[$i]->project_id]['donationRaised'])){
			    	$projectArr[$donationDetails[$i]->project_id]['donationRaised']=0;
			    }

			    if(!isset($projectArr[$donationDetails[$i]->project_id]['platFormFee'])){
			    	$projectArr[$donationDetails[$i]->project_id]['platFormFee']=0;
			    }

			    if(!isset($projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee'])){
			    	$projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee']=0;
			    }
                
                if(!isset($projectArr[$donationDetails[$i]->project_id]['donationDeducted'])){
			    	$projectArr[$donationDetails[$i]->project_id]['donationDeducted']=0;
			    }

			    if(!isset($projectArr[$donationDetails[$i]->project_id]['donationSettled'])){
			    	$projectArr[$donationDetails[$i]->project_id]['donationSettled']=0;
			    }
                $projectArr[$donationDetails[$i]->project_id]['donationRaised']=$projectArr[$donationDetails[$i]->project_id]['donationRaised']+$donationDetails[$i]->donation_amount;
			     if($donationDetails[$i]->trasnfer_status==1){
			    	$projectArr[$donationDetails[$i]->project_id]['platFormFee']=$projectArr[$donationDetails[$i]->project_id]['platFormFee']+$totalPlatFormFee;
			    	$projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee']=$projectArr[$donationDetails[$i]->project_id]['gstPlatFormFee']+$gstPlatFormFee;
			    	$projectArr[$donationDetails[$i]->project_id]['donationDeducted']=$projectArr[$donationDetails[$i]->project_id]['donationDeducted']+$deduct;
			    	$projectArr[$donationDetails[$i]->project_id]['donationSettled']=$projectArr[$donationDetails[$i]->project_id]['donationSettled']+$donationDetails[$i]->transfer_amount;
			    }
				# code...
			}

			$data['donationRaised']  =$donationRaised;
			$data['donationDeducted'] =$donationDeducted;
			$data['donationSettled'] =$donationSettled;
			$data['projectArr'] =$projectArr;
			

		    //echo "<pre>";print_r($projectArr);echo "</pre>";
		    $html = $this->load->view('report/donation_report_view', $data, true);
			// echo $html;
			// die();
            
			$this->load->library('pdf');
			// $this->pdf->setPaper('A4', 'landscape');
			$this->pdf->download($html, "Donation Report");
		}else{
			redirect(base_url('dashboard/donation'));
		}
	}
	
	public function donation_report(){
		print_r("Neerajkumar");
		exit;
	}


}
