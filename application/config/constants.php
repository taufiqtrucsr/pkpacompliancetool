<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('secrets.php');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


//custom defind for Zones
define('TRUCSR_DEFAULT_MAIL', "support@trucsr.in");
define('MAX_FILESIZE_BYTE', "10485760"); // In 2MB (Bytes) 2 * 1024 * 1024
define('MAX_FILESIZE_MB', "10 MB"); // In MB

define('MAX_KB_FILESIZE_BYTE', "512000"); // In 500KB (Bytes)
define('MAX_KB_FILESIZE_MB', "500 KB"); // In KB

define('JS_CSC_V', "22032201"); //ddmmyy01, ddmmyy02

define('SITE_NAME',$CT_SITE_NAME);
define('BASE_URL',$CT_BASE_URL);
define('WEB_URL', $CT_WEB_URL);
define('ROOT_PATH',$CT_ROOT_PATH); 

define('SKIN_PATH', ROOT_PATH."skin/");
define('SKIN_URL', BASE_URL."skin/");

define('COMPANY_LOGO_PATH', ROOT_PATH.'public/uploads/company/company_logo/');
define('COMPANY_LOGO', WEB_URL.'public/uploads/company/company_logo/');

define('COMPANY_ADD_PROOF_PATH', ROOT_PATH.'public/uploads/company/company_address_proof/');
define('COMPANY_ADD_PROOF_URL', WEB_URL.'public/uploads/company/company_address_proof/');

define('COMPANY_CIN_PATH', ROOT_PATH.'public/uploads/company/cin_certificate/');
define('COMPANY_CIN_URL', WEB_URL.'public/uploads/company/cin_certificate/');

define('COMPANY_GST_PATH', ROOT_PATH.'public/uploads/company/gst_certificate/');
define('COMPANY_GST_URL', WEB_URL.'public/uploads/company/gst_certificate/');

define('COMPANY_PAN_PATH', ROOT_PATH.'public/uploads/company/pan_card/');
define('COMPANY_PAN_URL', WEB_URL.'public/uploads/company/pan_card/');

define('COMPANY_MEMBER_PATH', ROOT_PATH.'public/uploads/company/company_board_member/');
define('COMPANY_MEMBER_URL', WEB_URL.'public/uploads/company/company_board_member/');

define('NGO_LOGO_PATH', ROOT_PATH.'public/uploads/ngo/ngo_logo/');
define('NGO_LOGO', WEB_URL.'public/uploads/ngo/ngo_logo/');

define('NGO_ADD_PROOF_PATH', ROOT_PATH.'public/uploads/ngo/ngo_address_proof/');
define('NGO_ADD_PROOF_URL', WEB_URL.'public/uploads/ngo/ngo_address_proof/');

define('NGO_CIN_PATH', ROOT_PATH.'public/uploads/ngo/ngo_cin/');
define('NGO_CIN_URL', WEB_URL.'public/uploads/ngo/ngo_cin/');

define('NGO_GST_PATH', ROOT_PATH.'public/uploads/ngo/ngo_gst/');
define('NGO_GST_URL', WEB_URL.'public/uploads/ngo/ngo_gst/');

define('NGO_PAN_PATH', ROOT_PATH.'public/uploads/ngo/ngo_pan/');
define('NGO_PAN_URL', WEB_URL.'public/uploads/ngo/ngo_pan/');

define('NGO_80G_PATH', ROOT_PATH.'public/uploads/ngo/ngo_80g/');
define('NGO_80G_URL', WEB_URL.'public/uploads/ngo/ngo_80g/');

define('NGO_FCRA_PATH', ROOT_PATH.'public/uploads/ngo/ngo_fcra/');
define('NGO_FCRA_URL', WEB_URL.'public/uploads/ngo/ngo_fcra/');

define('NGO_35AC_PATH', ROOT_PATH.'public/uploads/ngo/ngo_35ac/');
define('NGO_35AC_URL', WEB_URL.'public/uploads/ngo/ngo_35ac/');

define('NGO_12A_PATH', ROOT_PATH.'public/uploads/ngo/ngo_12a/');
define('NGO_12A_URL', WEB_URL.'public/uploads/ngo/ngo_12a/');

define('NGO_TRUSTEE_PATH', ROOT_PATH.'public/uploads/ngo/ngo_trustee/');
define('NGO_TRUSTEE_URL', WEB_URL.'public/uploads/ngo/ngo_trustee/');

define('NGO_CSR_PATH', ROOT_PATH.'public/uploads/ngo/ngo_csr/');
define('NGO_CSR_URL', WEB_URL.'public/uploads/ngo/ngo_csr/');

define('NGO_STAMP_PATH', ROOT_PATH.'public/uploads/ngo/ngo_official_seal/');
define('NGO_STAMP_URL', WEB_URL.'public/uploads/ngo/ngo_official_seal/');

define('NGO_SIGNATURE_PATH', ROOT_PATH.'public/uploads/ngo/ngo_signature/');
define('NGO_SIGNATURE_URL', WEB_URL.'public/uploads/ngo/ngo_signature/');

define('NGO_YEAR_PATH', ROOT_PATH.'public/uploads/ngo/ngo_year/');
define('NGO_YEAR_URL', WEB_URL.'public/uploads/ngo/ngo_year/');

define('NGO_MEMBER_PATH', ROOT_PATH.'public/uploads/ngo/ngo_board_member/');
define('NGO_MEMBER_URL', WEB_URL.'public/uploads/ngo/ngo_board_member/');

define('GOOGLE_RECAPTCHA_SITE_KEY', '6LffE8oUAAAAALgc-s7SyxSCdTQ0uYaWI7sR7zyr');
define('GOOGLE_RECAPTCHA_SECRET_KEY', '6LffE8oUAAAAAOzdkPxzYXEQkfZihSiEq-TlPGDW');

// Projects Funds Already Recieved Path
define('PRO_FUNDS_ALRECD_PATH', ROOT_PATH.'public/uploads/project/funds_alrecd/');
define('PRO_FUNDS_ALRECD_URL', WEB_URL.'public/uploads/project/funds_alrecd/');

// Projects Cover Image Path
define('PRO_COVER_IMG_PATH', ROOT_PATH.'public/uploads/project/cover_image/');
define('PRO_COVER_IMG_URL', WEB_URL.'public/uploads/project/cover_image/');

// Projects gallery Image Path
define('PRO_GALLERY_IMG_PATH', ROOT_PATH.'public/uploads/project/gallery_image/');
define('PRO_GALLERY_IMG_URL', WEB_URL.'public/uploads/project/gallery_image/');

//SDGs Images
define('PRO_SDGS_IMG_PATH', ROOT_PATH.'public/uploads/project/sdg_image/');
define('PRO_SDGS_IMG_URL', WEB_URL.'public/uploads/project/sdg_image/');

// Projects Goal Image Path
define('PRO_GOAL_IMG_PATH', ROOT_PATH.'public/uploads/project/goal_image/');
define('PRO_GOAL_IMG_URL', WEB_URL.'public/uploads/project/goal_image/');

// Projects Goal Image Path
define('PROJECT_PATH', ROOT_PATH.'public/uploads/project/document/');
define('PROJECT_PATH_URL', WEB_URL.'public/uploads/project/document/');

// Campaign (Motivator) Cover Image Path
define('CAMPAIGN_COVER_IMG_PATH', ROOT_PATH.'public/uploads/motivator/cover_image/');
define('CAMPAIGN_COVER_IMG_URL', WEB_URL.'public/uploads/motivator/cover_image/');

// Campaign (Motivator) CSV Path
define('CAMPAIGN_CSV_PATH', ROOT_PATH.'public/uploads/motivator/csv/');
define('CAMPAIGN_CSV_URL', WEB_URL.'public/uploads/motivator/csv/');

// Campaign (Fundraiser) Cover Image Path
define('FUND_CAMPAIGN_COVER_IMG_PATH', ROOT_PATH.'public/uploads/motivator/cover_image/');
define('FUND_CAMPAIGN_COVER_IMG_URL', WEB_URL.'public/uploads/motivator/cover_image/');

// Campaign (Fundraiser) CSV Path
define('FUND_CAMPAIGN_CSV_PATH', ROOT_PATH.'public/uploads/motivator/csv/');
define('FUND_CAMPAIGN_CSV_URL', WEB_URL.'public/uploads/motivator/csv/');

// Resources Cover Image Path
define('RESOURCES_COVER_IMG_PATH', ROOT_PATH.'public/uploads/resources/cover_image/');
define('RESOURCES_COVER_IMG_URL', WEB_URL.'public/uploads/resources/cover_image/');

// Resources Image Path
define('RESOURCES_IMG_PATH', ROOT_PATH.'public/uploads/resources/resources_image/');
define('RESOURCES_IMG_URL', WEB_URL.'public/uploads/resources/resources_image/');

//Contract PDF
define('CONTRACT_PDF_PATH', ROOT_PATH.'public/uploads/contract/');
define('CONTRACT_PDF_URL', WEB_URL.'public/uploads/contract/');

define('CS_CONTRACT_PDF_PATH', ROOT_PATH.'public/uploads/contract/cs_contract/');
define('CS_CONTRACT_PDF_URL', WEB_URL.'public/uploads/contract/cs_contract/');
define('CS_BOARD_PATH', ROOT_PATH.'public/uploads/contract/cs_board/');
define('CS_BOARD_URL', WEB_URL.'public/uploads/contract/cs_board/');

define('NS_CONTRACT_PDF_PATH', ROOT_PATH.'public/uploads/contract/ns_contract/');
define('NS_CONTRACT_PDF_URL', WEB_URL.'public/uploads/contract/ns_contract/');
define('NS_BOARD_PATH', ROOT_PATH.'public/uploads/contract/ns_board/');
define('NS_BOARD_URL', WEB_URL.'public/uploads/contract/ns_board/');

define('CONTRACT_ZIP_PATH', ROOT_PATH.'public/uploads/contract/logs/');
define('CONTRACT_ZIP_URL', WEB_URL.'public/uploads/contract/logs/');

//Download PDF
define('DOWNLOAD_PDF_PATH', ROOT_PATH.'public/uploads/downloads/organization/');

//PDF Template
define('PDF_TEMPLATE_PATH', ROOT_PATH.'public/pdf_template/');

//Banner Image
define('BANNER_PATH', ROOT_PATH.'public/uploads/banner/');
define('BANNER_IMAGE', WEB_URL.'public/uploads/banner/');

//Cheque Image
define('CHEQUE_IMG_PATH', ROOT_PATH.'public/uploads/cheque/');
define('CHEQUE_IMG_URL', WEB_URL.'public/uploads/cheque/');

//Receipt PDF
define('RECEIPT_PDF_PATH', ROOT_PATH.'public/uploads/receipt/');
define('RECEIPT_PDF_URL', WEB_URL.'public/uploads/receipt/');

//Payslip PDF
define('PAYSLIP_PDF_PATH', ROOT_PATH.'public/uploads/payslip/payslip_pdf/');
define('PAYSLIP_PDF_URL', WEB_URL.'public/uploads/payslip/payslip_pdf/');
define('CT_PAYNENT_PATH', ROOT_PATH.'public/uploads/payslip/ct_payment/');
define('CT_PAYNENT_URL', WEB_URL.'public/uploads/payslip/ct_payment/');
define('NT_80G_PATH', ROOT_PATH.'public/uploads/payslip/nt_80g_certificate/');
define('NT_80G_URL', WEB_URL.'public/uploads/payslip/nt_80g_certificate/');

//Invoice File
define('INVOICE_FILE_PATH', ROOT_PATH.'public/uploads/payslip/invoice/'); 
define('INVOICE_FILE_URL', WEB_URL.'public/uploads/payslip/invoice/');

//Newsletter Files
define('NEWSLETTER_PATH', ROOT_PATH.'public/uploads/newsletter/');
define('NEWSLETTER_URL', WEB_URL.'public/uploads/newsletter/');

// Report Image Path
define('REP_IMG_PATH', ROOT_PATH.'public/uploads/report/rep_image/');
define('REP_IMG_URL', WEB_URL.'public/uploads/report/rep_image/');

//financial   report
define('FINANCIAL_REPORT_PATH', ROOT_PATH.'public/uploads/report/financial_report/');
define('FINANCIAL_REPORT_URL', WEB_URL.'public/uploads/report/financial_report/');

//Report Cover Image Path
define('REP_COVER_IMG_PATH', ROOT_PATH.'public/uploads/report/rep_cover_image/');
define('REP_COVER_IMG_URL', WEB_URL.'public/uploads/report/rep_cover_image/');

define('FUND_UTILIZED_IMG_PATH', ROOT_PATH.'public/uploads/report/fund_utilize_image/');
define('FUND_UTILIZED_IMG_URL', WEB_URL.'public/uploads/report/fund_utilize_image/');

define('REP_CASE_STUDY_PATH', ROOT_PATH.'public/uploads/report/case_study_image/');
define('REP_CASE_STUDY_URL', WEB_URL.'public/uploads/report/case_study_image/');

define('REP_SDGS_PATH', ROOT_PATH.'public/uploads/report/sdgs_image/');
define('REP_SDGS_URL', WEB_URL.'public/uploads/report/sdgs_image/');


//Razor Pay Test API Keys
define('RAZOR_KEY_ID', $RAZOR_KEY_ID);
define('RAZOR_KEY_SECRET', $RAZOR_KEY_SECRET);


//Razor Pay Transfer Percentage
define('RAZOR_TRUCSR_TRANSFER_PERCENTAGE', '92.81');

//Trucsr Platform Fee Percentage
define('TRUCSR_PLATFORM_FEE_PERCENTAGE', '4.72');

//Motivator Image
define('MOTIVATOR_COVER_IMAGE_PATH', ROOT_PATH.'public/uploads/motivator/cover_image/');
define('MOTIVATOR_COVER_IMAGE', WEB_URL.'public/uploads/motivator/cover_image/');
define('MOTIVATOR_CSV_FUNDRAISER_PATH', ROOT_PATH.'public/uploads/motivator/csv/fundraiser');
define('MOTIVATOR_CSV_FUNDRAISER', WEB_URL.'public/uploads/motivator/csv/fundraiser');

//Resources Image
define('RESOURCES_COVER_IMAGE_PATH', ROOT_PATH.'public/uploads/resources/cover_image/');
define('RESOURCES_COVER_IMAGE', WEB_URL.'public/uploads/resources/cover_image/');
define('RESOURCES_IMAGE_PATH', ROOT_PATH.'public/uploads/resources/resources_image/');
define('RESOURCES_IMAGE', WEB_URL.'public/uploads/resources/resources_image/');

// Billing Invoice Path
define('BILLING_INVOICE_PATH', ROOT_PATH.'public/uploads/billing/invoice/');
define('BILLING_INVOICE_URL', WEB_URL.'public/uploads/billing/invoice/');

// Billing Report Path
define('BILLING_REPORT_PATH', ROOT_PATH.'public/uploads/billing/report/');
define('BILLING_REPORT_URL', WEB_URL.'public/uploads/billing/report/');


//Offline Transaction Path
define('OFFLINE_TRANSACTION_DOC',ROOT_PATH.'public/uploads/offline/offline_transaction_doc/');
define('OFFLINE_TRANSACTION_URL',WEB_URL.'public/uploads/offline/offline_transaction_doc/');


//download Recipt 
define('DOWNLOAD_RECIPT',WEB_URL.'donor-pay/download-receipt/');

//CSR_COMPLIANCE_DOCUMENTS_ALL_DOCUEMNTS
define('CSR_COMPLIANCE_DOCUMENTS', ROOT_PATH.'public/uploads/csr/csr_compliance/');
define('CSR_COMPLIANCE_URL', WEB_URL.'public/uploads/csr/csr_compliance/');

//MEDIA ACCESS
define('CSR_COMPLIANCE_CASE_STUDY', 'public/uploads/csr/csr_compliance/');
define('MEDIA_URL', WEB_URL);

//Set CLIENTID For APISetu 
define('CLIENTID', 'in.trucsr');

//Set APIKEY For APISetu 
define('APIKEY', 'rgNIyP8KVokUV6yjZFTkkGC2c0ilLqO5');

//Set Pagination Segment
define('SEGMENT',								4);

define('CONSENT', array(
    'signup-consent',
    'onboarding-t&c-contributor',
    'onboarding-t&c-implementer',
    'onboarding-t&c-motivator',
    'onboarding-t&c-fundraiser',
    'onboarding-t&c-volunteer',
    'onboarding-t&c-donor',
    'volunteering-rfp-accept',
    'project-create',
    )
);