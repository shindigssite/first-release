<?php include 'header.php'; ?>

<div class="row">
  <h3>Add Event</h3>
</div>
<form action="processAddEvent.php" method="post">
  <div class="row">
    <div class="span5">
      <label>Event Name</label>
      <input type="text" name="EventName" style="width: 500px;">
    </div>
  </div>
  <div class="row">
    <div class="span2">
      <label>Date</label>
      <div class="input-append date" id="datepicker1" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
        <input class="input-small" size="16" type="text">
	<span class="add-on"><i class="icon-th"></i></span>
      </div>
    </div>
    <div class="span3">
      <label>Start Time</label>
      <div class="input-append bootstrap-timepicker">
        <input id="timepicker1" type="text" class="input-small">
        <span class="add-on"><i class="icon-time"></i></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="span3">
      <label>Venue Name</label>
      <input type="text" name="Venue">
    </div>
  </div>
  <div class="row">
    <div class="span4">
      <label>Address</label>
      <input type="text" name="Address" style="width: 500px;">
    </div>
  </div>
  <div class="row">
    <div class="span2">
      <label>City</label>
      <input type="text" name="City">
    </div>
    <div class="span2">
      <label>State</label>
      <select name="State"> 
        <option value="" selected="selected">Select a State</option> 
        <option value="AL">Alabama</option> 
        <option value="AK">Alaska</option> 
        <option value="AZ">Arizona</option> 
        <option value="AR">Arkansas</option> 
        <option value="CA">California</option> 
        <option value="CO">Colorado</option> 
        <option value="CT">Connecticut</option> 
        <option value="DE">Delaware</option> 
        <option value="DC">District Of Columbia</option> 
        <option value="FL">Florida</option> 
        <option value="GA">Georgia</option> 
        <option value="HI">Hawaii</option> 
        <option value="ID">Idaho</option> 
        <option value="IL">Illinois</option> 
        <option value="IN">Indiana</option> 
        <option value="IA">Iowa</option> 
        <option value="KS">Kansas</option> 
        <option value="KY">Kentucky</option> 
        <option value="LA">Louisiana</option> 
        <option value="ME">Maine</option> 
        <option value="MD">Maryland</option> 
        <option value="MA">Massachusetts</option> 
        <option value="MI">Michigan</option> 
        <option value="MN">Minnesota</option> 
        <option value="MS">Mississippi</option> 
        <option value="MO">Missouri</option> 
        <option value="MT">Montana</option> 
        <option value="NE">Nebraska</option> 
        <option value="NV">Nevada</option> 
        <option value="NH">New Hampshire</option> 
        <option value="NJ">New Jersey</option> 
        <option value="NM">New Mexico</option> 
        <option value="NY">New York</option> 
        <option value="NC">North Carolina</option> 
        <option value="ND">North Dakota</option> 
        <option value="OH">Ohio</option> 
        <option value="OK">Oklahoma</option> 
        <option value="OR">Oregon</option> 
        <option value="PA">Pennsylvania</option> 
        <option value="RI">Rhode Island</option> 
        <option value="SC">South Carolina</option> 
        <option value="SD">South Dakota</option> 
        <option value="TN">Tennessee</option> 
        <option value="TX">Texas</option> 
        <option value="UT">Utah</option> 
        <option value="VT">Vermont</option> 
        <option value="VA">Virginia</option> 
        <option value="WA">Washington</option> 
        <option value="WV">West Virginia</option> 
        <option value="WI">Wisconsin</option> 
        <option value="WY">Wyoming</option>
      </select>
    </div>
    <div class="span2">
      <label>Zip</label>
      <input type="text" name="Email" style="width: 100px;">
    </div>
  </div>
  <div class="row">
    <div class="span5">
      <label>Description</label>
      <textarea rows="5" style="width: 500px;" name="Description"></textarea>
    </div>
  </div>
  <div class="row">
<?php
  include 'dbConnection.php';

  $query = "SELECT * FROM locales ORDER BY localeName";

  echo '<div class="span2">
      <label>Locale</label>
      <select name="Locale">
	<option value="" selected="selected">Select a Locale</option>';

  $result = mysql_query($query);
  while($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id'] . '">' . $row['localeName'] . '</option>';
  }

  echo '</select>
    </div>
    <div class="span2">
      <label>Category</label>
      <select name="Category">
	<option value="" selected="selected">Select a Category</option>';

  $query = "SELECT * FROM categories ORDER BY categoryName";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['id'] . '">' . $row['categoryName'] . '</option>';
  }

  echo '</select></div>';

  //////// Closing database connection ////////
  mysql_close($con);
?>
  </div>
  <div class="row">
    <div class="span2">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="js/bootstrap-timepicker.js" type="text/javascript"></script>
<script type="text/javascript">
  $('#timepicker1').timepicker({
    minuteStep: 1,
    template: 'modal',
    showSeconds: false,
    defaultTime: false
  });

  $('#datepicker1').datepicker({
    format: 'mm/dd/yyyy'
  });
</script>

<?php include 'footer.php'; ?>
