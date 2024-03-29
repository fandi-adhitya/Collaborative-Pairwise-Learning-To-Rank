 @extends('master.master_admin')
 @section('pageTitle', 'Manage Anime')
 @section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
	<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
		<a href="" class="btn btn-lg btn-secondary" style="margin-bottom: 10px;" data-toggle="modal" data-target="#exampleModal">Tambah Anime &nbsp;&nbsp;<i class="fas fa-plus"></i></a>
		<div class="row">
		<div class="col-xl-12 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">Animes</h4>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <table id="data-anime" class="table align-items-center " style="margin: 0 auto;">
				<thead class="thead-light">
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Image URL</th>
						<th scope="col">Type</th>
						<th scope="col">Members</th>
						<th scope="col">Genre</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
			</table>
            </div>
          </div>
		</div>
		<div class="col-xl-12 mb-6  mt--15" style="margin-top:40px;">
			<div class="card shadow" style="padding: 10px;">
	            <div class="card-header border-0">
	            	<div class="row align-items-center">
	                <div class="">
	                  <h4 style="">Anime Rating Tertinggi</h4>
	                </div>
	              </div>
	            </div>

	        <center>
            	<div id="piechart" style="width:900px; height: 400px">
  				</div>
            </center>
	        </div>
    	</div>
	</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Anime</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST" action="{{route('add.animes')}}">
				{{csrf_field()}}
      		 <div class="row" style="padding: 10px;">
			     <div class="col-md-12">
				      <div class="form-group">
				        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
				      </div>
				 </div>
			</div>
			<div class="row" style="padding: 10px;">
			     <div class="col-md-12">
				      <div class="form-group">
				        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Image URL" name="img_url">
				      </div>
				 </div>
			</div>
			<div class="row" style="padding: 10px;">
			     <div class="col-md-8">
				      <div class="form-group">
				        <select name="type">
 										<option value="TV">TV</option>
										<option value="MOVIE">MOVIE</option>
										<option value="OVA">OVA</option> 
								</select>
				      </div>
				 </div>
			</div>
			<div class="row" style="padding: 10px;">
			     <div class="col-md-12">
				      <div class="form-group">
				        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Episode" name="episode">
				      </div>
				 </div>
			</div>
			<div class="row" style="padding: 10px;">
			     <div class="col-md-12">
				      <div class="form-group">
				        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Members" name="members">
				      </div>
				 </div>
			</div>
			<div class="row" style="padding: 10px;">
			     <div class="col-md-12">
				      <div class="form-group">
				        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Genre" name="genre">
				      </div>
				 </div>
			</div>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
			</form>
    </div>
  </div>
</div>
@endsection		
@section('script')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style type="text/css">
	table.mySpecialClass {
    border-button: 10px solid #FFFFFF;
}
	.dataTables_length{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_filter{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_info{
		font-size:14px;
		color: #32325d;
	}
	.dataTables_wrapper{
		margin: 10px;
	}
	.dataTables_paginate{
		font-size:14px;
		color: #32325d;
	}
	#example_paginate a:hover{
		background-color: #ccc;
		font-size:14px;
	}
	.form-control{
		float: right;
		margin-left: 10px;
		height: 40px;
	}
	#example_previous a {
  background-color:black;
}

#example_next a {
  background-color:red;
}
.pagination>li>a, .pagination>li>span{
  border:1px solid red !important;
}

</style>
<script type="text/javascript" src="{{url('https://www.gstatic.com/charts/loader.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#data-anime').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url":"<?= route('dataAnime') ?>",
				"dataType":"json",
				"type":"POST",
				"data":{"_token":"<?= csrf_token() ?>"}
			},
			"columns":[
				{"data":"title"},
				{"data":"img_url"},
				{"data":"type"},
				{"data":"members"},
				{"data":"genre"},
				{"data":"action","searchable":false,"orderable":false}
			],
			columnDefs: [
				            {
				                targets: [ 0, 1, 2 ],
				                className: 'mdl-data-table__cell--non-numeric'
				            }
				        ]
			});
        $("#example_paginate").removeClass('paginate_button').addClass('btn-sm');
        $('#example_filter').addClass('form-group');
        $('input').addClass('form-control form-control-alternative');
        $('select').addClass('form-control form-control-alternative');
    });
    var animes = <?php echo $response; ?>;
      console.log(animes);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(animes);
        var options = {
          curveType: 'function',
          legend: { position: 'top' }
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
</script>
@endsection
