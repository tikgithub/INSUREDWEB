@switch($item->payment_confirm)
    @case('WAIT_FOR_PAYMENT')
        <div class="badge rounded-pill bg-warning text-dark fw-bold fs-6">
            ກາລຸນາຢືນຢັນການສັ່ງຊື້
        </div>
    @break

    @case('WAIT_FOR_APPROVED')
        <div class="fw-bold badge rounded-pill bg-info text-dark fs-6">
             ກາລຸນາລໍຖ້າລາຍກຳລັງຢູ່ໃນການກວດສອບ
        </div>
    @break

    @case('APPROVED_OK')
        <div class="fw-bold badge bg-light text-dark fs-6">
            ໝົດສັນຍາວັນທີ: 12/03/2023 ເວລາ 11:30
        </div>
    @break

    @default
@endswitch
