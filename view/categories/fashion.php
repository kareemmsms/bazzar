<?php
// Fashion Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .fashion-hero { background: linear-gradient(90deg,#f2c66d 60%,#e2b04a 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .fashion-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .fashion-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .fashion-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .fashion-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .fashion-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .fashion-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .fashion-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .fashion-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .fashion-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .fashion-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .fashion-products { flex-direction:column; align-items:center; } .fashion-card { width:90%; } }
    </style>
</head>
<body>
    <div class="fashion-hero">
        <i class="fa-solid fa-shirt"></i>
        <div class="fashion-title">Fashion</div>
        <div class="fashion-desc">Latest trends in clothing, shoes, and accessories. Discover your style at Bazaar Fashion.</div>
    </div>
    <div class="fashion-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Fashion Products</h2>
        <div class="fashion-products">
            <div class="fashion-card">
                <img src="https://cdn-icons-png.flaticon.com/512/892/892458.png" alt="Dress">
                <div class="fashion-card-title">Elegant Dress</div>
                <div class="fashion-card-desc">Perfect for any occasion. Available in multiple colors.</div>
            </div>
            <div class="fashion-card">
                <img src="https://cdn-icons-png.flaticon.com/512/892/892458.png" alt="Sneakers">
                <div class="fashion-card-title">Trendy Sneakers</div>
                <div class="fashion-card-desc">Comfort meets style. New arrivals just in!</div>
            </div>
            <div class="fashion-card">
                <img src="https://cdn-icons-png.flaticon.com/512/892/892458.png" alt="Bag">
                <div class="fashion-card-title">Designer Bag</div>
                <div class="fashion-card-desc">Carry your essentials in style with our exclusive bags.</div>
            </div>
        </div>
    </div>
</body>
</html>
