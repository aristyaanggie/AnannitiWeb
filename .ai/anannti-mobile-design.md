# Anannti Tattoo Studio — Mobile Page Design Spec

Dokumentasi ini merinci struktur, komponen, dan konten dari alur halaman mobile (single-page scroll) Anannti Tattoo Studio, berdasarkan urutan section: **Header → Hero → Choose Your Experience → Portfolio → Meet the Artist → Trusted by Clients → CTA → Footer**, ditambah **Mobile Menu Drawer**.

---

## 1. Design Language / Visual Identity

- **Tema:** Dark minimalist luxury, kontras tinggi antara section gelap (hitam/dark charcoal) dan section terang (putih)
- **Palet warna:**
  - Hitam/dark charcoal (`#0D0D0D` – `#1A1A1A`) — background dominan (header, hero, footer, card gelap)
  - Putih (`#FFFFFF`) — background section terang (Choose Your Experience alt, Portfolio, CTA card)
  - Abu-abu terang (`#A0A0A0` – `#C9C9C9`) — teks sekunder/deskripsi di atas background gelap
  - Aksen emas/kuning (`#F5B400`-ish) — hanya dipakai pada **star rating** (testimonial)
  - Border tipis abu-abu gelap untuk pemisah section pada background hitam
- **Tipografi:**
  - Heading: serif bold, ukuran besar (32–40px di mobile), line-height rapat — memberi kesan elegan/editorial (mis. "Bring Your Tattoo Vision to Life", "Choose Your Experience", "Meet the Artist", "Gus Tut")
  - Body/paragraph: sans-serif regular, abu-abu terang di atas dark, abu-abu gelap di atas putih
  - Label kecil (eyebrow text): sans-serif, uppercase, letter-spacing lebar, ukuran kecil (11–12px), warna abu-abu — contoh: "PREMIUM TATTOO STUDIO", "HOW WE SERVE YOU", "PORTFOLIO", "FEATURED ARTIST", "TRUSTED BY CLIENTS"
- **Tombol (Button):**
  - Primary: solid putih, teks hitam, rounded corner kecil, terkadang disertai icon (mis. chat bubble icon pada "Discuss Your Tattoo Idea")
  - Secondary: outline (border putih/abu tipis), background transparan, teks putih — dipakai untuk aksi sekunder (mis. "View Our Works", "Meet Gus Tut")
  - Full-width pada mobile, stacked vertikal saat ada 2 tombol

---

## 2. Header / Top Navigation (konsisten di semua section)

- **Layout:** flex row, logo kiri, hamburger menu kanan
- **Logo area:** icon bulat kecil (avatar/emblem, berubah-ubah per section — pencil, badge, person, gear — kemungkinan menandakan section context atau sekadar variasi ilustrasi) + teks "ANANNITI TATTOO" (uppercase, letter-spacing, bold, kecil)
- **Hamburger icon:** 3 garis horizontal, kanan atas → trigger **Menu Drawer** (lihat bagian 9)
- Background header mengikuti section: transparan/gelap di Hero, gelap solid di section lain, abu-abu solid khusus di section Portfolio
- Pada Hero, terdapat nav sekunder tersembunyi/samar di belakang (Home, Services, Shop, Gallery, Artist) — tampak seperti nav desktop yang di-overlay redup di balik hero image, kemungkinan artifact dari versi desktop; **di mobile nav utama diakses lewat hamburger**, bukan inline nav bar

---

## 3. Section — Hero ("Bring Your Tattoo Vision to Life")

- **Background:** foto studio/tattoo gelap dengan overlay gradient hitam (memastikan kontras teks putih)
- **Eyebrow label:** "PREMIUM TATTOO STUDIO"
- **Headline (H1):** "Bring Your Tattoo Vision to Life" — serif besar, 3 baris, putih
- **Paragraph:** "Every design is a collaboration. Every tattoo, a masterpiece crafted with precision and care."
- **CTA buttons (stacked):**
  1. Primary (putih, icon chat bubble): **"Discuss Your Tattoo Idea"**
  2. Secondary (outline putih): **"View Our Works"**
- **Footer bawah section** (footer ringkas, muncul berulang tiap section sebagai pola desain):
  - "Ananniti Tattoo"
  - "© 2023 Ananniti Tattoo Bali. All Rights Reserved."
  - Link inline: Services · Gallery · Artists · Booking
  - Link terpisah: Privacy Policy (underline)

> Catatan: footer versi mini ini tampak muncul di akhir tiap "slide/section" mockup — kemungkinan ini adalah representasi footer global yang dipotong per section dalam mockup, bukan footer berulang di tiap section asli. Perlu dikonfirmasi ke pembuat mockup, tapi untuk implementasi disarankan **footer lengkap hanya muncul sekali di akhir halaman** (lihat bagian 8).

---

## 4. Section — "Choose Your Experience"

- **Background:** hitam solid
- **Eyebrow label (center):** "HOW WE SERVE YOU"
- **Heading (center, serif):** "Choose Your Experience"
- **Layout:** 2 card vertikal (stacked), masing-masing dengan background abu-abu gelap sedikit lebih terang dari base (`#1E1E1E`-ish), rounded corner besar, padding generous

### Card 1 — Studio Service
- Thumbnail/preview gambar kecil di atas (screenshot booking form) — rounded, drop shadow
- Judul: **"Studio Service"** (bold, putih)
- Deskripsi: "Professional tattoo experience in our fully equipped studio with a comfortable environment."
- Button full-width putih: **"Book Studio Service"**

### Card 2 — Home Service
- Icon rumah dalam lingkaran gelap (bukan thumbnail gambar seperti card 1)
- Judul: **"Home Service"**
- Deskripsi: "Professional tattoo session at your preferred location with complete equipment."
- Button full-width putih: **"Book Home Service"**

- **Footer mini** di bawah section (pola sama seperti bagian 3)

---

## 5. Section — Portfolio

- **Header khusus:** background abu-abu (beda dari section lain yang hitam solid), logo emblem berbeda (badge/shield icon)
- **Eyebrow label:** "PORTFOLIO" (abu-abu, di atas background putih)
- **Background section:** putih
- **Gallery grid:** bento/masonry grid asimetris, kombinasi:
  - Tile foto tattoo asli (hasil karya di kulit klien) — berbagai ukuran (grid 2 kolom dengan beberapa tile lebih besar)
  - Tile berisi **screenshot mockup UI** (preview website/app lain) dengan overlay teks **"CHECK MY GALLERY"** dan tombol kecil — kemungkinan ini adalah tile promosi/link ke gallery eksternal atau preview interaktif, bukan foto tattoo biasa
  - Total terlihat ~4 baris grid dengan campuran foto tattoo & preview UI
- **CTA di bawah grid:** **"VIEW ALL →"** (text link, bukan button, dengan icon panah kanan)
- **Footer khusus section ini** (varian lebih detail dari footer mini lain):
  - "Ananniti Tattoo"
  - Deskripsi: "Premium tattoo experiences crafted with precision and care in the heart of Bali."
  - **2 kolom link:**
    - **EXPLORE:** Services, Gallery, Artists
    - **SUPPORT:** Booking, Privacy Policy
  - "© 2023 Ananniti Tattoo Bali. All Rights Reserved."

---

## 6. Section — "Meet the Artist"

- **Background:** hitam solid
- **Eyebrow label:** "FEATURED ARTIST"
- **Heading:** "Meet the Artist"
- **Deskripsi:** "Dedicated to creating timeless artwork with precision and passion."
- **Artist showcase card:**
  - Card besar dengan foto potret artist (hitam-putih/monochrome, dramatic lighting) sebagai background
  - Tag kategori di atas nama: **"BLACKWORK, BALINESE TRADITIONAL"** (uppercase, kecil, letter-spacing)
  - Nama artist besar (serif): **"Gus Tut"**
  - Di atas foto ada elemen preview halaman profil artist (mockup browser/screenshot "the Artist" page) — sepertinya menunjukkan preview halaman detail artist yang bisa diakses
- **CTA buttons (stacked):**
  1. Primary putih: **"View Portfolio"**
  2. Secondary outline: **"Meet Gus Tut"**
- **Footer mini** (pola link 1 kolom, bukan 2 kolom seperti section Portfolio): Services, Gallery, Artists, Booking, Privacy Policy

---

## 7. Section — "Trusted by Clients" (Testimonials)

- **Background:** hitam solid
- **Eyebrow label:** "TRUSTED BY CLIENTS"
- **Rating hero:**
  - Angka besar: **"4.5"** (font besar, serif/bold, putih)
  - Star icons di sampingnya (4.5 dari 5, warna emas/kuning, star terakhir setengah terisi)
  - Deskripsi kecil di bawah: "based on verified international clients. Real reviews from real collectors."
- **Heading:** "Trusted by Clients"
- **Deskripsi:** "Every review is genuine. Fine Line · Realism · Returning Clients"
- **Testimonial card** (rounded, background abu-abu gelap sedikit lebih terang):
  - 5 star icon emas di atas (rating penuh untuk review ini)
  - Quote review (italic/regular): *"Incredible attention to detail. The artist listened to exactly what I wanted and the fine line work is flawless. The studio is…"* (teks terpotong/truncated, kemungkinan "read more")
  - Avatar reviewer (icon placeholder bulat) + nama: **"Sarah K."**
  - Sub-info: "BALI · FINE LINE" (lokasi · kategori tattoo, uppercase kecil)
- **Carousel indicator:** 3 dot di bawah card, dot pertama aktif (solid putih), dot lain redup → menandakan testimonial bersifat **slider/carousel**, swipeable di mobile

### Sub-section — CTA Card ("Let's Create Something Meaningful Together")
- Card terpisah, background **putih** (kontras dari section hitam di atasnya), rounded besar
- Logo kecil + teks "Ananniti Tattoo" di atas
- Heading serif besar: **"Let's Create Something Meaningful Together"**
- Deskripsi: "Whether it's your first tattoo or your next masterpiece, we're here to help you shape every detail."
- Button full-width **hitam** (kontras dari card putih), icon chat bubble: **"Discuss Your Tattoo Idea"**
- Caption kecil di bawah button: **"FREE CONSULTATION · NO OBLIGATION"** (uppercase, dua item dipisah titik tengah)

---

## 8. Footer (Global, Lengkap)

- **Background:** hitam solid
- **Heading brand:** "ANANNITI TATTOO" (uppercase, bold)
- **Kolom link (single column, stacked):** Services, Gallery, Artists, Booking, Privacy Policy (masing-masing underline/hover style, beberapa berwarna putih terang menandakan link aktif)
- **Section "STUDIO":**
  - Alamat: "Jl. Raya Canggu, Bali"
  - Jam operasional: "Open Daily 10:00 – 22:00"
- **Section "CONNECT":**
  - Icon sosial media (kamera/Instagram icon, mail/email icon) — row horizontal, ukuran kecil
- **Copyright bawah:** "© 2023 Ananniti Tattoo Bali. All Rights Reserved." (abu-abu, center/left align, font kecil)

> Ini adalah **footer paling lengkap** dibanding footer mini yang muncul di section lain — dijadikan acuan untuk footer final di implementasi (satu footer detail di akhir halaman, section lain cukup pakai CTA + link ringkas jika diperlukan, atau tanpa footer berulang).

---

## 9. Mobile Menu Drawer

- **Trigger:** tap icon hamburger di header → drawer slide-in dari **kanan**, menutupi ± 85% lebar layar
- **Background:** hitam solid, full height
- **Header drawer:** judul **"Menu"** (besar, serif) + icon **X** (close) di kanan atas
- **List menu item** (vertikal, masing-masing dengan icon di kiri + label):
  1. 🔲 **Portfolio** (icon grid)
  2. 🕐/⭕ **Artists** (icon lingkaran/jam — kemungkinan icon person/clock, perlu dicek asli)
  3. ✏️ **Studio Services** (icon pensil)
  4. 📅 **Booking** (icon kalender)
  5. ✉️ **Contact** (icon amplop)
- **Style item:** icon + label sejajar horizontal, spacing vertikal antar item cukup lega (list style, bukan grid), tanpa border antar item (clean list)
- **Interaksi:** tap item → navigasi ke section/halaman terkait & drawer otomatis close; tap **X** atau tap area luar drawer (overlay) → close drawer

---

## 10. Ringkasan Komponen Reusable

| Komponen | Digunakan di | Variasi |
|---|---|---|
| Header (logo + hamburger) | Semua section | Background transparan (hero) / solid hitam / solid abu (portfolio) |
| Eyebrow label (uppercase small text) | Hampir semua section | Center-aligned atau left-aligned |
| Button primary (putih) | Hero, Choose Experience, Meet Artist, CTA card | Kadang dengan icon chat bubble |
| Button secondary (outline) | Hero, Meet Artist | — |
| Service card (image/icon + title + desc + button) | Choose Your Experience | Varian image thumbnail / icon lingkaran |
| Bento gallery grid | Portfolio | Campuran foto asli & UI preview tile |
| Artist showcase card | Meet the Artist | Foto full-bleed + tag + nama besar |
| Rating display (angka + stars) | Trusted by Clients | — |
| Testimonial card (carousel) | Trusted by Clients | Dot indicator di bawah |
| CTA card (white breakout) | Trusted by Clients | Background putih di tengah section hitam |
| Footer mini | Tiap akhir section | Link ringkas 1 baris |
| Footer lengkap | Akhir halaman | 2–3 kolom + info studio + sosial media |
| Menu drawer | Global (trigger dari header) | Slide from right, full black |
