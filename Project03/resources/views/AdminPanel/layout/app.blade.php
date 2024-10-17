@include('AdminPanel.layout.head')


<body class="bg-light">
    @include('AdminPanel.layout.navbar')

    <main>
        @yield('blogs')
        @yield('users')
        @yield('events')
        @yield('speakers')
        @yield('feedbacks')
        @yield('employees')
        @yield('generalInfo')
        @yield('comments')
        @yield('recommendations')
        @yield('login')
        @yield('register')
        @yield('welcome')


    </main>

    @include('AdminPanel.layout.footer')
    @include('AdminPanel.layout.scripts')

</body>

</html>