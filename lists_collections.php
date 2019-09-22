<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <title>Working with Lists and Collections - Knockout Tutorials</title>
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
                            <h2>Working with Lists and Collections</h2>
                            <div class="ml-auto">
                                <a href="index.php" class="btn btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Your seat reservations (<span data-bind="text: seats().length"></span>)</h4>

                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Passenger name</th>
                                    <th>Meal</th>
                                    <th>Surcharge</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- Todo: Generate table body -->
                            <tbody data-bind="foreach: seats">
                                <tr>
                                    <!-- <td data-bind="text: name"></td>
                                    <td data-bind="text: meal().mealName"></td> -->
                                    <td><input type="text" data-bind="value: name" class="form-control"></td>
                                    <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'" class="form-control"></select></td>
                                    <td data-bind="text: formattedPrice"></td>
                                    <td>
                                        <a href="#" data-bind="click: $root.removeSeat">Remove</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-secondary" type="button" data-bind="click: addSeat, enable: seats().length < 5">Reserve another seat</button>

                        <h3 data-bind="visible: totalSurcharge() > 0">
                            Total Surcharge: Rs. <span data-bind="text: totalSurcharge().toFixed(2)"></span>
                        </h3>
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
        // Class to represent a row in the seat reservations grid
        function SeatReservation(name, initialMeal) {
            let self = this;
            self.name = name;
            self.meal = ko.observable(initialMeal);

            self.formattedPrice = ko.computed(function() {
                var price = self.meal().price;
                return price ? "Rs. " + price.toFixed(2) : "None";
            });

        }

        // Overall viewmodel for this screen, along with initial state
        function ReservationsViewModel() {
            var self = this;
            // Non-editable catalog data - would come from the server
            self.availableMeals = [{
                    mealName: "Standard (sandwich)",
                    price: 0
                },
                {
                    mealName: "Premium (lobster)",
                    price: 34.95
                },
                {
                    mealName: "Ultimate (whole zebra)",
                    price: 290
                }
            ];

            // Editable data
            self.seats = ko.observableArray([
                new SeatReservation('Steve', self.availableMeals[0]),
                new SeatReservation('John', self.availableMeals[0])
            ]);

            self.addSeat = function() {
                self.seats.push(new SeatReservation("", self.availableMeals[0]));
            }
            self.removeSeat = function(seat) {
                self.seats.remove(seat);
            }
            self.totalSurcharge = ko.computed(function() {
                let total = 0;
                for (let i = 0; i < self.seats().length; i++)
                    total += self.seats()[i].meal().price;
                return total;
            });
        }
        ko.applyBindings(new ReservationsViewModel());
    </script>
</body>

</html>