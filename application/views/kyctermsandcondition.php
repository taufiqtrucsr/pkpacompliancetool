<div class="modal terms_and_condition" id="TermsConditionKYC">
  <div class="modal-dialog">
  <?php $consent = fatch_consent(CONSENT[2]); if(isset($consent->title)){ ?>
    <div class="modal-content">
       <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      <h2 class="heading"><?=$consent->title?></h2>
      <p style="color:#000;" class="termsandnotes">Please read the following T&C, them before
        proceeding</p>
      <div class="modal-body">
        <main>
          <article class="terms-and-conditions">
          <?=$consent->content?>
          </article>
        </main>
      </div>
      <div class="form-group text_terms" style="margin-top:15px;padding-left: 15px;">
        <!--<p class="notes">Note: Please refer clause No.__ in respect to Annual Subscription Fee
          of Rs. 7500 plus GST.</p>-->
        <div class="wrap_checkbox" style="margin-top:15px;">
          <input type="checkbox" class="form-check-input" id="CheckTerms" name="CheckTerms">
          <label class="form-check-label" for="CheckTerms">I Accept Terms and Conditions</label>
          <label id="checkbox_error" class="error" for="" style="position:absolute;display:none;">You Must Accept Terms and Condition Before Submitting.</label>
        </div>
      </div>
      <div class="term-buttons-container">
        <a class="scroll-to-bottom" style="display:none;">
          <svg width="20" height="11" xmlns="http://www.w3.org/2000/svg"
            title="Go to bottom to accept terms and conditions">
            <title>Go to bottom to accept terms and conditions</title>
            <path
              d="M20 1.39L18.594 0 9.987 8.261l-.918-.881.005.005L1.427.045 0 1.414 9.987 11 20 1.39"
              fill="#fff" fill-rule="evenodd" />
          </svg>
        </a>
        <button type="submit" class="accept-button" id="acceptbutton" aria-hidden="true"
          aria-label="Accept terms and conditions">
          Submit
        </button>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
