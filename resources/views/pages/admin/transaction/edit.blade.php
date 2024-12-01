@extends('layouts.admin')

@section('title')
    Store Dashboard Transaction Detail
@endsection

@section('content')
<!-- Section Content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transaction</h2>
            <p class="dashboard-subtitle">Edit "{{ $item->user->name }}" Transaction</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('transaction.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                       @if ($item->products->isNotEmpty())
                                          @foreach ($item->products as $product)
                                              <img src="{{ Storage::url($product->galleries->first()->photos) }}" class="w-100 mb-3" alt="{{ $product->name }}" />
                                          @endforeach
                                      @else
                                          <img src="{{ asset('images/default-product.png') }}" class="w-100 mb-3" alt="No Product" />
                                          <div class="product-subtitle">Product not found</div>
                                      @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="product-title">Customer Name</div>
                                                <div class="product-subtitle">{{ $item->user->name }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="product-title">Product Name</div>
                                                <div class="product-subtitle">
                                                    @if ($item->products->isNotEmpty())
                                                        {{ $item->products->first()->name }}
                                                    @else
                                                        Product not found
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transaction Status</label>
                                            <select name="transaction_status" class="form-control">
                                                <option value="{{ $item->transaction_status }}">{{ $item->transaction_status }}</option>
                                                <option value="" disabled>----------------</option>
                                                <option value="PENDING">PENDING</option>
                                                <option value="SHIPPING">SHIPPING</option>
                                                <option value="SUCCESS">SUCCESS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Price</label>
                                            <input type="hidden" name="total_price" value="{{ $item->total_price }}" />
                                            <input type="text" class="form-control" value="{{ number_format($item->total_price) }}" readonly />
                                        </div>
                                    </div>                    

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h5>Shipping Information</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address I</label>
                                            <input type="text" class="form-control" value="{{ $item->user->address_one }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address II</label>
                                            <input type="text" class="form-control" value="{{ $item->user->address_two }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <input type="text" class="form-control" value="{{ App\Models\Province::find($item->user->provinces_id)->name }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" value="{{ App\Models\Regency::find($item->user->regencies_id)->name }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" value="{{ $item->user->zip_code }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" class="form-control" value="{{ $item->user->country }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" value="{{ $item->user->phone_number }}" disabled />
                                        </div>
                                    </div>
                                </div>                                

                                <div class="row mt-3">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script>
    var transactionDetails = new Vue({
      el: "#transactionDetails",
      data: {
        status: "{{ $item->shipping_status }}",
        resi: "{{ $item->resi }}",
      },
    });
  </script>
@endpush