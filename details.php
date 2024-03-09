<?php

include("config/db_connect.php");


if(isset($_POST['delete']))
{
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM recipes WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql))
    {
       //success
       header('Location: index.php');
    }else{
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
}




//check GET request id person
if(isset($_GET["id"])){
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    //make sql
    $sql = "SELECT * FROM recipes WHERE id = $id";

    //get query result
    $result = mysqli_query($conn, $sql);

    //fetch result in array format
    $recipe = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <div class="container center">

        <?php  if($recipe): ?>
            <!-- OUTPUT INFORMATION -->
            <h4><?php echo htmlspecialchars($recipe['title']);?></h4>
            <!--<p>Created by: <//?php htmlspecialchars($pizza['email']); ?></p> -->
            <p>Created on: <?php echo date($recipe['created_at']); ?></p>
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($recipe['ingredients']);?></p>
            <h5>Link:</h5>
            <a href = "<?php echo htmlspecialchars($recipe['link']);?>" target="_blank"><?php echo htmlspecialchars($recipe['link']);?></href>


             <!-- DELETE FORM-->
            <form action="details.php" method="POST">
                <input type = "hidden" name  = "id_to_delete" value = "<?php echo $recipe['id'] ?>">
                <input type = "submit" name  = "delete" value = "Delete" class = "btn brand z-depth-0">
            </form>


        <?php else: ?>
            <h5>That recipe does not exist in our database!</h5>

        <?php endif; ?>

        
    </div>
    
	<?php include('templates/footer.php'); ?>
</html>