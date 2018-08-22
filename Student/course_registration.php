 <?php
  session_start();
  $username=$_SESSION["username"];
  echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">Log out </a></div>';
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="js/jquery.min.js"></script>
    <script src="common.js"></script>
    <style>		
      .details{
        float: right;
        margin-bottom: 2px;
      }
      @import "https://fonts.googleapis.com/css?family=Montserrat:300,400,700";
      .rwd-table {
        margin: 1em 0;
        
      }
      .rwd-table tr {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
      }
      .rwd-table th {
        display: none;
      }
      .rwd-table td {
        display: block;
      }
      .rwd-table td:first-child {
        padding-top: .5em;
      }
      .rwd-table td:last-child {
        padding-bottom: .5em;
      }
      .rwd-table td:before {
        content: attr(data-th) ": ";
        font-weight: bold;
        width: 6.5em;
        display: inline-block;
      }
      @media (min-width: 480px) {
        .rwd-table td:before {
          display: none;
        }
      }
      .rwd-table th, .rwd-table td {
        text-align: left;
      }
      @media (min-width: 480px) {
        .rwd-table th, .rwd-table td {
          display: table-cell;
          padding: .25em .5em;
        }
        .rwd-table th:first-child, .rwd-table td:first-child {
          padding-left: 0;
        }
        .rwd-table th:last-child, .rwd-table td:last-child {
          padding-right: 0;
        }
      }

      body {
        padding: 0 2em;
        font-family: Montserrat, sans-serif;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        color: #444;
        background: #eee;
      }

      h1 {
        font-weight: normal;
        letter-spacing: -1px;
        color: #34495E;
      }
      .dynamic{
        padding: 0;
      border: none;
      background: none;
      }
      .dynamic:hover{
        background: black;
      }
      .rwd-table {
        background: #34495E;
        color: #fff;
        border-radius: .4em;
        overflow: hidden;
      }
      .rwd-table tr {
        border-color: #46637f;
      }
      .rwd-table th, .rwd-table td {
        margin: .5em 1em;
      }
      @media (min-width: 480px) {
        .rwd-table th, .rwd-table td {
          padding: 1em !important;
        }
      }
      .rwd-table th, .rwd-table td:before {
        color: #dd5;
      }

      hr {
          display: block;
          height: 1px;
          border: 0;
          border-top: 1px solid #ccc;
          margin: 1em 0;
          padding: 0;
      }
      #save_btn{
        visibility: hidden;
      }
    </style>
    <title>course registration</title>
    
  </head>
  <body onload="check_registration();">
    <h1 id = "header">Course Registration Portal</h1>
    <hr/>
    <h2>Registered Courses</h2>
    <table class="rwd-table" id="table_taken_courses" width="100%" >
      <tr>
        <th width="20%">Course Code</th>
        <th width="20%">Title</th>
        <th width="20%">Instructor</th>
        <th width="20%">Credits</th>
        <th width="20%">L-T-P</th> 
        <th width="20%">Slot</th>
      </tr> 
    </table>
    <br/>
    <hr/>
    <h2>Pending Courses</h2>
    <table class="rwd-table" id="table_pending_courses" width="100%" >
      <tr>
        <th width="20%">Course Code</th>
        <th width="20%">Title</th>
        <th width="20%">Instructor</th>
        <th width="20%">Credits</th>
        <th width="20%">L-T-P</th> 
        <th width="20%">Slot</th>
      </tr> 
    </table>
    <br/>
    <hr/>
    <div class="details"><button id="save_btn" onclick="proceed_data()">Save</button></div>
    <h2>Floated Courses</h2>
    <table class="rwd-table" id="rwd-table" width="100%" >
      <tr>
        <th width="12%">Course Code</th>
        <th width="12%">Title</th>
        <th width="12%">Instructor</th>
        <th width="10%">Credits</th>
        <th width="10%">L-T-P</th> 
        <th width="10%">Slot</th>
        <th width="13%">Pre requisite1</th>
        <th width="13%">CGPA Constraint</th>
        <th width="13%">Allowed Batches</th>
      </tr> 
    </table>
  </body>
</html>