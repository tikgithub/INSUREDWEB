@switch($item->insurance_type)
    @case('HIGH-VALUEABLE')
        <div class="badge bg-primary fs-6">
          ປະກັນໄພຍານພາຫະນະ
        </div>
    @break

    @case('ACCIDENT')
        <div class="badge bg-danger fs-6">
             ປະກັນໄພອຸບັດຕິເຫດ
        </div>
    @break

    @case('THIRD-PARTY')
        <div class="badge bg-success fs-6">  
            ປະກັນໄພບຸກຄົນທີ່ ສາມ
        </div>
    @break

    @case('HEATH')
        <div class="badge bg-info text-dark fs-6">
            ປະກັນໄພສຸຂະພາບ
        </div>
    @break

    @default
@endswitch
