<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <title>Donation Reports</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <style>
        table,thead,th,td{
            border:1px solid black;
        }
        .form-control{
            width:80px;
            height:20px;
        }
        td:nth-child(4),td:nth-child(5){
           text-align: center;
        }
      </style>
   </head>
   <body>
   <label class="control-label" style="color:#000;text-transform: none;">
                                    Computation of profit under section 198,
                                    all the following fields are mandatory for the calculation purpose.(<?=$calculation->FY_year?>)
                                </label>
      <table class="table caclulator custom-width-calculator">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                Sr. No
                                            </th>
                                            <th scope="col">
                                                Particulars
                                            </th>
                                            <th scope="col">
                                                Amount
                                            </th>
                                            <th scope="col">
                                                Total
                                            </th>
                                            <th scope="col">
                                                Remarks
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Net Profit Before Tax as per Financial Statements</td>
                                            <td><?=$calculation->NP_before_tax?></td>
                                            <td><?=$calculation->NP_before_tax?></td>
                                            <td><?=$calculation->NP_before_tax_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td colspan="4" style="color:blue;">Add Credit Shall be given as per sub-section (2), if not given</td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>
                                                Add: Bounties and subsidies received from:</br>
                                                -Central Goverment</br>
                                                -State Goverment</br>
                                                -Public Authorities</br>
                                            </td>
                                            <td><?=$calculation->bounties_received?></td>
                                            <td><?=$calculation->bounties_received?></td>
                                            <td><?=$calculation->bounties_received_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td colspan="4" style="color:red;">Less: Credit shall not be given as per sub-section (3),if given</td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(a) Profits, by way of premium on shares or debentures of the company,
                                                which
                                                are issued or sold by the company;
                                            </td>
                                            <td><?=$calculation->premium_debunture_profits?></td>
                                            <td></td>
                                            <td><?=$calculation->premium_debunture_profits_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(b) Profits on sales by the company of forfeited shares;</td>
                                            <td><?=$calculation->sales_fortified_shares?></td>
                                            <td></td>
                                            <td><?=$calculation->sales_fortified_shares_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(c) Profits of a capital nature including profits from the sale of the
                                                undertaking or any of the undertakings of the company or of any part
                                                thereof; 
                                            </td>
                                            <td><?=$calculation->profits_captial_nature?></td>
                                            <td></td>
                                            <td><?=$calculation->profits_captial_nature_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(d) Profits from the sale of any immovable property or fixed assets of a
                                                capital nature comprised in the undertaking or any of the undertakings
                                                of
                                                the company, unless the business of the company consists, whether wholly
                                                or
                                                partly, of buying and selling any such property or assets:
                                                <br><br>
                                                Provided that where the amount for which any fixed asset is sold exceeds
                                                the
                                                written-down value thereof, credit shall be given for so much of the
                                                excess
                                                as is not higher than the difference between the original cost of that
                                                fixed
                                                asset and its written down value;
                                            </td>
                                            <td><?=$calculation->immvoable_fixed_assests?></td>
                                            <td></td>
                                            <td> <?=$calculation->immvoable_fixed_assests_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>(e) Any change in carrying amount of an asset or of a liability
                                                recognised
                                                in equity reserves including surplus in Profit and Loss Account on
                                                measurement of the asset or the liability at fair value.
                                            </td>
                                            <td><?=$calculation->carrying_amt_assests?></td>
                                            <td><?=$calculation->premium_debunture_profits+$calculation->sales_fortified_shares+$calculation->profits_captial_nature+$calculation->immvoable_fixed_assests+$calculation->carrying_amt_assests?></td>
                                            <td><?=$calculation->carrying_amt_assests_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td colspan="4" style="color:red;">Less: Sum shall be deducted as per sub-section (4),if not deducted</td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (a) All the usual working charges
                                            </td>
                                            <td><?=$calculation->usual_workings?></td>
                                            <td></td>
                                            <td><?=$calculation->usual_workings_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (b) Director's remuneration
                                            </td>
                                            <td><?=$calculation->directors_remumneration?></td>
                                            <td></td>
                                            <td><?=$calculation->directors_remumneration_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (c) Bonus or commission paid or payable to any member of the company's staff, or to engineer, technician, or person employed or engaged by the company, whether on a whole time or on a part time basis
                                            </td>
                                            <td><?=$calculation->bonous_commsion_paid?></td>
                                            <td></td>
                                            <td><?=$calculation->bonous_commsion_paid_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (d) Any tax notified by the Central Government as being in the nature of a tax on excess or abnormal profits
                                            </td>
                                            <td><?=$calculation->tax_notified_by_govt?></td>
                                            <td></td>
                                            <td><?=$calculation->tax_notified_by_govt_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (e) Any tax on business profits imposed for special reasons or in special circumstances and notified by the Central government in this behalf
                                            </td>
                                            <td><?=$calculation->special_tax_on_business_profits?></td>
                                            <td></td>
                                            <td><?=$calculation->special_tax_on_business_profits_remarks?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (f) Interest on debentures issued by the company
                                            </td>
                                            <td><?=$calculation->interest_on_debentures?></td>
                                            <td></td>
                                            <td><?=$calculation->interest_on_debentures_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (g) Interest on mortgages executed by the company and on loans and advances secured by a charge on its fixed assets or floating assets
                                            </td>
                                            <td><?=$calculation->interest_on_mortgages?></td>
                                            <td></td>
                                            <td><?=$calculation->interest_on_mortgages_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (h) Interest on unsecured loans and advances
                                            </td>
                                            <td><?=$calculation->Interest_on_unsecured_loans_and_advances?></td>
                                            <td></td>
                                            <td><?=$calculation->Interest_on_unsecured_loans_and_advances_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (i) Expenses on repairs, whether to immovable or to movable property, provided the repairs are not of a capital nature
                                            </td>
                                            <td><?=$calculation->Expenses_on_repairs?></td>
                                            <td></td>
                                            <td><?=$calculation->Expenses_on_repairs_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (j) Outgoings, inclusive of contributions made under Section 181
                                            </td>
                                            <td><?=$calculation->Outgoings?></td>
                                            <td></td>
                                            <td><?=$calculation->Outgoings_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (k) Depreciation to the extent provided in Section 123
                                            </td>
                                            <td><?=$calculation->Depreciation_Section_123?></td>
                                            <td></td>
                                            <td><?=$calculation->Depreciation_Section_123_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                                (l) The excess of expenditure over income, which had arisen in computing the net profits in accordance with Section 349 in any year which begins at or after the commencement of this Act, in so far as such excess has not been deducted in any subsequent year preceeding the year in respect of which the net profits have to be ascertained
                                            </td>
                                            <td><?=$calculation->excess_expenditure_over_income?></td>
                                            <td></td>
                                            <td><?=$calculation->excess_expenditure_over_income_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                            (m) Any compensation or damages to be paid by virtue of any legal liability, including a liability arising from a breach of contract
                                            </td>
                                            <td><?=$calculation->compensation_or_damages?></td>
                                            <td></td>
                                            <td><?=$calculation->compensation_or_damages_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                            (n) Any sum paid by way of insurance against the risk of meeting any liability such as is referred to in the previous clause
                                            </td>
                                            <td><?=$calculation->insurance_against_liability?></td>
                                            <td></td>
                                            <td><?=$calculation->insurance_against_liability_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>04</td>
                                            <td>
                                            (o) Debts considered bad and written off or adjusted during the year of account
                                            </td>
                                            <td><?=$calculation->debts_written_off?></td>
                                            <td><?=$calculation->usual_workings+
                                                    $calculation->directors_remumneration+
                                                    $calculation->bonous_commsion_paid+
                                                    $calculation->tax_notified_by_govt+
                                                    $calculation->special_tax_on_business_profits+
                                                    $calculation->interest_on_debentures+
                                                    $calculation->interest_on_mortgages+
                                                    $calculation->Interest_on_unsecured_loans_and_advances+
                                                    $calculation->Expenses_on_repairs+
                                                    $calculation->Outgoings+
                                                    $calculation->Depreciation_Section_123+
                                                    $calculation->excess_expenditure_over_income+
                                                    $calculation->compensation_or_damages+
                                                    $calculation->insurance_against_liability+
                                                    $calculation->voluntarily_compensation
                                                ?></td>
                                            <td><?=$calculation->debts_written_off_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td colspan="4" style="color:blue;">
                                                Add: Sum shall not be deducted as per sub-section (5), if deducted
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(a) Income-tax and super-tax payable by the company under the Income-tax
                                                Act, 1961, or any other tax on the income of the company not falling
                                                under
                                                clauses (d) and (e) of sub-section (4);
                                            </td>
                                            <td><?=$calculation->Income_and_super_tax?></td>
                                            <td></td>
                                            <td><?=$calculation->Income_and_super_tax_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(b) Any compensation, damages or payments made voluntarily, that is to
                                                say,
                                                otherwise than in virtue of a liability such as is referred to in clause
                                                (m)
                                                of sub-section (4);
                                            </td>
                                            <td><?=$calculation->voluntarily_compensation?></td>
                                            <td></td>
                                            <td><?=$calculation->voluntarily_compensation_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(c) Loss of a capital nature including loss on sale of the undertaking
                                                or
                                                any of the undertakings of the company or of any part thereof not
                                                including
                                                any excess of the written-down value of any asset which is sold,
                                                discarded,
                                                demolished or destroyed over its sale proceeds or its scrap value;
                                            </td>
                                            <td><?=$calculation->capital_loss_sec_350?></td>
                                            <td></td>
                                            <td><?=$calculation->capital_loss_sec_350_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>05</td>
                                            <td>(d) Any change in carrying amount of an asset or of a liability
                                                recognised
                                                in equity reserves including surplus in profit and loss account on
                                                measurement of the asset or the liability at fair value.
                                            </td>
                                            <td><?=$calculation->carring_amount?></td>
                                            <td><?=$calculation->Income_and_super_tax+
                                                    $calculation->voluntarily_compensation+
                                                    $calculation->capital_loss_sec_350+
                                                    $calculation->carring_amount
                                                ?></td>
                                            <td><?=$calculation->carring_amount_remark?></td>
                                        </tr>
                                        <tr>
                                            <td>06</td>
                                            <td>
                                                <b>Net Profit computed as per Section 198 of the Companies Act, 2013</b>
                                            </td>
                                            <td></td>
                                            <td class="section-six-total"><?=$calculation->net_profit?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <label class="control-label" style="color:#000;text-transform: none;">
                                    Computation of amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014 *, all the following fields are mandatory for the calculation purpose.
                                </label>
                                <table class="table caclulator">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                Sr. No
                                            </th>
                                            <th scope="col">
                                                Particulars
                                            </th>
                                            <th scope="col">
                                                Amount
                                            </th>
                                            <th scope="col">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>07</td>
                                            <td colspan="3" style="color:red;">Less: Total amount adjusted as per rule 2(1)(h) of CSR Policy Rule 2014 *</td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>
                                            (a) Profit arising from any overseas branch or branches
                                            </td>
                                            <td><?=$calculation->profit_from_oversease?></td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                            <td>07</td>
                                            <td>
                                            (b) Dividend received from Indian Companies covered U/s 135 of the act
                                            </td>
                                            <td><?=$calculation->dividend_received?></td>
                                            <td><?=$calculation->amt_adjusted?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                            Total Net Profit
                                            </td>
                                            <td></td>
                                            <td><?=$calculation->total_net_profit?></td>
                                        </tr>
                                    </tbody>
                                </table>
   </body>
</html>