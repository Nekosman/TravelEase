<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-3" id="sidebar">
            <img id="sidebarLogo" src="{{ url('assets/img/logoTravel.png') }}" alt="Sidebar Image"
                class="img-fluid mx-auto d-block">
            <br>
            <button class="btn btn-muted" id="toggleButton">
                <i class="fa-solid fa-bars"></i>
            </button>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="home">
                        <i class="fas fa-comments"></i>
                        <span>Chat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket.index') }}">
                        <i class="fa-solid fa-ticket icon"></i>
                        <span>Ticketing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="faq">
                        <i class="fa-solid fa-question icon"></i>
                        <span>FAQ</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa-solid fa-gear icon"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); confirmLogout();">
                        <i class="fa-solid fa-right-from-bracket icon"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="content p-4">
            @yield('contents')
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const sidebarLogo = document.getElementById('sidebarLogo');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');

            // Ganti logo saat sidebar dikecilkan
            if (sidebar.classList.contains('collapsed')) {
                sidebarLogo.src = "{{ url('assets/img/logo_icon.png') }}"; // Gambar kecil
            } else {
                sidebarLogo.src = "{{ url('assets/img/logoTravel.png') }}"; // Gambar besar
            }
        });

        function setActiveNavLink() {
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        setActiveNavLink();

        function confirmLogout() {
            if (confirm("Apakah Anda ingin logout?")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>