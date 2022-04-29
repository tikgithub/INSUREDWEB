@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row">
        <div class="notosanLao col-md-12 text-center">
            <h3>ກ່ອງຂໍ້ຄວາມ</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="fs-4">
                    <th>#</th>
                    <th>ຫົວຂໍ້</th>
                    <th>ຈາກ</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                        <tr style="cursor: pointer" class="align-middle"
                            onclick="openViewDetail('{{ route('MessageToUsController.ViewMessageDetail', ['id' => $item->id]) }}')">
                            <td>{{ $loop->index + 1 }}
                                @php
                                    if ($item->status == 0) {
                                        echo '<span class="badge bg-danger">*New</span>';
                                    }
                                @endphp
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <a href="{{route('MessageToUsController.DeleteMessage',['id'=>$item->id])}}" onclick="return confirm('Are you sure to delete this item ?')"
                                    class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
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
    <script>
        function openViewDetail(link) {
            console.log(link);
            window.location.href = link;
        }
    </script>
@endsection
