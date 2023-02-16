<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Received and Dispatched Graph</title>
  <link href="../assets/css/bootsrap/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/css/dasnboard.css" rel="stylesheet">
  <script src="../assets/plotly/plotly-2.16.1.min.js"></script>
</head>
<body>
<section id="subscription">
<div class="d-flex mb-2">
      <div class="col-sm-3 card rounded-0 shadow-sm ">
          <div class="card-body text-center fw-bold">
              <h5>Subscription</h5>
                <span class="barge barge-success bg-success text-white rounded rounded-pill px-1">Active</span>
                  Expires <p class="text-dark h1" >12,Dec 2023</p>
          </div>
      </div>
</div>
</section>
<section id="dashboard" class="container-fluid">
<div class="row">
  <div class="col-6">
  <div class="row">
    <div class="col">
    <table class="table table-bordered table-hover" id="tableReceived">
        <thead>
          <tr>
            <th scope="col" colspan="2">Coffee&nbsp;Received(Kg)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="color:blue;"></td>
            <td style="color:blue;"></td>
          </tr>
          <tr>
            <td style="color:#090489; font-weight:bolder;font-size:medium;"></td>
            <td style="color:#090489; font-weight:bolder;font-size:medium;"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col">
    <table class="table table-bordered table-hover" id="tableMovedOut">
        <thead>
          <tr>
            <th scope="col" colspan="2">Coffee&nbsp;Moved&nbsp;Out(kg)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="color:#658354;"></td>
            <td style="color:#658354;"></td>
          </tr>
          <tr>
            <td style="color:#4b6043; font-weight:bolder; font-size:medium;"></td>
            <td style="color:#4b6043; font-weight:bolder; font-size:medium;"></td>
          </tr>
        </tbody>
    </table>
    </div>

    <div class="col">
    <table class="table table-bordered table-hover" id="monthlyVariance">
          <thead>
          <tr>
            <th scope="col" colspan="2">Monthly&nbsp;Variance</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="" style="color:#f44336;">Received</td>
            <td style="color:#f44336;">Moved&nbsp;Out</td>
          </tr>
          <tr>
            <td style="color:#992a22; font-weight:bolder; font-size:medium;"></td>
            <td style="color:#992a22; font-weight:bolder; font-size:medium;"></td>
          </tr>
        </tbody>
    </table>
    </div>

  </div><!--End of row-->
    
    <div class="row">
    <div class="col overflow-hidden" id="coffeeInAndOut" style="padding:2px; border:2px solid green;">
    </div>
    </div>

  </div><!--end of first column-->
    
  <!--second column-->
  <div class="col-6">
  <div class="row">
    <div class="col overflow-hidden" id="dailyCoffeeProcessing" style="padding:2px; border:2px solid gray;">
    </div>
  </div>
  <div class="row">
    <div class="col">
      <table class="table table-bordered table-hover" id="currentMonth">
        <thead>
          <tr>
            <th scope="col">Monthly&nbsp;Processing</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="col">
      <table class="table table-bordered table-hover" id="hulled">
        <thead>
          <tr>
            <th scope="col">Hulled</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td>Hulled</td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="col">
      <table class="table table-bordered table-hover" id="graded">
        <thead>
          <tr>
            <th scope="col">Graded</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td>Graded</td>
            </tr>
          </tbody>
      </table>
    </div>

    <div class="col">
      <table class="table table-bordered table-hover" id="colorSorted">
        <thead>
          <tr>
            <th scope="col">Color&nbsp;Sorted</th>
          </tr>
        </thead>
          <tbody>
            <tr>
              <td >ColorSorter</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col">
      <table class="table table-bordered table-hover" id="dried">
        <thead>
          <tr>
            <th scope="col">Dried</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dried</td>
            </tr>
          </tbody>
      </table>
    </div>
  </div><!--End row-->
  </div>
</div><!--End of First Row-->

<div class="row">
 <div class="col-6">
    <div class="row">
      <div class="col">
      <table class="table table-bordered table-hover" id="tableQReceived">
          <thead>
            <tr>
              <th scope="col" colspan="2">Coffee&nbsp;Received(Kg)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:blue;"></td>
              <td style="color:blue;"></td>
            </tr>
            <tr>
              <td style="color:#090489; font-weight:bolder;font-size:medium;"></td>
              <td style="color:#090489; font-weight:bolder;font-size:medium;"></td>
            </tr>
          </tbody>
        </table>   
      </div>

      <div class="col">
    <table class="table table-bordered table-hover" id="tableQMovedOut">
          <thead>
            <tr>
              <th scope="col" colspan="2">Coffee&nbsp;Moved&nbsp;Out(kg)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:#658354;"></td>
              <td style="color:#658354;"></td>
            </tr>
            <tr>
              <td style="color:#4b6043; font-weight:bolder; font-size:medium;"></td>
              <td style="color:#4b6043; font-weight:bolder; font-size:medium;"></td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col">
    <table class="table table-bordered table-hover" id="quarterlyVariance">
            <thead>
            <tr>
              <th scope="col" colspan="2">Quarterly&nbsp;Variance</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:#f44336;">Received</td>
              <td style="color:#f44336;">Moved Out</td>
            </tr>
            <tr>
              <td style="color:#992a22; font-weight:bolder; font-size:medium;"></td>
              <td style="color:#992a22; font-weight:bolder; font-size:medium;"></td>
            </tr>
          </tbody>
      </table>
    </div>
    </div>
    <div class="row">
      <h1>Waiting For Data</h1>
    </div>
  </div><!---End of First Row-->

  <div class="col-6">
    <div class="row">
      <div class="col" id="quarterlyReceived">
      </div>
    </div>
  </div>
</div><!--End Of Second Row-->
</section>
<script src="../assets/css/bootsrap/js/bootstrap.min.js"></script>
<script src="../assets/js/tabledata.js"></script>
<script src="../assets/js/graph1.js" type="module"></script>
<script src="../assets/js/quartGraded.js" type="module"></script>
<script src="../assets/js/graph2.js" type="module"></script>
<script src="../assets/js/currMonthPro.js"></script>
</body>
</html>
