<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <title>Introduction - Knockout Tutorials</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <a href="index.php" class="navbar-brand">Learn Knockoutjs</a>
        <button class="navbar-toggler" data-target="#top-nav" data-toggle="collapse" aria-controls="top-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="top-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Tutorial</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-contents-center">
                            <h2>Introduction</h2>
                            <div class="ml-auto">
                                <a href="index.php" class="btn btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- This is a *view* - HTML markup that defines the appearance of your UI -->

                        <p>First name: <strong data-bind="text: firstName"></strong></p>
                        <p>Last name: <strong data-bind="text: lastName"></strong></p>
                        <p>Full name: <strong data-bind="text: fullName"></strong></p>

                        <p>First name: <input type="text" data-bind="value: firstName"></p>
                        <p>Last name: <input type="text" data-bind="value: lastName"></p>
                        <p>
                            <button class="btn btn-primary" data-bind="click: capitalizeLastName">Go Caps</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/knockout-3.5.0.js"></script>

    <script>
        // This is a simple *viewmodel* - JavaScript that defines the data and behavior of your UI
        function AppViewModel() {
            this.firstName = ko.observable("John");;
            this.lastName = ko.observable("Doe");

            this.fullName = ko.computed(function() {
                return this.firstName() + " " + this.lastName();
            }, this);

            this.capitalizeLastName = function() {
                let currentVal = this.lastName();
                this.lastName(currentVal.toUpperCase());
            };
        }

        // Activates knockout.js
        ko.applyBindings(new AppViewModel());
    </script>
</body>

</html>