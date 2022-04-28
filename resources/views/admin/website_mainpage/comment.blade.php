@php
use App\Models\User;
@endphp
@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center fw-bold">ຄຳຄິດເຫັນຂອງລູກຄ້າ</h3>
        </div>
    </div>
    {{-- Navigation --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('WebsiteController.index') }}">Website Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຄຳຄິດເຫັນຂອງລູກຄ້າ</li>
        </ol>
    </nav>
    <hr>
    {{-- Table display name --}}
    <div class="row pt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ຄຳເຫັນ</th>
                    <th>ດາວ</th>
                    <th>User Account</th>
                    <th>ເວລາ</th>
                    <th>ເຜິຍແພ</th>
                    <th>
                        <i class="bi bi-gear"></i>
                    </th>
                </thead>
                <tbody>
                    @foreach ($comments as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->comment }}</td>
                            <td>{{ $item->rates }}</td>
                            <td>
                                @php
                                    $user = User::find($item->user_id);
                                    $fullname = $user->firstname . ' ' . $user->lastname;
                                    echo $fullname;
                                @endphp
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                {{$item->status==1? 'ເຜີຍແພ່':'ປິດ'}}
                            </td>
                            <td>
                                @if ($item->status==0)
                                    <a href="{{route('WebsiteController.UpdateCommentStatus',['id'=>$item->id])}}" class="btn btn-success btn-sm"><i class="bi bi-check-circle me-2"></i>ເຜີຍແພ່</a>
                                @else
                                    <a href="{{route('WebsiteController.UpdateCommentStatus',['id'=>$item->id])}}" class="btn btn-warning btn-sm"><i class="bi bi-x-cicle me-2"></i>ປິດ</a>
                                @endif

                                <a href="http://" class="btn btn-danger btn-sm"><i class="bi bi-trash me-2"></i>ລຶບ</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection



@section('styles')
@endsection


@section('scripting')
    @include('toastrMessage')
@endsection
