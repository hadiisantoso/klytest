<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- Styles -->
        <style>
        .container{
            margin-top: 100px;
        }
        #submit #reset{
            margin-top : 50px;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($successMsg))
                <div class="alert alert-success"> {{ $successMsg }}</div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="clearfix">
                <a class='btn btn-success pull-right' style="margin-left:10px" id="alldata" href={{ route('data.create') }}>ADD</a>
            </div>
            <div style="margin-top:50px;">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data )
                        <tr>
                            <td>{{$data}}</td>
                            <td>
                                <a class='btn btn-primary' href={{ route('data.show',$data) }}>Details</a>
                                <a class='btn btn-info' href={{ route('data.edit',$data) }}>Edit</a>
                                <div class="pull-right">
                                <form action="{{action('DataController@destroy', $data)}}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    
                    </body>
                </table>
            </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</html>
