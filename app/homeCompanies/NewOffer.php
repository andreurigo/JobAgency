<?php
$documentRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT", FILTER_DEFAULT);
require "$documentRoot/app/homeCompanies/headerCompanies.html";
$action = filter_input(INPUT_GET, "Action", FILTER_VALIDATE_INT);
//Check if offer exists or is in process of creating/updating
if (isset($action)) {
    if ($action === 2) {
        include "../../models/mysqli_connect.php";
        $id = filter_input(INPUT_GET, "OfferID", FILTER_VALIDATE_INT);
        $offerToEditQuery = "SELECT * FROM offers WHERE OfferID = $id LIMIT 1";
        $offerToEdit = mysqli_query($dbc, $offerToEditQuery);
        $offerToEditQty = mysqli_num_rows($r);

        if ($offerToEditQty === 1) {
            $offerToEdit = mysqli_fetch_assoc($offerToEdit);
            $title = $offerToEdit['Title'];
            $description = $offerToEdit['Description'];
            $offerCategory = $offerToEdit['Category'];
        }
        mysqli_close($dbc);
    }
}
$categories = [
    "NULL",
    "TIC",
    "Administration",
    "Medicine",
    "Tourism",
    "Education",
    "Law",
    "Marketing",
    "Customer Support"
];
?>
<div class="container-fluid">
    <div class="row">
        <div class="worktitle2 col-md-12">
            <!--Form for Offer Creation/Update-->
            <form role="form" action="ActionOffer.php" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="title" name="title" class="form-control" id="title" value="<?php print($title ?? null); ?>"/>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    </br>
                    <select name="category" class="form-control">
                        <?php 
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php print($category) ?>" <?php print($category === $offerCategory ? "selected" : null); ?>><?php print($category) ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="description" rows="10" cols="0" name="description" class="form-control" id="description">
                        <?php print(isset($description) ? strip_tags(nl2br($description)) : null); ?>
                    </textarea>
                    <input for="action" type="hidden" id="action" name="Action" value=<?php echo $action; ?>>
                    <?php 
                    if (isset($id)) {
                    ?> 
                        <input type="hidden" id="id" name="OfferID" value="<?php print($id); ?>"/>
                    <?php
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">
                    <?php print($action === 1 ? 'Update' : 'Create') ?> offer
                </button>
            </form>
        </div>
    </div>
</div>
<?php
include('footer.php');
