# Favicon Setup Instructions

## Generate Favicon dari Logo

Gunakan logo yang sudah ada di `public/images/logo/logo.png` untuk membuat favicon dengan berbagai ukuran.

### Cara Generate:

#### Option 1: Online Tool (Recommended)
1. Buka https://realfavicongenerator.net/
2. Upload file `public/images/logo/logo.png`
3. Download semua file favicon yang dihasilkan
4. Extract dan pindahkan ke folder `public/`

#### Option 2: Manual dengan Image Editor
1. Buka `public/images/logo/logo.png` di Photoshop/GIMP
2. Crop ke bagian icon saja (puzzle + lampu tengah)
3. Resize ke ukuran:
   - 16x16px → `favicon-16x16.png`
   - 32x32px → `favicon-32x32.png`
   - 192x192px → `android-chrome-192x192.png`
   - 512x512px → `android-chrome-512x512.png`
4. Convert salah satu ke `favicon.ico`
5. Simpan semua di folder `public/`

### Update HTML Head

Setelah favicon files siap, tambahkan di `<head>` section di `learning-layout.blade.php`:

```blade
{{-- Favicons --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
```

### File Structure yang Dibutuhkan:
```
public/
├── favicon.ico
├── favicon-16x16.png
├── favicon-32x32.png
├── apple-touch-icon.png
├── android-chrome-192x192.png
├── android-chrome-512x512.png
└── site.webmanifest
```

### site.webmanifest Template:
```json
{
    "name": "Co-Think",
    "short_name": "Co-Think",
    "description": "Platform Pembelajaran Berpikir Komputasional",
    "icons": [
        {
            "src": "/android-chrome-192x192.png",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "/android-chrome-512x512.png",
            "sizes": "512x512",
            "type": "image/png"
        }
    ],
    "theme_color": "#6366f1",
    "background_color": "#ffffff",
    "display": "standalone"
}
```
