<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/profile.png') }}" type="image/x-icon">
</head>
<body>
    <div class="strip">

    </div>
    <div class="strip2">

    </div>

    <div class="container">

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="main">
            <div class="card">
                <div class="card-header">
                    <h1>Login</h1>
                    <hr>
                    Selamat Datang
                </div>
                <form method="POST" action="{{ url('/home') }}">
                    @csrf

                    <div class="wrapper">
                        <label for="username">
                            Username
                        </label>
                        <input type="text"
                        @if ($errors->has('name'))
                        class="err"
                        @endif
                        onclick="white(this)"
                        id="username" name="name" minlength="6" placeholder="username" required/>
                    </div>

                    <div class="wrapper">
                        <label for="password">
                            Password
                        </label>
                        <input type="password"
                        @if ($errors->has('password'))
                        class="err"
                        @endif
                        onclick="white(this)"
                        id="password" name="password" minlength="8" placeholder="******" required/>
                    </div>

                    <div class="wrapper">
                        <input type="submit" class="submit" id="login" name="submit" value="Login"/>
                    </div>


                </form>
            </div>



            <div class="content">
                <div class="content-header">
                    Informasi Aplikasi
                </div>
                <div class="content-main">
                    Aplikasi Sistem Early Warning System dibuat untuk membantu para pihak Bank dalam mendeteksi kemacetan kredit yaitu bertujuan untuk memperkecil resiko kredit.
                </div>
                <hr class="hor">
                <div class="content-main">
                    <ul>
                        <li>
                            Jumlah Nasabah <span>1000</span>
                        </li>
                        <li>
                            Jumlah Pengguna Hari ini <span>999</span>
                        </li>
                        <li>
                            Jumlah Pengguna Kemarin <span>888</span>
                        </li>
                        <li>
                            Total Pengguna <span>12000</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>



    <script>
        function white($el){
            if($el.classList[0])
                $el.classList.toggle('err');
        }
    </script>

</body>
</html>
