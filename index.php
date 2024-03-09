<?php


include("config/db_connect.php");

//write query for all pizzas
$sql = "SELECT title, ingredients, id FROM recipes ORDER BY created_at";

//make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free resilt from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);


//print_r($pizzas);
//explode(",", $pizzas[0]["ingredients"]);

?>




<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.php"); ?>
    
    <h4 class = "center">Recipe List</h4>

	<div class="container">
		<div class="row">
			
			<?php foreach($recipes as $recipe):?>

				<div class = "col s6 md3">
					<div class = "card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($recipe['title'])?></h6>
							<ul>
								<?php foreach(explode(',',$recipe['ingredients']) as $ing){ ?>
									<li><?php  echo htmlspecialchars($ing); ?></li>
								<?php } ?>
							</ul>
						</div>
						<div class = "card-action right-align">
							<a class = "brand-text" href = "details.php?id=<?php echo $recipe['id']?>">more info</a>
						</div>
					</div>	
				</div>
			
			<?php endforeach;?>

		</div>
	</div>



    <?php include("templates/footer.php"); ?>
</html>