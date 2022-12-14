<h3 class="text-center">{{_lang('this_court_have_this_cases')}} | {{_lang('number_of_cases')}} <span class="badge badge-primary">{{$model->cases->count()}}</span></h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>{{_lang('court_name')}}</td>
			<td>{{_lang('case_no')}}</td>
			<td>{{_lang('client_name')}}</td>
			<td>{{_lang('filling_date')}}</td>
			<td>{{_lang('file_no')}}</td>
		</tr>
	</thead>
	<tbody>
		@foreach($model->cases as $case)
 			<tr>
 			    <td>{{$case->court->name}}</td>
 				<td>{{$case->case_no}}</td>
 				<td>{{$case->client->name}}</td>
 				<td>{{$case->filling_date}}</td>
 				<td>{{$case->file_no}}</td>
 			</tr>
		@endforeach	
	</tbody>
</table>