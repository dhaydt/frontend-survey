<style>
    .verify section {
        display: flex;
        flex-direction: column;
        /* flex-flow: row wrap; */
    }

    .verify section>div {
        flex: 1;
        padding: 0.5rem;
    }

    .verify input[type="radio"] {
        display: none;

        &:not(:disabled)~label {
            cursor: pointer;
        }

        &:disabled~label {
            color: hsla(150, 5%, 75%, 1);
            border-color: hsla(150, 5%, 75%, 1);
            box-shadow: none;
            cursor: not-allowed;
        }
    }

    .verify label {
        height: 100%;
        display: block;
        background: #f7f7f7;
        border: 2px solid #d9d9d9;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        color: #929292;
        margin: 4px;
        text-align: center;
        box-shadow: 0px 3px 10px -2px hsla(150, 5%, 65%, 0.5);
        position: relative;
    }

    .verify input[type="radio"]:checked+label {
        background: #f7f7f7;
        border: 2px solid #0C93BF;
    }

    .verify input[type="radio"]#control_05:checked+label {
        background: red;
        border-color: red;
    }

    .verify p {
        font-weight: 500;
    }


    @media only screen and (max-width: 700px) {
        .verify section {
            flex-direction: column;
        }
    }

</style>
<div class="card card-body dynamic overflow-hidden">
    <div class="">
        <label for="exampleInputEmail1" class="form-label required">Nama Anda :</label>
        <input type="text" placeholder="Masukan nama" name="name" wire:model.live="name" class="form-control ms-2"
            id="name" required>
        @error('name')
        <small class="error text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mt-3">
        <label for="" class="form-label required">Nomor Handphone</label>
        <input type="number" wire:model.live="phone" class="form-control">
        @error('phone')
        <small class="error text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="card card-body dynamic overflow-hidden mt-3 verify">
    <p class="second-color">Pilih Pengiriman Kode Verifikasi</p>
    <section>
        <div>
            <input type="radio" id="control_01" wire:model.live="type" name="select" value="message">
            <label for="control_01">
                <p class="mb-0">
                    <img src="{{ asset('asseets/images/sms.png') }}" alt="">
                    <span class="ms-2">
                        Pengiriman kode verifikasi vis SMS ke nomor handphone {{ $phone }}
                    </span>
                </p>
            </label>
        </div>
        <div>
            <input type="radio" id="control_02" wire:model.live="type" name="select" value="whatsapp">
            <label for="control_02">
                <p class="mb-0">
                    <img src="{{ asset('asseets/images/wa.png') }}" alt="">
                    <span class="ms-2">
                        Pengiriman kode verifikasi ke nomor whatsapp {{ $phone }}
                    </span>
                </p>
            </label>
        </div>
    </section>
    @error('type')
    <small class="error text-danger">{{ $message }}</small>
    @enderror
    <div class="d-flex ms-2">
        <button
            class="btn btn-primary-next mt-2 nextBtn pull-right d-flex justify-content-center align-items-center"
            wire:click="verifyNumber" type="button" {{ ($timer !== 0) || ($isVerified == 1) ? 'disabled' : '' }}>
            <span>
                Kirimkan
            </span>
            <i class="fa-solid fa-arrow-right mt-1 ms-2"></i>
        </button>
    </div>
</div>

<div class="card card-body dynamic overflow-hidden mt-3">
    <div class="mt-3">
        <label for="" class="form-label required">Masukan Kode Verifikasi yang dikirimkan ke nomor handphone anda</label>
        <input type="number" wire:model.live="receivedCode" class="form-control">
        @error('receivedCode')
        <small class="error text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="text-center mt-2 {{ $timer !== 1 ? 'd-none' : '' }}">
        <span class="second-color">
            Kirim ulang dalam waktu <span id="timer">00:59</span>
        </span>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="d-flex ms-2">
        <button
            class="btn btn-primary-next mt-2 nextBtn pull-right d-flex justify-content-center align-items-center"
            wire:click="postCode" type="button">
            <span>
                Kirimkan
            </span>
            <i class="fa-solid fa-arrow-right mt-1 ms-2"></i>
        </button>
    </div>
</div>
@push('js')
<script>
    Livewire.on('user_verified', function(){
        console.log('called');

        Swal.fire({
            title: 'Success!',
            text: 'Nomor berhasil diverifikasi',
            icon: 'success',
            confirmButtonText: 'Oke'
        })
    })
    Livewire.on('countdown', function(){
        function countdown(minutes) {
            var seconds = 60;
            var mins = minutes
            function tick() {
                //This script expects an element with an ID = "counter". You can change that to what ever you want.
                var counter = document.getElementById("timer");
                var current_minutes = mins-1
                seconds--;
                counter.innerHTML = '0' + current_minutes.toString() + ":" + (seconds < 10 ? "00" : "") + String(seconds);
                if( seconds > 0 ) {
                    setTimeout(tick, 1000);
                } else {
                    if(mins > 1){
                        countdown(mins-1);
                    }else{
                        @this.set('timer', 0)
                    }
                }
            }
            tick();
        }
        //You can use this script with a call to onclick, onblur or any other attribute you would like to use.
        countdown(01);//where n is the number of minutes required.
    })
</script>
@endpush
