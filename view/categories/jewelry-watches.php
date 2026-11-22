<?php
// Jewelry & Watches Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry & Watches | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .jewelry-hero { background: linear-gradient(90deg,#e2b04a 60%,#f2c66d 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .jewelry-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .jewelry-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .jewelry-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .jewelry-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .jewelry-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .jewelry-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .jewelry-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .jewelry-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .jewelry-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .jewelry-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .jewelry-products { flex-direction:column; align-items:center; } .jewelry-card { width:90%; } }
    </style>
</head>
<body>
    <div class="jewelry-hero">
        <i class="fa-solid fa-gem"></i>
        <div class="jewelry-title">Jewelry & Watches</div>
        <div class="jewelry-desc">Timeless elegance in jewelry and watches. Discover dazzling pieces for every occasion.</div>
    </div>
    <div class="jewelry-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Jewelry & Watches</h2>
        <div class="jewelry-products">
            <div class="jewelry-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254067.png" alt="Diamond Ring">
                <div class="jewelry-card-title">Diamond Ring</div>
                <div class="jewelry-card-desc">Sparkling diamonds set in elegant bands.</div>
            </div>
            <div class="jewelry-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254067.png" alt="Luxury Watch">
                <div class="jewelry-card-title">Luxury Watch</div>
                <div class="jewelry-card-desc">Precision and style for every wrist.</div>
            </div>
            <div class="jewelry-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254067.png" alt="Pearl Necklace">
                <div class="jewelry-card-title">Pearl Necklace</div>
                <div class="jewelry-card-desc">Classic pearls for timeless beauty.</div>
            </div>
        </div>
    </div>
</body>
</html>
