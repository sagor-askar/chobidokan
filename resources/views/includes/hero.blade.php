<section id="hero" class="hero section">
    <div class="container">
        <!-- search box with dropdown -->
        <form action="{{ route('product.search') }}" method="GET">
        <div class="custom-input-group" style="display: flex; align-items: center; gap: 10px;">

            <!-- Dropdown -->
            <select class="custom-form-control" name="type" style="max-width: 10rem;">
                <option value="1" {{ (old('type', request()->query('type', 1)) == 1) ? 'selected' : '' }}>Image</option>
                <option value="2" {{ (old('type', request()->query('type')) == 2) ? 'selected' : '' }}>Videos</option>
            </select>

            <!-- Search Input -->
            <input type="text" class="custom-form-control" name="search"  value="{{ request()->query('search') }}" placeholder="SEARCH IMAGE HERE">

            <!-- Search Button -->
            <div class="custom-input-group-append">
                <button class="custom-btn" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        </form>
    </div>
</section>
