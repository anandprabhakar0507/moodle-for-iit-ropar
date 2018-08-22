 <?php
  session_start();
  $username=$_SESSION["username"];
  echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">Log out </a></div>';
?>

<!DOCTYPE html>
<html>
  <head>
    <script src="js/jquery.min.js"></script>
    <script src="common.js?v=2"></script>
    <title>dashboard</title>
    <style>
      h1 {
        font-weight: normal;
        letter-spacing: -1px;
        color: #34495E;
      }
      h2{
        font-size: 40px;
        height: 90px;
        line-height: 90px;
        text-align: center;
        border: 2px dashed #f69c55; 
      }

      hr {
          display: block;
          height: 10px;
          border: 0;
          border-top: 1px solid #ccc;
          margin: 1em 0;
          padding: 0;
          
      }
      body {
        padding: 0 2em;
        font-family: Montserrat, sans-serif;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        color: #444;
        background: #eee;
      }
      .details{
      float: right;
      padding: 0px;
      margin: 1px;
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
      a{
        text-decoration: none;
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

    </style>

  </head>
  <body onload="check12(2);">
    <h1 id = "header">Dashboard</h1>
    <button class="details" onclick="location.href = 'course_registration.php';" >Course Registartion Portal</button>
    <button class="details" onclick="location.href = 'academic_performance.php';">View Academic Performance</button>
    <hr/>
    <h2>Your Courses</h2>
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
  </body>
</html>