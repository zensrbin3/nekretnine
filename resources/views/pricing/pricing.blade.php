<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Paketi za oglašavanje nekretnina</h2>
            <p class="text-muted">
                Izaberi paket koji odgovara tvojim potrebama – bez skrivenih troškova.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Starter</h5>
                        <p class="text-muted small">
                            Idealno za privatna lica i povremeno oglašavanje.
                        </p>
                        <div class="my-4">
                            <span class="display-5 fw-bold">€10</span>
                            <span class="text-muted">/mesečno</span>
                        </div>
                        <ul class="list-unstyled text-start mb-4">
                            <li class="mb-2">✅ Do 3 aktivna oglasa</li>
                            <li class="mb-2">✅ Osnovna vidljivost</li>
                            <li class="mb-2">✅ Važenje oglasa 30 dana</li>
                            <li class="mb-2">✅ Email podrška</li>
                        </ul>
                        @php
                            $prices=
                            [
                                "Starter"=>"price_1Si2iTDee8lfP295kYvKLkVm",
                                "Company"=>"price_1Si2ipDee8lfP2950WUJFuvG" ,
                                "Enterprise"=>"price_1Si2j0Dee8lfP295xE24zHlr"
                            ]
                        @endphp
                        @if(auth()->user() && auth()->user()->subscribedToPrice($prices["Starter"]))
                            <div class="mt-auto p-3 text-center fw-bold rounded"
                                 style="background:#e9f7ef; color:#1e7e34;">
                                Kupili ste ovaj paket!
                            </div>
                        @else
                            <a href="{{ route('checkout','Starter') }}" class="btn btn-primary mt-auto">
                                Izaberi paket
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow border-primary text-center">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Company</h5>
                        <p class="text-muted small">
                            Najbolji izbor za agencije i aktivne prodavce.
                        </p>
                        <div class="my-4">
                            <span class="display-5 fw-bold">€25</span>
                            <span class="text-muted">/mesečno</span>
                        </div>
                        <ul class="list-unstyled text-start mb-4">
                            <li class="mb-2">✅ Do 20 aktivnih oglasa</li>
                            <li class="mb-2">✅ Istaknuti oglasi u pretrazi</li>
                            <li class="mb-2">✅ Statistika pregleda</li>
                            <li class="mb-2">✅ Prioritetna podrška</li>
                        </ul>
                        @if(auth()->user() && auth()->user()->subscribedToPrice($prices["Company"]))
                            <div class="mt-auto p-3 text-center fw-bold rounded"
                                 style="background:#e9f7ef; color:#1e7e34;">
                                Kupili ste ovaj paket!
                            </div>
                        @else
                            <a href="{{ route('checkout','Company') }}" class="btn btn-primary mt-auto">
                                Izaberi paket
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Enterprise</h5>
                        <p class="text-muted small">
                            Za velike agencije i profesionalne investitore.
                        </p>
                        <div class="my-4">
                            <span class="display-5 fw-bold">€50</span>
                            <span class="text-muted">/mesečno</span>
                        </div>
                        <ul class="list-unstyled text-start mb-4">
                            <li class="mb-2">✅ Neograničen broj oglasa</li>
                            <li class="mb-2">✅ Top pozicije na sajtu</li>
                            <li class="mb-2">✅ Brendirani profil agencije</li>
                            <li class="mb-2">✅ Telefonska i email podrška</li>
                        </ul>
                        @if(auth()->user() && auth()->user()->subscribedToPrice($prices["Enterprise"]))
                            <div class="mt-auto p-3 text-center fw-bold rounded"
                                 style="background:#e9f7ef; color:#1e7e34;">
                                Kupili ste ovaj paket!
                            </div>
                        @else
                            <a href="{{ route('checkout','Enterprise') }}" class="btn btn-primary mt-auto">
                                Izaberi paket
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
