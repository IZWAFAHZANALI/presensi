<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi! Selamat Datang di MPSNET</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-soft: #f0f4ff;
            --mps-navy: #000066;
            --mps-red: #ff4d6d;
            --accent-blue: #a2d2ff;
            --card-white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-soft);
            background-image: radial-gradient(#d1d9ff 1px, transparent 1px);
            background-size: 20px 20px;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            background: var(--card-white);
            padding: 40px;
            border-radius: 40px;
            box-shadow: 0 20px 0px rgba(0, 0, 102, 0.05), 0 30px 60px rgba(0, 0, 0, 0.1);
            width: 90%; /* Tambahan agar responsive di HP */
            /* --- PERBAIKAN: Max-width dikurangi agar kolom tidak "kepanjangan" --- */
            max-width: 380px; 
            position: relative;
            border: 4px solid #fff;
        }

        .login-container::before, .login-container::after {
            content: '';
            position: absolute;
            top: -20px;
            width: 60px;
            height: 40px;
            background: var(--mps-navy);
            border-radius: 50% 50% 0 0;
            z-index: -1;
        }
        .login-container::before { left: 40px; transform: rotate(-15deg); }
        .login-container::after { right: 40px; transform: rotate(15deg); }

        .logo-box {
            background: #fff;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: -90px auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border: 5px solid var(--bg-soft);
        }

        .logo-box img {
            width: 70%;
            height: auto;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            color: var(--mps-navy);
            font-weight: 800;
            text-align: center;
            margin-bottom: 5px;
            font-size: 1.4rem; /* Disesuaikan dengan lebar kotak baru */
            letter-spacing: -0.5px;
            text-shadow: 2px 2px 0px rgba(255, 255, 255, 0.8);
        }

        p.subtitle {
            text-align: center;
            color: #777;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .input-group-custom {
            margin-bottom: 20px;
        }

        .input-group-custom label {
            display: block;
            margin-left: 15px;
            margin-bottom: 5px;
            font-weight: 700;
            color: var(--mps-navy);
            font-size: 14px;
        }

        .input-group-custom input {
            width: 100%;
            padding: 12px 25px; 
            border-radius: 50px;
            border: 2px solid #eee;
            background: #fdfdfd;
            transition: all 0.3s ease;
            outline: none;
            box-sizing: border-box; /* Agar padding tidak menambah lebar */
        }

        .input-group-custom input:focus {
            border-color: var(--accent-blue);
            background: #fff;
            box-shadow: 0 0 15px rgba(162, 210, 255, 0.4);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 50px;
            background: var(--mps-navy);
            color: white;
            font-weight: 800;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 0px #000044;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 11px 0px #000044;
            background: #437bbb;
        }

        .btn-login:active {
            transform: translateY(7px);
            box-shadow: 0 2px 0px #000044;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating-deco {
            position: absolute;
            z-index: -1;
            animation: float 3s ease-in-out infinite;
            opacity: 0.5;
        }

        .alert-cute {
            border-radius: 20px;
            border: none;
            background: #ffe5ec;
            color: #ff4d6d;
            font-weight: 700;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <div class="floating-deco" style="top: 10%; left: 15%; width: 50px; height: 50px; background: #ffc8dd; border-radius: 50%;"></div>
    <div class="floating-deco" style="bottom: 15%; right: 10%; width: 80px; height: 80px; background: #cdb4db; border-radius: 50%; animation-delay: 1s;"></div>
    <div class="floating-deco" style="top: 20%; right: 20%; width: 30px; height: 30px; background: #a2d2ff; border-radius: 50%; animation-delay: 0.5s;"></div>

    <div class="login-container">
        <div class="logo-box">
            <img src="<?= base_url('assets/images/logo/logo-mpsnet.PNG') ?>" alt="Logo MPSNET">
        </div>

        <h2>
            <span style="color: #000066;">MEDIA PRATAMA</span> 
            <span style="color: #cc0000;">SOLUSINET</span>
        </h2>
        <p class="subtitle">✨ IT Consultant ✨</p>

        <?php if(!empty(session()->getFlashdata('pesan'))) : ?>
            <div class="alert alert-cute alert-dismissible fade show" role="alert">
                <span class="me-2">Oops!</span> <?= session()->getFlashdata('pesan') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <form method="POST" action="<?= base_url('login') ?>">
            <div class="input-group-custom">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username..." required>
            </div>

            <div class="input-group-custom">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password..." required>
            </div>

            <button type="submit" class="btn-login">
                Masuk Dashboard 🚀
            </button>
        </form>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>