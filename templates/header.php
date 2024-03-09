<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's Cooking</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
	    .brand{
	        background: #bbdefb !important;
	    }
  	    .brand-text{
  		    color: #bbdefb !important;
  	    }
  	    form{
  		    max-width: 460px;
  		    margin: 20px auto;
  		    padding: 20px;
  	    }
        h4{
            color: white;
        }
        h5{
            color: white;
        }
        a{
            color: black;
        }
        h6{
            color: #ffca28;
        }
        li{
            color: black;
        }

        .edit-button{
            color: white;
        }
        .edit-button-container{
            margin-top: 20px;   /* Increase top margin */
            margin-bottom: 10px;  /* Decrease bottom margin */
            padding: 10px;  /* Just for demonstration, you can adjust padding as needed */
            /*border: 1px solid #000;  /* Just for demonstration, you can remove this */
        }

        .delete-form{
            margin-top: 20px;   /* Increase top margin */
            margin-bottom: 10px;  /* Decrease bottom margin */
            padding: 10px;  /* Just for demonstration, you can adjust padding as needed */
            /*border: 1px solid #000;  /* Just for demonstration, you can remove this */
        }



        @media (max-width: 1200px) and (orientation: portrait) {
          
            .brand-logo.brand-text{
            font-size: 20px; /* Adjust the font size as needed */
            }
           

        }
  </style>

</head>

<body class=" blue lighten-4">
	<nav class="white z-depth-0">
        <div class="container">
        
        <a href="index.php" class="brand-logo brand-text hide-on-small-only">What's Cooking</a>
        <a href="index.php" class="brand-logo brand-text show-on-small hide-on-med-and-up left">What's Cooking</a>
        
        <ul id="nav-mobile" class="right"><!--hide-on-small-and-down-->
            <li><a href="add.php" class="btn brand z-depth-0">Add a Recipe</a></li>
        </ul>
        </div>
    </nav>
    