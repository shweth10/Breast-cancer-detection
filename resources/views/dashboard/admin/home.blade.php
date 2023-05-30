@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Claims Staff')
@section('content')
@php
    $clients= App\Models\Client::all();
    $policies=App\Models\Policy::all();
    $payments=App\Models\Payment::all();
    $claims=App\Models\Claim::all();
@endphp

<div class="relative max-w-7xl mx-auto">
        <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
            <div class="flex-1 px-6 py-8 lg:p-12 bg-gray-600">
                <h3 class="text-2xl font-extrabold text-white sm:text-3xl">Dashboard</h3>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12 mt-3">
        <div class="flex flex-wrap">
    <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
    <div class="flex-auto p-4">
      <div class="flex flex-wrap">
        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
          <h5 class="text-blueGray-400 uppercase font-bold text-xs">
            Claims Pending
          </h5>
          <span class="font-semibold text-xl text-blueGray-700">
            {{ App\Models\Claim::where('approval_status', 'pending')->count() }}
          </span>
        </div>
        <div class="relative w-auto pl-4 flex-initial">
          <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
            <i class="fas fa-clock"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="w-full lg:w-6/12 xl:w-3/12 px-4">
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
    <div class="flex-auto p-4">
      <div class="flex flex-wrap">
        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
          <h5 class="text-gray-500 uppercase font-bold text-xs">
            Claims Approved
          </h5>
          <span class="font-semibold text-3xl text-gray-800">
            {{ App\Models\Claim::where('approval_status', 'approved')->count() }}
          </span>
        </div>
        <div class="relative w-auto pl-4 flex-initial">
          <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-green-500">
            <i class="far fa-check-circle fa-2x"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="w-full lg:w-6/12 xl:w-3/12 px-4">
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
    <div class="flex-auto p-4">
      <div class="flex flex-wrap">
        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
          <h5 class="text-gray-500 uppercase font-bold text-xs">
            Claims Rejected
          </h5>
          <span class="font-semibold text-2xl text-gray-800">
            {{ App\Models\Claim::where('approval_status', 'rejected')->count() }}
          </span>
        </div>
        <div class="relative w-auto pl-4 flex-initial">
          <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
            <i class="fas fa-times"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection