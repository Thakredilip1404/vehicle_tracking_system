<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Tracking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <style>

            #data_table {
            table-layout: fixed;
            width: 100% !important;
            }
            #data_table td,
            #data_table th{
            width: auto !important;
            white-space: normal;
            text-overflow: ellipsis;
            overflow: hidden;
            }
    </style>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">Vehicle Tracking System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
      <!--Main layout-->
  <main class="my-5">
    <div class="container">
      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-5 text-primary"><strong>My Vehicles</strong></h4>

        <div class="row">
          <div class="col-lg-6 mb-4">
            <div class="card">
            <h4 class="text-primary">Available Vehicles</h4>
                @if(count($vehicles) > 0)
                <table class="table" id="data_table">
                <thead>
                    <tr>
                        <th> Vehicle Name</th>
                        <th> Vehicle Type</th>
                        <th> Year Of Manf  </th>
                        <th> Date Of Purchase </th>
                        <th> Created_at</th>
                        <th> Updated_at </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach($vehicles as $vehicle)
                    <tr id="vehicle_row_{{ $vehicle['id'] }}">
                        <td id="vehicle_name_id_{{ $vehicle['id'] }}"> {{$vehicle['vehicle_name'] }} </td>
                        <td id="vehicle_type_id_{{ $vehicle['id'] }}"> {{$vehicle['vehicle_type'] }} </td>
                        <td id="vehicle_manf_id_{{ $vehicle['id'] }}"> {{ date('Y',strtotime($vehicle['year_of_manf'])) }} </td>
                        <td id="vehicle_dop_id_{{ $vehicle['id'] }}"> {{ date('d-m-Y',strtotime($vehicle['date_of_pruchase'])) }} </td>
                        <td id="vehicle_createdat_id_{{ $vehicle['id'] }}"> {{ date('d-m-Y',strtotime($vehicle['created_at'])) }} </td>
                        <td id="vehicle_updatedat_id_{{ $vehicle['id'] }}"> {{ date('d-m-Y',strtotime($vehicle['updated_at'])) }} </td>
                        <td id="row_id_{{ $vehicle['id'] }}">
                            <button class="btn btn-primary btn-block mb-1 edit_vehicle" id="{{ $vehicle['id'] }}">Edit</button>
                            <button class="btn btn-primary btn-block mb-1 delete_vehicle" id="{{ $vehicle['id'] }}"> Delete</button>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            </table>
                @endif 
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <div class="card">
                <h4 class="text-primary">Add/Edit vehicle</h4>
            <form>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="vehicle_id" id="vehicle_id"></input>
                    <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text"  class="form-control" id="vehicle_name"/>
                        <label class="form-label" for="form5Example1">Vehicle Name</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                    <select class="form-select" aria-label="Default select example" id="vehicle_type" >
                    <option value="Car" sekected>Car</option>
                    <option value="Bike">Bike</option>
                    <option value="Other">Other</option>
                    </select>
                        <label class="form-label" for="form5Example2">Vehicle Type</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" min="1900" max="2023" step="1" value="2023"  class="form-control" id="vehicle_yof"/>
                        <label class="form-label" for="form5Example1">Year of manufacturer</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="date"  class="form-control" id="vehicle_dop"/>
                        <label class="form-label" for="form5Example1">Date of purchase</label>
                    </div>

                    <!-- Submit button -->
                    <button type="button" class="btn btn-primary btn-block mb-4 edit_save_button" id="edit_save_button">Save</button>
                    </form>
            </div>
          </div>
        </div>

      </section>
      <!--Section: Content-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <hr class="m-0" />

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-dark" href="{{ route('home') }}">Vehicle Tracking System</a>
    </div>
    <!-- Copyright -->
  </footer>
    @yield('content')
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('storage/js/custom.js') }}"></script>
    
</body>
</html>