@extends('layouts.frontend')
@section('content')
   
     <section class="mt-5">
    <div class="container">
      <h3 class="text-center text-danger">Who are you</h3>
      <table class="table table-striped table-bordered">
  <thead>
   <tr>
      <th scope="col">Devdwon</th>
      <th scope="col">Devdwon</th>
      <th scope="col">Devdwon</th>
      <th scope="col">Devdwon</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($model as $element)
   <tr>
     <td scope="row">{{$element->client->name}}</td>
     <td>{{$element->client_category->name}}</td>
     <td>{{isset($element->hearing[0])?$element->hearing[0]->date:''}}</td>
     <td>{{$element->case_stage->name}}</td>
     <td>{{$element->thana}}</td>
     <td>{{$element->case_no}}</td>
     <td>{{$element->court->name}}</td>
     <td>{{isset($element->hearing[1])?$element->hearing[1]->date:''}}</td>
   </tr>
  @endforeach

  </tbody>
</table>
    </div>
  </section>
@stop