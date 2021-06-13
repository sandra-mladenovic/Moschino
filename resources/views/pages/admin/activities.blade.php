@extends('layouts.admin.layout')
@section('title')
Dashboard
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Activities</h4>
                <p class="card-category"> Users activities on site</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                      <label>Filter by date:</label>
                      <input type="date" class="form-control  col-lg-4 col-md-12 col-sm-12" name="date" id='date'>
                    <thead class=" text-primary">
                      <th class="numberOfMessages thActivities"> ID</th>
                      <th class="numberOfMessages thActivities"> Name</th>
                      <th class="numberOfMessages thActivities">Activiti</th>
                      <th class="numberOfMessages thActivities">Date</th>
                    </thead>
                    <tbody id='action'>
                      <?php $br=1?>
                        @foreach ($activities as $a)
                      <tr>
                        <td> {{$br++}}</td>
                        <td>{{$a->full_name}}</td>
                        <td>{{$a->action}}</td>
                        <td> {{date('d.m.Y.', strtotime($a->date))}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
@endsection
