{{-- Genaral Menu --}}

@guest
    {{-- Guest Exclusive Menu --}}
@else
    {{-- User Exclusive Menu --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('series.index')}}">Entries</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Reports</a>
    </li>
@endguest
