@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row notosanLao">
        <div class="col-md-12">
            <h3 class="text-center">ລາຍການປະກັນໄພບຸກຄົ້ນທີ 3</h3>
        </div>
    </div>
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ປະກັນໄພບຸກຄົນທີ 3</li>
        </ol>
    </nav>
    <hr>
    {{-- Search Panel here --}}
    <div class="row mb-3 notosanLao">
        <label for="" class="col-sm-2 align-self-center col-form-label text-center">ຈັດລຽງຕາມລາຄາ:</label>
        <div class="col-sm-2 align-self-center text-center">
            <select name="sortingPrice" id="sortingPrice" class="form-select">
                <option value="">ຕໍ່າຫາສູງ</option>
                <option value="">ສູງຫາຕໍ່າ</option>
            </select>
        </div>

        <label for="" class="col-sm-2  align-self-center col-form-label">ຈັດລຽງຕາມລັກສະນະຂອງຍານພາຫະນະ:</label>
        <div class="col-sm-3 align-self-center">
            <select name="vehicle_detail" id="vehicle_Detail" class="form-select">
                @foreach ($vehicleDetail as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

   
    {{-- Card list display the insurance package --}}
    <hr>
    <div class="row">
        <div class="col-md-12">

            <div class="row row-cols-1 row-cols-md-3 g-4 notosanLao">
                @foreach ($thirdPartyPackage as $item)
                <div class="col">
                    <div class="card">
                        <img src="{{asset($item->logo)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->package_name}}</h5>
                            <p class="card-text">{{$item->vehicle_types}} {{$item->vehicle_details}}</p>
                            <p class="card-text text-danger fw-bold fs-4">₭ {{number_format($item->final_price,0)}}</p>
                            <p class="card-text text-center">
                                <a href="{{route('InsuranceFlowController.showInputPageThirdPartyInsurance',['id'=>$item->id])}}" class="btn btn-danger text-white"><i class="bi bi-cart me-2"></i> ຊື້ເລີຍ</a>
                                <a href="{{route('InsuranceFlowController.showThirdPartyInsuranceCoverItem',['id'=>$item->id])}}" class="btn btn-secondary text-white"><i class="bi bi-info-circle me-2"></i> ການຄຸ້ມຄອງ</a>
                                <button id="compare-{{$item->id}}" type="button" onclick="onClickCompare('compare-{{$item->id}}')" class="btn btn-warning text-dark"><i class="bi bi-eye-fill"></i> ສົມທຽບ</button>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
              
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
@section('scripting')
    <script>
        var compare1;
        var compare2;

        function onClickCompare(id){

           
            if(compare1==undefined){
                compare1 = document.getElementById(id);
                compare1.classList.remove('btn-warning');
                compare1.classList.add('btn-info');

            }else{
                if(compare1.getAttribute('id')==id){
                    compare1.classList.remove('btn-info');
                    compare1.classList.add('btn-warning');
                    compare1=undefined;

                }else{
                    compare2 = document.getElementById(id);
                    compare2.classList.remove('btn-warning');
                    compare2.classList.add('btn-info');
                    var url = "{{route('InsuranceFlowController.showCompareViewThirdPartyInsurance',['id1'=>':id1','id2'=>':id2'])}}";
                    url = url.replace(':id1',compare1.getAttribute('id').replace('compare-',''));
                    url = url.replace(':id2',compare2.getAttribute('id').replace('compare-',''));
                    //go to compare view
                    window.location.replace(url);
                    
                }
               
            }
        
        }
    </script>
@endsection
