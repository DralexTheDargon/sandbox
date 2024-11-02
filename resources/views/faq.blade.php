<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    @php
        function clickableLinks($text){
            $pattern = '/(https?:\/\/[^\s]+)/';
            return preg_replace($pattern, '<a href="$1" target="_blank">$1</a>', e($text));
        }
    @endphp

    
<div class="container">
    <h1 class="custom-primary mb-4 text-center">FAQs</h1>
    <p class="custom-primary mb-4 text-center">Frequently Asked Questions</p>
    <div class="accordion" id="faqAccordion">
        @foreach ($faqs as $index => $faq)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" 
                            type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapse{{ $index }}" 
                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                            aria-controls="collapse{{ $index }}">
                        {{ $faq->question }}
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                     aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {!! clickableLinks($faq->answer) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>