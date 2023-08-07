<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <h3>Merchant</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="domain">Domain</label>
                                        <input type="text" class="form-control" id="domain" name="doamin" placeholder="Enter Domain">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="api_key">Password</label>
                                        <input type="password" class="form-control" id="api_key" name="api_key" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="registerMerchant()">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function registerMerchant() {
                var formData = {
                    domain: document.getElementById('domain').value,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    api_key: document.getElementById('api_key').value,
                };

                // Call your function with the form data
                registerMerchantFunction(formData);
            }
            function registerMerchantFunction(formData) {
                $.ajax({
                    url: '/merchant-store',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                    },
                    error: function(error) {
                        // Handle error response
                    }
                });
            }
        </script>
    </body>
</html>
