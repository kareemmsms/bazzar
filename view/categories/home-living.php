<?php
// Home & Living Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home & Living | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .home-hero { background: linear-gradient(90deg,#e2b04a 60%,#f2c66d 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .home-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .home-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .home-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .home-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .home-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .home-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .home-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .home-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .home-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .home-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .home-products { flex-direction:column; align-items:center; } .home-card { width:90%; } }
    </style>
</head>
<body>
    <div class="home-hero">
        <i class="fa-solid fa-couch"></i>
        <div class="home-title">Home & Living</div>
        <div class="home-desc">Elevate your space with stylish decor, furniture, and essentials for comfortable living.</div>
    </div>
    <div class="home-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Home & Living</h2>
        <div class="home-products">
            <div class="home-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046857.png" alt="Decor Vase">
                <div class="home-card-title">Decor Vase</div>
                <div class="home-card-desc">Add elegance with beautiful vases and decor.</div>
            </div>
            <div class="home-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046857.png" alt="Comfy Sofa">
                <div class="home-card-title">Comfy Sofa</div>
                <div class="home-card-desc">Relax in style with our premium sofas.</div>
            </div>
            <div class="home-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046857.png" alt="Wall Art">
                <div class="home-card-title">Wall Art</div>
                <div class="home-card-desc">Express your taste with unique wall art.</div>
            </div>
        </div>
    </div>
</body>
</html>
