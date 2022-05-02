@switch($item->insurance_type)
    @case('HIGH-VALUEABLE')
        <div class="text-center rounded-pill bg-info">
          ປະກັນໄພຍານພາຫະນະ
        </div>
    @break

    @case('ACCIDENT')
        <div class="text-center bg-danger rounded-pill text-white" >
             ປະກັນໄພອຸບັດຕິເຫດ
        </div>
    @break

    @case('THIRD-PARTY')
        <div class="bg-success text-center rounded-pill text-white">  
            ປະກັນໄພບຸກຄົນທີ່ ສາມ
        </div>
    @break

    @case('HEATH')
        <div class="text-center bg-warning rounded-pill">
            ປະກັນໄພສຸຂະພາບ
        </div>
    @break

    @default
@endswitch
