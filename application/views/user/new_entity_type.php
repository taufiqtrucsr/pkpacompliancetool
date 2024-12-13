<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
?>
<?php $this->load->view('common/head_common'); ?>
<style>
    .sub_container {
        color: black;
        margin: auto;
        background: white;
        height: 270px;
        width: 220px;
        border-radius: 5px;
        border: 1.5px solid #ffff;
    }

    .page {
        width: 100%;
        margin: 10px;
        box-shadow: 0px 0px 5px #000;
        animation: pageIn 1s ease;
        transition: all 1s ease, width 0.2s ease;
    }

    .preview-pdf {
        width: 100px;
        height: 100px;
        overflow: hidden;
    }

    .current_act_btn {
        border: 1.5px solid #3366cc;
        border-radius: 5px;
    }

    .cross-icons {
        position: absolute;
        color: white;
        background: #ff0000c2;
        border-radius: 3px;
        margin-left: 69px;
        margin-top: 5px;
        z-index: 10;
        cursor: pointer;
    }

    .submit_user:hover {
        background-color: #3366cc;
    }

    .btn:focus,
    .btn.Focus {
        outline: 0;
    }

    .footer {
        display: none;
    }

    .main_container {
        background: #E5E5E5;
        text-align: center;
        display: flex;
        justify-content: center;
        padding: 60px 0px;
        font-family: averta_regular;
    }

    .full-page {
        background: #f6f8fc;
    }

    .main_title {
        color: #7082A9;
        font-size: 24px;
        font-family: averta_regular;
    }

    @media only screen and (max-width: 600px) {
        .main_container {
            display: contents;
        }

        .sub_container {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        body {
            font-size: 12px;
        }

        .main_title {
            font-size: 20px;
        }
    }

    .addmoreGov {
        cursor: pointer;
        width: 200px;
        text-align: center;
        padding: 10px;
        background: #fff;
        color: #1F7BE7;
        font-size: 15px;
    }

    @media only screen and (min-width: 600px) {
        .main_container {
            display: contents;
        }

        .sub_container {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        body {
            font-size: 14px;
        }
    }

    @media only screen and (min-width: 768px) {
        .main_container {
            display: grid;
        }
    }

    @media only screen and (min-width: 992px) {
        .main_container {
            display: flex;
            padding: 60px 0px;
        }

        body {
            font-size: 13px;
        }
    }

    @media only screen and (min-width: 1200px) {
        .main_container {
            display: flex;
            padding: 41px 0px !important;
        }
    }

    label {
        width: 100%;
    }

    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 1px 1px #2ecc71;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .mb-7 {
        margin-bottom: 7px;
    }
</style>
<link rel="stylesheet" media="all" href="https://harvesthq.github.io/chosen/chosen.css" />
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>/css/implementor.css" />

<body class="full-page">
    <?php $this->load->view('common/header'); ?>

    <div class="container" style="padding:50px;">
        <?php
        if (isset($_SESSION['UserId'])) {
            $UserDetails = $this->UserModel->GetUserById($_SESSION['UserId']);
            $select_entity_id = $entity_type;
            $role = $UserDetails->current_active_role;
            $gov_query = $this->db->query("SELECT * FROM `governing_act` WHERE `entity_id`= " . $select_entity_id . "");
            $gov_act = $gov_query->result_array();

            $query = $this->db->query("SELECT * FROM `state_master`");
            $state = $query->result_array();

            $district_query = $this->db->query("SELECT * FROM `district_master`");
            $district = $district_query->result_array();

            $user_id = $_SESSION['UserId'];

            $dateofincorporation = '';
            $entity_address_1 = '';
            $pincode = '';
            $EntityName = '';

            $llp_company = [2, 6, 7, 8, 9, 10, 11];
            $board_govt_trustee_title = '';
            $board_govt_trustee_part1 = '';
            $textlength = 10;
            $board_govt_trustee_part2 = '';
            if ($select_entity_id == 1) {
                // taufiq
                $board_govt_trustee_title = 'Trustee / Council Group';
                // $board_govt_trustee_title = 'Board Members Details';
                // end taufiq
                $board_govt_trustee_part1 = 'Name *';
                // taufiq
                $board_govt_trustee_part2 = 'PAN *';
                // $board_govt_trustee_part2 = 'DIN / DPIN *';
                // end taufiq
                $dateof_reg_incor = "Date Of Registration";
            } elseif ($select_entity_id == 3) {
                $board_govt_trustee_title = 'Governing Body Members';
                $board_govt_trustee_part1 = 'Name *';
                $board_govt_trustee_part2 = 'PAN *';
                $dateof_reg_incor = "Date Of Registration";
            } elseif (in_array($select_entity_id, $llp_company)) {
                $board_govt_trustee_title = 'Board of Director';
                $board_govt_trustee_part1 = 'Name *';
                $board_govt_trustee_part2 = 'DIN/DPIN *';
                $dateof_reg_incor = "Date Of Incorporation";
                $textlength = 8;
            } elseif ($select_entity_id == 5 || $select_entity_id == 4 || $select_entity_id == 13) {
                $board_govt_trustee_title = 'Partners ';
                $board_govt_trustee_part1 = 'Partner *';
                $board_govt_trustee_part2 = 'PAN *';
                $dateof_reg_incor = "Date Of Registration";
            } elseif ($select_entity_id == 12) {
                $board_govt_trustee_title = 'HUF Member Details';
                $board_govt_trustee_part1 = 'Name *';
                $board_govt_trustee_part2 = 'PAN *';
                $dateof_reg_incor = "Date Of Registration";
            }
        }
        ?>
        <div class="text-center">
            <P class="main_title">Complete Your Entity Profile</P>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="edit-ngo-page organisation-main-steps" id="entity-step-form">
                    <div class="col-12">
                        <div class="tab-content">
                            <div id="ngo-register" class="tab-pane fade in active">
                                <div class="">
                                    <div class="stepwizard col-md-offset-3">
                                        <div class="stepwizard-row setup-panel"
                                            style="justify-content: center !important; display: flex;">
                                            <div class="stepwizard-step">
                                                <a href="#ngo-step-1" id="ngo-step-1-btn" type="button"
                                                    class="btn btn-primary btn-circle"><span class="step-count">1</span>
                                                    KYC</a>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#ngo-step-2" id="ngo-step-2-btn" type="button"
                                                    class="btn btn-default btn-circle" disabled="disabled"><span
                                                        class="step-count">2</span> Profile Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- USER DETAILS STEP 1 START -->
                                    <div id="ngo-step-1">
                                        <form action="<?php echo base_url(); ?>Register/ngoEditFormStep1"
                                            enctype="multipart/form-data" id="edit-ngo-form-1" method="POST"
                                            novalidate="novalidate">

                                            <input type="hidden" name="Usertype" id="user_type_id"
                                                value="<?= $UserDetails->user_type; ?>">
                                            <input type="hidden" name="entitytypeId" id="entitytypeId"
                                                value="<?= $user_profile_check->entity_type; ?>">
                                            <input type="hidden" name="account_id"
                                                value="<?= $UserDetails->account_id; ?>">
                                            <input type="hidden" name="usersprofileID" id="usersprofile"
                                                value="<?= $usersprofile->id; ?>">
                                            <input type="hidden" name="current_role" id="current_role"
                                                value="<?= $UserDetails->current_active_role; ?>">

                                            <div class="container">
                                                <div class="row setup-content registration-flow-setup">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6 cinReg"
                                                                style="display:table;">
                                                                <label class="control-label">Enter CIN / Registration
                                                                    Number<span>*</span></label>
                                                                <input
                                                                    placeholder="Enter CIN / Registration Number here.."
                                                                    type="text" class="form-control" id="cin_no"
                                                                    required name="cin_no"
                                                                    value="<?php echo $cin_no; ?>" <?php echo (in_array($select_entity_id, $cinEntityTypeList)) ? "maxlength='21'" : ""; ?> autocomplete="off">
                                                                <span class="text-danger api-error"></span>
                                                            </div>
                                                            <div class="form-group col-sm-6 cinReg"
                                                                style="display:table; clear:both;width:100%">
                                                            </div>
                                                            <?php
                                                            if ($select_entity_id == 1 || $select_entity_id == 3) {
                                                                $CIN_SH = "block;";
                                                            } else {
                                                                $CIN_SH = "none;";
                                                            }
                                                            ?>
                                                            <!-- taufiq -->
                                                            <div class="foundation_society"
                                                                style="display:<?php echo $CIN_SH; ?>">

                                                                <?php
                                                                if ($usersprofile->governing_act_id) {
                                                                    $govexplode = array_map('intval', explode(',', $usersprofile->governing_act_id));
                                                                    foreach ($govexplode as $gkeys => $gvalue) {
                                                                        echo '<div class="form-group col-sm-6">
                                        <label class="control-label">Governing Act<span>*</span></label>
                                        <div class="select-box">
                                        <select id="govAct" name="govAct[]" required class="form-control">
                                        <option >Select Governing ID</option>';
                                                                        foreach ($gov_act as $key => $gov_actvalue) {
                                                                            echo '<option value="' . $gov_actvalue['id'] . '" ';
                                                                            if ($gov_actvalue['id'] == $gvalue) {
                                                                                echo "selected";
                                                                            }
                                                                            echo '>' . $gov_actvalue['governing_act'] . '
                                        </option>';
                                                                        }
                                                                        echo '</select>
                                        </div>
                                        </div>';
                                                                    }
                                                                } else {
                                                                    echo '<div class="form-group col-sm-6">
                                  <label class="control-label">Governing Act<span>*</span></label>
                                  <div class="select-box">
                                  <select id="govAct" name="govAct[]" required class="form-control">
                                  ';
                                                                    foreach ($gov_act as $key => $gov_actvalue) {
                                                                        echo '<option value="' . $gov_actvalue['id'] . '">' . $gov_actvalue['governing_act'] . '
                                      </option>';
                                                                    }
                                                                    echo '</select>
                                  </div>
                                  </div>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <!-- end taufiq -->

                                                            <div id="MoreGoverning">

                                                            </div>
                                                            <!-- ADD MORE GOVERNING ACT -->
                                                            <div class="row" style="clear:both;">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <?php
                                                                        if ($select_entity_id == 2 && $currentRole == 3) {
                                                                            echo '<p class="addmoreGov"  onclick="addMoreGoverningAct();"> <span>+</span> Add another Trust Act </p>';
                                                                        } else {
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ADD MORE GOVERNING ACT -->


                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <h1 class="_heading">Entity Details</h1>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <?php
                                                                if ($UserDetails->user_type == 1) {
                                                                    if ($usersprofile->entity_name) {
                                                                        $EntityName = $usersprofile->entity_name;
                                                                    } else {
                                                                        $EntityName = $user_profile_check->entity_name;
                                                                    } ?>
                                                                    <!--Sanjay Oraon 28/06/2023 adding pattern attribute-->
                                                                    <label class="control-label">Entity
                                                                        Name<span>*</span></label>
                                                                    <input required onpaste="return false;"
                                                                        placeholder="Entity Name" type="text" minlength="5"
                                                                        maxlength="100" class="form-control validate-char"
                                                                        id="orgName" name="entityName"
                                                                        value="<?= $EntityName ?>">
                                                                    <!--<input required onpaste="return false;" placeholder="Entity Name" type="text" minlength="5" maxlength="100" class="form-control validate-char" id="orgName" name="entityName" 
                                  value="<?php echo (!in_array($select_entity_id, $cinEntityTypeList)) ? $EntityName : '' ?>">-->
                                                                    <!--<input <?php echo (in_array($select_entity_id, $cinEntityTypeList)) ? "readonly" : ""; ?> required onpaste="return false;" placeholder="Entity Name" type="text" minlength="5" maxlength="100" class="form-control validate-char" id="orgName" name="entityName" 
                                  value="<?php echo (!in_array($select_entity_id, $cinEntityTypeList)) ? $EntityName : '' ?>">-->
                                                                <?php }
                                                                ?>

                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label class="control-label">Entity
                                                                    type<span>*</span></label>
                                                                <input placeholder="Enter entity type here" type="text"
                                                                    minlength="10" maxlength="100" class="form-control"
                                                                    id="entityTypeName"
                                                                    value="<?php echo $org_type_name; ?>"
                                                                    name="entityTypeName" value="" disabled />
                                                                <input type="hidden" name="entityType"
                                                                    value="<?php echo $select_entity_id; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6 date-of-incop">
                                                                <label class="control-label">
                                                                    <?= $dateof_reg_incor; ?><span>*</span>
                                                                </label>
                                                                <!--sanjay oraon 28/06/2023 max date and disable mannual input --->
                                                                <input type="date"
                                                                    value="<?= (isset($usersprofile->date_of_incorp_birth)) ? date('Y-m-d', $usersprofile->date_of_incorp_birth) : ''; ?>"
                                                                    class="form-control" id="incorpDate"
                                                                    name="incorpDate" onkeydown="return false"
                                                                    max="<?php echo date('Y-m-d'); ?>">
                                                                <!--<input type="date" value="<?= $usersprofile->date_of_incorp_birth; ?>" <?php echo (in_array($select_entity_id, $cinEntityTypeList)) ? "readonly" : ""; ?> class="form-control" id="incorpDate" name="incorpDate" onkeydown="return false" max="<?php echo date('Y-m-d'); ?>">-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label class="control-label">Entity Registered
                                                                    Address<span>*</span></label>
                                                                <input placeholder="Enter Registered address here"
                                                                    type="text" minlength="10" class="form-control"
                                                                    id="registerAddress" name="registerAddress"
                                                                    value="<?= $usersprofile->entity_address; ?>"
                                                                    required />
                                                                <!--<input <?php echo (in_array($select_entity_id, $cinEntityTypeList)) ? "readonly" : ""; ?> placeholder="Enter Registered address here"
                                                                    type="text" minlength="10"
                                                                    class="form-control" id="registerAddress"
                                                                    name="registerAddress"
                                                                    value="<?= $usersprofile->entity_address; ?>"
                                                                    required />-->
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label
                                                                    class="control-label">Pincode<span>*</span></label>
                                                                <input placeholder="Enter Pincode here" type="text"
                                                                    minlength="6" maxlength="6"
                                                                    class="form-control validate-number" id="pincode"
                                                                    name="pincode"
                                                                    value="<?php echo $usersprofile->pincode; ?>"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label class="control-label">State<span>*</span></label>
                                                                <div class="select-box">
                                                                    <select id="state" name="state"
                                                                        class="form-control state_step1 mb-7" required>
                                                                        <option value="">Select State</option>
                                                                        <?php
                                                                        foreach ($state as $key => $value) {
                                                                            if ($value['id'] == 38) {
                                                                                continue;
                                                                            }
                                                                            $current_stat_code = $usersprofile->state;
                                                                            ?>
                                                                            <option value="<?php echo $value['id']; ?>"
                                                                                data-id="<?php echo $value['st_code']; ?>"
                                                                                <?php if ($value['id'] == $current_stat_code) {
                                                                                    echo "selected";
                                                                                } ?>>
                                                                                <?php echo $value['st_name']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label
                                                                    class="control-label">District<span>*</span></label>
                                                                <div class="select-box">

                                                                    <select id="cityOrDistrict" name="cityOrDistrict"
                                                                        class="form-control cityOrDistrict-step1 mb-7"
                                                                        required>
                                                                        <option value="">Select District</option>
                                                                        <?php
                                                                        if (count($SelCity) > 0) {
                                                                            foreach ($SelCity as $skeys => $svals) {
                                                                                echo '<option value="' . $svals->id . '" ';
                                                                                if ($svals->id == $usersprofile->district) {
                                                                                    echo "selected";
                                                                                }
                                                                                echo '>' . $svals->dst_name . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- taufiq -->
                                                            <div class="form-group col-sm-6">
                                                                <label class="control-label">City<span>*</span></label>
                                                                <input placeholder="Enter City here" type="text"
                                                                    class="form-control validate-char" id="City"
                                                                    name="city" value="<?= $usersprofile->city; ?>"
                                                                    required />
                                                            </div>
                                                            <?php
                                                            $comapanies = [6, 7, 8, 9, 10, 11];
                                                            if (in_array($select_entity_id, $comapanies)) {
                                                                $proff_select = "none;";
                                                            } else {
                                                                $proff_select = "block;";
                                                            }

                                                            if ($select_entity_id == 4) {
                                                                $CIN_SH = "none;";
                                                            } else {
                                                                $CIN_SH = "block;";
                                                            }
                                                            ?>
                                                            <!-- taufiq -->
                                                            <div class="foundation_society form-group col-sm-6">
                                                                <div>
                                                                    <div>
                                                                        <!-- COMMENT BY SOURAV 15 AUG AS PER FIGMA-->
                                                                        <!-- <div class="form-group col-sm-6" 
                                                                    style="display: <?php echo $CIN_SH; ?>">
                                                                    <label
                                                                        class="control-label">City<span>*</span></label>
                                                                    <input placeholder="Enter City here" type="text"
                                                                        minlength="3" class="form-control validate-char" id="city"
                                                                        name="city"
                                                                        value="<?php echo $usersprofile->city; ?>" required />
                                                                </div> -->
                                                                        <div style="display: <?php echo $proff_select; ?>">
                                                                            <label class="control-label">Upload Address
                                                                                Proof</label>
                                                                            <div class="select-box">

                                                                                <select id="b_addressProof_type"
                                                                                    name="b_addressProof_type"
                                                                                    class="form-control">
                                                                                    <option value="">Select Address
                                                                                        Proof Doc
                                                                                        and Upload</option>
                                                                                    <option value="1" <?php if ($usersprofile->address_proof_type == 1) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                                                        Rent Agreement</option>
                                                                                    <option value="2" <?php if ($usersprofile->address_proof_type == 2) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                                                        Electricity Bill</option>
                                                                                    <option value="3" <?php if ($usersprofile->address_proof_type == 3) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                                                                        Phone Bill</option>
                                                                                </select>
                                                                                <input type="hidden"
                                                                                    name="existedaddressproof"
                                                                                    value="<?= $usersprofile->address_proof ?>">
                                                                                <div class="file-exist">
                                                                                    <?php if ($usersprofile->address_proof) {
                                                                                        if (pathinfo($usersprofile->address_proof, PATHINFO_EXTENSION) == 'pdf') { ?>
                                                                                            <svg class="cross-icons"
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16" height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                            </svg>
                                                                                            <embed class="preview-pdf"
                                                                                                src="<?php echo NGO_ADD_PROOF_URL . '' . $usersprofile->address_proof; ?>"></embed>
                                                                                        <?php } else { ?>
                                                                                            <svg class="cross-icons"
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16" height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-x"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                            </svg>
                                                                                            <img class="preview-img"
                                                                                                src="<?php echo NGO_ADD_PROOF_URL . '' . $usersprofile->address_proof; ?>"
                                                                                                style="width:100px;height:100px;" />
                                                                                        <?php }
                                                                                    } ?>
                                                                                </div>
                                                                                <div class="not-file-exist"
                                                                                    style="display:none">
                                                                                    <svg class="cross-icons"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-x"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                                                    </svg>
                                                                                    <input type="file"
                                                                                        id="file-uploader"
                                                                                        style="display:none;"
                                                                                        name="uploadedAddressProof"
                                                                                        class="file-upload-preview-img  file_upload_common"
                                                                                        accept="image/jpg, image/png, application/pdf">
                                                                                    <label class="error"
                                                                                        id="b_addressProof_type-error"></label>
                                                                                    <div class="preview-pdf"></div>
                                                                                    <img class="preview-img" src=""
                                                                                        style="width:100px;height:100px;" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end taufiq -->
                                                            <!-- end taufiq -->
                                                        </div>
                                                    </div>




                                                    <?php

                                                    if ($select_entity_id == 1) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 2 && $currentRole != 3) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 7) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 4) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 5) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 3) {
                                                        $SecT = "table";
                                                    } elseif ($select_entity_id == 6) {
                                                        $SecT = "table";
                                                    } else {
                                                        $SecT = "none";
                                                    }
                                                    ?>
                                                    <div class="form-divide board-dir-sec"
                                                        style="display:<?php echo $SecT; ?>">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="form-group col-sm-12">
                                                                    <h1 class="_heading">
                                                                        <?php echo $board_govt_trustee_title; ?>
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="board-directors-list">
                                                            <div class="col-sm-12">

                                                                <?php
                                                                $delteIcons = 0;
                                                                // echo "22".$currentRole;
                                                                /* if ($select_entity_id == $Entity_type_id_sel) { */
                                                                if (count($governing_body) > 0) {
                                                                    foreach ($governing_body as $gkeys => $gvals) {
                                                                        if ($delteIcons != 0) {
                                                                            $deletegov = '<img class="remove-btn removeAddMoreTrustee" src="' . SKIN_URL . 'images/deleteIconsline.svg" alt="" style="padding:10px;">';
                                                                        } else {
                                                                            $deletegov = '';
                                                                        }
                                                                        /*echo '<div class="form-group col-sm-6">
                                                                              <label class="control-label" for="dirName">' . $board_govt_trustee_part1 . '</label>
                                                                              <input type="text"  class="form-control addMoreBoardDetails validate-char" '.((in_array($select_entity_id,$cinEntityTypeList))? "readonly" : "").' id="dirName" name="dirName[]" value="' . $gvals->governing_body_name . '" />
                                                                              </div>
                                                                              <div class="form-group col-sm-6">
                                                                              <label class="control-label">' . $board_govt_trustee_part2 . '</label>
                                                                                <input type="text" maxlength="10" placeholder="" class="form-control '.((in_array($select_entity_id,$llp_company))? "validate-number" : "").'" oninput="this.value = this.value.toUpperCase()" id="din" '.((in_array($select_entity_id,$cinEntityTypeList))? "readonly" : "").' name="din[]" value="' . $gvals->din_or_DPIN .'">
                                                                               
                                                                            </div>
                                                                            ';*/
                                                                        echo '<div class="row"><div class="form-group col-sm-6">
                                        <label class="control-label" for="dirName">' . $board_govt_trustee_part1 . '</label>
                                        <input type="text"  class="form-control addMoreBoardDetails validate-char" id="dirName" name="dirName[]" value="' . $gvals->governing_body_name . '" required/>
                                        </div>
                                        <div class="form-group col-sm-6">
                                        <label class="control-label">' . $board_govt_trustee_part2 . '</label>
                                          <input type="text" placeholder="" class="form-control ' . ((in_array($select_entity_id, $llp_company)) ? "validate-number" : "") . '" oninput="this.value = this.value.toUpperCase()"  name="din[]" value="' . $gvals->din_or_DPIN . '" required>
                                         ' . $deletegov . '
                                      </div></div>
                                      ';
                                                                        $delteIcons++;
                                                                    }
                                                                } else {
                                                                    /*echo '<div class="form-group col-sm-6">
                                                                    <label class="control-label" for="dirName">' . $board_govt_trustee_part1 . '</label>
                                                                    <input type="text"  class="form-control addMoreBoardDetails  validate-char"  name="dirName[]" '.((in_array($select_entity_id,$cinEntityTypeList))? "readonly" : "").' value="" />
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                    <label class="control-label">' . $board_govt_trustee_part2 . '</label>
                                                                    <input type="text" placeholder="" class="form-control '.((in_array($select_entity_id,$llp_company))? "validate-number" : "").'" oninput="this.value = this.value.toUpperCase()" '.((in_array($select_entity_id,$cinEntityTypeList))? "readonly" : "").' name="din[]" value="" maxlength="10" />
                                                                    </div>';*/
                                                                    echo '<div class="row"><div class="form-group col-sm-6">
                                    <label class="control-label" for="dirName">' . $board_govt_trustee_part1 . '</label>
                                    <input type="text"  class="form-control addMoreBoardDetails  validate-char"  name="dirName[]"  value="" />
                                    </div>
                                    <div class="form-group col-sm-6">
                                    <label class="control-label">' . $board_govt_trustee_part2 . '</label>
                                    <input type="text" placeholder="" class="form-control ' . ((in_array($select_entity_id, $llp_company)) ? "validate-number" : "") . '" oninput="this.value = this.value.toUpperCase()"  name="din[]" value=""  />
                                    </div></div>';
                                                                }
                                                                ?>

                                                            </div>
                                                            <div id="more-board-body">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12" style="margin-top:20px;">
                                                            <div class="row">
                                                                <div class="form-group col-sm-6">
                                                                    <?php
                                                                    //if(!in_array($select_entity_id,$cinEntityTypeList)){ 
                                                                    if ($select_entity_id == 1) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore"   onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } elseif (in_array($select_entity_id, $llp_company)) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } elseif ($select_entity_id == 7) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } elseif ($select_entity_id == 4 || $select_entity_id == 5) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    }
                                                                    /* elseif ($select_entity_id == 5) {
                                                                    echo '<a href="javascript:void()"  class="btn addmore" onclick="addMorePartner()"> <span>+</span> Add More </a>';
                                                                    } */ elseif ($select_entity_id == 3) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } elseif ($select_entity_id == 12) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } elseif ($select_entity_id == 13) {
                                                                        echo '<a href="javascript:void()"  class="btn addmore" onclick="addMore(1)"> <span>+</span> Add More </a>';
                                                                    } else {

                                                                    }
                                                                    //	}
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!-- Documents -->
                                                    <!-- $select_entity_id == 4 || $select_entity_id == 5 -->
                                                    <div class="form-divide board-dir-sec">

                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="form-group col-sm-12">
                                                                    <h1 class="_heading">Documents</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">

                                                                <?php
                                                                if (count($usersdocuments_pan) > 0) {
                                                                    foreach ($usersdocuments_pan as $Pankeys => $Panvals) {
                                                                        echo '<div class="form-group col-sm-6">
                                      <label class="control-label" for="orgType">Entity PAN Number *</label>
                                      <input type="text" oninput="this.value = this.value.toUpperCase()" placeholder=""Enter Entity PAN Number Here" class="form-control alpha_numeric" minlength="10" maxlength="10" id="panNumber" name="panNumber" value="' . $Panvals->document_number . '" />
                                      <input type="hidden" name="panexistfile" value="' . $Panvals->document_file_path . '">
                                    </div>';
                                                                    }
                                                                } else {
                                                                    echo '<div class="form-group col-sm-6">
                                  <label class="control-label validate-char" for="orgType">Entity PAN Number *</label>
                                  <input type="text" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Entity PAN Number Here" class="form-control alpha_numeric" id="panNumber" name="panNumber" minlength="10" maxlength="10" value="">
                        
                                 </div>';
                                                                }
                                                                ?>
                                                                <?php
                                                                if (count($usersdocuments_gst) > 0) {
                                                                    foreach ($usersdocuments_gst as $gstkeys => $gstvals) {
                                                                        echo '<div class="form-group col-sm-6">
                                      <label class="control-label">GST Number *</label>
                                      <input type="text" oninput="this.value = this.value.toUpperCase()"  placeholder="Enter GST Number Here" class="form-control alpha_numeric" id="gstNumber" name="gstNumber" value="' . $gstvals->document_number . '" maxlength="15"/>
                                      <input type="hidden" name="gstexistfile" value="' . $gstvals->document_file_path . '">
                                    </div>';
                                                                    }
                                                                } else {
                                                                    echo ' <div class="form-group col-sm-6">
                                      <label class="control-label">GST Number *</label>
                                     <input type="text" oninput="this.value = this.value.toUpperCase()"  placeholder="Enter GST Number Here" class="form-control alpha_numeric" id="gstNumber" name="gstNumber" value="" maxlength="15"/>
                                 </div>';
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="form-group col-sm-6">
                                                                    <label class="control-label"> Upload PAN * </label>

                                                                    <input type="file" name="uploadPan"
                                                                        class="form-control upload __upload file-upload-preview"
                                                                        id="uploadpan" <?php if (count($usersdocuments_pan) > 0) {
                                                                        } else {
                                                                            echo "required";
                                                                        } ?>
                                                                        accept="image/jpg, image/png, application/pdf"
                                                                        data-msg-accept="Invaild file format, accepts only .png, .jpg and .pdf format.">


                                                                    <img
                                                                        src="<?php echo SKIN_URL; ?>images/upload-pan.svg">
                                                                    <p class="__filename"></p>
                                                                    <?php
                                                                    if (count($usersdocuments_pan) > 0) {
                                                                        foreach ($usersdocuments_pan as $cinkeys => $cinvals) {
                                                                            if ($cinvals->document_file_path) {
                                                                                $fileInfo = pathinfo($cinvals->document_file_path);
                                                                                $extension = $fileInfo['extension'];
                                                                                echo '<input type="hidden" name="panexistfile" value="' . $cinvals->document_file_path . '">';
                                                                                echo '<a href="' . NGO_PAN_URL . $cinvals->document_file_path . '" target="_blank" class="preview display-block">Preview</a>';
                                                                            }
                                                                        }
                                                                    } else { ?>
                                                                        <a href="#" target="_blank"
                                                                            class="preview">Preview</a>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="form-group col-sm-6">
                                                                    <label class="control-label"> Upload GST Certificate
                                                                        *
                                                                    </label>
                                                                    <input type="file" name="uploadGst"
                                                                        class="form-control upload __upload file-upload-preview"
                                                                        id="uploadgst" <?php if (count($usersdocuments_pan) > 0) {
                                                                        } else {
                                                                            echo "required";
                                                                        } ?>
                                                                        accept="image/jpg, image/png,application/pdf"
                                                                        data-msg-accept="Invaild file format, accepts only .png, .jpg and .pdf format.">
                                                                    <img
                                                                        src="<?php echo SKIN_URL; ?>images/gst-upload.svg">
                                                                    <p class="__filename"></p>
                                                                    <?php
                                                                    if (count($usersdocuments_gst) > 0) {
                                                                        foreach ($usersdocuments_gst as $cinkeys => $cinvals) {
                                                                            if ($cinvals->document_file_path) {
                                                                                $fileInfo = pathinfo($cinvals->document_file_path);
                                                                                $extension = $fileInfo['extension'];
                                                                                echo '<input type="hidden" name="gstexistfile" value="' . $cinvals->document_file_path . '">';
                                                                                echo '<a href="' . NGO_GST_URL . $cinvals->document_file_path . '" target="_blank" class="preview display-block">Preview</a>';
                                                                            }
                                                                        }
                                                                    } else { ?>
                                                                        <a href="#" target="_blank"
                                                                            class="preview">Preview</a>
                                                                    <?php } ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if ($select_entity_id == 4 || $select_entity_id == 13) {
                                                            $SecT = "none";
                                                        } else {
                                                            $SecT = "block";
                                                        }
                                                        ?>
                                                        <div class="regcertificatre-sec"
                                                            style="display: <?php echo $SecT; ?>;">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="form-group col-sm-6">
                                                                        <label class="control-label">Registration
                                                                            Certificate *</label>
                                                                        <?php
                                                                        if (count($usersdocuments_regcert) > 0) {
                                                                            foreach ($usersdocuments_regcert as $cinkeys => $cinvals) {
                                                                                echo '<input type="date" class="form-control" onkeydown="return false" id="registrationCertificate" max="' . date("Y-m-d") . '"
                                                                            name="registrationCertificate" value="' . $cinvals->calendar_start_date . '">';
                                                                            }
                                                                        } else {
                                                                            echo '<input type="date" class="form-control" onkeydown="return false" id="registrationCertificate"
                                                                            max="' . date("Y-m-d") . '"  name="registrationCertificate">';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <label class="control-label" for="orgSector">MOA
                                                                            & AOA/ Trust Deed / R&R (Updated Up-to)
                                                                            *</label>
                                                                        <?php
                                                                        if (count($usersdocuments_trustdeed) > 0) {
                                                                            foreach ($usersdocuments_trustdeed as $cinkeys => $cinvals) {
                                                                                echo '<input type="date" name="trustDeadDate"  onkeydown="return false" class="form-control" min="' . date("Y-m-d", strtotime("+1 day")) . '" value="' . $cinvals->calendar_start_date . '">';
                                                                            }
                                                                        } else {
                                                                            echo '<input type="date" name="trustDeadDate" onkeydown="return false" class="form-control" min="' . date("Y-m-d", strtotime("+1 day")) . '">';
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="form-group col-sm-6">
                                                                        <input type="file" name="uploadRegdCertificate"
                                                                            accept="image/jpg,image/png,application/pdf"
                                                                            data-msg-accept="Invaild file format, accepts only .png, .jpg and .pdf format."
                                                                            class="form-control upload reg-certi __upload file-upload-preview"
                                                                            id="uploadRegdcertificate" <?php if (count($usersdocuments_regcert) > 0) {
                                                                            } else {
                                                                                echo "required";
                                                                            } ?>>
                                                                        <img
                                                                            src="<?php echo SKIN_URL; ?>images/reg-certi.svg">
                                                                        <p class="__filename"></p>
                                                                        <?php
                                                                        if (count($usersdocuments_regcert) > 0) {
                                                                            foreach ($usersdocuments_regcert as $cinkeys => $cinvals) {
                                                                                $fileInfo = pathinfo($cinvals->document_file_path);
                                                                                $extension = $fileInfo['extension'];
                                                                                echo '<input type="hidden" name="existRegproof" value="' . $cinvals->document_file_path . '">';
                                                                                echo '<a href="' . NGO_CIN_URL . $cinvals->document_file_path . '" target="_blank" class="preview display-block">Preview</a>';
                                                                            }
                                                                        } else { ?>
                                                                            <a href="#" target="_blank"
                                                                                class="preview">Preview</a>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group col-sm-6">
                                                                        <input type="file" name="trustDead"
                                                                            accept="image/jpg,image/png,application/pdf"
                                                                            data-msg-accept="Invaild file format, accepts only .png, .jpg and .pdf format."
                                                                            class="form-control upload trust-deed __upload file-upload-preview"
                                                                            id="trustdead" <?php if (count($usersdocuments_trustdeed) > 0) {
                                                                            } else {
                                                                                echo "required";
                                                                            } ?>>
                                                                        <img
                                                                            src="<?php echo SKIN_URL; ?>images/upl-trust.svg">
                                                                        <p class="__filename"></p>
                                                                        <?php
                                                                        if (count($usersdocuments_trustdeed) > 0) {
                                                                            foreach ($usersdocuments_trustdeed as $cinkeys => $cinvals) {
                                                                                if ($cinvals->document_file_path) {
                                                                                    $fileInfo = pathinfo($cinvals->document_file_path);
                                                                                    $extension = $fileInfo['extension'];
                                                                                    echo '<input type="hidden" name="existTrustproof" value="' . $cinvals->document_file_path . '">';
                                                                                    echo '<a href="' . NGO_TRUSTEE_URL . $cinvals->document_file_path . '" target="_blank" class="preview display-block">Preview</a>';

                                                                                }
                                                                            }
                                                                        } else { ?>
                                                                            <a href="#" target="_blank"
                                                                                class="preview">Preview</a>
                                                                        <?php } ?>
                                                                        <input type="hidden" name="allowedfiles"
                                                                            id="allowedfiles" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="full-width">
                                                            <div class="col-sm-12">
                                                                <div class="wrap_flex_btn">
                                                                    <div class="form-group">
                                                                        <a href="<?php //echo base_url(); ?>register/user_type"
                                                                            class="cancelBtn">Cancel</a>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button type="submit"  onclick="addMore(0);"
                                                                            class="btn btn-primary saveBtn">Save &
                                                                            Continue</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                    </div>

                                                    <div class="full-width">
                                                        <div class="col-sm-12">
                                                            <div class="wrap_flex_btn">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url(); ?>register/user_type"
                                                                        class="cancelBtn">Cancel</a>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" onclick="addMore(0);"
                                                                        class="btn btn-primary saveBtn">Save &
                                                                        Continue</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                        </form>
                                    </div>
                                    <!-- USER DETAILS STEP 1 END -->
                                </div>
                                <!-- </div> -->
                                <div class="text-center" id="submit_org" style="display:none;">
                                    <button class="btn btn-primary btn-sm submit_user"
                                        style="width:200px;height:40px;border-radius:5px;font-family:averta_regular;background:#3366CC;"
                                        onclick="updateEntityType();">&nbsp;&nbsp;continue&nbsp;&nbsp;</button>
                                </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal terms_and_condition" id="uploadaddressDocument">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div lass="modal-body">
                                <div class="content">
                                    <input type="file" name="uploadedAddressProof" class="form-control">
                                    <input type="url" name="uploadedAddressProofLink" class="form-control">
                                </div>
                            </div>
                            <button class="accept btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- FORM SUBMIT -->

    <link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
    <script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
    <script src="<?php echo SKIN_URL; ?>js/jquery.contributorcsr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.js"></script>
    <script>
        jQuery(".__upload").change(function (event) {
            const files = event.target.files;
            const file = files[0];
            if ($(this).val()) {
                $(this).closest('div').find('.error').eq(1).remove();
                jQuery(this).siblings(".__filename").html(file.name);
            } else {
                jQuery(this).siblings(".__filename").html('');
            }
        });
            /*
            Sanjay Oraon
            Date 22-09-2023
            no longer use
            function addMoreBoardDetails() {
                let html_Board =
                    '<div id="addMoreBoardDetails" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Name<span>*</span></label><input type="text"  class="form-control addMoreBoardDetails validate-char" name="dirName[]" value="" /> </div> <div class="form-group col-sm-6"><label class="control-label">PAN<span>*</span></label><input type="text" placeholder="" class="form-control validate-number" name="din[]" value="">  <img class="remove-btn" src="<?= SKIN_URL; ?>images / deleteIconsline.svg" alt="" style="padding: 10px; " onclick="removeAddMoreBoard()"> </div></div></div>';
        jQuery(html_Board).appendTo('#more-board-body');
        initializeValidation();
            }
            */
        $(document).keyup('[name="dirName[]"]', function () {
            addMore(0);
        });
        $('[name="din[]"]').on('keyup', function () {
            addMore(0);
        }); function validateFile(fn) {
            var validExtensions = ['pdf'];
            var fileNameExt = fn.substr(fn.lastIndexOf('.') + 1);
            if ($.inArray(fileNameExt, validExtensions) == -1)
                return false;
            else
                return true;
        }
        $(document).on('change', '.file_upload_common', function (e) {
            $('.not-file-exist').show();
            $('.file-exist').hide();
            if (this.files.length > 0) {
                $('.cross-icons').show();
                if (validateFile(this.files[0].name)) {
                    $(this).parent().find('.preview-img').hide();
                    $(this).parent().find('.preview-pdf').show();
                    var $this = $(this);
                    $this.parent().find('.preview-pdf').empty();
                    var file = e.target.files[0];
                    var fileReader = new FileReader();

                    fileReader.onload = function () {
                        var typedarray = new Uint8Array(this.result);

                        pdfjsLib.getDocument(typedarray).promise.then(function (pdf) {
                            for (var i = 0; i < pdf.numPages; i++) {
                                (function (pageNum) {
                                    pdf.getPage(i + 1).then(function (page) {
                                        // you can now use *page* here
                                        var viewport = page.getViewport(2.0);
                                        var pageNumDiv = document.createElement("div");
                                        pageNumDiv.className = "pageNumber";
                                        //pageNumDiv.innerHTML = "Page " + pageNum;
                                        var canvas = document.createElement("canvas");
                                        canvas.className = "page";
                                        canvas.title = "Page " + pageNum;
                                        $this.parent().find('.preview-pdf').append(pageNumDiv);
                                        $this.parent().find('.preview-pdf').append(canvas);
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;


                                        page.render({
                                            canvasContext: canvas.getContext('2d'),
                                            viewport: viewport
                                        }).promise.then(function () {
                                            console.log('Page rendered');
                                        });
                                        page.getTextContent().then(function (text) {
                                            console.log(text);
                                        });
                                    });
                                })(i + 1); break;
                            }
                        });
                    };
                    fileReader.readAsArrayBuffer(file);

                } else {
                    $(this).parent().find('.preview-img').show();
                    $(this).parent().find('.preview-pdf').hide();
                }
            } else {
                $('#b_addressProof_type').val('');
                $('.cross-icons').hide();
                $(this).parent().find('.preview-img').hide();
                $(this).parent().find('.preview-pdf').hide();
            }
        });
        function addMore(res) {
            let flag = false;
            $('.board-directors-list .row').each(function () {
                $(this).closest('.row').find('.msg-custom').remove();
                if ($(this).find('[name="dirName[]"]').val() == '') {
                    $(this).find('[name="dirName[]"]').css("border", "1px solid #aa2a29");
                    $(this).find('[name="dirName[]"]').closest('div').append('<label class="msg-custom" style="color: #aa2a29;font-size: 11px!important;padding: 0 !important;">This Field Is Required.</label>');
                    flag = true;
                } else {
                    $(this).find('[name="dirName[]"]').css("border", "1px solid #ced0dd");
                }
                if ($(this).find('[name="dirName[]"]').val().length <= 5 && $(this).find('[name="dirName[]"]').val().length != '') {
                    $(this).find('[name="dirName[]"]').css("border", "1px solid #aa2a29");
                    $(this).find('[name="dirName[]"]').closest('div').append('<label class="msg-custom" style="color: #aa2a29;font-size: 11px!important;padding: 0 !important;">Please Enter At Least 5 Characters.</label>');
                    flag = true;
                } else {
                    $(this).find('[name="dirName[]"]').css("border", "1px solid #ced0dd");
                }
                if ($(this).find('[name="din[]"]').val().length != '') {
                    <?php if (!in_array($select_entity_id, $llp_company)) { ?>
                        var regex = /^([A-Z]{5,})+([0-9]{4,})+([A-Z]{1,})+$/;
                        if (regex.test($(this).find('[name="din[]"]').val())) {
                            $(this).find('[name="din[]"]').css("border", "1px solid #ced0dd");
                        } else {
                            $(this).find('[name="din[]"]').css("border", "1px solid #aa2a29");
                            $(this).find('[name="din[]"]').closest('div').append('<label class="msg-custom"  style="color: #aa2a29;font-size: 11px!important;padding: 0 !important;">Please Enter Valid 10 Characters PAN Number.</label>');
                            flag = true;
                        }
                    <?php } else { //if(!in_array($select_entity_id,$cinEntityTypeList)){ ?>
                        if ($(this).find('[name="din[]"]').val().length == 8) {
                            $(this).find('[name="din[]"]').css("border", "1px solid #ced0dd");
                        } else {
                            $(this).find('[name="din[]"]').css("border", "1px solid #aa2a29");
                            $(this).find('[name="din[]"]').closest('div').append('<label class="msg-custom"  style="color: #aa2a29;font-size: 11px!important;padding: 0 !important;">Please Enter Valid 8 Digit DIN/DPIN Number.</label>');
                            flag = true;
                        }
                    <?php } ?>

                } else {
                    $(this).find('[name="din[]"]').css("border", "1px solid #ced0dd");
                }
                if ($(this).find('[name="din[]"]').val().length == '') {
                    $(this).find('[name="din[]"]').css("border", "1px solid #aa2a29");
                    $(this).find('[name="din[]"]').closest('div').append('<label class="msg-custom"  style="color: #aa2a29;font-size: 11px!important;padding: 0 !important;">This Field Is Required.</label>');
                    flag = true;
                } else {
                    $(this).find('[name="din[]"]').css("border", "1px solid #ced0dd");
                }
            });
            if (flag != true) {
                if (res == 1) {
                    let html_Board =
                        '<div id="addMoreTrusteeDetails" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName"><?php echo $board_govt_trustee_part1; ?></label><input type="text"  class="form-control addMoreBoardDetails validate-char" name="dirName[]" value=""  /> </div> <div class="form-group col-sm-6"><label class="control-label"><?php echo $board_govt_trustee_part2; ?></label><input type="text" placeholder="" class="form-control  <?php echo ((in_array($select_entity_id, $llp_company)) ? "validate-number" : ""); ?>" name="din[]" oninput="this.value = this.value.toUpperCase()" value="" > <img class="remove-btn removeAddMoreTrustee" src="<?= SKIN_URL; ?>images/deleteIconsline.svg" alt="" style="padding:10px;"> </div></div></div>';
                    jQuery(html_Board).appendTo('#more-board-body');
                }
                return false;
            }
            return true;
        }
            /*
            Sanjay Oraon
            Date 22-09-2023
            no longer use

            function addMoreGoverningedetails() {
                let html_Board =
                    '<div id="addMoreGoverningeDetails" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Governing Body Member Name <span>*</span></label><input type="text"  class="form-control addMoreBoardDetails validate-char" id="dirName" name="dirName[]" value="" required/> </div> <div class="form-group col-sm-6"><label class="control-label">PAN<span>*</span></label><input type="text" placeholder="" class="form-control validate-number" id="din" name="din[]" value="" required> <img class="remove-btn" src="<?= SKIN_URL; ?>images / deleteIconsline.svg" alt="" style="padding: 10px; " onclick="removeAddMoreGoverninge()"> </div></div></div>';
        jQuery(html_Board).appendTo('#more-board-body');
        initializeValidation();
                
            }

        function addMoreTrustCouncil() {
            let html_Board =
                '<div id="addMoreTrustCouncil" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Name <span>*</span></label><input type="text"  class="form-control addMoreBoardDetails validate-char" id="dirName" name="dirName[]" value=""required  /> </div> <div class="form-group col-sm-6"><label class="control-label">PAN<span>*</span></label><input type="text" placeholder="" class="form-control validate-number" id="din" name="din[]"  value="" required> <img class="remove-btn" src="<?= SKIN_URL; ?>images/deleteIconsline.svg" alt="" style="padding:10px;" onclick="removeAddMoreTrustCouncil()"> </div></div></div>';
            jQuery(html_Board).appendTo('#more-board-body');
            initializeValidation();
        }

        function addMorePartner() {
            let html_Board =
                '<div id="addMorePartner" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Name <span>*</span></label><input type="text" class="form-control addMoreBoardDetails validate-char" id="dirName" name="dirName[]" value="" required  /> </div> <div class="form-group col-sm-6"><label class="control-label">PAN<span>*</span></label><input type="text" placeholder="" class="form-control validate-number" id="din" name="din[]" value="" required> <img class="remove-btn" src="<?= SKIN_URL; ?>images/deleteIconsline.svg" alt="" style="padding:10px;" onclick="removeAddMorePartner()">  </div></div></div>';
            jQuery(html_Board).appendTo('#more-board-body');
            initializeValidation();
        }

        function addMorePartnerpan() {
            let html_Board =
                '<div id="addMorePartnerpan" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Name <span>*</span></label><input type="text" class="form-control addMoreBoardDetails" id="dirName" name="dirName[]" value="" required /> </div> <div class="form-group col-sm-6"><label class="control-label">PAN <span>*</span></label><input type="text" placeholder="" class="form-control validate-number" id="din" name="din[]" value="" required> <img class="remove-btn" src="<?= SKIN_URL; ?>images/deleteIconsline.svg" alt="" style="padding:10px;" onclick="removeAddMorePartnerpan()"> </div></div></div>';
            jQuery(html_Board).appendTo('#more-board-body');
            initializeValidation();
        }

            Sanjay Oraon
            Date 22 -09 - 2023
            no longer use
        function removeAddMoreBoard() {
            const element = document.getElementById("addMoreBoardDetails");
            element.remove();
        }
            */

        $(document).on('click', '.removeAddMoreTrustee', function (e) {
            $(this).closest('.row').remove();
        });
        /*
        Sanjay Oraon
        Date 22-09-2023
        no longer use

        function removeAddMoreGoverninge() {
            const element = document.getElementById("addMoreGoverningeDetails");
            element.remove();
        }

        function removeAddMoreTrustCouncil() {
            const element = document.getElementById("addMoreTrustCouncil");
            element.remove();
        }

        function removeAddMorePartner() {
            const element = document.getElementById("addMorePartner");
            element.remove();
        }

        function removeAddMorePartnerpan() {
            const element = document.getElementById("addMorePartnerpan");
            element.remove();
        }*/
        $.validator.addMethod("pastDate", function (value, element) {
            var enteredDate = new Date(value);
            var currentDate = new Date();
            return enteredDate <= currentDate;
        }, "Please enter a past date.");
        //Pan Format Validator Sanjay Oraon
        $.validator.addMethod("panFormat", function (value, element) {
            var regex = /^([A-Z]{5,})+([0-9]{4,})+([A-Z]{1,})+$/;
            return regex.test(value);
        }, "Please enter a valid PAN number.");
        //Gst Format Validator Sanjay Oraon
        $.validator.addMethod("gstFormat", function (value, element) {
            var regex = /^([0-9]{2,})+([A-Z]{5,})+([0-9]{4,})+([A-Z]{1,})+([0-9]{1,})+([A-Z]{1,})+([A-Z0-9]{1,})+$/;
            return regex.test(value);
        }, "Please enter a valid GST number.");
        //cin Format Validator Sanjay Oraon
        $.validator.addMethod("cinFormat", function (value, element) {
            var regex = /^([LUu]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/;
            return regex.test(value);
        }, "Please enter a valid CIN number.");

        $("#edit-ngo-form-1").validate({
            ignore: ':hidden',
            rules: {
                enityType: {
                    required: true,
                },
                cin_no: {
                    required: true,
                    <?php if (in_array($select_entity_id, $cinEntityTypeList)) { ?> cinFormat: true <?php } ?>
                },
                incorpDate: {
                    required: true,
                    date: true
                },
                registrationCertificate: {
                    required: true,
                    date: true
                },
                trustDeadDate: {
                    required: true,
                    date: true
                },
                panNumber: {
                    required: true,
                    panFormat: true
                },
                gstNumber: {
                    required: true,
                    minlength: 15,
                    gstFormat: true
                },
                pincode: {
                    required: true,
                    digits: true,
                },
                /*"dirName[]": {
                    required: true,
                    maxlength:50
                },
                "din[]": {
                    required: true,
                    minlength: 8
                },*/
                incorpDate: {
                    required: true,
                },
                state: {
                    required: true
                },
                cityOrDistrict: {
                    required: true
                },
                uploadPan: {
                    //required: true,
                    extension: "png|pdf|jpg",
                    filesize: 10485760,
                },
                uploadedAddressProof: {
                    extension: "png|pdf|jpg",
                    filesize: 10485760,
                },
                uploadRegdCertificate: {
                    //required: true,
                    extension: "png|pdf|jpg",
                    filesize: 10485760,
                },
                trustDead: {
                    //required: true,
                    extension: "png|pdf|jpg",
                    filesize: 10485760,
                }
            },
            messages: {
                cin_no: {
                    "minlength": "Please enter 10 digit number."
                },
                incorpDate: {
                    required: "Please enter a date.",
                    date: "Please enter a valid date."
                },
                uploadPan: {
                    required: "Please select a file, accepts only .png, .jpg and .pdf format.",
                    extension: "Invaild file format, accepts only .png, .jpg and .pdf format.",
                    filesize: "File size exceeds the maximum limit of 10MB."
                },
                uploadedAddressProof: {
                    required: "Please select a file, accepts only .png, .jpg and .pdf format.",
                    extension: "Invaild file format, accepts only .png, .jpg and .pdf format.",
                    filesize: "File size exceeds the maximum limit of 10MB."
                },
                uploadGst: {
                    required: "Please select a file, accepts only .png, .jpg and .pdf format.",
                    extension: "Invaild file format, accepts only .png, .jpg and .pdf format.",
                    filesize: "File size exceeds the maximum limit of 10MB."
                },
                uploadRegdCertificate: {
                    required: "Please select a file, accepts only .png, .jpg and .pdf format.",
                    extension: "Invaild file format, accepts only .png, .jpg and .pdf format.",
                    filesize: "File size exceeds the maximum limit of 10MB."
                },
                trustDead: {
                    required: "Please select a file, accepts only .png, .jpg and .pdf format.",
                    extension: "Invaild file format, accepts only .png, .jpg and .pdf format.",
                    filesize: "File size exceeds the maximum limit of 10MB."
                },
            },
            submitHandler: function () {
                if (addMore(0) == false)
                    return true;
            }
        });
    </script>

    <script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
    <?php $this->load->view('common/footer_js'); ?>

    <?php
    /*	Sanjay Oraon
                       06/07/2023
                       script for cin validation
                   */
    if (in_array($select_entity_id, $cinEntityTypeList)) { ?>
        <script>
            let launcher = false;
            /*$('#cin_no').change(function() {

                $this = $(this);
                var cin = $this.val();
 
                $this.closest('form').find('[name="entityName"]').val('');
                $this.closest('form').find('[name="incorpDate"]').val('');
                $this.closest('form').find('[name="registerAddress"]').val('');
                $this.closest('form').find('[name="dirName[]"]').val('');
                $this.closest('form').find('[name="din[]"]').val('');
 
                $this.closest('form').find('.api-error').text('');

                var regex = /^([LUu]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/;
                if(regex.test(cin) === true)
                    launcher = true;
                else
                    launcher = false;

                if(launcher === true){
 
                   $('#loader').show()
 
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "register/getCompanyAndDirectorsDetails/",
                        data: {
                            cin: cin
                        },
                        dataType: "json",
                        success: function(response){
                            if(response.company.error != 'bad gateway'  && response.director.error != 'bad gateway' && response.company.error != 'record_not_found' ){
                                $this.closest('form').find('.board-directors-list .col-sm-12').html('');
        
                                let _d = response.company.incorporationDate.split('/');
                                let date = _d[2]+'-'+_d[1]+'-'+_d[0];
        
                                $this.closest('form').find('[name="entityName"]').val(response.company.companyName);
                                $this.closest('form').find('[name="incorpDate"]').val(date);
                                $this.closest('form').find('[name="registerAddress"]').val(response.company.registeredAddress);
        
                                $(response.director).each(function(){
                                    let html_Board ='<div id="addMoreTrusteeDetails" class="col-sm-12"><div class="row"><div class="form-group col-sm-6"><label class="control-label" for="dirName">Name *</label><input type="text"  class="form-control addMoreBoardDetails validate-char" id="dirName" readonly name="dirName[]" value="'+this.name+'" required /> </div> <div class="form-group col-sm-6"><label class="control-label">DIN/DPIN *</label><input type="text" placeholder="" class="form-control validate-number" name="din[]" readonly value="'+this.din+'" required> </div></div></div>';
                                    jQuery(html_Board).appendTo('#more-board-body');
                                });
        
        
                            }else{
                                $this.closest('form').find('.board-directors-list .col-sm-12').html('');
                                if(response.company.error == 'bad gateway'  || response.director.error == 'bad gateway'){
                                    $this.closest('form').find('.api-error').text('something wents wrong please enter cin number again');
                                    $this.val('');
                                }else{
                                    $this.closest('form').find('.api-error').text('Please enter valid cin number');
                                }
                            }
                        },
                        complete: function () {
                            $('#edit-ngo-form-1').validate();
                            $('#loader').hide()
                        }
                    });
                }
            });*/

        </script>
    <?php } ?>


    <script>
        // const data = @json($district);
        var districts = <?php echo json_encode($district); ?>;

        // console.log('data: ', data);
        // code added for page refresh
        (function () {

            $(".state_step1").change(function () {
                var element = $(this).find('option:selected');
                var id = element.attr("data-id");
                let new_dist = [];
                districts.map(function (val) {

                    if (val.st_code == id) {
                        new_dist.push(val);
                    }
                    else if (id == "ALL") {
                        new_dist.push(val);
                    }
                });
                let html = `<option value="">Select District</option>`;
                new_dist.forEach(element => {
                    html += `<option value="${element.id}">${element.dst_name}</option>`
                });

                $(`.cityOrDistrict-step1`).empty().append(html);
            })

        })();

        hash = window.location.hash;
        if (hash == '#ngo-step-1') {
            //alert("ee");
            $("#entity-choose-sec").hide();
            $("#entity-step-form").show();
            $("#ngo-step-1-btn").removeClass('btn-default btn-complete').addClass('btn-primary');
            $("#ngo-step-2-btn").removeClass('btn-primary btn-complete').addClass('btn-default');
            $("#ngo-step-1-btn").removeAttr('disabled');
            $("#ngo-step-2-btn").attr('disabled', 'disabled');
            $("#ngo-step-2").css("display", "none");
            //$("#ngo-step-2").css("height", 0);
            //$("#ngo-step-2").css("display", "flex");
            $("#ngo-step-1").css("display", "block");
        }
        $("#submit-form").click(function () {
            $("#TermsConditionKYC").modal('show');
        });
        $('#CheckTerms').on('change', function (e) {
            e.target.value == 'on' ? $('.accept').removeAttr("disabled") : $('.accept').attr("disabled");
        });
        /*  jQuery("#b_addressProof_type").change(function() {
              let uploadname = jQuery(this).val();
              if (uploadname) {
                  jQuery('#file-uploader-address-step-1').trigger('click');
                  jQuery("#address_proof_name").val(uploadname);
              } else {
                  jQuery("#address_proof_name").val();
              }
          });

          const fileUploader_address_1 = document.getElementById('file-uploader-address-step-1');
          const feedback_address_1 = document.getElementById('feedback-address-1');
          const progress_address_1 = document.getElementById('progress-address-1');
          const readers_address_1 = new FileReader();

          fileUploader_address_1.addEventListener('change', (event) => {
              const files = event.target.files;
              const file = files[0];
              readers_address_1.readAsDataURL(file);
              readers_address_1.addEventListener('progress', (event) => {
                  if (event.loaded && event.total) {
                      const percent = (event.loaded / event.total) * 100;
                      progress_address_1.value = percent;
                      document.getElementById('progress-label').innerHTML = Math.round(percent) + '%';
                      if (percent === 100) {
                          jQuery(".progress_bar").show();
                          let msg =
                              `<span style="color:green;">File <u><b>${file.name}</b></u> has been uploaded successfully.<p class="Addressproofremove">Remove<span></p></span>`;
                          feedback_address_1.innerHTML = msg;
                          activeRemoveFile();
                      }
                  }
              });
          });


          $(document).on('click', '.Addressproofremove', function() {
              // This will work!
              jQuery(".progress_bar").hide();
              jQuery('#file-uploader-address-step-1').val('');

          });*/

        function addMoreGoverningAct() {
            // alert("Ok");
            $.ajax({
                type: "POST",
                dataType: "text",
                url: BASE_URL + "register/addMoreGoverningAct/",
                success: function (response) {
                    jQuery(response).appendTo('#MoreGoverning');
                }
            });
        }

        $("#state option[value=37 ]").hide();
        // $("#state option[value=38 ]").hide();

        $(document).ready(function () {
            $("input[type='file']").change(function () {
                var fileName = $(this).val().split("\\").pop();
                var fileExtension = fileName.split(".").pop().toLowerCase();
                var allowedExtensions = ["jpg", "png", "pdf"];
                if (fileName !== "") {
                    $(this).attr("required", true);
                    $(this).closest("div").find('a').hide();
                    if (allowedExtensions.includes(fileExtension)) {
                        $("#allowedfiles").val(1);
                        console.log("File selected: " + fileName);
                    } else {
                        $(this).closest("div").find('a').show();
                        $("#allowedfiles").val(0);
                        $(this).val("");
                    }
                } else {
                    console.log("No file selected");
                }
                $('#edit-ngo-form-1').validate();
            });
        });

        /*	
            sanjay oraon 
            28/06/2023 
            no use
            $(document).ready(function() {
                $("#incorpDate").on("input", function() {
                var enteredDate = new Date($(this).val());
                var currentDate = new Date();
                if (enteredDate > currentDate) {
                    $(this).val(""); 
                }
                });
            });
        */
        $(document).on('mouseover', '[name="registerAddress"]', function () {
            $(this).attr("title", $(this).val());
        });
        $(document).on('click', '.cross-icons', function () {
            $('[name="b_addressProof_type"]').val('');
            $('[name="existedaddressproof"]').val('');
            $(this).hide();
            $(this).parent().find('embed').remove();
            $(this).parent().find('.preview-pdf').empty();
            $(this).parent().find('.preview-img').hide();
            $(this).parent().find('#file-uploader').val('');
        });
    </script>

    <div id="loader"></div>
</body>

</html>