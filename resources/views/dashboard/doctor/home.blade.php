@extends('layouts.main-template')

@section('title', isset($title) ? $title : 'Dashboard | Client')

@section('content')
@php
    $client = App\Models\Client::where('client_email', auth()->user()->email)->first();
    $policies = App\Models\Policy::all();
    $payments = App\Models\Payment::all();
@endphp

<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-600 px-6 py-8 lg:p-12">
            <h3 class="text-2xl font-extrabold text-white sm:text-3xl">User Information</h3>
        </div>
    </div>

    <section class="bg-gray-100 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/3">
                    <div class="bg-white rounded-lg shadow-lg mb-4">
                        <div class="px-6 py-8">
                            <div class="flex justify-center mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            </div>
                            <h5 class="my-3">{{ $client->client_fname }}</h5>
                            <p class="text-muted mb-1">{{ $client->Age }} Years Old</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg">
                        <div class="p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item flex justify-between items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0"></p>
                                </li>
                                <li class="list-group-item flex justify-between items-center p-3">
                                    <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                    <p class="mb-0"></p>
                                </li>
                                <li class="list-group-item flex justify-between items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0"></p>
                                </li>
                                <li class="list-group-item flex justify-between items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0"></p>
                                </li>
                                <li class="list-group-item flex justify-between items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0"></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="md:w-2/3">
                    <div class="bg-white rounded-lg shadow-lg mb-4">
                        <div class="p-8">
                            <p class="mb-4 text-primary font-bold">Personal Details</p>
                            <div class="flex justify-between mb-4">
                                <p class="font-bold">Full Name</p>
                                <p class="text-muted">{{ $client->client_fname }}</p>
                                </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-4">
                            <p class="font-bold">Email</p>
                            <p class="text-muted">{{ $client->client_email }}</p>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-4">
                            <p class="font-bold">Phone</p>
                            <p class="text-muted">{{ $client->phone_number }}</p>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-4">
                            <p class="font-bold">Driving Registration Number</p>
                            <p class="text-muted">{{ $client->driving_license_number }}</p>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-4">
                            <p class="font-bold">Vehicle Registration</p>
                            <p class="text-muted">{{ $client->vehicle_registration }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


