<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Single page applications - Knockout Tutorials</title>
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
                            <h2>Single page applications </h2>
                            <div class="ml-auto">
                                <a href="index.php" class="btn btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Folders -->
                        <ul class="folders" data-bind="foreach: folders">
                            <li data-bind="text: $data, 
                            css: { selected: $data == $root.chosenFolderId() },
                            click: $root.goToFolder"></li>
                        </ul>

                        <table class="table table-striped table-hover table-bordered" data-bind="with: chosenFolderData">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody data-bind="foreach: mails">
                                <tr data-bind="click: $root.goToMail">
                                    <td data-bind="text: from"></td>
                                    <td data-bind="text: to"></td>
                                    <td data-bind="text: subject"></td>
                                    <td data-bind="text: date"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Chosen mail -->
                        <div class="viewMail" data-bind="with: chosenMailData">
                            <div class="mailInfo">
                                <h1 data-bind="text: subject"></h1>
                                <p><label>From</label>: <span data-bind="text: from"></span></p>
                                <p><label>To</label>: <span data-bind="text: to"></span></p>
                                <p><label>Date</label>: <span data-bind="text: date"></span></p>
                            </div>
                            <p class="message" data-bind="html: messageContent" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="assets/js/knockout-3.5.0.js"></script>
    <script src="assets/js/sammy.min.js"></script>

    <script>
        (function() {
            function WebmailViewModel() {
                // Data
                var self = this;
                self.folders = ['Inbox', 'Archive', 'Sent', 'Spam'];
                self.chosenFolderId = ko.observable();
                self.chosenFolderData = ko.observable();
                self.chosenMailData = ko.observable();

                // Behaviours
                self.goToFolder = function(folder) {
                    location.hash = folder
                };
                self.goToMail = function(mail) {
                    location.hash = mail.folder + '/' + mail.id
                };

                // Client-side routes    
                Sammy(function() {
                    this.get('#:folder', function() {
                        self.chosenFolderId(this.params.folder);
                        self.chosenMailData(null);
                        $.get("mail.php", {
                            folder: this.params.folder
                        }, self.chosenFolderData);
                    });

                    this.get('#:folder/:mailId', function() {
                        self.chosenFolderId(this.params.folder);
                        self.chosenFolderData(null);
                        $.get("mail.php", {
                            mailId: this.params.mailId
                        }, self.chosenMailData);
                    });

                    this.get('', function() {
                        this.app.runRoute('get', '#Inbox');
                    });

                }).run();
            }

            ko.applyBindings(new WebmailViewModel());
        })();
    </script>
</body>

</html>