@extends('layout.index')
@section('content')
   <div class="inbox">
    
  		 <h2>{{$title}}</h2>
  		<div class="pull-right"><a href="{{URL::to('createprisonwing')}}" class="btn btn-primary">Add Prison Wings</a></div>
  			<br/>
  			<br/>
    	 <div class="col-md-12 mailbox-content  tab-content tab-content-in">
    	 	<div class="tab-pane active text-style" id="tab1">
	    	 	<div class="mailbox-border">
	              
	                <table class="table tab-border">
	                <thead>
	               	 	<tr>
		                	<th>Sl No</th>
		                	<th>Name</th>
		                	<th>Action</th>
	                	</tr>
	                </thead>
	                 <?php $i=1; ?>
	                @foreach($prisionwings as $row)

	                    <tbody>
	                        <tr class="unread checked">
	                            <td >
	                                {{$i++}}
	                            </td>
	                            <td>
	                                {{$row->name}}
	                            </td>
	                            <td>
	                             @if($row->is_enable == 1)
			    				{!! link_to_route('master.prisonwingaction', 'Disable', [$row->id], ['class' => 'btn btn-warning','onclick'=>"javascript:return confirm('Are you sure want to disable ?')"]) !!}
								@else
			    				{!! link_to_route('master.prisonwingaction', 'Enable', [$row->id], ['class' => 'btn btn-success','onclick'=>"javascript:return confirm('Are you sure want to enable ?')"]) !!}
								@endif

								{!! link_to_route('master.editprisonwing', 'Edit', [$row->id],['class'=>'btn btn-info','onclick'=>"javascript:return confirm('Are you sure want to edit?')"])  !!}
								{!! link_to_route('master.deleteprisonwing', 'Delete', [$row->id],['class'=>'btn btn-danger','onclick'=>"javascript:return confirm('Are you sure want to delete?')"])  !!}
				         </td>
	                            
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	               </div>   
               </div>
            </div>
          <div class="clearfix"> </div>     
  </div>
   @endsection