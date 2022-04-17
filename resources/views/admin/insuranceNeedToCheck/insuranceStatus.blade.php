@switch($item->insurance_type)
    @case('HIGH-VALUEABLE')
        <div class="fw-bold badge rounded-pill bg-info text-dark"style="width: 100%; font-size: 10pt">
          ປະກັນໄພຍານພາຫະນະ
        </div>
    @break

    @case('ACCIDENT')
        <div class="badge bg-danger rounded-pill text-dark" style="width: 100%; font-size: 10pt">
             ປະກັນໄພອຸບັດຕິເຫດ
        </div>
    @break

    @case('THIRD-PARTY')
        <div class="badge bg-success rounded-pill text-dark" style="width: 100%; font-size: 10pt">  
            ປະກັນໄພບຸກຄົນທີ່ ສາມ
        </div>
    @break

    @case('HEATH')
        <div class="badge bg-warning text-dark rounded-pill" style="width: 100%; font-size: 10pt">
            ປະກັນໄພສຸຂະພາບ
        </div>
    @break

    @default
@endswitch
