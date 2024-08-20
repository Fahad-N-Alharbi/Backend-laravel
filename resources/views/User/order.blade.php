@extends('layouts.app')

@section('content')
    <div class="container" style="direction: rtl;">
        <h1 class="text-right">الطلبات الحالية</h1>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center" style="font-size: 1.5rem; font-weight: bold;">
                لا يوجد طلبات حتى الآن
            </div>
        @else
            <div class="row">
                @foreach ($orders as $order)
                    <!-- تقسيم العرض إلى 3 طلبات في الصف الواحد -->
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-right">
                                <h5 class="card-title">طلب #{{ $order->order_id }}</h5>
                                <p class="card-text">اسم العميل: {{ $order->user_name }}</p>
                                <p class="card-text">الموقع: {{ $order->location }}</p>
                                <p class="card-text">الحجم: {{ $order->size }}</p>
                                <p class="card-text">الوزن: {{ $order->weight }}</p>
                                <p class="card-text">وقت الاستلام: {{ $order->pickup_time }}</p>
                                <p class="card-text">وقت التوصيل: {{ $order->delivery_time }}</p>
                                <p class="card-text">الحالة الحالية: {{ $order->status }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-3">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">إنشاء طلب جديد</a>
        </div>
    </div>
@endsection
