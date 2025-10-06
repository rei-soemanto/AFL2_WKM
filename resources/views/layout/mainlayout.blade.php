<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WKM @yield('name')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logoWKM.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/siema@latest/dist/siema.min.js"></script>
</head>
<body>
    @include('layout.navigation')
    @yield('content')
    @include('layout.footer')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</body>
<script>
    $(document).ready(function () {
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 800);
            }
        });
    });

    $("#contactForm").on("submit", function (e) {
        e.preventDefault();

        emailjs.sendForm('wkmukti', 'template_6uyoxto', this)
            .then(function () {
                alert("Message sent successfully!");
                $("#contactForm")[0].reset();
            }, function (error) {
                alert("Failed to send message. Please try again.");
                console.error(error);
            });
        });
</script>
</html>