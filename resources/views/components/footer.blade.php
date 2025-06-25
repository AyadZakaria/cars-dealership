<footer class="border-t border-gray-200 py-6 shadow-sm">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
        <nav class="flex flex-wrap gap-6 text-gray-600 text-sm font-medium">
            <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <a href="{{ url('/cars') }}" class="hover:text-blue-600 transition-colors">Cars</a>
            <a href="{{ url('/my-reservations') }}" class="hover:text-blue-600 transition-colors">My Reservations</a>
            <a href="{{ url('/contact') }}" class="hover:text-blue-600 transition-colors">Contact</a>
        </nav>
        <div class="text-xs text-gray-400 text-center md:text-right w-full md:w-auto">
            &copy; {{ date('Y') }} Cars Dealership. All rights reserved.
        </div>
    </div>
</footer>
