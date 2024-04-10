@extends('coordinator.Website.layout.app')

@section('title', 'List Outstanding Ideas')

@section('main_content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">List Outstanding Ideas</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i> Back</a></li>
                            {{-- <li class="breadcrumb-item"><a href="#!">List Outstanding Ideas</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p>List of featured ideas</p>
    @foreach ($ideas as $idea)
        <p>Topic: {{ $idea->topic }}</p>
        <p>Tag: {{ $idea->tag }}</p>
    @endforeach

</section>
@endsection