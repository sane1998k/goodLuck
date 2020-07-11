<html>
 <head>
  <title>Просмоторщик</title>
  <script src="js/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/test.css" />
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
  <link href="css/jquery.datetimepicker.min.css" rel="stylesheet" />
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.datetimepicker.full.min.js"></script>

  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>


 </head>
 <body>
  <div class="container box">
   <h1 align="center">Таблица рецептов</h1>
   <br />
   <div class="table-responsive">
    <br />


    <div class="row">
             <div class="col-md-4">
                 <input type="text" id="start_date" class="form-control" autocomplete="off" placeholder = "С 2020-01-01">
                 </div>
                 <div class="col-md-4">
                 <div class="wide"><input type="text" id="end_date" class="form-control" autocomplete="off" placeholder = "По 2020-12-12"></div>

              </div>
     <div class="col-md-4">
      <input type="button" name="search" id="search" value="Поиск" class="btn btn-info" />
     </div>
    </div>
    <br />
    <table id="order_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>ID</th>
       <th>Дата,время старта</th>
       <th>Имя рецептуры</th>
       <th>задание, кГ</th>
       <th>факт,кГ</th>
       <th>задание</th>
       <th>факт</th>
              <th>задание, кГ</th>
              <th>факт,кГ</th>
                     <th>задание, кГ</th>
                     <th>факт,кГ</th>
                            <th>задание, кГ</th>
                            <th>факт,кГ</th>
                                   <th>задание, кГ</th>
                                   <th>факт,кГ</th>
                                          <th>задание, кГ</th>
                                          <th>факт,кГ</th>
                                                 <th>задание, кГ</th>
                                                 <th>факт,кГ</th>
                                                        <th>задание, кГ</th>
                                                        <th>факт,кГ</th>
                                                               <th>задание, кГ</th>
                                                               <th>факт,кГ</th>
                                                                      <th>задание, кГ</th>
                                                                      <th>факт,кГ</th>
                                                                             <th>задание, кГ</th>
                                                                             <th>факт,кГ</th>
<th>задание, кГ</th>
<th>факт,кГ</th>

<th>задание, кГ</th>
<th>факт,кГ</th>

<th>задание, кГ</th>
<th>факт,кГ</th>

<th>задание, кГ</th>
<th>факт,кГ</th>

<th>задание, кГ</th>
<th>факт,кГ</th>


      </tr>
     </thead>
    </table>

   </div>
  </div>
  <script>
  jQuery.datetimepicker.setLocale('ru');
   $('#start_date').datetimepicker({
          timepicker: true,
          datepicker: true,
          format: 'Y-m-d H:i', // formatDate
          hours12: false,
          step: 1
      });
  </script>
    <script>
     $('#end_date').datetimepicker({
            timepicker: true,
            datepicker: true,
            format: 'Y-m-d H:i', // formatDate
            hours12: false,
            step: 1
        });
    </script>
 </body>
</html>


<script type="text/javascript" language="javascript" >
$(document).ready(function(){


 $('.input-daterange').datepicker({
  timePicker: true,
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#order_data').DataTable({
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"php/fetch.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date
    }
   }
  });
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Both Date is Required");
  }
 });

});
</script>