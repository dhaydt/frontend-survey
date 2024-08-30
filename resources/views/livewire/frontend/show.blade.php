<div>
    <div class="card card-body shadow-sm stepper">
        <x-survey-header name="{{ $survey['name'] }}" description="{{ $survey['description'] }}"></x-survey-header>

        <div class="header-hr"></div>

        @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
        @endif
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel row">
                <div class="stepwizard-step col-2">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-secondary-fill' : 'btn-primary-fill' }}">1</a>
                    <p>Isi Formulir</p>
                </div>
                <div class="stepwizard-step col-4">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-secondary-fill' : 'btn-primary-fill' }}">2</a>
                    <p>Data Responden</p>
                </div>
                <div class="stepwizard-step col-2">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-secondary-fill' : 'btn-primary-fill' }}"
                        disabled="disabled">3</a>
                    <p>Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content px-5 {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12 pt-2">

                @include('livewire.frontend.partials.form')

                <button
                    class="btn btn-primary-next mt-2 nextBtn pull-right d-flex justify-content-center align-items-center"
                    wire:click="firstStepSubmit" type="button">
                    <span>
                        Selanjutnya
                    </span>
                    <i class="fa-solid fa-arrow-right mt-1 ms-2"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row setup-content px-5 {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12 mt-3">
            <div class="col-md-12">
                @include('livewire.frontend.data_diri')
                <div class="d-flex mt-4">
                    <button class="btn btn-danger nextBtn pull-right my-0 me-3" type="button" wire:click="back(1)">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        <span>Sebelumnya</span>
                    </button>
                    <button
                        class="btn btn-primary-next nextBtn pull-right d-flex justify-content-center align-items-center"
                        type="button" wire:click="secondStepSubmit">
                        <span>
                            Selanjutnya
                        </span>
                        <i class="fa-solid fa-arrow-right mt-1 ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row setup-content px-5 {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="d-flex paper-plane flex-column justify-content-center align-items-center mt-5">
                    <div class="" style="height: 80px; width: 80px;">
                        <img src="{{ asset('asseets/images/paper-plane.png') }}" class="h-100 w-100" alt="">
                    </div>

                    <p class="first-color">Data Anda Telah Berhasil Terkirim</p>

                    <div class="d-flex flex-column justify-content-ceenter align-items-center mt-4">
                        <h3 class="text-secondary">Terima Kasih</h3>
                        <p class="second-color">Atas Partisipasinya</p>
                    </div>
                </div>



                <div class="d-flex mt-5 justify-content-center">
                    <button class="btn btn-primary-next d-flex nextBtn pull-right" type="button" wire:click="back(1)">
                        <span>Kembali</span>
                        <i class="fa-solid fa-arrow-right ms-2 mt-1"></i>
                    </button>
                    {{-- <button class="btn btn-primary-next d-flex justify-content-center align-items-center"
                        wire:click="submitForm" type="button">
                        <i class="fa-solid fa-save me-2"></i>
                        <span>Simpan</span>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    Livewire.on('scroll-top', function(){
        window.scrollTo(0, 0);
    })
</script>
<script>
    $(document).ready(function(){
        var loc = @this.need_location;
        if(loc == 1){
            getlocation();
        }
    })

    function getlocation(){

        navigator.geolocation.getCurrentPosition(success, error);

        function success(pos){
            console.log('pos',pos);

            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            const accuracy = pos.coords.accuracy;

            // var map = L.map('map').setView([lat, lng], 13);

            // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     maxZoom: 19,
            //     enableHighAccuracy : true,
            //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            // }).addTo(map);

            $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lng, function(data){
                console.log('add',data);
                var city = data.address.city;
                var postcode = data.address.postcode;
                var negara = data.address.country;
                var pulau = data.address.region;
                var kelurahan = data.address.village;
                var county = data.address.county;
                var display =  data.display_name;

                @this.set('city', city);
                @this.set('postcode', postcode);
                @this.set('negara', negara);
                @this.set('pulau', pulau);
                @this.set('kelurahan', kelurahan);
                @this.set('latitude', lat);
                @this.set('longitude', lng);
                @this.set('displayname', display);
                @this.set('county', county);
            });

            // L.marker([lat, lng]).addTo(map);
            // L.circle([lat, lng], { radius: accuracy}).addTo(map);
        }

        function error(err){
            console.log('err', err);

            if(err.code === 1){
                alert("Aktifkan Lokasi untuk Mengisi Survey");
                document.getElementById("question").innerHTML = "<h1 class='text-center'>Mohon Mengaktifkan Lokasi Untuk Mengisi Survey</h1>";
            }else{
                alert("Tidak Bisa Mengambil lokasi anda");
                document.getElementById("question").innerHTML = "Mohon Mengaktifkan Lokasi Untuk Mengisi Survey";
            }
        }

    }

</script>
@endpush
