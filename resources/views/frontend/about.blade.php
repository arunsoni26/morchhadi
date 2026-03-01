@extends('frontend.layouts.app')
@section('title', 'Morchhadi — About Us')

@section('content')

<style>
    /* SAME THEME AS HOME PAGE */
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(120deg, #fffdf8, #fef6e6);
        color: #3a2e2a;
    }

    /* HERO */
    .about-hero {
        min-height: 70vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 80px 0;
    }

    /* floating gradient background */
    .about-hero::before {
        content: "";
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, #ffb34730, #ff7a0020);
        border-radius: 50%;
        top: -200px;
        right: -150px;
        z-index: 0;
        animation: floatBg 8s ease-in-out infinite alternate;
    }

    .about-hero::after {
        content: "";
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, #ff7a0025, #ffb34720);
        border-radius: 50%;
        bottom: -200px;
        left: -150px;
        z-index: 0;
        animation: floatBg2 10s ease-in-out infinite alternate;
    }

    @keyframes floatBg {
        0% {
            transform: translateY(0px);
        }

        100% {
            transform: translateY(40px);
        }
    }

    @keyframes floatBg2 {
        0% {
            transform: translateX(0px);
        }

        100% {
            transform: translateX(40px);
        }
    }

    /* GLASS CARD */
    .glass-box {
        background: #ffffff;
        padding: 60px;
        border-radius: 30px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.08);
        position: relative;
        z-index: 2;
        animation: fadeUp 1.2s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* SECTION TITLE */
    .section-title {
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }

    .section-title::after {
        content: "";
        width: 80px;
        height: 4px;
        background: linear-gradient(45deg, #c56a00, #ff8c00);
        display: block;
        margin: 10px auto;
        border-radius: 10px;
    }

    /* FEATURE BOX */
    .feature-box {
        background: #fff;
        padding: 35px;
        border-radius: 25px;
        transition: 0.4s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
    }

    .feature-box:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 80px rgba(255, 140, 0, 0.2);
    }

    .icon {
        font-size: 45px;
    }

    /* FOUNDER CARD */
    .founder-card {
        background: #fff;
        padding: 40px;
        border-radius: 30px;
        text-align: center;
        transition: 0.4s;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    }

    .founder-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 80px rgba(255, 140, 0, 0.2);
    }

    /* FADE SCROLL */
    .fade-section {
        opacity: 0;
        transform: translateY(60px);
        transition: 1s ease;
    }

    .fade-section.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- HERO -->
<section class="about-hero">
    <div class="container">
        <div class="glass-box text-center">
            <h1 class="fw-bold display-5">
                Har Cup Me Bharosa,<br>
                Har Swad Me Morchhadi Ka Vaada ☕
            </h1>
            <p class="mt-3">
                Morchhadi Chai ka mission hai har ghar tak asli kadak chai pahunchana.
            </p>
        </div>
    </div>
</section>


<!-- STORY -->
<section class="container py-5 fade-section">
    <h2 class="section-title">Hamari Kahani</h2>
    <div class="glass-box">
        <p style="line-height:1.9; font-size:17px;">
            Morchhadi Chai ka safar ek simple mission se shuru hua —
            logon tak asli aur premium chai ka swad pahunchana. Hum believe karte hain chai sirf ek drink nahi,
            balki har ghar ki emotion hai.
            <br><br>

            Isliye hum quality par kabhi compromise nahi karte. Har batch ko carefully select aur hygienically pack kiya jata hai taaki har cup me same kadak taste mile.
            <br><br>

            Hum retail customers ke saath-saath wholesalers aur shopkeepers ko bhi bulk supply provide karte hain.
        </p>
    </div>
</section>


<!-- WHY CHOOSE -->
<section class="container py-5 fade-section">
    <h2 class="section-title">Why Choose Morchhadi?</h2>
    <div class="row g-4 mt-4">
        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon">🌿</div>
                <h5 class="mt-3">Premium Quality Leaves</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon">🔥</div>
                <h5 class="mt-3">Kadak & Consistent Taste</h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-box text-center">
                <div class="icon">📦</div>
                <h5 class="mt-3">Bulk & Retail Supply</h5>
            </div>
        </div>
    </div>
</section>


<!-- FOUNDER -->
<section class="container py-5 fade-section">
    <h2 class="section-title">Founder</h2>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="founder-card">
                <img src="{{ asset('img/images/founder.jpeg') }}"
                    class="rounded-circle mb-3"
                    width="160">
                <h5>Santosh Sen</h5>
            </div>
        </div>
    </div>
</section>

<script>
    const sections = document.querySelectorAll('.fade-section');
    window.addEventListener('scroll', () => {
        const triggerBottom = window.innerHeight * 0.85;
        sections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            if (sectionTop < triggerBottom) {
                section.classList.add('show');
            }
        });
    });
</script>

@endsection