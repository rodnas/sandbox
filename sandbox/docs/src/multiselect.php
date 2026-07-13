<html lang="en">

<head>

    <title>php select2 multiple select example tutorial</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<body>

    <div class="row mt-5">

        <div class="col-md-6 offset-3 mt-5">

            <div class="card">

                <div class="card-header bg-info text-white">

                    <h4>PHP Select2 Multiple Select Example Tutorial - Nicesnippets.com</h4>

                </div>

                <div class="card-body" style="height: 280px;">

                    <form action="multiSelectPro.php" method="post">

                        <div class="form-group">

                            <label>Title :</label>

                            <input type="title" name="title" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Category :</label>

                            <select class="category related-post form-control" name="category[]" multiple>

                                <option value="1">Laravel</option>

                                <option value="2">Jquery</option>

                                <option value="3">React</option>

                                <option value="4">Jquery ui</option>

                                <option value="5">Android</option>

                                <option value="6">React Native</option>

                                <option value="7">Vue js</option>

                                <option value="8">Bootstrap 4</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <button class="btn btn-success store-related-post btn-sm">Save</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            $('.category').select2();

        });

    </script>

</body>

</html>