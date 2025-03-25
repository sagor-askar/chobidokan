@extends('includes.master')
@section('content')
    <main class="main">
        <div class="faq-container">
            <h2>Frequently Asked Questions</h2>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">
                        Does CRX ask for any upfront payment?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>We never request upfront payments for loan approval. The money is transferred immediately after
                            the
                            contract is signed.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        Do we lend to people with bad credit?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>CRX does not provide loans to individuals with bad credit.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        What is the loan approval timeframe?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>The approval process usually takes between 24 and 48 hours after submission.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        What documents are required?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Government ID, proof of address, and proof of income are required.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        Are there any hidden fees?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>No, all costs are clearly stated before signing the contract.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        Can I repay my loan early without penalty?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes, early repayment is allowed without any penalties.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        What are the interest rates?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Interest rates vary based on your credit profile and loan amount.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        How do I apply for a loan?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>You can apply online through our website by filling out the loan application form.</p>
                    </div>
                </div>

                <div class="faq-item hidden">
                    <button class="faq-question">
                        What happens if I miss a payment?
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Missing a payment may result in late fees and could affect your credit score.</p>
                    </div>
                </div>
            </div>

            <button id="viewMore">View More</button>
            <button id="viewLess" style="display: none;">View Less</button>
        </div>

    </main>
@endsection
