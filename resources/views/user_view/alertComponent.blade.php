
@switch($item->payment_confirm)
@case('WAIT_FOR_PAYMENT')
    <div class="alert fs-4 fw-bold alert-info me-2" role="alert">
        <i class="bi bi-cash-stack me-2"></i> ກາລຸນາຢືນຢັນການສັ່ງຊື້
    </div>
@break

@case('WAIT_FOR_APPROVED')
    <div class="alert fs-4 fw-bold alert-warning me-2" role="alert">
        <i class="bi bi-clock-history me-2"></i> ກາລຸນາລໍຖ້າລາຍກຳລັງຢູ່ໃນການກວດສອບ
    </div>
   
@break

@case('APPROVED_OK')
    <div class="alert fs-5 fw-bold alert-success me-2" role="alert">
        <i class="bi bi-check2-circle me-2"></i> ໝົດສັນຍາວັນທີ: {{\Carbon\Carbon::parse($item->end_date)->format('d/m/Y | H:m A')}}
    </div>
@break

@default
@endswitch