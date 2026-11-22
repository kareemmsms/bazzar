<?php
// Gift Cards Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Cards | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .giftcards-hero { background: linear-gradient(90deg,#f2c66d 60%,#e2b04a 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .giftcards-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .giftcards-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .giftcards-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .giftcards-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .giftcards-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .giftcards-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .giftcards-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .giftcards-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .giftcards-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .giftcards-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .giftcards-products { flex-direction:column; align-items:center; } .giftcards-card { width:90%; } }
    </style>
</head>
<body>
    <div class="giftcards-hero">
        <i class="fa-solid fa-credit-card"></i>
        <div class="giftcards-title">Gift Cards</div>
        <div class="giftcards-desc">Flexible, thoughtful, and perfect for any occasion. Give the gift of choice with Bazaar Gift Cards.</div>
    </div>
    <div class="giftcards-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Gift Cards</h2>
        <div class="giftcards-products">
            <div class="giftcards-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Birthday Card">
                <div class="giftcards-card-title">Birthday Card</div>
                <div class="giftcards-card-desc">Celebrate birthdays with a special gift card.</div>
            </div>
            <div class="giftcards-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Anniversary Card">
                <div class="giftcards-card-title">Anniversary Card</div>
                <div class="giftcards-card-desc">A memorable way to mark anniversaries.</div>
            </div>
            <div class="giftcards-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="Thank You Card">
                <div class="giftcards-card-title">Thank You Card</div>
                <div class="giftcards-card-desc">Show appreciation with a thoughtful gesture.</div>
            </div>
        </div>
    </div>
</body>
</html>
