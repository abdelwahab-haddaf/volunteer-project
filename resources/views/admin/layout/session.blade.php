

        @if(session('success'))
                <script>
                    new Noty({
                        type:'success',
                        layout:'bottomCenter',
                        text:"{{session('success')}}",
                        timeout:5000,
                        killer: true,
                    }).show();

            </script>
        @endif

