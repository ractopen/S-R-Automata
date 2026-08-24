<style>
    .logo-link {
        display: flex;
        align-items: center;
        gap: 00px;
    }

    .logo-name {
        height: 30px;
        width: auto;
        object-fit: contain;
        display: block;

    }

    .logo {
        height: 60px;
        width: auto;
        object-fit: contain;
        display: block;
        transform: translateY(-10px);
    }

    header a {
        text-decoration: none;
        color: #000;
        font-family: Arial;
        font-size: 14px;
    }

    header a:hover {
        color: pink;
    }

    header a.btn-signup {
        background-color: #135db2eb;
        border: transparent;
        padding: 10px;
        border-radius: 6px;
        color: #ffffff;
    }

    header a.btn-signup:hover {
        background-color: rgba(49, 134, 231, 0.81);
        color: #ffffffbb;
    }
</style>

<header
    style="background-color: transparent; padding-top: 50px; padding-right:50px; padding-bottom:20px; padding-left:50px;">

    <nav style="display: flex; justify-content: space-between; align-items: center;">


        <!-- LEFT SECTION -->
        <div>
            <a href="/" class="logo-link">
                <img src="images/logo.png" alt="Logo" class="logo">
                <img src="images/name.png" alt="Name" class="logo-name">
            </a>
        </div>

        <!-- CENTER SECTION -->
        <div style="display: flex; gap: 40px;">
            <a href="/">Home</a>
            <a href="#">Support</a>
            <a href="#">About Us</a>
            <a href="#">Services</a>
        </div>

        <!-- RIGHT SECTION -->
        <div>
            <a href="{{ route('register') }}" class="btn-signup">Get Started</a>
        </div>

    </nav>
</header>
