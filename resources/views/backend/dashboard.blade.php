@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')

    <div class="container">
        @foreach($list as $lis)
          <div class="icon"><i class="pic fab {{ $lis }} fa-lg"></i></div>
        @endforeach
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                <div class="card-body">
                    {!! __('strings.backend.welcome') !!}
                </div><!--card-body-->
            </div><!--card-->
            
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="card bg-primary text-white p-3">
                  <div class="card-body">
                    <div class="text-value">{{ $users }}</div>
                    <div>Usuarios clientes...</div>
                    <div class="progress progress-xs my-2">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="7" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                    {{-- <small class="text-muted">Lorem ipsum dolor sit amet enim.</small> --}}
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card bg-primary text-white p-3">
                  <div class="card-body">
                    <div class="text-value">
                        {{ $payments }}
                    </div>
                    <div>Inscripciones ...</div>
                    <div class="progress progress-xs my-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    {{-- <small class="text-muted">Lorem ipsum dolor sit amet enim.</small> --}}
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card bg-primary text-white p-3">
                  <div class="card-body">
                    <div class="text-value">{{ $sales }}</div>
                    <div>Ventas...</div>
                    <div class="progress progress-xs my-2">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    {{-- <small class="text-muted">Lorem ipsum dolor sit amet enim.</small> --}}
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card bg-primary text-white p-3">
                  <div class="card-body">
                    <div class="text-value">{{ $products }}</div>
                    <div>Productos...</div>
                    <div class="progress progress-xs my-2">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    {{-- <small class="text-muted">Lorem ipsum dolor sit amet enim.</small> --}}
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->


        </div><!--col-->
    </div><!--row-->
@endsection
