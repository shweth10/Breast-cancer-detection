<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Car Insurance Hub</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>
        <!--====== Animate CSS ======-->
        <link rel="stylesheet" href="/css/animate.css">

        <!--====== Slick CSS ======-->
        <link rel="stylesheet" href="/css/tiny-slider.css">

        <!--====== Line Icons CSS ======-->
        <link rel="stylesheet" href="/fonts/lineicons/font-css/LineIcons.css">

        <!--====== Tailwind CSS ======-->
        <link rel="stylesheet" href="/css/tailwindcss.css">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .m-2{
                margin: 0.5rem;
                }
            .inline-block{
                display: inline-block;
                }
            .rounded{
                border-radius: 0.25rem;
                }
            .bg-black{
                    --tw-bg-opacity: 1;
                    background-color: rgb(33 43 54 / var(--tw-bg-opacity));
                    }
            .py-1{
                padding-top: 0.25rem;
                padding-bottom: 0.25rem;
                }
            .px-2{
                padding-left: 0.5rem;
                padding-right: 0.5rem;
                }
            .text-sm{
                    font-size: 0.875rem;
                    line-height: 1.25rem;
                    }
            .font-semibold{
                    font-weight: 600;
                    }
            .text-white{
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                    }

        </style>
    </head>
    <body>
    @php
    $policies = App\Models\Policy::all();
    @endphp
    
        <section class="header_area">
        <div class="navbar-area bg-white">
            <div class="container relative">
                <div class="row items-center">
                    <div class="w-full">
                        <nav class="flex items-center justify-between py-4 navbar navbar-expand-lg">
                            <a class="navbar-brand mr-5" href="#home">
                               <h4 >Car Policy Hub</h4>
                            </a>
                            <a class="navbar-brand mr-5" href="#home">
                                    <a href="#"><img src="/images/logo1.png" alt=""style="height: 100px; width: 150px; float: left;"></a>
                             </a>
                            <button class="block navbar-toggler focus:outline-none lg:hidden" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="absolute left-0 z-20 hidden w-full px-5 py-3 duration-300 bg-white lg:w-auto collapse navbar-collapse lg:block top-full mt-full lg:static lg:bg-transparent shadow lg:shadow-none" id="navbarOne">
                                <ul id="nav" class="items-center content-start mr-auto lg:justify-end navbar-nav lg:flex">
                                    <li class="nav-item ml-5 lg:ml-11">
                                        <a class="page-scroll active" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item ml-5 lg:ml-11">
                                        <a class="page-scroll active" href="#pricing">Products</a>
                                    </li>
                                    <li class="nav-item ml-5 lg:ml-11">
                                        <a class="page-scroll" href="#services">Services</a>
                                    </li>
                                    <li class="nav-item ml-5 lg:ml-11">
                                        <a class="page-scroll" href="#contact">Team</a>
                                    </li>
                                </ul>

                            </div> <!-- navbar collapse -->
                            <div>
    @if (Route::has('user.login'))
        <div>
            @auth
                <a class="m-2 inline-block rounded bg-black py-1 px-2 text-sm font-semibold text-white" href="{{ route('user.home') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <label class="m-2 inline-block rounded bg-black py-1 px-2 text-sm font-semibold">
                    Log in as:
                    <select onchange="window.location.href=this.value">
                        <option value="{{ route('user.home') }}"></option>
                        <option value="{{ route('user.login') }}">Insurer</option>
                        <option value="{{ route('doctor.login') }}">Client</option>
                        <option value="{{ route('admin.login') }}">Claims Staff</option>
                    </select>
                </label>

                @if (Route::has('user.register'))
                    <!--<a class="m-2 inline-block rounded bg-black py-1 px-2 text-sm font-semibold text-white" href="{{ route('user.register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> -->
                @endif
            @endauth
        </div>
    @endif
</div>



                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header navbar -->

        <div id="home" class="header_hero bg-gray relative z-10 overflow-hidden lg:flex items-center">
            <div class="hero_shape shape_1">
                <img src="/images/shape/shape-1.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_2">
                <img src="/images/shape/shape-2.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_3">
                <img src="/images/shape/shape-3.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_4">
                <img src="/images/shape/shape-4.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_6">
                <img src="/images/shape/shape-1.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_7">
                <img src="/images/shape/shape-4.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_8">
                <img src="/images/shape/shape-3.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_9">
                <img src="/images/shape/shape-2.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_10">
                <img src="/images/shape/shape-4.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_11">
                <img src="/images/shape/shape-1.svg" alt="shape">
            </div><!-- hero shape -->
            <div class="hero_shape shape_12">
                <img src="/images/shape/shape-2.svg" alt="shape">
            </div><!-- hero shape -->

            <div class="container">
                <div class="row">
                    <div class="w-full lg:w-1/2">
                        <div class="header_hero_content pt-150 lg:pt-0">
                            <h2 class="hero_title text-2xl sm:text-4xl md:text-5xl lg:text-4xl xl:text-5xl font-extrabold">#1<span class="text-theme-color"> Vehicle</span> Insurance Management System</h2>
                        </div> <!-- header hero content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header_shape hidden lg:block"></div>

            <div class="header_image flex items-center">
                <div class="image 2xl:pl-25">
                    <img src="/images/car-insurance.png" alt="Header Image" width="300" height="200">
                </div>
            </div> <!-- header image -->
        </div> <!-- header hero -->
    </section>

    <!--====== HEADER PART ENDS ======-->

    

      <!--====== PRICING PLAN PART START ======-->

      <section id="pricing" class="pricing_area pt-120 pb-120">
        <div class="container">
            <div class="row justify-center">
                <div class="w-full lg:w-1/2">
                    <div class="section_title text-center pb-6">
                        <h5 class="sub_title">Pricing Plans</h5>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="w-full">
                    
                    <div class="pricing_content mt-6_area">
                        <div class="tab-content">
                            <div class="active tab-pane" id="monthlyPlan" data-tab-content>
                                <div class="row justify-center">
                                @foreach($policies as $policy)
                                    <div class="w-full sm:w-9/12 md:w-7/12 lg:w-4/12">
                                        <div class="single_pricing text-center mt-8 mx-3 active">
                                            <div class="pricing_title relative inline-block">
                                                <h4 class="title group-hover:text-white">{{ $policy->policy_type }}</h4>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="112" height="110" viewBox="0 0 112 110">
                                                    <path class="services_shape" id="Polygon_15" data-name="Polygon 15" d="M51.2,2.329a11,11,0,0,1,9.6,0L96.15,19.478a11,11,0,0,1,5.927,7.466l8.76,38.665a11,11,0,0,1-2.1,9.258l-24.508,30.96A11,11,0,0,1,75.6,110H36.4a11,11,0,0,1-8.625-4.173L3.266,74.867a11,11,0,0,1-2.1-9.258l8.76-38.665a11,11,0,0,1,5.927-7.466Z" fill="#f94f4f"/>
                                                </svg>
                                            </div>
                                            <div class="pricing_content mt-6">
                                                <span class="pricing_price font-bold text-black text-4xl">${{ $policy->max_coverage_amount }} max</span>
                                                <p class="mt-4 leading-9">{{ $policy->coverage_information }} </p>
                                                <a href="{{ route('policy.report', $policy->id) }}" class="main-btn pricing_btn">More Information</a>
                                            </div>
                                        </div>  <!-- single pricing -->
                                    </div>
                                    @endforeach
                                </div> <!-- row -->
                                </div> <!-- row -->
                            </div>
                        </div>
                    </div> <!-- pricing menu -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PRICING PLAN PART ENDS ======-->

    <!--====== SERVICES PART START ======-->

    <section id="services" class="services_area pt-120 pb-120">
        <div class="container">
            <div class="row justify-center">
                <div class="w-full lg:w-1/2">
                    <div class="section_title text-center pb-6">
                        <h5 class="sub_title">What We Do</h5>
                        <h4 class="main_title">Our Services</h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-center">
                <div class="w-full sm:w-10/12 md:w-6/12 lg:w-4/12">
                    <div class="single_services text-center mt-8 mx-3">
                        <div class="services_icon">
                            <i class="lni lni-grid-alt"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                                <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                            </svg>
                        </div>
                        <div class="services_content mt-5 xl:mt-10">
                            <h3 class="services_title text-black font-semibold text-xl md:text-2xl lg:text-xl xl:text-3xl">Variety of features</h3>
                            <p class="mt-4">Insurance companies can manage policies, claims, premiums, payments, and customers with ease </p>
                        </div>
                    </div> <!-- single services -->
                </div>

                <div class="w-full sm:w-10/12 md:w-6/12 lg:w-4/12">
                    <div class="single_services text-center mt-8 mx-3">
                        <div class="services_icon">
                            <i class="lni lni-control-panel"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                                <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                            </svg>
                        </div>
                        <div class="services_content mt-5 xl:mt-10">
                            <h3 class="services_title text-black font-semibold text-xl md:text-2xl lg:text-xl xl:text-3xl">Policy Management</h3>
                            <p class="mt-4">Insurers can use our system to create, view, update, and delete policies seamlessly, manage claims effectively by creating, viewing, updating, and deleting them, and manage premiums using a customizable dashboard.</p>
                        </div>
                    </div> <!-- single services -->
                </div>

                <div class="w-full sm:w-10/12 md:w-6/12 lg:w-4/12">
                    <div class="single_services text-center mt-8 mx-3">
                        <div class="services_icon">
                            <i class="lni lni-revenue"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                                <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                            </svg>
                        </div>
                        <div class="services_content mt-5 xl:mt-10">
                            <h3 class="services_title text-black font-semibold text-xl md:text-2xl lg:text-xl xl:text-3xl">Payment Management</h3>
                            <p class="mt-4">Our payment management module integrates with payment gateways to make premium and claim payments easy and hassle-free.</p>
                        </div>
                    </div> <!-- single services -->
                </div>

                <div class="w-full sm:w-10/12 md:w-6/12 lg:w-4/12">
                    <div class="single_services text-center mt-8 mx-3">
                        <div class="services_icon">
                            <i class="lni lni-consulting"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                                <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                            </svg>
                        </div>
                        <div class="services_content mt-5 xl:mt-10">
                            <h3 class="services_title text-black font-semibold text-xl md:text-2xl lg:text-xl xl:text-3xl">Customer Management</h3>
                            <p class="mt-4">Provides authorized users with the ability to create customers, link policies to them, and manage customer records effectively</p>
                        </div>
                    </div> <!-- single services -->
                </div>

                <div class="w-full sm:w-10/12 md:w-6/12 lg:w-4/12">
                    <div class="single_services text-center mt-8 mx-3">
                        <div class="services_icon">
                            <i class="lni lni-bolt"></i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                                <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                            </svg>
                        </div>
                        <div class="services_content mt-5 xl:mt-10">
                            <h3 class="services_title text-black font-semibold text-xl md:text-2xl lg:text-xl xl:text-3xl">Streamlined System</h3>
                            <p class="mt-4">With our system, insurance companies can save time and resources, streamline operations, and deliver excellent customer service.</p>
                        </div>
                    </div> <!-- single services -->
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== SERVICES PART ENDS ======-->


    <!--====== TEAM PART START ======-->

    <section id="contact" class="team_area bg-gray pt-120 pb-120">
        <div class="container">
            <div class="row justify-center">
                <div class="w-full lg:w-1/2">
                    <div class="section_title text-center pb-6">
                        <h5 class="sub_title">Team</h5>
                        <h4 class="main_title">Meet Our Team Members</h4>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="team-wrapper relative">
                <div class="row team_active">
                    <div class="w-full lg:w-4/12">
                        <div class="single_team_item mx-auto">
                            <div class="single_team mx-2">
                                <div class="team_image relative">
                                    <img src="/images/guy1.png" alt="team" class="w-full">
                                    <ul class="social absolute top-4 right-8">
                                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team_content py-5 px-8 relative">
                                    <h4 class="team_name text-xl md:text-2xl"><a href="#" class="text-black group-hover:text-white">Shweth Maharaj</a></h4>
                                    <p class="mt-2 transition-all duration-300 group-hover:text-white">UI Designer</p>
                                </div>
                            </div> <!-- single team -->
                        </div>
                    </div>
                    <div class="w-full lg:w-4/12">
                        <div class="single_team_item mx-auto">
                            <div class="single_team mx-3">
                                <div class="team_image relative">
                                    <img src="/images/guy2.png" alt="team" class="w-full">
                                    <ul class="social absolute top-4 right-8">
                                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team_content py-5 px-8 relative">
                                    <h4 class="team_name text-xl md:text-2xl"><a href="#" class="text-black group-hover:text-white">Neeraj Ghutla</a></h4>
                                    <p class="mt-2 transition-all duration-300 group-hover:text-white">Database Administrator</p>
                                </div>
                            </div> <!-- single team -->
                        </div>
                    </div>
                    <div class="w-full lg:w-4/12">
                        <div class="single_team_item mx-auto">
                            <div class="single_team mx-3">
                                <div class="team_image relative">
                                    <img src="/images/girl1.png" alt="team" class="w-full">
                                    <ul class="social absolute top-4 right-8">
                                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team_content py-5 px-8 relative">
                                    <h4 class="team_name text-xl md:text-2xl"><a href="#" class="text-black group-hover:text-white">Jazbia Naem</a></h4>
                                    <p class="mt-2 transition-all duration-300 group-hover:text-white">Software Architect</p>
                                </div>
                            </div> <!-- single team -->
                        </div>
                    </div>
                    <div class="w-full lg:w-4/12">
                        <div class="single_team_item mx-auto">
                            <div class="single_team mx-3">
                                <div class="team_image relative">
                                    <img src="/images/guy3.png" alt="team" class="w-full">
                                    <ul class="social absolute top-4 right-8">
                                        <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-twitter-filled"></i></a></li>
                                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                                <div class="team_content py-5 px-8 relative">
                                    <h4 class="team_name text-xl md:text-2xl"><a href="#" class="text-black group-hover:text-white">Tushaar Sharma</a></h4>
                                    <p class="mt-2 transition-all duration-300 group-hover:text-white">Technical Writer</p>
                                </div>
                            </div> <!-- single team -->
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
        </div> <!-- container -->
    </section>

    <!--====== TEAM PART ENDS ======-->



    <!--====== FOOTER PART START ======-->

    <footer id="footer" class="footer_area bg-black relative z-10">
        <div class="shape absolute left-0 top-0 opacity-5 h-full overflow-hidden w-1/3">
            <img src="/images/footer-shape-left.png" alt="">
        </div>
        <div class="shape absolute right-0 top-0 opacity-5 h-full overflow-hidden w-1/3">
            <img src="/images/footer-shape-right.png" alt="">
        </div>
        <div class="container">
            <div class="footer_widget pt-18 pb-120">
                <div class="row justify-center">
                    <div class="w-full md:w-1/2 lg:w-3/12">
                        <div class="footer_about mt-13 mx-3">
                            <div class="footer_logo">
                                <a href="#"><img src="/images/logo1.png" alt=""></a>
                            </div>
                        </div> <!-- footer about -->
                    </div>
                    <div class="w-full md:w-1/2 lg:w-5/12">
                        <div class="footer_link_wrapper flex flex-wrap mx-3">
                            <div class="footer_link w-1/2 md:pl-13 mt-13">
                                <h2 class="footer_title text-xl font-semibold text-white">Quick Links</h2>
                                <ul class="link pt-4">
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">Company</a></li>
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">Privacy Policy</a></li>
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">About</a></li>
                                </ul>
                            </div> <!-- footer link -->
                            <div class="footer_link w-1/2 md:pl-13 mt-13">
                                <h2 class="footer_title text-xl font-semibold text-white">Resources</h2>
                                <ul class="link pt-4">
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">Support</a></li>
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">Contact</a></li>
                                    <li><a href="#" class="text-white mt-4 hover:text-theme-color">Terms</a></li>
                                </ul>
                            </div> <!-- footer link -->
                        </div> <!-- footer link wrapper -->
                    </div>
                    <div class="w-full md:w-2/3 lg:w-4/12">
                        <h2 class="footer_title text-xl font-semibold text-white">Designed and Developed By: </h2>
                                <ul class="link pt-4">
                                    <li><a  class="text-white mt-4 hover:text-theme-color">Shweth Maharaj</a></li>
                                    <li><a  class="text-white mt-4 hover:text-theme-color">Neeraj Ghutla</a></li>
                                    <li><a  class="text-white mt-4 hover:text-theme-color">Jazbia Naem</a></li>
                                    <li><a  class="text-white mt-4 hover:text-theme-color">Tushaar Sharma</a></li>
                                </ul>
                    </div>
                </div> <!-- row -->
            </div> <!-- footer widget -->
            <div class="footer_copyright pt-3 pb-6 border-t-2 border-solid border-white border-opacity-10 sm:flex justify-between">
                <div class="footer_social pt-4 mx-3 text-center">
                    <ul class="social flex justify-center sm:justify-start">
                        <li class="mr-3"><a href="https://facebook.com/uideckHQ"><i class="lni lni-facebook-filled"></i></a></li>
                        <li class="mr-3"><a href="https://twitter.com/uideckHQ"><i class="lni lni-twitter-filled"></i></a></li>
                        <li class="mr-3"><a href="https://instagram.com/uideckHQ"><i class="lni lni-instagram-original"></i></a></li>
                        <li class="mr-3"><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                            Developed using Laravel v{{ Illuminate\Foundation\Application::VERSION }} & PHP v{{ PHP_VERSION }}
                        </div>
                    </ul>
                </div> <!-- footer social -->
            </div> <!-- footer copyright -->
        </div> <!-- container -->
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="scroll-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">

                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->

        <script src="/js/tiny-slider.js"></script>

        <!--====== Wow js ======-->
        <script src="/js/wow.min.js"></script>

        <!--====== Main js ======-->
        <script src="/js/main.js"></script>
    </body>
</html>
