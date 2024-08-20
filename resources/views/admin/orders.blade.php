@extends('layouts.app')

@section('content')
    <div class="container" style="direction: rtl;">
        <h1 class="text-right">الطلبات الحالية</h1>
        <div class="row">
            @foreach ($orders as $order)
                <!-- تقسيم العرض إلى 3 طلبات في الصف الواحد -->
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-right">
                            <h5 class="card-title">طلب #{{ $order->order_id }}</h5>
                            <p class="card-text">اسم العميل: {{ $order->user_name }}</p> <!-- Customer's name -->
                            <p class="card-text">الموقع: {{ $order->location }}</p>
                            <p class="card-text">الحجم: {{ $order->size }}</p>
                            <p class="card-text">الوزن: {{ $order->weight }}</p>
                            <p class="card-text">وقت الاستلام: {{ $order->pickup_time }}</p>
                            <p class="card-text">وقت التوصيل: {{ $order->delivery_time }}</p>
                            <p class="card-text">الحالة الحالية: {{ $order->status }}</p>

                            <form action="{{ route('admin.updateOrder', $order->order_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="status">تحديث الحالة:</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                        <option value="in_progress" {{ $order->status === 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>تم التوصيل</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">تحديث الحالة</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
