<x-mail::message>
# Introduction

طلب جديد {{$order->iorder_id}}
مكان الطلب{{$order->location}}
تفاصيل 
 الحجم: {{ $order->size }}
الوزن{{$order->size }}
وقت الاستلام: {{ $order->pickup_time }}
وقت التوصيل: {{ $order->delivery_time }}

<h5 class="card-title">طلب #{{ $order->order_id }}</h5>
                            <p class="card-text">اسم العميل: {{ $order->user_name }}</p> <!-- Customer's name -->
                            <p class="card-text">الموقع: {{ $order->location }}</p>
                            <p class="card-text">الحجم: {{ $order->size }}</p>
                            <p class="card-text">الوزن: {{ $order->weight }}</p>
                            <p class="card-text">وقت الاستلام: {{ $order->pickup_time }}</p>
                            <p class="card-text">وقت التوصيل: {{ $order->delivery_time }}</p>
                            <p class="card-text">الحالة الحالية: {{ $order->status }}</p>


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
