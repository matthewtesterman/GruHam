<?php
$access = "private"; #Variable used to restrict user access (private or public);
include("session.php");
include("header.php");
?>
<div id="content">
<?php include("profile-menu.php"); ?>
<div id="content-main-profile">
  <h3>Your Financial Calculator (Under Construction)</h3>
  <p>Can you afford  the home of your dreams? We will help you determine by using our financial calculator. Enter the information in the following fields that apply to you.  </p>
  <h4>Income (Enter $ amounts):  </h4>
  <div class="calc-form-left-column"><p>Total Checkings:</p></div>

  <div class="calc-form-right-column">
    <p><input name="textfield" type="text" id="textfield" size="10">&nbsp;</p>
  </div>
  <div class="calc-form-left-column">
    <p>Total Savings:</p>
</div>
  <div class="calc-form-right-column">
    <input name="textfield10" type="text" id="textfield10" size="10">&nbsp;</p>
  </div>

  <div class="calc-form-left-column">
    <p>CD Initial Amount:</p>
  </div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10">&nbsp;
    </p>
  </div>
  <div class="calc-form-left-column">
    <p>CD Age (Years):</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>

<div class="calc-form-left-column">
    <p>Stocks (Current Value):</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
<div class="calc-form-left-column">
    <p>Retirement:</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
<div class="calc-form-left-column">
    <p>Total Real Estate Value:</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
<div class="calc-form-left-column">
    <p>Annual Gross Income:</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
<div class="calc-form-left-column">
    <p>Total Bonds:</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
  <h4>&nbsp;</h4>
  <h4>Expenditures (Enter $ amounts):</h4>
  <div class="calc-form-left-column">
    <p>Total Revolving Credit:</p></div>

  <div class="calc-form-right-column">
    <p><input name="textfield" type="text" id="textfield" size="10">&nbsp;</p>
  </div>
  <div class="calc-form-left-column">
    <p>Total Mortgages:</p>
</div>
  <div class="calc-form-right-column">
    <input name="textfield10" type="text" id="textfield10" size="10">&nbsp;</p>
  </div>

  <div class="calc-form-left-column">
    <p>Total Auto Loans:</p>
  </div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10">&nbsp;
    </p>
  </div>
  <div class="calc-form-left-column">
    <p>Total Student Loans:</p>
</div>
  <div class="calc-form-right-column">
    <p>
      <input name="textfield10" type="text" id="textfield10" size="10"> &nbsp;
    </p>
  </div>
    <div class="calc-form-left-column">
    <p>&nbsp;</p>
</div>
  <div class="calc-form-right-column">
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="button" disabled id="button" value="Calculate!">
  </p>
  </div>
<div id="clearall">
</div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
</div>



<?php
include("footer.php");
?>