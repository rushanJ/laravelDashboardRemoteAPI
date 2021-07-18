

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<style>
  a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
  font-family: 'Quicksand', sans-serif;
}

#previous1, #previous2 {
  background-color: #d6d6d6;
  color: black;
}

#next1, #next2 {
  background-color: #006c94;
  color: white;
}

#previous1, #next1{
  border-radius: 4px;
  width: 100px;
  text-align: center;
}

#previous2, #next2 {
  border-radius: 50%;
  margin: 10px;
}

.centered {
  position: absolute;
  padding-top: 250px;
  padding-bottom: 250px;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style>
<title>Equiepment Dashboard</title>
  </head>
  <body>
    {{-- Nav Bar Start --}}
      <div class="bd-example">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">
                Equepment Dashboard    
            </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
         <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <form class="form-inline">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Login</button>
            </form>
          </div>
        </nav>       
      </div>
   {{-- Nav Bar END --}}

    {{-- Status tiles Start --}}
      <div class="container">
        <div class="row" style="margin-top: 10px">
          <div class="col-sm-3">
            <div class="card text-white bg-success mb-4" style="max-width: 18rem;">
                <div class="card-header">Operational</div>
                <div class="card-body">
                  <h5 class="card-title"><h1>{{ $operational }} </h1></h5>
                </div>
              </div>
          </div>
          <div class="col-sm-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Non-Operational</div>
                <div class="card-body">
                  <h5 class="card-title"><h1>{{ $nonoperational }} </h1></h5>
                </div>
              </div>
          </div>
          
        </div>
      </div>
   {{-- Status tiles End --}}
    {{-- Bar Chart Start --}}
    <div id="chart" style="height: 400px;"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sample_chart')",
        
      });
    </script>
     {{-- Bar Chart End --}}
     {{-- Buttons Start --}}
     <div class="centered">
      <a href="?lastId={{ $previousId }}" id="previous1"> Previous</a>
      <a href="?lastId={{ $nextId }}" id="next1">Next </a>
         <br> <br>
     </div>
     
   {{-- Buttons End --}}
 {{-- Table Start --}}
<div class="table-responsive">
<table class="table" style="margin-left: 80px; margin-right:80px; margin-top: 20px;">
    <thead class="thead-dark">
      <tr>
        <th scope="col">AssetID</th>
        <th scope="col">Asset Category</th>
        <th scope="col">Operational Status</th>
        <th scope="col">Description</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th scope="row">{{  $item['AssetID'] }}</th>
            <td>{{  $item['AssetCategoryID'] }}</td>
            <td>{{  $item['OperationalStatus'] }}</td> 
            <td>{{  $item['Description'] }}</td>
          </tr>
    @endforeach
    </tbody>
  </table>
</div>
 {{-- Table End --}}
  </body>
</html>