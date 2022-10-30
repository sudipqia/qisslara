@extends('layouts.frontend')
@section('content')

  <section class="mt-5">
    <div class="container">
      <h3 class="text-center text-danger"> অনুসন্ধানকৃত ফলাফল:</h3>
    @if ($model->count()>0)
      <table class="table table-striped table-bordered">
  <thead>
   <tr>
      <th scope="col">বাদী / বিবাদী</th>
      <th scope="col">পক্ষে</th>
      <th scope="col">পরবর্তী তারিখ</th>
      <th scope="col">ধার্য</th>
      <th scope="col">থানা</th>
      <th scope="col">মামলা নং</th>
      <th scope="col">আদালত</th>
      <th scope="col">পূর্ব তারিখ</th>
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
  {{ $model->links() }}
  @else
  <div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">ওহ নো!</h4>
  <p>আপনার অনুসন্ধানকৃত কনটেন্ট পাওয়া যায় নি.</p>
  <hr>
  <p class="mb-0">অনুগ্রহ করে আবার চেস্টা করুন.</p>
</div>
  @endif

    </div>
  </section>
@stop