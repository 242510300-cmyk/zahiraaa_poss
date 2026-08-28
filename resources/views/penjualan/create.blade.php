@extends('layouts.app')

@section('title', 'POS - Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    .card-penjualan {
        background-color: #fdf6ec;
        border: 1px solid #d8c3a5;
        border-radius: 10px;
    }

    .card-penjualan h2, .card-penjualan h3 {
        color: #6f4e37;
    }

    #search-produk {
        border: 1px solid #d8c3a5;
    }

    #search-produk:focus {
        border-color: #6f4e37;
        box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.15);
    }

    .product-item {
        border: 1px solid #e5dcc9 !important;
        background-color: #fffdf9;
    }

    .input-qty-pilih {
        border: 1px solid #d8c3a5;
    }

    .btn-tambah {
        background-color: #6f4e37;
        border: none;
        color: #fff;
    }

    .btn-tambah:hover {
        background-color: #5a3e2b;
        color: #fff;
    }

    .table-cart thead th {
        color: #6f4e37;
        border-bottom: 2px solid #d8c3a5;
        background-color: #f5ead9;
    }

    #total {
        color: #6f4e37;
        font-weight: 700;
    }

    #metode-pembayaran {
        border: 1px solid #d8c3a5;
    }

    .btn-checkout {
        background-color: #2e7d32;
        border: none;
        color: #fff;
        font-weight: 600;
    }

    .btn-checkout:hover {
        background-color: #256428;
        color: #fff;
    }
</style>

<div class="container my-4">

    <h2 class="mb-4" style="color:#6f4e37;">Tambah Penjualan</h2>

    <div class="row">

        <div class="col-md-5">
            <div class="card card-penjualan shadow-sm p-3">

                <input type="text"
                       id="search-produk"
                       class="form-control mb-3"
                       placeholder="Cari produk...">

                <div style="max-height:450px;overflow-y:auto">

                    @foreach($produks as $produk)

                    <div class="card mb-2 p-2 product-item"
                         data-id="{{ $produk->id }}"
                         data-nama="{{ $produk->nama }}"
                         data-harga="{{ $produk->harga_jual }}">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <b>{{ $produk->nama }}</b>
                                <br>
                                <small>
                                    Rp {{ number_format($produk->harga_jual,0,',','.') }}
                                </small>
                            </div>

                            <div>
                                <input type="number"
                                       value="1"
                                       min="1"
                                       class="form-control form-control-sm input-qty-pilih mb-1"
                                       style="width:60px">

                                <button type="button"
                                        class="btn btn-tambah btn-sm">
                                    +
                                </button>
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>
        </div>

        <div class="col-md-7">

            <div class="card card-penjualan shadow-sm p-3">

                <div class="table-responsive">
                    <table class="table table-bordered table-cart mb-3">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="cart">

                        </tbody>

                    </table>
                </div>

                <h3>
                    Total:
                    <span id="total">
                        Rp 0
                    </span>
                </h3>

                <form action="{{ route('penjualan.store') }}" method="POST">

                    @csrf

                    <div id="input-cart"></div>

                    <select name="metode_pembayaran"
                            id="metode-pembayaran"
                            class="form-control my-3"
                            required>

                        <option value="">
                            Pilih Pembayaran
                        </option>

                        <option value="cash">
                            Cash
                        </option>

                    </select>

                    <button class="btn btn-checkout w-100">
                        Checkout
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

let cart = [];

function rupiah(n){
    return "Rp " + Number(n).toLocaleString('id-ID');
}

document.querySelectorAll('.btn-tambah')
.forEach(btn=>{

btn.onclick=function(){

let card=this.closest('.product-item');

let id=card.dataset.id;
let nama=card.dataset.nama;
let harga=parseInt(card.dataset.harga);

let qty=parseInt(
card.querySelector('.input-qty-pilih').value
);

let cek=cart.find(x=>x.id==id);

if(cek){
    cek.qty+=qty;
}else{
    cart.push({
        id:id,
        nama:nama,
        harga:harga,
        qty:qty
    });
}

render();

}

});

function render(){

let html="";
let input="";
let total=0;

cart.forEach((item,index)=>{

let subtotal=item.harga*item.qty;

total+=subtotal;

html+=`
<tr>
<td>${item.nama}</td>
<td>
<button type="button" class="btn btn-danger btn-sm" onclick="ubahHarga(${index},-1000)">-</button>
<input type="number" value="${item.harga}" style="width:90px" onchange="hargaManual(${index},this.value)">
<button type="button" class="btn btn-success btn-sm" onclick="ubahHarga(${index},1000)">+</button>
</td>
<td>
<button type="button" onclick="ubahQty(${index},-1)">-</button>
${item.qty}
<button type="button" onclick="ubahQty(${index},1)">+</button>
</td>
<td>${rupiah(subtotal)}</td>
<td>
<button type="button" class="btn btn-danger btn-sm" onclick="hapus(${index})">Hapus</button>
</td>
</tr>
`;

input+=`
<input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
<input type="hidden" name="items[${index}][qty]" value="${item.qty}">
<input type="hidden" name="items[${index}][harga]" value="${item.harga}">
`;

});

document.getElementById('cart').innerHTML=html;
document.getElementById('input-cart').innerHTML=input;
document.getElementById('total').innerHTML=rupiah(total);

}

function ubahHarga(index,jumlah){
cart[index].harga += jumlah;
if(cart[index].harga < 0){ cart[index].harga=0; }
render();
}

function hargaManual(index,value){
cart[index].harga=parseInt(value);
render();
}

function ubahQty(index,jumlah){
cart[index].qty+=jumlah;
if(cart[index].qty<1){ cart[index].qty=1; }
render();
}

function hapus(index){
cart.splice(index,1);
render();
}

</script>

@endsection