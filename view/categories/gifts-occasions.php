<?php
// Gifts & Occasions Page
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gifts & Occasions | Bazaar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { background: linear-gradient(120deg,#fff9ed 0%,#fbeedc 100%); font-family:'Segoe UI',Arial,sans-serif; }
        .gifts-hero { background: linear-gradient(90deg,#f2c66d 60%,#e2b04a 100%); color: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a33; padding: 38px 18px 26px 18px; margin: 36px auto 28px auto; max-width: 700px; text-align:center; }
        .gifts-hero i { font-size: 3.5rem; margin-bottom: 12px; }
        .gifts-section { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px #e2b04a22; padding: 32px 24px; max-width: 900px; margin: 0 auto 32px auto; }
        .gifts-title { color: #c19a6b; font-weight: 800; font-size: 2.1rem; margin-bottom: 10px; }
        .gifts-desc { color: #7c6845; font-size: 1.18rem; margin-bottom: 24px; }
        .gifts-products { display: flex; flex-wrap: wrap; gap: 26px; justify-content: center; }
        .gifts-card { background: linear-gradient(100deg,#fffbe9 70%,#ffe7b8 100%); border-radius: 14px; box-shadow: 0 2px 16px #e2b04a22; padding: 22px 18px; width: 260px; text-align:center; transition: transform 0.14s, box-shadow 0.15s; }
        .gifts-card:hover { transform: translateY(-6px) scale(1.03); box-shadow: 0 6px 32px #e2b04a33; }
        .gifts-card img { width: 80px; height: 80px; object-fit:contain; margin-bottom: 10px; }
        .gifts-card-title { font-weight: 700; color: #e2b04a; font-size: 1.13rem; margin-bottom: 7px; }
        .gifts-card-desc { color: #7c6845; font-size: 1.01rem; }
        @media (max-width:700px) { .gifts-products { flex-direction:column; align-items:center; } .gifts-card { width:90%; } }
    </style>
</head>
<body>
    <div class="gifts-hero">
        <i class="fa-solid fa-gift"></i>
        <div class="gifts-title">Gifts & Occasions</div>
        <div class="gifts-desc">Perfect presents for every event. Find thoughtful gifts for your loved ones and special moments.</div>
    </div>
    <div class="gifts-section">
        <h2 class="mb-4" style="color:#e2b04a; font-weight:800;">Featured Gifts & Occasions</h2>
        <div class="gifts-products">
            <div class="gifts-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254062.png" alt="Birthday Gift">
                <div class="gifts-card-title">Birthday Gift</div>
                <div class="gifts-card-desc">Celebrate with joy and surprise!</div>
            </div>
            <div class="gifts-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254062.png" alt="Anniversary Gift">
                <div class="gifts-card-title">Anniversary Gift</div>
                <div class="gifts-card-desc">Memorable gifts for special milestones.</div>
            </div>
            <div class="gifts-card">
                <img src="https://cdn-icons-png.flaticon.com/512/254/254062.png" alt="Graduation Gift">
                <div class="gifts-card-title">Graduation Gift</div>
                <div class="gifts-card-desc">Congratulate achievements with style.</div>
            </div>
        </div>
    </div>
</body>
</html>
