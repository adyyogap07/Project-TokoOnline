@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .float-whatsapp {
            position: fixed;
            bottom: 40px;
            left: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50%;  /* Ubah ke 50% untuk bentuk bulat sempurna */
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2); /* Perbaiki shadow */
            z-index: 100;
            display: flex;
            align-items: center;      /* Untuk centering vertikal */
            justify-content: center;  /* Untuk centering horizontal */
            width: 60px;
            height: 60px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .float-whatsapp:hover {
            background-color: #128C7E;
            color: #FFF;
            transform: scale(1.1);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3); /* Shadow lebih kuat saat hover */
        }

        .float-whatsapp i {
            font-size: 32px;  /* Sesuaikan ukuran icon */
            line-height: 1;   /* Perbaiki line height */
            display: flex;    /* Flexbox untuk centering lebih baik */
            align-items: center;
            justify-content: center;
            margin: 0;        /* Hapus margin */
            padding: 0;       /* Hapus padding */
        }

        /* Tambahkan animasi bounce */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .float-whatsapp:hover i {
            animation: bounce 1s infinite;
        }
    </style>
@endpush

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel">
        <div class="container">
            <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
                <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
                >
                <ol class="carousel-indicators">
                    <li
                    class="active"
                    data-target="#storeCarousel"
                    data-slide-to="0"
                    ></li>
                    <li data-target="#storeCarousel" data-slide-to="1"></li>
                    <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img
                        src="/images/banner.jpg"
                        alt="Carousel Image"
                        class="d-block w-100"
                    />
                    </div>
                    <div class="carousel-item">
                    <img
                        src="/images/banner.jpg"
                        alt="Carousel Image"
                        class="d-block w-100"
                    />
                    </div>
                    <div class="carousel-item">
                    <img
                        src="/images/banner.jpg"
                        alt="Carousel Image"
                        class="d-block w-100"
                    />
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Trend Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementCategory = 0 @endphp
                    @forelse ($categories as $category)
                        <div
                            class="col-6 col-md-3 col-lg-2"
                            data-aos="fade-up"
                            data-aos-delay="{{ $incrementCategory+= 100 }}"
                        >
                            <a href="{{ route('categories-detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img
                                    src="{{  Storage::url($category->photo) }}"
                                    alt=""
                                    class="w-100"
                                    />
                                </div>
                                <p class="categories-text">
                                    {{  $category->name }}
                                </p>
                            </a>
                        </div>
                    @empty
                        <div
                            class="col-12 text-center py-5"
                            data-aos="fade-up"
                            data-aos-delay="100"
                        >
                            No Categories Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Products</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0 @endphp
                    @forelse ($products as $product)
                        <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="{{  $incrementProduct += 100 }}"
                        >
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div
                                    class="products-image"
                                    style="
                                        @if($product->galleries)
                                            background-image: url('{{ $product->galleries->first() ? Storage::url($product->galleries->first()->photos) : '' }}');
                                        @else
                                            background-color: #eee;
                                        @endif
                                    "
                                    ></div>
                                </div>
                                <div class="products-text">
                                    {{  $product->name }}
                                </div>
                                <div class="products-price">
                                    Rp {{ $product->price }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div
                                class="col-12 text-center py-5"
                                data-aos="fade-up"
                                data-aos-delay="100"
                            >
                                No Products Found
                            </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
    <!-- Tambahkan button WhatsApp -->
    <a href="https://wa.me/6285174235005" target="_blank" class="float-whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>
@endsection