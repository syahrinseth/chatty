<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        .chat-container {
            display: flex;
            flex-direction: column;
        }

        .chat {
            border: 1px solid gray;
            border-radius: 3px;
            width: 50%;
            padding: 0.5em;
        }

        .chat-left {
            background-color: white;
            align-self: flex-start;
        }

        .chat-right {
            background-color: #3f9ae5;
            align-self: flex-end;
        }

        .message-input-container {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: white;
            border: 1px solid gray;
            padding: 1em;


        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        </div>
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        {{-- <script src="/js/firebase-messaging-sw.js"></script> --}}

        {{-- @yield('scripts') --}}
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"></script>
        <script>
            // Give the service worker access to Firebase Messaging.
            // Note that you can only use Firebase Messaging here, other Firebase libraries
            // are not available in the service worker.
            // importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
            // importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

            // Initialize the Firebase app in the service worker by passing in
            // your app's Firebase config object.
            // https://firebase.google.com/docs/web/setup#config-object
            var firebaseConfig = {
                apiKey: "AIzaSyArAVRN1xA3indWehtf5aXrW03tBLWEfj4",
                authDomain: "epnr-dev.firebaseapp.com",
                // databaseURL: "your app db url",
                projectId: "epnr-dev",
                storageBucket: "epnr-dev.appspot.com",
                messagingSenderId: "888997854888",
                appId: "1:888997854888:web:3cf977d8f320f79d390c9d"
            };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            // Retrieve an instance of Firebase Messaging so that it can handle background
            // messages.
            const messaging = firebase.messaging();

            messaging.setBackgroundMessageHandler(function(payload) {
                console.log('[firebase-messaging-sw.js] Received background message ', payload);
                // Customize notification here
                const {title, body} = payload.notification;
                const notificationOptions = {
                    body,
                };

                return self.registration.showNotification(title,
                    notificationOptions);
            });
        </script>
</body>
</html>
