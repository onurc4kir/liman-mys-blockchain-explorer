@extends('layouts.master')

@section('content')


<h2 class="text-bold">{{ __("Blockchain Gezgini") }}</h2>

<ul class="nav nav-tabs" role="tablist" style="margin-bottom: 25px; font-size:16px;">

<li class="nav-item">
        <a class="nav-link active" onclick="exploreBlockchain()" href="#blockchain-explorer" data-toggle="tab">
            <i class="fas fa-server"></i> {{ __("Blockchain Explorer") }}
        </a>
    </li>
    
    
    

    <li class="nav-item">
        <a  class="nav-link" onclick="getLatestNews()" href="#latest-news" data-toggle="tab">
            <i class="fas fa-server"></i> {{ __("Son Gelişmeler") }}
        </a>
    </li>


    <li class="nav-item">
        <a id="coin-analiz" class="nav-link" 
        onclick="getCoinAnalyze()" href="#trend-analyzer" data-toggle="tab">
            <i class="fas fa-server"></i> {{ __("Trend Takipçisi") }}
        </a>
    </li>
    
  
</ul>

<div class="tab-content">
    <div id="blockchain-explorer" class="tab-pane active">
        @include('blockchainexplorer.main')
    </div>
    <div id="latest-news" class="tab-pane">
          @include('latestnews.main')
    </div>
    <div id="trend-analyzer" class="tab-pane">
     @include('trendanalyzer.main')
    </div>
</div>
@endsection
