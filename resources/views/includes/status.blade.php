     @if ($errors->any())
                    <div class="alert alert-danger fade-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-secondary text-center fade-message">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- @section('script') --}}
                    <script>
                    $(function(){
        setTimeout(function() {
            $('.fade-message').slideUp();
        }, 2000);
    });
    </script>

