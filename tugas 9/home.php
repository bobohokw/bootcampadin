<?php
// 1. KONEKSI DATABASE
$koneksi = mysqli_connect("localhost", "root", "jakarta48", "ecommerce_dino");

// 2. AMBIL DATA PRODUK DARI DATABASE
$ambil = mysqli_query($koneksi, "SELECT * FROM products ORDER BY id DESC");
$produk_db = [];
while($row = mysqli_fetch_assoc($ambil)){
    $produk_db[] = [
        'id' => (int)$row['id'],
        'cat' => 'Koleksi Dino', 
        'name' => $row['nama_produk'],
        'price' => (int)$row['harga'],
        'img' => 'img/' . $row['gambar'], // Mencari di folder img/
        'desc' => $row['deskripsi']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DinoMarket | Sahabat Purba, Gaya Masa Depan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --dino-primary: #00b894; --dino-secondary: #0984e3; --dino-danger: #ff7675; 
            --bg-body: #f8fafc; --glass: rgba(255, 255, 255, 0.9);
        }
        
        body { background: var(--bg-body); font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; scroll-behavior: smooth; }

        /* PROMO BAR */
        .promo-bar { background: #0de9ae; overflow: hidden; white-space: nowrap; padding: 10px 0; }
        .promo-text { display: inline-block; color: #ffffff; font-weight: 500; animation: promoScroll 18s linear infinite; }
        @keyframes promoScroll { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }

        /* NAVBAR */
        .navbar { background: var(--glass); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(0,0,0,0.05); padding: 0.7rem 0; }
        .nav-container { padding: 0 24px; width: 100%; }
        .logo-icon { 
            background: linear-gradient(135deg, var(--dino-primary), var(--dino-secondary)); 
            width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; 
            justify-content: center; color: white; cursor: pointer; box-shadow: 0 6px 12px rgba(0,184,148,0.2);
        }

        /* TYPEWRITER */
        .typewriter-box {
            flex-grow: 1; text-align: center; max-width: 450px; background: rgba(0, 184, 148, 0.08); 
            border-radius: 50px; padding: 6px 20px; margin: 0 20px; border: 1px dashed var(--dino-primary);
            height: 34px; display: flex; align-items: center; justify-content: center;
        }
        #dinoTypewriter { font-size: 13px; font-weight: 700; color: var(--dino-primary); white-space: nowrap; }

        /* CARDS */
        .p-card { 
            border: none; border-radius: 24px; background: white; transition: 0.4s; height: 100%; 
            overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); position: relative; border: 1px solid rgba(0,0,0,0.03);
        }
        .p-card:hover { transform: translateY(-10px); box-shadow: 0 20px 25px rgba(0,0,0,0.08); border-color: var(--dino-primary); }
        .p-img-wrap { width: 100%; aspect-ratio: 1/1; overflow: hidden; background: #f1f5f9; }
        .p-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: 0.6s; }
        
        .fav-btn { 
            position: absolute; top: 12px; right: 12px; z-index: 10; background: white; border: none; 
            width: 32px; height: 32px; border-radius: 10px; display: flex; align-items: center; 
            justify-content: center; color: #cbd5e1;
        }
        .fav-btn.active { color: var(--dino-danger); }

        /* FLASH SALE */
        .flash-sale-box { background: linear-gradient(135deg, #ef4444, #f87171); border-radius: 32px; padding: 2rem; color: white; margin-bottom: 3rem; }
        .timer-unit { background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); padding: 8px 12px; border-radius: 10px; font-weight: 800; display: inline-block; min-width: 45px; text-align: center; }

        footer { background: #0f172a; color: #94a3b8; padding: 80px 0 40px; border-radius: 60px 60px 0 0; margin-top: 100px; }
        #toast { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); background: #1e293b; color: white; padding: 14px 30px; border-radius: 16px; display: none; z-index: 10000; font-weight: 600; }
        .pointer { cursor: pointer; }
        .fw-800 { font-weight: 800; }
    </style>
</head>
<body>

<div id="toast">🦖 Roar! Berhasil!</div>

<div class="promo-bar text-center">
    <div class="promo-text">⚡ DINO SALE 2026: GUNAKAN KODE "RAWR" UNTUK CASHBACK 100% | GRATIS ONGKIR SEJAGAT RAYA! ⚡</div>
</div>

<nav class="navbar sticky-top">
    <div class="nav-container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button class="btn border-0 p-0 me-3" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"><i class="bi bi-list fs-1 text-dark"></i></button>
                <div class="logo-icon me-2">🦖</div>
                <div class="d-none d-md-block">
                    <span class="fw-800 fs-5 d-block">DinoMarket</span>
                    <span class="small opacity-75">Sahabat Purba, Gaya Masa Depan</span>
                </div>
            </div>
            <div class="typewriter-box"><div id="dinoTypewriter"></div></div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-dark rounded-pill px-4 btn-sm fw-700" onclick="location.href='tambah_user.php'">Gabung</button>
                <div class="position-relative pointer p-1" data-bs-toggle="offcanvas" data-bs-target="#cartBox">
                    <i class="bi bi-handbag-fill fs-2 text-primary"></i>
                    <span id="cartCount" class="badge rounded-circle bg-danger position-absolute top-0 start-50 translate-middle" style="font-size: 10px;">0</span>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="flash-sale-box shadow-lg">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <h2 class="fw-800 m-0"><i class="bi bi-lightning-charge-fill text-warning"></i> FLASH SALE</h2>
            <div class="d-flex gap-2 align-items-center">
                <span class="timer-unit" id="h-box">00</span> : <span class="timer-unit" id="m-box">00</span> : <span class="timer-unit" id="s-box">00</span>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-3" id="flashGrid"></div>
    </div>

    <div class="bg-white p-4 rounded-4 shadow-sm mb-5">
        <div class="row g-3">
            <div class="col-lg-7"><input type="text" id="searchInput" class="form-control bg-light border-0" placeholder="Cari barang purba..." onkeyup="filterProducts()"></div>
            <div class="col-lg-5">
                <select id="filterPrice" class="form-select border-0 bg-light fw-600" onchange="filterProducts()">
                    <option value="default">Urutkan Harga</option>
                    <option value="low">Terendah</option>
                    <option value="high">Tertinggi</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="fw-800 mb-4">Koleksi Produk 🦕</h4>
    <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-4" id="mainGrid"></div>
</div>

<footer>
    <div class="container text-center text-md-start">
        <div class="row g-5">
            <div class="col-lg-4"><h4 class="text-white fw-800 mb-4">DinoMarket</h4><p class="small opacity-75">Marketplace masa kini dengan teknologi purba terdepan.</p></div>
            <div class="col-lg-8 text-md-end pt-md-5"><p class="small opacity-50">© 2026 DinoMarket Indonesia. Made with Dino-Power.</p></div>
        </div>
    </div>
</footer>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content overflow-hidden rounded-5 border-0">
            <div class="row g-0">
                <div class="col-md-6"><img id="mdImg" src="" class="w-100 h-100 object-fit-cover"></div>
                <div class="col-md-6 p-4 p-md-5 bg-white">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <h2 id="mdName" class="fw-800 mb-2"></h2>
                    <h3 id="mdPrice" class="text-primary fw-800 mb-4"></h3>
                    <p id="mdDesc" class="text-muted lh-lg mb-4"></p>
                    <button class="btn btn-success w-100 py-3 rounded-pill fw-800 shadow" onclick="addToCart()">TAMBAH KERANJANG 🛒</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start" id="sidebarMenu">
    <div class="offcanvas-header border-bottom p-4"><h5 class="fw-800 m-0">MENU UTAMA</h5><button class="btn-close" data-bs-dismiss="offcanvas"></button></div>
    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush">
            <a href="index.php" class="list-group-item py-4 px-4 fw-800 text-danger border-0">⚙️ ADMIN PANEL</a>
            <a href="tambah_user.php" class="list-group-item py-4 px-4 fw-800 border-0">👥 DATA USER</a>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" id="cartBox">
    <div class="offcanvas-header border-bottom p-4"><h5 class="fw-800 m-0">KERANJANG</h5><button class="btn-close" data-bs-dismiss="offcanvas"></button></div>
    <div class="offcanvas-body d-flex flex-column p-4">
        <div id="cartList" class="flex-grow-1 overflow-auto"></div>
        <div class="mt-auto pt-4 border-top">
            <div class="d-flex justify-content-between mb-3"><span class="fw-600">Total</span><span id="cartTotal" class="fw-800 text-primary fs-5">Rp 0</span></div>
            <button class="btn btn-success w-100 py-3 rounded-pill fw-800" onclick="checkout()">CHECKOUT (WA)</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // DATA DARI PHP
    const ITEMS = <?php echo json_encode($produk_db); ?>;
    let cart = [], favs = [], currentId = null;

    // TIMER FLASH SALE (BERDETAK)
    function startTimer() {
        let h = 2, m = 45, s = 0;
        setInterval(() => {
            if(s==0){ if(m==0){ if(h==0) return; h--; m=59; } else { m--; } s=59; } else { s--; }
            document.getElementById('h-box').innerText = String(h).padStart(2,'0');
            document.getElementById('m-box').innerText = String(m).padStart(2,'0');
            document.getElementById('s-box').innerText = String(s).padStart(2,'0');
        }, 1000);
    }

    // TYPEWRITER
    const dinoTexts = ["🦖 Roar! Produk Baru!", "🚚 Gratis Ongkir!", "🔥 Diskon Purba!"];
    let tIdx = 0, cIdx = 0, isDel = false;
    function typeWriter() {
        const target = document.getElementById("dinoTypewriter");
        const fullTxt = dinoTexts[tIdx];
        target.textContent = isDel ? fullTxt.substring(0, cIdx--) : fullTxt.substring(0, cIdx++);
        if (!isDel && cIdx > fullTxt.length) { isDel = true; setTimeout(typeWriter, 2000); }
        else if (isDel && cIdx < 0) { isDel = false; tIdx = (tIdx + 1) % dinoTexts.length; setTimeout(typeWriter, 500); }
        else { setTimeout(typeWriter, isDel ? 40 : 80); }
    }

    function filterProducts() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        let pool = ITEMS.filter(x => x.name.toLowerCase().includes(q));
        const sort = document.getElementById('filterPrice').value;
        if(sort==='low') pool.sort((a,b)=>a.price-b.price);
        if(sort==='high') pool.sort((a,b)=>b.price-a.price);

        document.getElementById('mainGrid').innerHTML = pool.map(x => `
            <div class="col" onclick="openDetail(${x.id})">
                <div class="p-card">
                    <button class="fav-btn ${favs.includes(x.id)?'active':''}" onclick="event.stopPropagation(); toggleFav(${x.id})"><i class="bi bi-heart-fill"></i></button>
                    <div class="p-img-wrap"><img src="${x.img}" onerror="this.src='https://placehold.co/400x400?text=No+Image'"></div>
                    <div class="p-3">
                        <small class="fw-700 text-primary opacity-75 text-uppercase" style="font-size:10px">DATABASE ITEM</small>
                        <div class="fw-700 text-truncate my-1">${x.name}</div>
                        <div class="text-dark fw-800">Rp ${x.price.toLocaleString()}</div>
                    </div>
                </div>
            </div>`).join('');
    }

    function openDetail(id) {
        currentId = id; const p = ITEMS.find(x=>x.id===id);
        document.getElementById('mdImg').src = p.img;
        document.getElementById('mdName').innerText = p.name;
        document.getElementById('mdPrice').innerText = "Rp " + p.price.toLocaleString();
        document.getElementById('mdDesc').innerText = p.desc;
        new bootstrap.Modal('#detailModal').show();
    }

    function toggleFav(id) { favs.includes(id)?favs=favs.filter(i=>i!==id):favs.push(id); filterProducts(); toast("Favorit Diupdate! ❤️"); }
    function addToCart() { cart.push(ITEMS.find(x=>x.id===currentId)); updateCart(); bootstrap.Modal.getInstance('#detailModal').hide(); toast("Masuk Keranjang! 🛒"); }

    function updateCart() {
        document.getElementById('cartCount').innerText = cart.length;
        document.getElementById('cartList').innerHTML = cart.map((x,i)=>`
            <div class="d-flex align-items-center gap-3 bg-light p-3 rounded-4 mb-3">
                <img src="${x.img}" width="50" height="50" class="rounded-3 object-fit-cover">
                <div class="flex-grow-1"><div class="fw-700 small text-truncate">${x.name}</div><div class="text-primary fw-800 small">Rp ${x.price.toLocaleString()}</div></div>
                <i class="bi bi-trash3-fill text-danger pointer" onclick="cart.splice(${i},1); updateCart()"></i>
            </div>`).join('');
        document.getElementById('cartTotal').innerText = "Rp " + cart.reduce((s,x)=>s+x.price,0).toLocaleString();
    }

    function checkout() {
        if(cart.length===0) return alert("Pilih produk!");
        let pesan = "Halo DinoMarket, saya pesan:%0A" + cart.map(x=>`- ${x.name}`).join('%0A');
        window.open(`https://api.whatsapp.com/send?phone=6281295245344&text=${pesan}`, '_blank');
    }

    function toast(m) { const t=document.getElementById('toast'); t.innerText=m; t.style.display='block'; setTimeout(()=>t.style.display='none', 2500); }

    window.onload = () => {
        filterProducts(); typeWriter(); startTimer();
        document.getElementById('flashGrid').innerHTML = ITEMS.slice(0, 4).map(x => `
            <div class="col" onclick="openDetail(${x.id})">
                <div class="p-card border-0 bg-white p-2">
                    <div class="p-img-wrap rounded-4"><img src="${x.img}" onerror="this.src='https://placehold.co/400x400?text=Flash+Sale'"></div>
                    <div class="p-2 text-center fw-800 text-danger">Rp ${(x.price*0.5).toLocaleString()}</div>
                </div>
            </div>`).join('');
    };
</script>
</body>
</html>