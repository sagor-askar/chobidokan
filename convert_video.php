<?php
$content = file_get_contents('d:/laragon/www/chobidokan/resources/views/frontend/menu/imageDetails.blade.php');

// 1. Download Route
$content = str_replace('product.image-download', 'product.video-download', $content);

// 2. Main Media Preview
$imgTag = '<img src="{{ route(\'product.file.view\', $product->id) }}" alt="{{ $product->file_name }}" draggable="false">';
$videoTag = '<video id="productVideo" class="popup-image" style="max-height: 80vh; z-index: 1;" muted playsinline controlsList="nodownload" onmouseenter="this.play()" onmouseleave="this.pause(); this.currentTime=0;"><source src="{{ route(\'product.view.video\', $product->id) }}" type="{{ $product->file_type }}"></video>';
$content = str_replace($imgTag, $videoTag, $content);

// 3. Popup Media Preview
$popupImgTag = '<img src="{{ route(\'product.file.view\', $product->id) }}" class="popup-image" id="popupImgEl" alt="Full Preview">';
$popupVideoTag = '<video class="popup-image" id="popupImgEl" controls autoplay><source src="{{ route(\'product.view.video\', $product->id) }}" type="{{ $product->file_type }}"></video>';
$content = str_replace($popupImgTag, $popupVideoTag, $content);

// 4. Text Replacements
$content = str_replace('Similar Images', 'Similar Videos', $content);
$content = str_replace('Buy Single Image', 'Buy Single Video', $content);
$content = str_replace('Single Image', 'Single Video', $content);
$content = str_replace('multiple images? Save with an image pack.', 'multiple videos? Save with a video pack.', $content);
$content = preg_replace('/{{ \$sub->total_image }} {{ \$sub->total_image > 1 \? \'images\' : \'image\' }}/', '{{ $sub->total_image }} {{ $sub->total_image > 1 ? \'videos\' : \'video\' }}', $content);
$content = str_replace('subPricePerImage', 'subPricePerVideo', $content);
$content = str_replace('price_per_image', 'price_per_video', $content);
$content = str_replace('High-Res {{ strtoupper($product->file_type ?? \'JPG\') }}', 'HD {{ strtoupper($product->file_type ?? \'MP4\') }}', $content);

// 5. CSS for Similar items
$content = str_replace('.gallery-item img {', '.gallery-item img, .gallery-item video {', $content);
$content = str_replace('.gallery-item:hover img {', '.gallery-item:hover img, .gallery-item:hover video {', $content);

// 6. Similar Grid Loop Media Replacement
$vSnippet = '<div class="gallery-item position-relative overflow-hidden rounded shadow-lg"
                                 onmouseenter="const v=this.querySelector(\'video\'); if(v) v.play();"
                                 onmouseleave="const v=this.querySelector(\'video\'); if(v){ v.pause(); v.currentTime=0; }">
                                <a href="{{ route(\'product-details\', $similarProduct->id) }}">
                                    <video class="w-100 h-100" style="object-fit:cover;" muted playsinline preload="metadata">
                                        <source src="{{ route(\'product.view.video\', $similarProduct->id) }}" type="{{ $similarProduct->file_type }}">
                                    </video>
                                    <div class="position-absolute top-50 start-50 translate-middle text-white" style="z-index: 5; opacity: 0.8; pointer-events:none;">
                                        <i class="fa fa-play-circle fa-3x"></i>
                                    </div>
                                </a>';
$imgSnippet = '<div class="gallery-item position-relative overflow-hidden rounded shadow-lg">
                                <a href="{{ route(\'product-details\', $similarProduct->id) }}">
                                    <img src="{{ route(\'product.file.view\', $similarProduct->id) }}" alt="{{ $similarProduct->title }}">
                                </a>';

$content = str_replace($imgSnippet, $vSnippet, $content);

file_put_contents('d:/laragon/www/chobidokan/resources/views/frontend/menu/videoDetails.blade.php', $content);
echo "File updated successfully.";
