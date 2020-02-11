<?php
include('headerCompanies.html');
//Check if offer exists or is in process of creating/updating
if (isset($_GET['Title'])) {
  $title = $_GET[ 'Title'];
}
if (isset($_GET['Description'])) {
	$description = $_GET['Description'];
}
if (isset($_GET['Action'])) {
    if ($_GET['Action'] == 2) {
		require ('../../models/mysqli_connect.php');
        $action = 2;
		$id = $_GET['OfferID'];
		$q = "SELECT * FROM offers WHERE OfferID = ".$id;
    	$r = @mysqli_query ($dbc, $q);
    	$num = mysqli_num_rows($r);

		if($num == 1) {
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
				$title = $row['Title'];
				$description = $row['Description'];
                $category = $row['Category'];
			}
		}
    mysqli_close($dbc);
    } else {
        $action = 1;
    }
} else {
    $action = 1;
}
?>
  <div class="container-fluid">
    <div class="row">
      <div class="worktitle2 col-md-12">
<!--Form for Offer Creation/Update-->
        <form role="form" action="ActionOffer.php?" method="GET">
          <div class="form-group">
            <label for="title">
              Title
            </label>
            <input type="title" name="title" class="form-control" id="title" value=<?php if (isset($title)) echo "'".$title."'"; ?>>
            </input>
          </div>
          <div class="form-group">
            <label for="category">
              Category
            </label><br/>
            <select name="category" class="form-control"> 
              <option value="NULL" <?php if (!(isset($category)) || $category=='NULL') echo "selected"; ?>>Others</option>
              <option value="TIC" <?php if ((isset($category)) && $category=='TIC') echo "selected"; ?>>TIC</option>
              <option value="Administration" <?php if ((isset($category)) && $category=='Administration') echo "selected"; ?>>Administration</option>
              <option value="Medicine" <?php if ((isset($category)) && $category=='Medicine') echo "selected"; ?>>Medicine</option>
              <option value="Tourism" <?php if ((isset($category)) && $category=='Tourism') echo "selected"; ?>>Tourism</option>
              <option value="Education" <?php if ((isset($category)) && $category=='Education') echo "selected"; ?>>Education</option>
              <option value="Law" <?php if ((isset($category)) && $category=='Law') echo "selected"; ?>>Law</option>
              <option value="Marketing" <?php if ((isset($category)) && $category=='Marketing') echo "selected"; ?>>Marketing</option>
              <option value="Customer Support" <?php if ((isset($category)) && $category=='Customer Support') echo "selected"; ?>>Customer Support</option>
            </select>
            </div>
            <div class="form-group">
                <label for="description">
                    Description
                </label>
                <textarea type="description" rows="10" cols="0" name="description" class="form-control" id="description">
                    <?php if (isset($description)) echo strip_tags(nl2br($description)); ?>
                </textarea>
                <input for="action" type="action" id="action" name="Action" value=<?php echo $action; ?> hidden></input>
                <?php if(isset($id)) { echo '<input for="id" type="id" id="id" name="OfferID" value='.$id.' hidden></input>';} ?>
            </div>
            <button type="submit" class="btn btn-primary">
                <?php if($action == 1){ echo 'Create Offer'; } elseif ($action == 2){ echo 'Update Offer'; } ?>
            </button>
        </form>
      </div>
    </div>
  </div>
  <?php
include('footer.html');
?>