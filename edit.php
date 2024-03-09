<?php

include("config/db_connect.php");

    $id = isset($_GET["id"]) ? mysqli_real_escape_string($conn, $_GET["id"]) : null;
    $sql = "SELECT title, ingredients, link FROM recipes WHERE id=$id";
    $result = mysqli_query($conn, $sql);


    // Check if the query was successful
    if ($result) {
        $recipe = mysqli_fetch_assoc($result);

        // Set variables for existing values
        $existingTitleFromDatabase = $recipe['title'];
        $existingIngredientsFromDatabase = $recipe['ingredients'];
        $existingLinkFromDatabase = $recipe['link'];

        // Free the result set
        mysqli_free_result($result);
    } else {
    echo "Error fetching existing data: " . mysqli_error($conn);
    }

    $title = $ingredients = $link = '' ;
	$errors = array('title' => '', 'ingredients' => '', 'link' => '');



	if(isset($_POST['submit'])){
		
		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check ingredients
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z0-9\s\/]+)(,\s*[a-zA-Z0-9\s\/]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

        // check link
		if(empty($_POST['link'])){
			$errors['link'] = 'A link is required';
		} else{
			$link = filter_var($_POST['link'],FILTER_SANITIZE_URL);
			if (!filter_var($link, FILTER_VALIDATE_URL)){
				$errors['link'] = 'Must be a valid link';
			}
		}


		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			$link = mysqli_real_escape_string($conn, $_POST['link']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
			if($id !== null) {
			    //create sql
                $sql = "UPDATE recipes SET title='$title', ingredients='$ingredients', link='$link' WHERE id='$id'";
			    //save to db and check
			    if(mysqli_query($conn, $sql)){
				    //success
				    header('Location: index.php');
			    }else{
				    //error
				    echo "query error:" . mysqli_error($conn);
			    }
			//echo 'form is valid';
			header('Location: index.php');
		    }
            else{
                echo "Invalid recipe ID";
                
            }
        }

	} // end POST check

?>


<!DOCTYPE html>
<html lang="en">

    <?php include("templates/header.php"); ?>

    
	<section class="container grey-text">
		<h4 class="center">Edit a Recipe</h4>
		<form class="white" action="edit.php?id=<?php echo $id; ?>" method="POST">
			<!--<label>Your Email</label>
			<input type="text" name="email" value="<//?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><//?php echo $errors['email']; ?></div>-->
			<label>Recipe Name</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title ? $title : $existingTitleFromDatabase) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients ? $ingredients : $existingIngredientsFromDatabase) ?>">
			<div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <label>Recipe Video</label>
            <input type="text" name="link" value="<?php echo htmlspecialchars($link ? $link : $existingLinkFromDatabase) ?>">
			<div class="red-text"><?php echo $errors['link']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
           

		</form>
	</section>

    <?php include('templates/footer.php'); ?>

</html>