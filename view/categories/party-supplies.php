<?php
// Party Supplies Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Supplies | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .party-hero { background: linear-gradient(90deg,#e2b04a 60%,#f2c66d 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .party-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .party-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .party-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .party-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .party-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .party-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .party-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .party-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .party-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .party-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .party-products { flex-direction:column; align-items:center; } .party-card { width:90%; } }
    </style>
</head>
<body>
    <div class="party-hero">
        <i class="fa-solid fa-champagne-glasses"></i>
        <div class="party-title">Party Supplies</div>
        <div class="party-desc">Everything you need for a perfect celebration. Decor, tableware, and more for every party!</div>
    </div>
    <div class="party-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Party Supplies</h2>
        <div class="party-products">
            <div class="party-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3176/3176290.png" alt="Balloons">
                <div class="party-card-title">Colorful Balloons</div>
                <div class="party-card-desc">Brighten up your party with vibrant balloons.</div>
            </div>
            <div class="party-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3176/3176290.png" alt="Party Hats">
                <div class="party-card-title">Party Hats</div>
                <div class="party-card-desc">Fun hats for guests of all ages.</div>
            </div>
            <div class="party-card">
                <img src="https://cdn-icons-png.flaticon.com/512/3176/3176290.png" alt="Tableware">
                <div class="party-card-title">Festive Tableware</div>
                <div class="party-card-desc">Stylish plates and cups for your event.</div>
            </div>
        </div>
    </div>
</body>
</html>
