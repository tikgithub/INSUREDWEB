@switch($item->payment_confirm)
    @case('WAIT_FOR_PAYMENT')
        <div class="badge rounded-pill bg-warning text-start text-dark fw-bold" style="width: 100%; font-size: 10pt">
            ຢືນຢັນການສັ່ງຊື້
        </div>
    @break

    @case('WAIT_FOR_APPROVED')
        <div class="fw-bold badge rounded-pill bg-info text-start text-dark"  style="width: 100%; font-size: 10pt">
             ກາລຸນາກວດສອບ
        </div>
    @break

    @case('APPROVED_OK')
        <div class="fw-bold badge bg-light text-dark text-start"  style="width: 100%; font-size: 10pt">
            ໝົດສັນຍາວັນທີ: 12/03/2023 ເວລາ 11:30
        </div>
    @break

    @default
@endswitch
