@extends('layouts.app')

@section('content')
    <div class="container" style="direction: rtl;">
        <!-- زر العودة إلى الصفحة السابقة -->
        <div class="mb-4">
            <button onclick="window.history.back();" class="btn btn-secondary">
                <i class="bi bi-arrow-right"></i> العودة
            </button>
        </div>

        <h1 class="text-right mb-4">تقديم طلب شاحنة</h1>
        
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="location">الموقع:</label>
                <input type="text" id="location" name="location" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="size">الحجم:</label>
                <input type="text" id="size" name="size" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="weight">الوزن:</label>
                <input type="number" id="weight" name="weight" class="form-control" step="0.01" required>
            </div>

            <div class="form-group mb-3">
                <label for="pickup_time">وقت الاستلام:</label>
                <input type="datetime-local" id="pickup_time" name="pickup_time" class="form-control">
            </div>

            <div class="form-group mb-4">
                <label for="delivery_time">وقت التوصيل:</label>
                <input type="datetime-local" id="delivery_time" name="delivery_time" class="form-control">
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">تقديم الطلب</button>
            </div>
        </form>
    </div>
@endsection
