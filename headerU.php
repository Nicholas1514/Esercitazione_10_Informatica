<html>
<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 <style>
        body {
            background: linear-gradient(to bottom right, #6a11cb, #2575fc);
            color: black;
            font-family: Arial, sans-serif;
        }
        h3
        {
        	font-weight: bold;
            text-align: center;
            text-decoration: underline;
		}
        h2
        {
        	font-weight: bold;
            text-align: center;
            text-decoration: underline;
		}
        p
        {
        	font-weight: bold;
            text-align: center;
            text-decoration: underline;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .btn-primary {
            background-color: green;
            border: none;
        }
        .btn-primary:hover {
            background-color: limegreen;
        }
    </style>

</head>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            
            <a class="navbar-brand" href="dashboard.php">Gestione BAR</a>
              

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  
                        <li class="nav-item"><a class="nav-link" href="ordini.php">Visualizza ordini</a></li>
                        <li class="nav-item"><a class="nav-link" href="prodotti_clienti.php">Visualizza prodotti</a></li>
                		<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    

                </ul>
            </div>
        </div>
    </nav>
