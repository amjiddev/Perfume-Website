<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5><i class="fas fa-bottle-droplet"></i> {{ $footerSettings->company_name ?? 'Almukhtar Perfume' }}</h5>
                <p>{{ $footerSettings->company_description ?? 'Premium fragrances for the discerning taste.' }}</p>
            </div>
            <div class="col-md-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    @php
                        $quickLinks = $footerSettings->quick_links ?? [
                            ['label' => 'Home', 'url' => 'home'],
                            ['label' => 'Shop', 'url' => 'shop'],
                            ['label' => 'About', 'url' => 'about'],
                        ];
                    @endphp
                    @foreach($quickLinks as $link)
                        <li><a href="{{ route($link['url'] ?? '#') }}">{{ $link['label'] ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    @php
                        $serviceLinks = $footerSettings->customer_service_links ?? [
                            ['label' => 'Privacy Policy', 'url' => route('privacy-policy')],
                            ['label' => 'Terms & Conditions', 'url' => route('terms-and-conditions')],
                            ['label' => 'Disclaimer', 'url' => route('disclaimer')],
                        ];

                        foreach ($serviceLinks as &$link) {
                            if (($link['url'] ?? '#') === '#') {
                                if (($link['label'] ?? '') === 'Privacy Policy') {
                                    $link['url'] = route('privacy-policy');
                                } elseif (($link['label'] ?? '') === 'Terms & Conditions') {
                                    $link['url'] = route('terms-and-conditions');
                                } elseif (($link['label'] ?? '') === 'Disclaimer') {
                                    $link['url'] = route('disclaimer');
                                }
                            }
                        }
                        unset($link);
                    @endphp
                    @foreach($serviceLinks as $link)
                        <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Follow Us</h5>
                <div>
                    <ul>
                        @php
                            $socialLinks = [
                                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => $footerSettings->facebook_url ?? '#'],
                                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => $footerSettings->instagram_url ?? '#'],
                                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => $footerSettings->tiktok_url ?? '#'],
                            ];
                        @endphp
                        @foreach($socialLinks as $social)
                            @if($social['url'] && $social['url'] !== '#')
                                <li><a href="{{ $social['url'] }}" class="me-2" target="_blank" rel="noopener noreferrer"><i class="fab fa-{{ $social['icon'] }}"></i> {{ $social['label'] }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>{{ $footerSettings->copyright_text ?? '© 2024 Almukhtar Perfume. All rights reserved.' }}</p>
        </div>
    </div>
</footer>
