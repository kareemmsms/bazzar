<?php
// Statues Fashion Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statues Fashion | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .statues-hero { background: linear-gradient(90deg,#e2b04a 60%,#f2c66d 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .statues-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .statues-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .statues-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .statues-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .statues-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .statues-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .statues-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .statues-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .statues-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .statues-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .statues-products { flex-direction:column; align-items:center; } .statues-card { width:90%; } }
    </style>
</head>
<body>
    <div class="statues-hero">
        <i class="fa-solid fa-person-dress"></i>
        <div class="statues-title">Statues Fashion</div>
        <div class="statues-desc">Unique statue-inspired fashion and artistic wear. Express yourself with bold, creative styles!</div>
    </div>
    <div class="statues-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Statues Fashion</h2>
        <div class="statues-products">
            <div class="statues-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3469/3469105.png" alt="Statue Dress">
                <div class="statues-card-title">Statue Dress</div>
                <div class="statues-card-desc">Inspired by classic sculptures. Limited edition.</div>
            </div>
            <div class="statues-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3469/3469105.png" alt="Artistic Cape">
                <div class="statues-card-title">Artistic Cape</div>
                <div class="statues-card-desc">Wearable art for the bold and creative.</div>
            </div>
            <div class="statues-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3469/3469105.png" alt="Sculpted Shoes">
                <div class="statues-card-title">Sculpted Shoes</div>
                <div class="statues-card-desc">Step into style with statue-inspired footwear.</div>
            </div>
        </div>
    </div>
</body>
</html>
