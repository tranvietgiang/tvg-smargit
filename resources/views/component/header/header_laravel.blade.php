@include('component.linkSupport.fontawesome')

<!-- header -->
<header class="bg-success pt-1">
    <div class="container text-center">
        <div class="d-flex align-items-center justify-content-between ">

            <div class="d-flex justify-content-center align-items-center gap-2 position-relative">
                <span class="cursor-pointer"> <i class="fa-solid fa-caret-down" id="logout"></i></span>
                <!-- check user login yet? -->
                @if (Auth::check())
                    <form style="z-index: 1" class="form_logout d-none position-absolute top-0 left-0 mt-4"
                        action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-sm btn btn-link text-black">Logout</button>
                    </form>
                @endif
            </div>

            <div><span class="display-5  fw-bolder text-danger">Laravel</span></div>

            <div class="btn btn-success d-flex justify-content-center align-items-center gap-2 fst-italic">
                <a href=""><i class="fa-solid fa-circle-user fs-3 text-black"></i></a>
                <!-- show name -->
                @if (session('name'))
                    <span class="text-white">{{ session('name') }}</span>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- js -->
<script src="{{ asset('component/js/header_laravel.blade.js') }}"></script>
