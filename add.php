<?php

include("config/db_connect.php");


 $title = $ingredients = $link = '' ;
	$errors = array('title' => '', 'ingredients' => '', 'link' => '');

	if(isset($_POST['submit'])){
		
		// check email
		//if(empty($_POST['email'])){
			//$errors['email'] = 'An email is required';
		//} else{
			//$email = $_POST['email'];
			//if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			//	$errors['email'] = 'Email must be a valid email address';
			//}
		//}

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
			
			//create sql
			$sql = "INSERT INTO recipes(title, ingredients, link) VALUES('$title',  '$ingredients', '$link')";

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

	} // end POST check

?>


<!DOCTYPE html>
<html lang="en">

    <?php include("templates/header.php"); ?>

    
	<section class="container grey-text">
		<h4 class="center">Add a Recipe</h4>
		<form class="white" action="add.php" method="POST">
			<!--<label>Your Email</label>
			<input type="text" name="email" value="<//?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><//?php echo $errors['email']; ?></div>-->
			<label>Recipe Name</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
			<div class="red-text"><?php echo $errors['ingredients']; ?></div>
            <label>Recipe Video</label>
            <input type="text" name="link" value="<?php echo htmlspecialchars($link) ?>">
			<div class="red-text"><?php echo $errors['link']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
           

		</form>
	</section>

    <?php include('templates/footer.php'); ?>

</html>