<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
$this->load->view('common/head_common');
?>
<link rel="stylesheet" media="all" href="<?php echo SKIN_URL; ?>css/csrcompliance.css" />

<body class="full-page">
    <?php $this->load->view('common/header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 csrreports" id="contractDetailsBlock">
                <?php $this->load->view('csrcompliance/sidebar.php'); ?>
                <div class="col-sm-10 right-side-bar-dashboard grey-create-project">
                    <div id="membershipCheck"></div>
                    <div class="kyc-title">
                        <h2>Reports</h2>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item active"><a class="nav-link " href="#Progress_Report" data-toggle="tab"
                                aria-expanded="true">Progress Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Closing_Report" data-toggle="tab"
                                aria-expanded="false">FY Closing Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="#Completion_Report" data-toggle="tab"
                                aria-expanded="false">Project Completion Report</a></li>
                    </ul>
                    <div id="Progress_Report" class="container tab-pane active in">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link " href="#Newest" data-toggle="tab"
                                    aria-expanded="true">Newest</a></li>
                            <li class="nav-item"><a class="nav-link" href="#Archived " data-toggle="tab"
                                    aria-expanded="false">Archived </a></li>
                        </ul>
                        <div id="Newest" class="container tab-pane active in">
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Contribution</th>
                                    <th></th>
                                    <th>Utilisation</th>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <th>Last Report filed</th>
                                    <th>Project Status</th>
                                    <th>Committed</th>
                                    <th>Received</th>
                                    <th>Balance</th>
                                    <th>Spent</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><a href="#">A+ Education P...</a></td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Sustainable Enviorn...</a></td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="Archived" class="container tab-pane">
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Contribution</th>
                                    <th></th>
                                    <th>Utilisation</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <th>Last Report filed</th>
                                    <th>Project Status</th>
                                    <th>Committed</th>
                                    <th>Received</th>
                                    <th>Balance</th>
                                    <th>Spent</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><a href="#">A+ Education P...</a></td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View </a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Sustainable Enviorn...</a></td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="Closing_Report" class="container tab-pane">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link " href="#CSR_2" data-toggle="tab"
                                    aria-expanded="true">CSR-2</a></li>
                            <li class="nav-item"><a class="nav-link" href="#Director_Report " data-toggle="tab"
                                    aria-expanded="false">Director’s Report </a></li>
                        </ul>
                        <div id="CSR_2" class="container tab-pane active in">
                            <table class="table">
                                <tr>
                                    <th colspan="6">Project Status</th>
                                </tr>
                                <tr>
                                    <th colspan="6"><a href=""> Generate CSR-2 Report </a></th>
                                </tr>
                                <tr>
                                    <th>Year</th>
                                    <th>Generated on</th>
                                    <th>On-going</th>
                                    <th>Other than On-going</th>
                                    <th>Unspent Amt</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><b>2021-2022</b></td>
                                        <td>10 Feb 2022</td>
                                        <td>02</td>
                                        <td>05</td>
                                        <td>25,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                    <tr>
                                        <td><b>2020-2021</b></td>
                                        <td>9 Feb 2022</td>
                                        <td>01</td>
                                        <td>01</td>
                                        <td>10,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="Director_Report" class="container tab-pane">
                            <table class="table">
                                <tr>
                                    <th colspan="6">Project Status</th>
                                </tr>
                                <tr>
                                    <th><a href="<?php echo base_url().'CsrCompliance/reportcreate?year=2023-2024' ?>">Generate Director Reports</a></th>
                                </tr>
                                <tr>
                                    <th>Year</th>
                                    <th>Generated on</th>
                                    <th>On-going</th>
                                    <th>Other than On-going</th>
                                    <th>Unspent Amt</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    <?php foreach ($director_reports as $key => $value) {
                                        $timestamp = (int) $value->created_at;
                                        $date = date('d M Y', strtotime('@' . $timestamp));
                                        echo '<tr>
                                                <td><b>' . $value->FY_year . '</b></td>
                                                <td>' . $datae . '</td>
                                                <td>02</td>
                                                <td>05</td>
                                                <td>' . $value->amt_unspent_for_FY . '</td>
                                                <td><a href="' . base_url() . 'CsrCompliance/previewreport?year=' . $value->FY_year . '&report_id=' . $value->report_id . '" target="_blank">View & Download </a></td>
                                            </tr>';

                                    } ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="Completion_Report" class="container tab-pane">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link " href="#Newest" data-toggle="tab"
                                    aria-expanded="true">Newest</a></li>
                            <li class="nav-item"><a class="nav-link" href="#Archived " data-toggle="tab"
                                    aria-expanded="false">Archived </a></li>
                        </ul>
                        <div id="Newest" class="container tab-pane active in">
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Contribution</th>
                                    <th></th>
                                    <th>Utilisation</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <th>Last Report filed</th>
                                    <th>Project Status</th>
                                    <th>Committed</th>
                                    <th>Received</th>
                                    <th>Balance</th>
                                    <th>Spent</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td>A+ Education P...</td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                    <tr>
                                        <td>Sustainable Enviorn...</td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="Archived" class="container tab-pane">
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Contribution</th>
                                    <th></th>
                                    <th>Utilisation</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Project</th>
                                    <th>Last Report filed</th>
                                    <th>Project Status</th>
                                    <th>Committed</th>
                                    <th>Received</th>
                                    <th>Balance</th>
                                    <th>Spent</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td>A+ Education P...</td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                    <tr>
                                        <td>Sustainable Enviorn...</td>
                                        <td>10 Feb 2022</td>
                                        <td>In-progress</td>
                                        <td>₹10,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td>₹9,00,000</td>
                                        <td>₹1,00,000</td>
                                        <td><a href="#">View & Download </a></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!--table class="table">
            <tr>
                <th>Year</th>
                <th>Generated on</th>
                <th>On-going</th>
                <th>Other than On-going</th>
                <th>Unspent Amt</th>
                <th></th>
            </tr>
            <tbody>
                ?php foreach ($reports as $key => $value) {

                    echo '<tr>
                        <td>' . $value->FY_year . '</td>
                        <td>' . $value->created_at . '</td>
                        <td>02</td>
                        <td>05</td>
                        <td>25,00,000</td>
                        <td><a href="#"> View & Download </a></td>
                    </tr>';
                } ?>
            </tbody>
        </table-->
                    </div>
                </div>
            </div>
        </div>
</body>
<link rel="stylesheet" href="<?php echo SKIN_URL; ?>css/jquery.multiselect.css">
<script src="<?php echo SKIN_URL; ?>js/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/discover.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/implementor.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="<?php echo SKIN_URL . 'js/compliance.js?v=' . JS_CSC_V; ?>"></script>
<script type="text/javascript" src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<?php $this->load->view('common/footer_js'); ?>