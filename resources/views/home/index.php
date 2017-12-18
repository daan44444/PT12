<link rel="stylesheet" type="text/css" href="css/4-pages/home.css"/>
</head>
<body id="body_top">
<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-light bg-palletlightGrey">
    <a class="navbar-brand h-nav" href="#">
        <div class="position-absolute z-index">
            <img src="img/logo/2.png" width="auto" height="100" class="d-inline-block align-top" alt="">
        </div>
    </a>
</nav>

<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-palletoffWhite">
    <div class="container t-palletdarkGrey" id="myArrow">
        <a class="navbar-brand" href="#body_top">Foodchamp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login / Register</a>
                </li>
                <?php
                /*
                    $user = new User();
                    if ($user->isLoggedIn()){
                        echo'
                            <li class="nav-item">
                                <a class="nav-link" href="#">Dashboard</a>
                            </li>   
                        ';
                    }
                */
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- BMI Calculation -->
<section id="section_one" class="bg-image_one py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card bg-palletlightRed">
                    <div class="card-body">
                        <div class="card-title text-center t-palletWhite"><h2>Calculate you're BMI here!</h2></div>
                        <form name="bmiForm">
                            <div class="form-row">
                                <div class="form-group col-md-6 t-palletWhite">
                                    <label for="weight">Your Weight(kg): </label>
                                    <input id="weight" class="form-control" type="text" name="weight">
                                </div>
                                <div class="form-group col-md-6 t-palletWhite">
                                    <label for="height">Your Height(cm): </label>
                                    <input id="height" class="form-control" type="text" name="height">
                                </div>
                            </div>
                            <h5><input class="button btn-BMI" type="button" value="Calculate BMI" onClick="calculateBmi()"><br/></h5>

                            <div class="form-row">
                                <div class="form-group col-md-6 t-palletWhite">
                                    <label for="bmi">Your BMI: </label>
                                    <input id="bmi" class="form-control" type="text" name="bmi">
                                </div>
                                <div class="form-group col-md-6 t-palletWhite">
                                    <label for="meaning">This Means: </label>
                                    <input id="meaning" class="form-control" type="text" name="meaning">
                                </div>
                            </div>
                            <h5><input class="button btn-BMI" type="reset" value="Reset"/></h5>
                        </form>
                    </div>
                </div>
                <div class="text-center pt-5 animated bounce" id="myArrow">
                    <a href="#section_two" class="t-palletdarkGrey">
                        <i class="fa fa-arrow-down fa-3x bg-palletoffWhite rounded-circle p-2" aria-hidden="true" ></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Small introduction -->
<section id="section_two" class="bg-palletoffWhite py-5">
    <div class="container">
        <div class="text-center pb-5">
            <h2>Small introduction</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 text-center">
                <i class="fa fa-search fa-5x" aria-hidden="true"></i>
                <p><b>1. </b>Perfect meal plan for you're needs!</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-download fa-5x" aria-hidden="true"></i>
                <p><b>2. </b><a href="#">Download</a> our fitness app now!</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-step-forward fa-5x" aria-hidden="true"></i>
                <p><b>3. </b>Take a step to the future off healthiness and mealplans</p>
            </div>
            <div class="col-md-3 text-center">
                <i class="fa fa-heart fa-5x" aria-hidden="true"></i>
                <p><b>4. </b>Be healty. be safe. Be FoodChamp.</p>
            </div>
        </div>
        <div class="text-center">
            <button class="button btn-readMore"><h5>Read more..</h5></button>
        </div>
    </div>
</section>

<!-- What do we offer -->
<section id="section_three" class="bg-image_two">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-5 bg-palletlightGrey t-palletWhite">
                <div class="text-center">
                    <h2>What do we offer</h2>
                </div>
                <p>
                    Foodchamp stands for Commitment, Motivation and Healthiness. Foodchamp makes new mealplans everyday. Why do you ask? Well very simple we love to provide our
                    costumers with a new variation of mealplans to them fir and healthy + variaty == skills!
                </p>
            </div>
        </div>
    </div>
</section>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>