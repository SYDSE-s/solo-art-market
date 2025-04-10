@extends('layouts.app')

<style>
    .card {
        padding: 10px;
    }
    .card-body {
        background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(0, 225, 255, 0.5));
        border-radius: 10px;
        padding: 2px !important;
    }
    .wrap {
        border-radius: 10px;
        background-color: white;
        padding: 10px
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4" id="capture">
                <div class="card">
                    <div class="card-body">
                        <div class="wrap">
                            <img src="{{ asset('img/kta.png') }}" height="100">
                            hello world
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-aqua mt-5" id="download-btn">Download sebagai Gambar</button>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById("download-btn").addEventListener("click", function () {
            let div = document.getElementById("capture");
    
            html2canvas(div).then(canvas => {
                let link = document.createElement("a");
                link.href = canvas.toDataURL("image/png");
                link.download = "screenshot.png";
                link.click();
            });
        });
    </script>
@endsection