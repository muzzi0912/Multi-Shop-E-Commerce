<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<style>
    table.dataTable tbody td {
        padding: 8px 10px;
        background: black;
        color: white;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem;
        color: white;
    }

    .dataTables_wrapper label {
        font-size: .8125rem;
        color: white;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 65px;
        margin-left: 0.25rem;
        margin-right: 0.25rem;
        color: white;
    }
</style>

<body>
    <div class="container-scroller">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Message</h4>
                            <div class="table-responsive">
                                <table id="messageTable" class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->subject }}</td>
                                                <td>{{ $row->message }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#messageTable').DataTable();
        });
    </script>
</body>

</html>
