<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('properties.advertising_packages') }}</h2>
            <p class="text-muted">{{ __('properties.choose_package') }}</p>
        </div>

        <div class="row g-4 justify-content-center">
            @php
                $prices = [
                    "Starter" => "price_1Si2iTDee8lfP295kYvKLkVm",
                    "Company" => "price_1Si2ipDee8lfP2950WUJFuvG",
                    "Enterprise" => "price_1Si2j0Dee8lfP295xE24zHlr"
                ];
            @endphp

            @foreach(['Starter','Company','Enterprise'] as $plan)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm text-center @if($plan=='Company') border-primary @endif">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ __('properties.' . strtolower($plan)) }}</h5>
                            <p class="text-muted small">{{ __('properties.' . strtolower($plan) . '_desc') }}</p>
                            <div class="my-4">
                                <span class="display-5 fw-bold">
                                    @if($plan=='Starter') €10 @elseif($plan=='Company') €25 @else €50 @endif
                                </span>
                                <span class="text-muted">{{ __('properties.monthly') }}</span>
                            </div>
                            <ul class="list-unstyled text-start mb-4">
                                @if($plan=='Starter')
                                    <li class="mb-2">✅ {{ __('properties.up_to_3_ads') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.basic_visibility') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.ad_valid_30_days') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.email_support') }}</li>
                                @elseif($plan=='Company')
                                    <li class="mb-2">✅ {{ __('properties.up_to_20_ads') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.featured_listings') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.view_stats') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.priority_support') }}</li>
                                @else
                                    <li class="mb-2">✅ {{ __('properties.unlimited_ads') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.top_positions') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.branded_profile') }}</li>
                                    <li class="mb-2">✅ {{ __('properties.phone_email_support') }}</li>
                                    <li class="mb-2" id="shouldWaitToFinishSubscription" style="display: none"></li>
                                @endif
                            </ul>

                            @if(auth()->user() && auth()->user()->subscribedToPrice($prices[$plan]))
                                <div class="mt-auto p-3 text-center fw-bold rounded"
                                     style="background:#e9f7ef; color:#1e7e34;">
                                    {{ __('properties.package_purchased') }}
                                </div>
                            @elseif(auth()->user() && !auth()->user()->subscribedToPrice($prices[$plan])
                                       && auth()->user()->subscribed('default'))
                                <a href="#"
                                   class="btn btn-secondary mt-auto wait-subscription-btn"
                                   data-ends-at="{{ auth()->user()->subscription('default')->ends_at }}">
                                    {{ __('properties.choose_package_btn') }}
                                </a>
                            @else
                                <a href="{{ route('checkout',$plan) }}" class="btn btn-primary mt-auto">
                                    {{ __('properties.choose_package_btn') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.wait-subscription-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const originalText = this.innerText;
            const originalClasses = this.className;
            const endsAt = this.dataset.endsAt;
            if (!endsAt) return;

            this.classList.remove('btn-secondary');
            this.classList.add('btn-warning');

            const diffMs = new Date(endsAt) - new Date();
            const diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));

            this.innerText = "{{ __('properties.wait_subscription_msg') }}".replace(':days', diffDays);

            setTimeout(() => {
                this.innerText = originalText;
                this.className = originalClasses;
            }, 3000);
        });
    });
</script>
