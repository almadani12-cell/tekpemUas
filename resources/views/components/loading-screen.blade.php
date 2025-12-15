<div id="loading-screen" class="fixed inset-0 z-[100] bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 flex items-center justify-center">
    <div class="text-center">
        {{-- Logo dengan animasi fade + scale --}}
        <div class="loading-logo mb-6">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Co-Think Logo" class="h-32 w-auto mx-auto">
        </div>
        
        {{-- Judul --}}
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-2 loading-text tracking-wider" style="font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: 0.02em;">Co-Think</h2>
        <p class="text-sm sm:text-base text-slate-600 mb-6 loading-text px-4">Platform Pembelajaran Berpikir Komputasional</p>
        
        {{-- Loading spinner --}}
        <div class="flex justify-center">
            <div class="w-12 h-12 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .loading-logo {
        animation: fadeInScale 0.8s ease-out;
    }
    
    .loading-text {
        animation: fadeInUp 0.6s ease-out 0.3s both;
    }
    
    #loading-screen {
        transition: opacity 0.5s ease-out;
    }
    
    #loading-screen.fade-out {
        opacity: 0;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingScreen = document.getElementById('loading-screen');
        
        // Hide loading screen after page is fully loaded
        window.addEventListener('load', function() {
            setTimeout(() => {
                loadingScreen.classList.add('fade-out');
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }, 800); // Show loading for at least 800ms
        });
    });
</script>
