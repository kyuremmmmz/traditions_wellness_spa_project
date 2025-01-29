
<div class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50 hidden" id="spinner-container">
    <div class="relative w-10 h-10">
        <div class="absolute inset-0 rounded-full bg-gray-800 opacity-60 animate-pulse"></div>
        <div class="absolute inset-0 rounded-full bg-gray-800 opacity-60 animate-pulse animation-delay-1000"></div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { transform: scale(0); }
    50% { transform: scale(1); }
}

/* Tailwind's animation utilities do not support custom keyframes or delays by default, 
   so you need to manually add these styles if they aren't already in your custom CSS file. */
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animation-delay-1000 {
    animation-delay: -1s;
}
</style>
