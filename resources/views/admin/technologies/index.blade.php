@extends('layouts.app')
@section('cdn')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> 
@endsection
@section('content')
{{-- @dump($sort) --}}
@if (session('message'))
<div class="alert alert-info">
    {{ session('message') }}
</div>
@endif
  <div class="container">
    @section('title')
    <h1 class="mt-4 mb-5">Technology</h1>
    @endsection
    
    <div class="row">
     
      {{-- <div class="col-12 d-flex justify-content-end">
        <a technology="button" class="btn btn-success border fw-bold" href="{{route('admin.technologies.create')}}">Create New Technology</a>
      </div>
    </div> --}}
    
        
    
    <table class="table table-light table-striped   mt-5">
      <thead class="table-head">
        <tr>
          <th scope="col">
            <a href="{{route('admin.technologies.index')}}?sort=id&order={{ $sort == 'id' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              @if ($sort == 'id')
              <i class="bi bi-arrow-down d-inline-block @if ($order == 'DESC') rotate-180 @endif"></i>
              @endif
              Id
              
            </a>
          </th>
          <th  scope="col">
            <a href="{{route('admin.technologies.index')}}?sort=label&order={{$sort == 'label' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Label
              @if ($sort == 'label')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
        </th>
        
          <th scope="col">
            <a href="{{route('admin.technologies.index')}}?sort=color&order={{$sort == 'color' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Color
              @if ($sort == 'color')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.technologies.index')}}?sort=created_at&order={{$sort == 'created_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Created At
              @if ($sort == 'created_at')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          <th scope="col">
            <a href="{{route('admin.technologies.index')}}?sort=updated_at&order={{$sort == 'updated_at' && $order != 'DESC' ? 'DESC' : 'ASC' }}">
              Updated At
              @if ($sort == 'updated_at')
              <i class="bi bi-arrow-down d-inline-block @if($order == 'DESC')rotate-180 @endif"></i>
              @endif
            </a>
          </th>
          {{-- <th scope="col">Actions</th> --}}
        </tr>
      </thead>
              
          
          
      <tbody>
        @forelse ($technologies as $technology)
            
        <tr class="table-dark w-100">
          <th>{{$technology->id}}</th>
          <td>{{$technology->label}}</td>
          <td><span style="background-color:{{$technology->color}} " class="color-preview"></span>{{$technology->color}}</td>
          <td>{{$technology->created_at}}</td>
          <td>{{$technology->updated_at}}</td>
          
          {{-- <td class="d-flex flex-row align-items-center justify-content-between">
            <a class="" href="{{ route('admin.technologies.show', ['technology' => $technology ])}}"><i class="bi bi-aspect-ratio-fill text-primary fs-5  "></i></a>
            
            <a class="" href="{{ route('admin.technologies.edit', ['technology' => $technology ])}}"><i class="bi bi-pencil text-primary fs-5  "></i></a>

            <button class="bi bi-clipboard2-x-fill text-danger delete-icon {{route('admin.technologies.index')}}?sort=" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$technology->id}}"></button> --}}
            
            
          </td>
          
        </tr>
        @empty
        <tr>
          <td colspan="6">
            No Data Here!
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
    {{-- {{ $technologies->links('') }} --}}
  </div>
              
  {{-- @section('modals')
@foreach($technologies as $technology)
<div class="modal fade" id="delete-modal-{{$technology->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4  fw-bold" id="exampleModalLabel">Attention</h1>



        <button technology="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fs-2 fw-bold">
        Are you sure you want to delete the technology with label {{$technology->label}}?
      </div>
      <div class="modal-footer">
        <button technology="button" class="btn btn-info text-light border fw-bold" data-bs-dismiss="modal">Close</button>
        <form class="" action="{{ route('admin.technologies.destroy', ['technology' => $technology ])}}" method="POST">
          @csrf
          @method('delete')
          <button technology="submit" class="btn btn-danger border fw-bold">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endforeach
@endsection  --}}

@endsection
          
              
              
              
              
          

