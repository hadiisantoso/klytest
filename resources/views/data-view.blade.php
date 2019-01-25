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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <form class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter Name" value={{$data->name}}>
                </div>
                <div class="form-group">
                    <label for="inputeEmail">Email address</label>
                    <input type="email" class="form-control" id="inputeEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" value={{$data->email}}>
                </div>
                <div class="form-group">
                    <label for="brithdate">Birth Date</label>
                    <input class="form-control" id="birthdate" name="birth_date" autocomplete="off" value={{$data->birth_date}}>
                </div>
                <div class="form-group">
                    <label for="inputPhoneNumber">Phone Number</label>
                    <input type="text" class="form-control" id="inputPhoneNumber" name="phone_number" placeholder="Enter Phone Number" value={{$data->phone_number}}>
                </div>
                <div class="form-group">
                <label for="sel1">Gender</label>
                <select class="form-control" id="sel1" name="gender">
                @foreach($genders as $gender)
                    <option value="{{ $gender['key'] }}" @if($data->gender == $gender['key']) selected @endif> {{ $gender['value'] }} </option>
                @endforeach
                </select>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Enter Address" value={{ $data->address}}>
                </div>
                
            </form>
            </div>
        </div>
    </body>

    <script type="text/javascript">
          $(function () {
            $('#birthdate').datepicker({
                uiLibrary: 'bootstrap4'
            });
          });
    </script>
</html>
