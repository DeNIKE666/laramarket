<div class="container-fluid page-body-wrapper">
    @include('layouts.partials.dashboard.sidebar')


    <div class="main-panel">
        <div class="content-wrapper">
            @if($errors->any())
                <div class="alert-danger alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')

        </div>

        @include('layouts.partials.dashboard.footer')



    </div>
    <!-- main-panel ends -->
</div>
