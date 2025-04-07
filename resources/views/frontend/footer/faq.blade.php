@extends('includes.master')
@section('content')
<main class="main">
    <div class="faq-container">
        <h2>Frequently Asked Questions</h2>

        <main id="faq" class="container my-5 py-3">
            <h2 class="mb-5">Frequently Asked Questions</h2>

            <div class="accordion" id="faqAccordion">
                @foreach ($faq as $item)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                            {{ $item->question }}
                        </button>
                    </h2>
                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $item->id }}" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ $item->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</main>
@endsection
