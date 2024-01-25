<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <style>
        /* Add CSS styles for input elements */
        input[type="text"],
        input[type="number"],
        textarea {
            color: black;
            /* Change text color to black */
        }

        option {
            color: black;
            /* Change text color to black */
        }

        select.js-example-basic-single::selection {
            color: black;
            /* Change the text color to black */
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        @include('admin.partials.sidebar')

        @include('admin.partials.navbar')
        <div class="main-panel">
            <div class="content-wrapper">

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Send Greeding To {{ $order->name }}</h4>
                            <form class="forms-sample" action="{{ route('view.sent_notify', $order->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">Custumer Greeting</label>
                                    <input type="text" name="greeting" class="form-control" id=""
                                        placeholder="Custumer Name">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">First line</label>
                                    <input type="text" name="first_line" class="form-control" id=""
                                        placeholder="First line">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Email Body</label>
                                    <input type="text" name="email_body" class="form-control" id=""
                                        placeholder="Email Body">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">Email Button Name</label>
                                    <input type="text" name="email_button" class="form-control" id=""
                                        placeholder="Email Button Name">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputName1">Email (URL)</label>
                                    <input type="url" name="email_url" class="form-control" id=""
                                        placeholder="Enter URL">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Last line</label>
                                    <input type="text" name="last_line" class="form-control" id=""
                                        placeholder="Last Line">
                                </div>


                                <button class="btn btn-success mr-2">Sent Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</body>

</html>
