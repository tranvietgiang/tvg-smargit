<!-- header user -->
@include('component.header.header_laravel')

<!-- alert welcome  -->
@if (session('list-success'))
    <div class="alert alert-success text-center display-6">{{ session('list-success') }}</div>
@endif

<!-- Link mdbootstrap-css -->
<link rel="stylesheet" href="{{ asset('component/css/mdb.min.css') }}">
<section class="w-50 mx-auto mt-5">
    <div class="display-5 text-center m-5">
        User
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ds as $value)
                    <tr>
                        <!-- $loop->iteration tự động tăng từ 1, không cần ++. -->
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>

                        <!-- delete -->
                        <td>
                            <form action="{{ route('destroy', $value->id) }}" method="post"
                                onsubmit="return confirm('You have such remove account this!');">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- Link mdbootstrap-js -->
<script src="{{ asset('component/js/mdb.umd.min.js') }}"></script>
