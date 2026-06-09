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
                            ['label' => 'Privacy Policy', 'url' => '#'],
                            ['label' => 'Terms & Conditions', 'url' => '#'],
                            ['label' => 'Disclaimer', 'url' => '#'],
                        ];
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
                            $socialLinks = $footerSettings->social_links ?? [
                                ['icon' => 'facebook', 'label' => 'Facebook', 'url' => '#'],
                                ['icon' => 'instagram', 'label' => 'Instagram', 'url' => '#'],
                                ['icon' => 'tiktok', 'label' => 'TikTok', 'url' => '#'],
                            ];
                        @endphp
                        @foreach($socialLinks as $social)
                            <li><a href="{{ $social['url'] ?? '#' }}" class="me-2"><i class="fab fa-{{ $social['icon'] ?? 'facebook' }}"></i> {{ $social['label'] ?? '' }}</a></li>
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
