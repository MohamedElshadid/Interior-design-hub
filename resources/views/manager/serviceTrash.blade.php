@extends('admin.base')

@section('adminbase')

<div class="text-center">
  <table class="table table-dark" style="background-color: rgba(0,0,0,0.5);">
    <thead>
      
      <tr>
        <th scope="col" class="text-light h6" style="font-weight:700">#</th>
        <th scope="col" class="text-light h6" style="font-weight:700">Image</th>
        <th scope="col" class="text-light h6" style="font-weight:700">Title</th>
        <th scope="col" class="text-light h6" style="font-weight:700">Hint</th>
        <th scope="col" class="text-light h6" style="font-weight:700">Description</th>
        <th scope="col" class="text-light h6" style="font-weight:700">Price</th>
        <th scope="col" class="text-light h6" colspan="2" style="font-weight:700">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($services as $service)
      <tr>
        <th scope="row">{{$service->id}}</th>
        <td><img src="/images/service/{{$service->image}}" style="display: inline-block; height: 100px; width:100px; border-radius:50%; border:1px solid black"></td>
        <td>{{$service->title}}</td>
        <td>{{$service->hint}}</td>
        <td>{{$service->description}}</td>
        <td>{{$service->price}}</td>
        <td>
            <a href="{{ route('manager.serviceTrash.edit', $service->id) }}"class="btn btn-success">Active</a>
          </td>
          <td>
            {!! Form::open(['route' => ['manager.serviceTrash.destroy',$service->id] ,'method' => 'delete', 'style'=>'display:inline-block']) !!}
            {!! Form::submit('Delete',['class'=>'btn btn-secondary']) !!}
            {!! Form::close() !!}
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection